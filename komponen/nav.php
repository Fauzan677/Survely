<?php

$user_id = $_SESSION['user_id'];
$koin = ambilKoinReward($user_id); // Panggil fungsi untuk mendapatkan nilai koin

?>

<nav class="navbar dashboard navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid py-2">
        <a href="dashboard.php">
            <img class="ms-5" src="img/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-auto" id="navbarNavAltMarkup">
            <form class="w-75 ms-5 me-5" role="search">
                <input class="form-control" type="search" placeholder="Cari Pertanyaan Survei" aria-label="Search">
            </form>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-1">
                    <img src="img/koin.png" alt="" width="25px">
                </span>
                <span class="navbar-text lato-bold">
                    <?php echo $koin['koin']; ?>
                </span>
                <a class="nav-link me-3" href="#">
                    <img src="img/refresh.png" alt="" width="15px">
                </a>
                <a class="nav-link me-3" href="#">
                    <img src="img/notifikasi.png" alt="" width="15px">
                </a>
                <span class="nav-item dropdown border border-secondary rounded me-5">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="img/profile.png" alt="" width="20px">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                        <li><a class="dropdown-item" href="keluar.php">Keluar</a></li>
                    </ul>
                </span>
            </div>
        </div>
    </div>
</nav>