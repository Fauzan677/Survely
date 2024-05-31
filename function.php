<?php
session_start();
# membuat koneksi
$conn = new mysqli('localhost', 'root', '', 'survely');

function daftar($data)
{
    global $conn;

    $username = $conn->real_escape_string($data['username']);
    $email = $conn->real_escape_string($data['email']);
    $tglLahir = $conn->real_escape_string($data['tglLahir']);
    $password = $conn->real_escape_string($data['password']);

    if (empty($username) || empty($email) || empty($tglLahir) || empty($password)) {
        return -1;
    }

    // Cek apakah username sudah ada
    $sql = "SELECT user_id FROM pengguna WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return 0;
    } else {
        // Hash password sebelum menyimpan
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Buat query untuk insert data
        $sql = "INSERT INTO pengguna (username, email, tgl_lahir, password, reward) VALUES ('$username', '$email', '$tglLahir', '$hashedPassword', 50)";

        $conn->query($sql);
        return $conn->affected_rows;
    }
}

function masuk($data)
{
    global $conn;

    $email = $data['email'];
    $password = $data['password'];

    if (empty($email) || empty($password)) {
        return -1;
    }

    // Lakukan sanitasi input
    $email = mysqli_real_escape_string($conn, $email);

    // Query untuk memeriksa keberadaan pengguna dengan email dan password yang sesuai
    $sql = "SELECT * FROM pengguna WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Password benar, atur session dan kembalikan true
            $_SESSION['user_id'] = $user['user_id'];
            return true;
        }
    }

    // Jika tidak ditemukan pengguna atau password tidak cocok, kembalikan false
    return false;
}

function tambah($data)
{
    global $conn;

    $pertanyaan = htmlspecialchars(trim($data['pertanyaan']), ENT_QUOTES);
    $jenisOpsi = htmlspecialchars(trim($data['jenisOpsi']), ENT_QUOTES);
    $kategori = htmlspecialchars(trim($data['kategori']), ENT_QUOTES);
    $jenisKoin = htmlspecialchars(trim($data['jenisKoin']), ENT_QUOTES);
    $koin = htmlspecialchars(trim($data['koin']), ENT_QUOTES);
    $umur = htmlspecialchars(trim($data['umur']), ENT_QUOTES);
    $orang = htmlspecialchars(trim($data['orang']), ENT_QUOTES);
    $user_id = $_SESSION['user_id'];
    if (isset($data['opsi'])) {
        $opsi = $data['opsi']; // Ini akan menjadi array berisi nilai input opsi
    }

    // Pemeriksaan apakah salah satu variabel kosong
    if (empty($pertanyaan) || empty($jenisOpsi) || empty($kategori) || empty($jenisKoin) || empty($koin) || empty($umur) || empty($orang) || empty($opsi)) {
        return -1;
    }

    // Mulai transaksi database
    $conn->begin_transaction();

    // Buat query SQL untuk memasukkan data ke dalam tabel postingan
    $sql_postingan = "INSERT INTO postingan 
                      VALUES ('', '$user_id', '$kategori', '$pertanyaan', '$jenisOpsi', '$jenisKoin', '$koin', '$umur', '$orang', NOW())";

    // Eksekusi perintah SQL untuk memasukkan data ke dalam tabel postingan
    if ($conn->query($sql_postingan) === TRUE) {
        // Ambil ID postingan yang baru saja dimasukkan
        $id_postingan = $conn->insert_id;

        // Simpan setiap opsi ke tabel opsi (contoh)
        foreach ($opsi as $nilaiOpsi) {
            $sqlOpsi = "INSERT INTO opsi (post_id, opsi) VALUES ($id_postingan, '$nilaiOpsi')";
            $conn->query($sqlOpsi);
        }

        // Kurangi koin dari pengguna
        $totalKoin = intval($koin) * intval($orang);
        $sql_update_koin = "UPDATE pengguna SET koin = koin - $totalKoin WHERE user_id = $user_id";
        $result_update_koin = $conn->query($sql_update_koin);

        // Periksa hasil pembaruan koin
        if ($result_update_koin) {
            // Commit transaksi jika semua operasi berhasil
            $conn->commit();
            return TRUE;
        } else {
            // Rollback transaksi jika ada operasi yang gagal
            $conn->rollback();
            return FALSE;
        }
    } else {
        // Rollback transaksi jika gagal memasukkan data postingan
        $conn->rollback();
        return FALSE;
    }
}

