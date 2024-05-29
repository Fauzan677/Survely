<?php
require 'function.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tanya'])) {
    if (tambah($_POST) > 0) {
        header("Location: dashboard.php");
        exit;
    } else if (tambah($_POST) === -1) {
        $_SESSION['flash_message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Semua field harus diisi';
        $_SESSION['input_values'] = $_POST;
    } else {
        // Jika login gagal, tampilkan pesan error
        $_SESSION['flash_message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Error';
        $_SESSION['input_values'] = $_POST;
    }
}

// Mengambil nilai dari session jika ada
$input_values = $_SESSION['input_values'] ?? [];
unset($_SESSION['input_values']);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bertanya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <div class="container">
        <a href="dashboard.php" class="position-fixed">
            <img src="img/back.png" alt="" width="30px">
        </a>

        <h1 class="lato-bold text-center mt-5">Ajukan Pertanyaan</h1>

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <!-- Flash message -->
                <?php if (isset($_SESSION['flash_message'])) :
                    echo $_SESSION['flash_message'];
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>';
                    unset($_SESSION['flash_message']);
                endif; ?>
                <div class="card mt-3 mb-5">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Tulis Pertanyaanmu Disini" id="floatingTextarea2" style="height: 100px" name="pertanyaan"><?php echo htmlspecialchars($input_values['pertanyaan'] ?? '', ENT_QUOTES); ?></textarea>
                                <label for="floatingTextarea2">Tulis Pertanyaanmu Disini...</label>
                            </div>
                            <p class="lato-medium mb-3">Opsi:</p>
                            <div id="opsiContainer">
                                <?php if (isset($_POST['opsi'])) : ?>
                                    <?php foreach ($_POST['opsi'] as $opsiValue) : ?>
                                        <input class="form-control mb-2" type="text" placeholder="Tulis Opsi Jawaban..." aria-label="default input example" name="opsi[]" value="<?php echo htmlspecialchars($opsiValue, ENT_QUOTES); ?>">
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="tambah">
                                <button type="button" class="opsi btn">Tambah opsi..</button>
                            </div>

                            <div class="mt-5 d-flex flex-wrap" style="width: 70%;">
                                <select class="form-select pilihan" aria-label="Default select example" name="jenisOpsi" value="<?php echo htmlspecialchars($input_values['jenisOpsi'] ?? '', ENT_QUOTES); ?>">
                                    <option value="" selected>Jenis Opsi</option>
                                    <option value="pilihan ganda">Pilihan Ganda</option>
                                    <option value="kotak centang">Kotak Centang</option>
                                </select>
                                <select class="form-select pilihan ms-3" aria-label="Default select example" name="kategori" value="<?php echo htmlspecialchars($input_values['kategori'] ?? '', ENT_QUOTES); ?>">
                                    <option value="" selected>Semua Kategori</option>
                                    <option value="1">Kesehatan</option>
                                    <option value="2">Pendidikan</option>
                                </select>
                                <select class="form-select pilihan mt-3" aria-label="Default select example" name="jenisKoin" value="<?php echo htmlspecialchars($input_values['jenisKoin'] ?? '', ENT_QUOTES); ?>">
                                    <option value="" selected>Jenis Koin</option>
                                    <option value="emas">Emas</option>
                                    <option value="perak">Perak</option>
                                </select>
                                <select class="form-select pilihan mt-3 ms-4" aria-label="Default select example" name="koin" value="<?php echo htmlspecialchars($input_values['koin'] ?? '', ENT_QUOTES); ?>">
                                    <option value="" selected>Koin</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                </select>
                                <select class="form-select pilihan mt-3" aria-label="Default select example" name="umur" value="<?php echo htmlspecialchars($input_values['umur'] ?? '', ENT_QUOTES); ?>">
                                    <option value="" selected>Semua Umur</option>
                                    <option value="20+ tahun">20+ Tahun</option>
                                    <option value="30+ tahun">30+ Tahun</option>
                                </select>
                                <select class="form-select pilihan mt-3 ms-3" aria-label="Default select example" name="orang" value="<?php echo htmlspecialchars($input_values['orang'] ?? '', ENT_QUOTES); ?>">
                                    <option value="" selected>Orang</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <button type="submit" class="btn tombol-biru mt-5 float-end me-5" name="tanya">Tanyakan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="JS/script.js"></script>
</body>

</html>