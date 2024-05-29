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
        <div class="row mb-3">
            <div class="menu col-lg-2 border-end ">
                <div class="row mt-3">
                    <div class="col text-center">
                        <img src="img/profileAbu.png" alt="" width="100px" height="100px" class="mb-2">
                        <p class="lato-bold">Fauzan Najib H</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5 text-center">
                        <p class="lato-light">Pertanyaan</p>
                        <p class="lato-bold">12</p>
                    </div>
                    <div class="col-lg-2 d-flex justify-content-center">
                        <hr class="vertical-hr">
                    </div>
                    <div class="col-lg-5 text-center">
                        <p class="lato-light">Jawaban</p>
                        <p class="lato-bold">12</p>
                    </div>
                    <hr class="mx-auto w-75">
                </div>

                <nav class="nav d-flex flex-column">
                    <a class="nav-link montserrat-medium" href="#">
                        <img src="img/all.png" alt="">
                        Profil
                    </a>
                    <a class="nav-link montserrat-medium" href="#">
                        <img src="img/kesehatan.png" alt="" width="24px">
                        Pertanyaan
                    </a>
                    <a class="nav-link montserrat-medium" href="#">
                        <img src="img/pendidikan.png" alt="" width="24px">
                        Jawaban
                    </a>
                    <a class="nav-link montserrat-medium menu-aktif" href="#">
                        <img src="img/keuangan.png" alt="" width="24px">
                        Koinku
                    </a>
                    <a class="nav-link montserrat-medium" href="#">
                        <img src="img/analisis.png" alt="" width="24px">
                        Analisis
                    </a>
                    <a class="nav-link montserrat-medium" href="#">
                        <img src="img/bantuan.png" alt="" width="24px">
                        Bantuan
                    </a>
                    <a class="nav-link montserrat-medium" href="#">
                        <img src="img/keluar.png" alt="" width="24px">
                        Keluar
                    </a>
                </nav>
            </div>

            <div class="col-lg-10">
                <div class="row mt-3 ms-3 koinReward">
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body d-flex flex-row align-items-center">
                                <img src="img/reward.png" alt="" width="40px">
                                <p class="lato-bold my-auto ms-3 besar">3695</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body d-flex flex-row align-items-center">
                                <img src="img/koin.png" alt="" width="40px">
                                <p class="lato-bold my-auto ms-3 besar">3695</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 ms-3">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="lato-bold mb-5">Beli</h3>
                                <form action="">
                                    <div class="d-flex flex-row align-items-end">
                                        <div class="form-floating mb-3 w-50">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="jumlah">
                                            <label for="floatingInput">Jumlah</label>
                                        </div>
                                        <p class="lato-bold ms-2">Koin</p>
                                    </div>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Sumber Dana</option>
                                        <option value="1">BNI</option>
                                        <option value="2">Mandiri</option>
                                        <option value="3">BCA</option>
                                    </select>

                                    <p class="lato-bold mt-5">Total</p>
                                    <input class="form-control w-50" type="text" value="Total" aria-label="readonly input example" readonly>
                                    <button type="submit" class="btn tombol-biru mt-3 me-3 float-end">Konfirmasi</button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="lato-bold mb-5">Tarik</h3>
                                <form action="">
                                    <div class="d-flex flex-row align-items-end">
                                        <div class="form-floating mb-3 w-50">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="jumlah">
                                            <label for="floatingInput">Jumlah</label>
                                        </div>
                                        <p class="lato-bold ms-2">Koin</p>
                                    </div>
                                    <select class="form-select mb-3" aria-label="Default select example">
                                        <option selected>Sumber Dana</option>
                                        <option value="1">BNI</option>
                                        <option value="2">Mandiri</option>
                                        <option value="3">BCA</option>
                                    </select>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Rekening Tujuan">
                                        <label for="floatingInput">Rekening Tujuan</label>
                                    </div>

                                    <p class="lato-bold mt-5">Total</p>
                                    <input class="form-control w-50" type="text" value="Total" aria-label="readonly input example" readonly>
                                    <button type="submit" class="btn tombol-oranye mt-3 me-3 float-end">Konfirmasi</button>
                                </form>

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