<?php
require 'function.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];


$data = ambilUserDariId($user_id);
$jumlahPertanyaan = hitungKolom('postingan', 'user_id', $user_id);
$jumlahJawaban = hitungKolom('jawaban', 'user_id', $user_id);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survely | Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <?php
    include 'komponen/nav.php';
    ?>

    <div class="dashboardHome container-fluid">
        <div class="row">
            <div class="menu col-lg-2 border-end ">
                <div class="row mt-3">
                    <div class="col text-center">
                        <img src="img/profileAbu.png" alt="" width="100px" height="100px" class="mb-2">
                        <p class="lato-bold"><?php echo $data['username'];?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5 text-center">
                        <p class="lato-light">Pertanyaan</p>
                        <p class="lato-bold"><?php echo $jumlahPertanyaan;?></p>
                    </div>
                    <div class="col-lg-2 d-flex justify-content-center">
                        <hr class="vertical-hr">
                    </div>
                    <div class="col-lg-5 text-center">
                        <p class="lato-light">Jawaban</p>
                        <p class="lato-bold"><?php echo $jumlahJawaban;?></p>
                    </div>
                    <hr class="mx-auto w-75">
                </div>

                <nav class="nav flex-column">
                    <a class="nav-link montserrat-medium menu-aktif mb-1" href="#">
                        <img src="img/all.png" alt="">
                        Profil
                    </a>
                    <a class="nav-link montserrat-medium mb-1" href="#">
                        <img src="img/kesehatan.png" alt="" width="24px">
                        Pertanyaan
                    </a>
                    <a class="nav-link montserrat-medium mb-1" href="#">
                        <img src="img/pendidikan.png" alt="" width="24px">
                        Jawaban
                    </a>
                    <a class="nav-link montserrat-medium mb-1" href="koin.php">
                        <img src="img/keuangan.png" alt="" width="24px">
                        Koinku
                    </a>
                    <a class="nav-link montserrat-medium mb-1" href="#">
                        <img src="img/analisis.png" alt="" width="24px">
                        Analisis
                    </a>
                    <a class="nav-link montserrat-medium mb-1" href="#">
                        <img src="img/bantuan.png" alt="" width="24px">
                        Bantuan
                    </a>
                    <a class="nav-link montserrat-medium" href="keluar.php">
                        <img src="img/keluar.png" alt="" width="24px">
                        Keluar
                    </a>
                </nav>
            </div>

            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-4 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="lato-bold mb-4">Tentang</h3>
                                <div class="d-flex flex-row border-bottom">
                                    <img src="img/user.svg" alt="" width="30px" height="30px">
                                    <p class="ms-3 lato-regular"><?php echo ($data['jenis_kelamin']) ? $data['jenis_kelamin'] : '...';?></p>
                                </div>
                                <div class="d-flex flex-row border-bottom mt-3">
                                    <img src="img/birthday.svg" alt="" width="30px" height="30px">
                                    <p class="ms-3 lato-regular"><?php echo ($data['tgl_lahir']) ? $data['tgl_lahir'] : '...';?></p>
                                </div>
                                <div class="d-flex flex-row border-bottom mt-3">
                                    <img src="img/location.svg" alt="" width="30px" height="30px">
                                    <p class="ms-3 lato-regular"><?php echo ($data['lokasi']) ? $data['lokasi'] : '...';?></p>
                                </div>
                                <div class="d-flex flex-row border-bottom mt-3">
                                    <img src="img/mail.svg" alt="" width="30px" height="30px">
                                    <p class="ms-3 lato-regular"><?php echo ($data['email']) ? $data['email'] : '...';?></p>
                                </div>
                                <div class="d-flex flex-row border-bottom mt-3">
                                    <img src="img/phone.svg" alt="" width="30px" height="30px">
                                    <p class="ms-3 lato-regular"><?php echo ($data['no_telepon']) ? $data['no_telepon'] : '...';?></p>
                                </div>
                                <div class="mt-3 ms-5">
                                    <button type="button" class="btn tombol-biru">Verifikasi</button>
                                    <button type="button" class="btn tombol-oranye ms-3">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4">
                        <div class="card">
                            <div class="card-body follow">
                                <h3 class="lato-bold mb-4">Mengikuti</h3>
                                <div class="d-flex flex-row">
                                    <img src="img/profileAbu.png" alt="" height="30px">
                                    <p class="d-flex flex-column ms-2">
                                        <span class="lato-bold">Najib</span>
                                        <span class="nunito-light kecil">najib@gmail.com</span>
                                    </p>
                                    <p class="border rounded keterangan mt-1 ms-auto">
                                        Mengikuti
                                    </p>
                                    <img src="img/moreV.png" alt="" height="20px" class="mt-1 ms-3">
                                </div>
                                <div class="d-flex flex-row">
                                    <img src="img/profileAbu.png" alt="" height="30px">
                                    <p class="d-flex flex-column ms-2">
                                        <span class="lato-bold">Najib</span>
                                        <span class="nunito-light kecil">najib@gmail.com</span>
                                    </p>
                                    <p class="border rounded keterangan mt-1 ms-auto">
                                        Mengikuti
                                    </p>
                                    <img src="img/moreV.png" alt="" height="20px" class="mt-1 ms-3">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4">
                        <div class="card">
                            <div class="card-body follow">
                                <h3 class="lato-bold mb-4">Pengikut</h3>
                                <div class="d-flex flex-row">
                                    <img src="img/profileAbu.png" alt="" height="30px">
                                    <p class="d-flex flex-column ms-2">
                                        <span class="lato-bold">Najib</span>
                                        <span class="nunito-light kecil">najib@gmail.com</span>
                                    </p>
                                    <p class="border rounded keterangan mt-1 ms-auto">
                                        Hapus
                                    </p>
                                    <img src="img/moreV.png" alt="" height="20px" class="mt-1 ms-3">
                                </div>
                                <div class="d-flex flex-row">
                                    <img src="img/profileAbu.png" alt="" height="30px">
                                    <p class="d-flex flex-column ms-2">
                                        <span class="lato-bold">Najib</span>
                                        <span class="nunito-light kecil">najib@gmail.com</span>
                                    </p>
                                    <p class="border rounded keterangan mt-1 ms-auto">
                                        Hapus
                                    </p>
                                    <img src="img/moreV.png" alt="" height="20px" class="mt-1 ms-3">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pb-5">
                    <div class="col-lg-6 mt-4 pertanyaan">
                        <div class="card">
                            <div class="card-body d-flex flex-column">
                                <h3 class="lato-bold">Pertanyaan</h3>
                                <a href="" class="text-decoration-none ms-auto me-3">See all</a>
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row">
                                                <img src="img/profileAbu.png" alt="" width="30px" height="30px">
                                                <p class="d-flex flex-column ms-2">
                                                    <span class="lato-bold">Kesehatan</span>
                                                    <span class="nunito-light kecil">15 menit lalu</span>
                                                </p>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <button type="button" class="koin btn btn-outline-secondary d-flex flex-row align-items-center justify-content-center me-2 mt-1">
                                                    <img src="img/koin.png" alt="" width="10">
                                                    <span class="ms-1 nunito-bold">5</span>
                                                </button>
                                                <div class="d-flex flex-row align-items-center">
                                                    <img src="img/radioButton.png" class="ms-2 me-1 mb-3" width="15px" height="15px">
                                                    <p class="kecil">Pilihan Ganda</p>
                                                </div>

                                            </div>
                                            <img src="img/more.png" alt="" height="24px" width="24px">
                                        </div>
                                        <p class="lato-light ms-3 keterangan">Apa yang kamu lakukan ketika kamu merasakan keluhan kesehatan?</p>


                                        <div class="perintah d-flex flex-row float-end">
                                            <button type="button" class="btn btn-outline-secondary d-flex align-items-center me-2 kecil sentuh-back-oranye">Hentikan</button>
                                            <button type="button" class="btn btn-outline-secondary d-flex align-items-center me-5 kecil sentuh-back-biru">Lihat</button>
                                        </div>



                                        <div class="d-flex flex-row ms-5 mt-4">
                                            <img src="img/people.png" alt="" height="15px">
                                            <p class="nunito-bold kecil ms-1">7/10</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4 pertanyaan">
                        <div class="card">
                            <div class="card-body d-flex flex-column">
                                <h3 class="lato-bold">Jawaban</h3>
                                <a href="" class="text-decoration-none ms-auto me-3">See all</a>
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row">
                                                <img src="img/profileAbu.png" alt="" width="30px" height="30px">
                                                <p class="d-flex flex-column ms-2">
                                                    <span class="lato-bold">Kesehatan</span>
                                                    <span class="nunito-light kecil">15 menit lalu</span>
                                                </p>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <button type="button" class="koin btn btn-outline-secondary d-flex flex-row align-items-center justify-content-center me-2 mt-1">
                                                    <img src="img/koin.png" alt="" width="10">
                                                    <span class="ms-1 nunito-bold">5</span>
                                                </button>
                                                <div class="d-flex flex-row align-items-center">
                                                    <img src="img/radioButton.png" class="ms-2 me-1 mb-3" width="15px" height="15px">
                                                    <p class="kecil">Pilihan Ganda</p>
                                                </div>

                                            </div>
                                            <img src="img/more.png" alt="" height="24px" width="24px">
                                        </div>
                                        <p class="lato-light ms-3 keterangan">Apa yang kamu lakukan ketika kamu merasakan keluhan kesehatan?</p>




                                        <button type="button" class="btn btn-outline-secondary d-flex align-items-center me-5 kecil float-end sentuh-back-biru">Lihat</button>




                                        <div class="d-flex flex-row ms-5 mt-4">
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




        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>