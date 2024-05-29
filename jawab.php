<?php
require 'function.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
} else {
    // Tangani jika post_id tidak disediakan di URL.
    echo "Post ID tidak ditemukan.";
}

if (dataDashboard('postingan.post_id', $post_id) !== FALSE) {
    $data = dataDashboard('postingan.post_id', $post_id);
} else {
    echo "Error";
}

if (isset($_POST['jawab']) && isset($_POST['opsi'])) {
    // Tangani nilai yang dipilih dari formulir
    $opsi_id = $_POST['opsi'];
    $user_id = $_SESSION['user_id'];
    $post_id = $_GET['post_id'];

    // Panggil fungsi untuk menyimpan jawaban
    if (simpanJawaban($user_id, $post_id, $opsi_id)) {
        // Redirect ke halaman dashboard.php jika jawaban berhasil disimpan
        header("Location: dashboard.php");
        exit(); // Pastikan tidak ada kode berikutnya yang dieksekusi setelah redirect
    } else {
        echo "Gagal menyimpan jawaban.";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menjawab</title>
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
                    <a class="nav-link montserrat-medium mb-1" href="#">
                        <img src="img/all.png" alt="">
                        Semua
                    </a>
                    <?php foreach ($data as $d) : ?>
                        <a href="#" class="nav-link montserrat-medium mb-1 <?php echo $d['nama_kategori'] == 'Kesehatan' ? 'menu-aktif' : '' ?>">
                            <img src="img/kesehatan.png" alt="" width="24px">
                            Kesehatan
                        </a>
                        <a href="#" class="nav-link montserrat-medium mb-1 <?php echo $d['nama_kategori'] == 'Pendidikan' ? 'menu-aktif' : '' ?>">
                            <img src="img/pendidikan.png" alt="" width="24px">
                            Pendidikan
                        </a>
                        <a class="nav-link montserrat-medium mb-1" href="#">
                            <img src="img/keuangan.png" alt="" width="24px">
                            Keuangan
                        </a>
                    <?php endforeach; ?>
                </nav>
            </div>
            <div class="post col-lg-6">
                <?php foreach ($data as $d) : ?>
                    <div class="card mt-5 ms-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row">
                                    <img src="img/profileAbu.png" alt="" width="40px" height="40px">
                                    <p class="d-flex flex-column ms-2">
                                        <span class="lato-bold"><?php echo $d['username']; ?></span>
                                        <span class="nunito-light kecil"><?php echo waktuBerlalu($d['created_at']); ?></span>
                                    </p>
                                </div>
                                <div class="d-flex flex-row">
                                    <button type="button" class="koin btn btn-outline-secondary d-flex flex-row align-items-center me-2">
                                        <img src="img/koin.png" alt="" width="20">
                                        <span class="ms-1 nunito-bold"><?php echo $d['koin']; ?></span>
                                    </button>
                                    <img src="img/people.png" alt="" class="mt-1 ms-2 me-1" height="20px">
                                    <p class="nunito-bold mt-1" style="font-size: small"><?php echo hitungJawabanDariPostId($d['post_id']); ?>/<?php echo $d['jumlah_orang']; ?></p>
                                </div>
                                <a href="">
                                    <img src="img/more.png" alt="" height="24px" width="24px">
                                </a>
                            </div>
                            <p class="lato-light ms-5"><?php echo $d['pertanyaan']; ?></p>
                            <hr>

                            <form action="" method="post" class="ms-5">
                                <?php foreach ($d['opsi'] as $opsi) : ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="opsi" id="opsi_<?php echo $opsi['opsi_id']; ?>" value="<?php echo $opsi['opsi_id']; ?>" <?php echo (hitungJawabanDariPostId($d['post_id']) == $d['jumlah_orang'] || sudahMenjawab($d['post_id'], $_SESSION['user_id']) || $d['user_id'] == $_SESSION['user_id']) ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="opsi_<?php echo $opsi['opsi_id']; ?>">
                                            <?php echo htmlspecialchars($opsi['opsi']); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                                <?php if (hitungJawabanDariPostId($d['post_id']) != $d['jumlah_orang'] && !sudahMenjawab($d['post_id'], $_SESSION['user_id']) && $d['user_id'] != $_SESSION['user_id']) : ?>
                                    <button type="submit" class="btn tombol-biru float-end me-5" name="jawab">Jawab</button>
                                <?php endif; ?>
                            </form>

                            <hr class="mt-5">

                            <div class="d-flex flex-row ms-5">
                                <img src="img/profileAbu.png" alt="" width="30px" height="30px">
                                <div class="form-floating-sm ms-3" style="width: 75%;">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="komentar">
                                    <label for="floatingInput"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <p class="lato-bold">Pertanyaan Langsung</p>
                            <a href="" class="lato-regular ms-1 mt-2" style="text-decoration: none; font-size: 10px;">See all</a>
                            <img src="img/refresh.png" class="mt-2 ms-4 float-end" width="15px" height="15px">
                        </div>

                        <div class="pertanyaanLain border rounded">
                            <div class="keterangan d-flex flex-row justify-content-between align-items-center">
                                <p class="d-flex flex-column ms-2 mt-2">
                                    <span class="lato-bold">Kesehatan</span>
                                    <span class="nunito-light kecil">15 menit lalu</span>
                                </p>
                                <button type="button" class="koin btn btn-outline-secondary d-flex flex-row align-items-center my-auto">
                                    <img src="img/koin.png" alt="" width="15">
                                    <span class="ms-1 nunito-bold">5</span>
                                </button>
                                <div class="mb-2 me-4">
                                    <img src="img/radioButton.png" class=" me-1" width="15px" height="15px">
                                    <p style="font-size: 70%" class=" d-inline">Pilihan Ganda</p>
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