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
        $sql = "INSERT INTO pengguna (username, email, tgl_lahir, password) VALUES ('$username', '$email', '$tglLahir', '$hashedPassword')";

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
    if( isset($data['opsi']) ) {
        $opsi = $data['opsi']; // Ini akan menjadi array berisi nilai input opsi
    }

    // Pemeriksaan apakah salah satu variabel kosong
    if (empty($pertanyaan) || empty($jenisOpsi) || empty($kategori) || empty($jenisKoin) || empty($koin) || empty($umur) || empty($orang) || empty($opsi)) {
        return -1;
    }

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

        return TRUE;
    } else {
        return FALSE;
    }
}

function ambilData($data, $id = null)
{
    global $conn;

    // Buat kueri SQL dasar
    $sql = "SELECT * FROM $data";

    // Tambahkan filter WHERE jika ID disediakan
    if ($id !== null) {
        $id = intval($id); // Pastikan ID adalah integer untuk keamanan
        $sql .= " WHERE id = $id";
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
        $data[] = $row;
    }

    // Kembalikan array yang berisi hasil query
    return $data;
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

function waktuBerlalu($waktu) {
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

function potongTeks($text, $maxLength) {
    if (strlen($text) > $maxLength) {
        return substr($text, 0, $maxLength) . "...";
    } else {
        return $text;
    }
}

function hitungJawabanDariPostId($postId) {
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM jawaban WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}

function simpanJawaban($user_id, $post_id, $opsi_id) {
    global $conn;

    // Siapkan kueri SQL INSERT
    $sql = "INSERT INTO jawaban (user_id, post_id, opsi_id) VALUES ('$user_id', '$post_id', '$opsi_id')";

    // Jalankan kueri SQL
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function sudahMenjawab($post_id, $user_id) {
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