function ambilKoinReward($userId)
{
    global $conn; // Gunakan koneksi global

    // Query untuk mengambil nilai koin dan reward
    $query = "SELECT koin, reward FROM pengguna WHERE user_id = $userId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $koin = $row['koin'] !== null ? $row['koin'] : 0; // Jika NULL, kembalikan 0
        $reward = $row['reward'] !== null ? $row['reward'] : 0; // Jika NULL, kembalikan 0
        return ['koin' => $koin, 'reward' => $reward];
    } else {
        return ['koin' => 0, 'reward' => 0]; // Default value if no koin or reward is found
    }
}

function dataDashboard($whereColumn = null, $whereValue = null)
{
    global $conn;

    // Buat kueri SQL dasar untuk mengambil data dari tabel postingan, kategori, opsi, dan pengguna
    $sql = "SELECT postingan.*, kategori.nama AS nama_kategori, opsi.opsi_id AS opsi_id, opsi.opsi, pengguna.username 
            FROM postingan
            LEFT JOIN kategori ON postingan.kategori_id = kategori.kategori_id
            LEFT JOIN opsi ON postingan.post_id = opsi.post_id
            LEFT JOIN pengguna ON postingan.user_id = pengguna.user_id";

    // Tambahkan klausa WHERE jika kolom dan nilai diberikan
    if ($whereColumn !== null && $whereValue !== null) {
        // Pastikan untuk menyanitasi input sebelum menggunakannya dalam kueri SQL
        $whereColumn = $conn->real_escape_string($whereColumn);
        $whereValue = $conn->real_escape_string($whereValue);
        $sql .= " WHERE $whereColumn = '$whereValue'";
    }

    // Jalankan kueri SQL
    $result = $conn->query($sql);

    // Periksa jika kueri berhasil dieksekusi
    if ($result === FALSE) {
        return FALSE; // Kembalikan FALSE jika terjadi kesalahan
    }

    // Buat array untuk menyimpan hasil query
    $data = array();

    // Ambil setiap baris hasil query dan masukkan ke dalam array
    while ($row = $result->fetch_assoc()) {
        // Jika post_id belum ada di array, buat entri baru
        if (!isset($data[$row['post_id']])) {
            $data[$row['post_id']] = $row;
            $data[$row['post_id']]['opsi'] = array();
        }
        // Tambahkan opsi ke array opsi dari post_id yang sama
        if ($row['opsi_id'] !== null) {
            $data[$row['post_id']]['opsi'][] = array(
                'opsi_id' => $row['opsi_id'],
                'opsi' => $row['opsi']
            );
        }
    }

    // Kembalikan array yang berisi hasil query, dengan reindex untuk menghapus kunci post_id
    return array_values($data);
}

date_default_timezone_set('Asia/Jakarta');

function waktuBerlalu($waktu)
{
    $waktu = strtotime($waktu);
    $selisih = time() - $waktu;

    if ($selisih < 1) {
        return 'kurang dari 1 detik yang lalu';
    }

    $kondisi = array(
        12 * 30 * 24 * 60 * 60 => 'tahun',
        30 * 24 * 60 * 60      => 'bulan',
        24 * 60 * 60           => 'hari',
        60 * 60                => 'jam',
        60                     => 'menit',
        1                      => 'detik'
    );

    foreach ($kondisi as $secs => $str) {
        $d = $selisih / $secs;

        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? ' yang lalu' : ' yang lalu');
        }
    }
}

function potongTeks($text, $maxLength)
{
    if (strlen($text) > $maxLength) {
        return substr($text, 0, $maxLength) . "...";
    } else {
        return $text;
    }
}

function hitungJawabanDariPostId($postId)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM jawaban WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}

function simpanJawaban($user_id, $post_id, $opsi_id, $koin)
{
    global $conn;

    // Siapkan kueri SQL INSERT
    $sql = "INSERT INTO jawaban (user_id, post_id, opsi_id) VALUES ('$user_id', '$post_id', '$opsi_id')";

    // Jalankan kueri SQL
    if ($conn->query($sql) === TRUE) {
        // Jika berhasil memasukkan jawaban, update kolom koin pada tabel pengguna
        $updateKoinSql = "UPDATE pengguna SET koin = IFNULL(koin, 0) + $koin WHERE user_id = $user_id";
        if ($conn->query($updateKoinSql) === TRUE) {
            return true;
        } else {
            // Gagal mengupdate koin, Anda dapat mengembalikan false atau menambahkan logging untuk menangani kesalahan
            return false;
        }
    } else {
        return false;
    }
}

