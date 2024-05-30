<?php
require 'function.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Mengambil semua kategori
$queryKategori = "SELECT * FROM kategori";
$resultKategori = $conn->query($queryKategori);

// Menentukan kategori yang dipilih (dari query string atau default)
$kategoriTerpilih = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';

// Mengambil data postingan berdasarkan kategori yang dipilih
if ($kategoriTerpilih == 'Semua') {
    $data = dataDashboard(); // Ambil semua data postingan
} else {
    $data = dataDashboard('kategori.nama', $kategoriTerpilih); // Ambil data postingan berdasarkan kategori
}



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <?php
    include 'komponen/nav.php';
    ?>

    <div class="dashboardHome container-fluid">
        <div class="row">
            <div class="menu col-lg-2 border-end">
                <h2 class="lato-bold biru text-center mt-4">CATEGORI</h2>
                <hr>
                <nav class="nav flex-column">
                    <a class="nav-link mb-1 montserrat-medium <?php echo $kategoriTerpilih == 'Semua' ? 'menu-aktif' : ''; ?>" href="?kategori=Semua">
                        <img src="img/all.png" alt="">
                        Semua
                    </a>
                    <!-- Link untuk kategori dari database -->
                    <?php while ($kategori = $resultKategori->fetch_assoc()) : ?>
                        <a class="nav-link mb-1 montserrat-medium <?php echo $kategoriTerpilih == $kategori['nama'] ? 'menu-aktif' : ''; ?>" href="?kategori=<?php echo htmlspecialchars($kategori['nama']); ?>">
                            <img src="img/<?php echo strtolower($kategori['nama']); ?>.png" alt="" width="24px">
                            <?php echo htmlspecialchars($kategori['nama']); ?>
                        </a>
                    <?php endwhile; ?>
                </nav>
            </div>
            <div class="post col-lg-6 ms-5">
                <h1 class="lato-black text-start mt-5">Ada yang ingin dicari?</h1>
                <a href="tambah.php" class="float-end me-5">
                    <button type="button" class="btn tombol-biru">
                        Tanya Sekarang!
                    </button>
                </a>
                <div class="mt-5">
                    <button type="button" class="btn tombol-oranye">Semua</button>
                    <button type="button" class="btn btn-outline-secondary sentuh-back-oranye">
                        <img src="img/koin.png" alt="" width="20px">
                    </button>
                    <button type="button" class="btn btn-outline-secondary sentuh-back-oranye">
                        <img src="img/reward.png" alt="" width="20px">
                    </button>
                </div>
                <hr>
                <?php foreach ($data as $d) : ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row">
                                    <img src="img/profileAbu.png" alt="" width="40px" height="40px">
                                    <p class="d-flex flex-column ms-2">
                                        <span class="lato-bold"><?php echo $d['nama_kategori']; ?></span>
                                        <span class="nunito-light kecil"><?php echo waktuBerlalu($d['created_at']); ?></span>
                                    </p>
                                </div>
                                <div class="d-flex flex-row">
                                    <button type="button" class="koin btn btn-outline-secondary d-flex flex-row align-items-center me-2">
                                        <img src="img/koin.png" alt="" width="20">
                                        <span class="ms-1 nunito-bold"><?php echo $d['koin']; ?></span>
                                    </button>
                                    <img src="img/radioButton.png" class="mt-2 ms-2 me-1" width="15px" height="15px">
                                    <p><?php echo $d['jenis_opsi']; ?></p>
                                </div>
                                <img src="img/more.png" alt="" height="24px" width="24px">
                            </div>
                            <p class="lato-light ms-5"><?php echo potongTeks($d['pertanyaan'], 60); ?></p>
                            </p>

                            <a href="jawab.php?post_id=<?php echo $d['post_id']; ?>">
                                <?php if (hitungJawabanDariPostId($d['post_id']) == $d['jumlah_orang'] || sudahMenjawab($d['post_id'], $_SESSION['user_id']) || $d['user_id'] == $_SESSION['user_id']) : ?>
                                    <button type="button" class="btn btn-outline-secondary sentuh-back-oranye float-end me-5">Lihat</button>
                                <?php else : ?>
                                    <button type="button" class="btn btn-outline-secondary sentuh-back-biru float-end me-5">Jawab</button>
                                <?php endif; ?>
                            </a>

                            <div class="d-flex flex-row ms-5 mt-4">
                                <img src="img/people.png" alt="" height="20px">
                                <p class="nunito-bold ms-1"><?php echo hitungJawabanDariPostId($d['post_id']); ?>/<?php echo $d['jumlah_orang']; ?></p>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-3">
                <div class="card mt-5">
                    <div class="card-body position-relative">
                        <img src="img/presentasi.png" alt="" class="mx-3">
                        <a href="">
                            <img src="img/moreV.png" alt="" class="position-absolute top-0 end-0 mt-3 me-3">
                        </a>

                        <div class="d-flex flex-row mt-3">
                            <p class="lato-bold">Pertanyaan Langsung</p>
                            <a href="" class="lato-regular mt-2 ms-5" style="text-decoration: none; font-size: 10px;">See all</a>
                        </div>

                        <div class="pertanyaanLangsung border rounded">
                            <button type="button" class="nunito-medium tombol-oranye float-end mt-4 me-3">Lihat</button>
                            <div class="keterangan">
                                <p class="d-flex flex-column ms-2 mt-2">
                                    <span class="lato-bold">Kesehatan</span>
                                    <span class="nunito-light kecil">15 menit lalu</span>
                                </p>
                                <div class="d-flex flex-row ms-3">
                                    <img src="img/people.png" alt="" height="15px">
                                    <p class="nunito-bold kecil ms-1">7/10</p>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>