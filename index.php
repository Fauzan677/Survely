<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survely | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid py-2">
            <img class="ms-5" src="img/logo.png" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link sentuh-col-oranye" href="#beranda">Beranda</a>
                    <a class="nav-link sentuh-col-oranye" href="#tentang">Tentang Kami</a>
                    <a class="nav-link sentuh-col-oranye" href="#kategori">Kategori</a>
                    <a class="nav-link sentuh-col-oranye" href="#kontak">Kontak</a>
                </div>
                <div class="navbar-nav ms-auto me-5">
                    <a class="nav-link me-1 sentuh-back-oranye" href="register.php">Daftar</a>
                    <a href="login.php">
                        <button type="button" class="btn tombol-biru">
                            Masuk
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="header container-fluid mt-3" id="beranda">
        <div class="row">
            <div class="col-md-5 offset-1 mt-5">
                <h1 class="lato-black mt-5">Berkolaborasi, Mengumpulkan Wawasan</h1>
                <p class="montserrat-semibold biru">Survely adalah tempat untuk memfasilitasi pengumpulan data kuesioner secara kolaboratif. Kuesioner Mudah Dibuat, Mudah Dijawab!</p>
                <button type="button" class="btn tombol-oranye mt-3">Coba Sekarang</button>
            </div>
            <div class="col-md-4">
                <img src="img/header.png" alt="" width="500px" height="600px">
            </div>
        </div>
    </div>

    <div class="tentang container-fluid mt-3 pt-5" id="tentang">
        <h3 class="lato-bold text-center">Kenapa Kami?</h3>
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-3">
                <div class="card rounded-3">
                    <div class="card-body text-center">
                        <img src="img/mudah.png" alt="">
                        <h5 class="card-title oranye lato-regular mt-2">Mudah</h5>
                        <p class="card-text text-center lato-regular">Kemudahan dengan antarmuka intuitif, pengisian kuesioner yang cepat, panduan pengguna lengkap, dan dukungan pelanggan yang responsif.</p>
                        <button type="button" class="btn tombol-outline-oranye">
                            Lihat
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card rounded-3">
                    <div class="card-body text-center">
                        <img src="img/aman.png" alt="">
                        <h5 class="card-title oranye lato-regular mt-2">Aman</h5>
                        <p class="card-text text-center lato-regular">Menjamin keamanan data dengan enkripsi canggih, perlindungan privasi pengguna, pemantauan berkelanjutan</p>
                        <button type="button" class="btn tombol-outline-oranye mt-4">
                            Lihat
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card rounded-3">
                    <div class="card-body text-center">
                        <img src="img/kredibel.png" alt="">
                        <h5 class="card-title oranye lato-regular mt-2">Kredibel</h5>
                        <p class="card-text text-center lato-regular">Memastikan kredibilitas dengan validasi responden, metode pengumpulan data yang terstandar, dan dukungan dari para ahli di bidang penelitian.</p>
                        <button type="button" class="btn tombol-outline-oranye">
                            Lihat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="categori container" id="kategori">
        <h3 class="lato-bold text-center biru mt-5">Siapa Yang Kami Bantu?</h3>
        <p class="lato-regular text-center">Jika Anda memerlukan data dari kategori dibawah, kami bisa membantu</p>
        <div class="row d-flex justify-content-evenly mt-5">
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Kesehatan.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Kesehatan</p>
            </div>
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Pendidikan.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Pendidikan</p>
            </div>
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Keuangan.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Keuangan</p>
            </div>
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Sosial.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Sosial</p>
            </div>
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Kenegaraan.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Kenegaraan</p>
            </div>
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Perusahaan.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Perusahaan</p>
            </div>
        </div>

        <div class="row justify-content-evenly mt-4">
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Lingkungan.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Lingkungan</p>
            </div>
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Budaya.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Budaya</p>
            </div>
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Teknologi.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Teknologi</p>
            </div>
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Transportasi.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Transportasi</p>
            </div>
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Pariwisata.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">Pariwisata</p>
            </div>
            <div class="col-md-1 text-center kategori">
                <div class="card rounded-5 kartu-kategori">
                    <div class="card-body">
                        <img src="img/Psikologi.png" alt="">
                    </div>
                </div>
                <p class="lato-regular">psikologi</p>
            </div>
        </div>
    </div>

    <div class="footer container-fluid mt-5" id="kontak">
        <div class="row">
            <div class="col-md-4 offset-md-1 mt-5">
                <img src="img/survely_putih.png" class="ms-3 kategori" alt="">
                <div class="mt-3">
                    <img src="img/facebook.png" alt="" class="kategori">
                    <img src="img/instagram.png" class="ms-2 kategori" alt="">
                    <img src="img/twitter.png" class="ms-2 kategori" alt="">
                    <img src="img/linkedin.png" class="ms-2 kategori" alt="">
                </div>
            </div>

            <div class="col-md-3 mt-4">
                <p class="lato-bold">INFORMASI</p>
                <ul>
                    <li>
                        Home
                    </li>
                    <li>
                        Pertanyaan
                    </li>
                    <li>
                        Hubungi Kami
                    </li>
                    <li>
                        Tentang Kami
                    </li>
                </ul>
            </div>

            <div class="col-md-3 mt-4">
                <p class="lato-bold">KONTAK</p>
                <ul>
                    <li>
                        <img src="img/location.svg" class="me-3 kategori" alt="">
                        Yogyakarta
                    </li>
                    <li class="mt-2">
                        <img src="img/phone.svg" class="me-3 kategori" alt="">
                        08123456789
                    </li>
                    <li class="mt-2">
                        <img src="img/mail.svg" class="me-3 kategori" alt="">
                        Survely@gmail.com
                    </li>
                </ul>
            </div>
        </div>

        <hr class="mx-auto mt-5">

        <p style="text-align: center; color: white">&copy; 2023 Survely All Rights Reserved.</p>
    </div>

    <script src="JS/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>