function sudahMenjawab($post_id, $user_id)
{
    global $conn;

    $post_id = (int)$post_id;
    $user_id = (int)$user_id;

    $sql = "SELECT COUNT(*) as count FROM jawaban WHERE post_id = $post_id AND user_id = $user_id";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        return FALSE; // Atau tangani kesalahan sesuai kebutuhan Anda
    }

    $row = $result->fetch_assoc();

    return $row['count'] > 0;
}

function beliKoin($userId, $jumlah, $sumberDana, $total)
{
    global $conn;

    // Query untuk memasukkan data ke tabel beli_koin
    $query = "INSERT INTO beli_koin (user_id, jumlah, sumber_dana, total) VALUES ('$userId', '$jumlah', '$sumberDana', '$total')";

    if ($conn->query($query) === TRUE) {
        // Mengupdate kolom koin di tabel pengguna
        $queryUpdate = "UPDATE pengguna SET koin = IFNULL(koin, 0) + $jumlah WHERE user_id = $userId";
        if ($conn->query($queryUpdate) === TRUE) {
            return true; // Berhasil membeli koin dan mengupdate koin
        } else {
            return false; // Gagal mengupdate koin
        }
    } else {
        return false; // Gagal memasukkan data ke tabel beli_koin
    }
}

// Function to handle coin withdrawal
function tarikKoin($userId, $jumlah, $sumberDana, $rekeningTujuan, $total) {
    global $conn;

    // Start a database transaction
    $conn->begin_transaction();

    // Insert data into tarik_koin table
    $queryTarikKoin = "INSERT INTO tarik_koin (user_id, jumlah, sumber_dana, rekening_tujuan, total) 
                       VALUES ('$userId', '$jumlah', '$sumberDana', '$rekeningTujuan', '$total')";

    // Update koin in pengguna table
    $queryUpdateKoin = "UPDATE pengguna SET koin = koin - $jumlah WHERE user_id = $userId";

    // Perform both queries
    $resultTarikKoin = $conn->query($queryTarikKoin);
    $resultUpdateKoin = $conn->query($queryUpdateKoin);

    // Check if both queries were successful
    if ($resultTarikKoin && $resultUpdateKoin) {
        // Commit the transaction
        $conn->commit();
        return true; // Successfully completed transaction
    } else {
        // Rollback the transaction
        $conn->rollback();
        return false; // Failed to complete transaction
    }
}

function getOpsiStats($post_id) {
    global $conn;
    
    // Sanitize the input
    $post_id = $conn->real_escape_string($post_id);

    // Create the SQL query
    $sql = "
        SELECT j.opsi_id, o.opsi, COUNT(j.opsi_id) AS jumlah
        FROM jawaban j
        JOIN opsi o ON j.opsi_id = o.opsi_id
        WHERE j.post_id = '$post_id'
        GROUP BY j.opsi_id, o.opsi
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result === FALSE) {
        return FALSE;
    }

    // Fetch all results into an associative array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function hapusPostingan($post_id) {
    global $conn;

    // Sanitize the input
    $post_id = $conn->real_escape_string($post_id);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete from opsi table
        $sqlOpsi = "DELETE FROM opsi WHERE post_id = '$post_id'";
        if (!$conn->query($sqlOpsi)) {
            throw new Exception("Error deleting from opsi: " . $conn->error);
        }

        // Delete from jawaban table (if exists)
        $sqlJawaban = "DELETE FROM jawaban WHERE post_id = '$post_id'";
        if (!$conn->query($sqlJawaban)) {
            throw new Exception("Error deleting from jawaban: " . $conn->error);
        }

        // Delete from postingan table
        $sqlPostingan = "DELETE FROM postingan WHERE post_id = '$post_id'";
        if (!$conn->query($sqlPostingan)) {
            throw new Exception("Error deleting from postingan: " . $conn->error);
        }

        // Commit transaction
        $conn->commit();
        return true;
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        return false;
    }
}
