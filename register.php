<?php
require 'function.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['daftar'])) {
    // Set flash message berdasarkan hasil registrasi
    if (daftar($_POST) > 0) {
        $_SESSION['flash_message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Registrasi berhasil!';
        header("Location: login.php");
        exit;
    } else if (daftar($_POST) === 0) {
        $_SESSION['flash_message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Username sudah ada. Silakan pilih username lain.';
        $_SESSION['input_values'] = $_POST;
    } else if (daftar($_POST) === -1) {
        $_SESSION['flash_message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Semua field harus diisi';
        $_SESSION['input_values'] = $_POST;
    } else {
        $_SESSION['flash_message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Error: Terjadi kesalahan pada registrasi.';
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
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>

    <div class="container">
        <h1 class="lato-bold text-center my-5">Bergabung bersama <a href="index.php" class="text-decoration-none"><span class="biru">Surve</span><span class="oranye">ly</span></a></h1>
        <div class="row">
            <div class="col-md-6 offset-3">
                <!-- Flash message -->
                <?php if (isset($_SESSION['flash_message'])) :
                    echo $_SESSION['flash_message'];
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>';
                    unset($_SESSION['flash_message']);
                endif; ?>
                <div class="card">
                    <div class="card-body p-5">
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo htmlspecialchars($input_values['username'] ?? '', ENT_QUOTES); ?>">
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo htmlspecialchars($input_values['email'] ?? '', ENT_QUOTES); ?>">
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="tglLahir" name="tglLahir" value="<?php echo htmlspecialchars($input_values['tglLahir'] ?? '', ENT_QUOTES); ?>">
                                <label for="tglLahir">Tanggal Lahir</label>
                            </div>
                            <div class="form-floating password">
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php echo htmlspecialchars($input_values['password'] ?? '', ENT_QUOTES); ?>">
                                <label for="password">Password</label>
                                <i class="fa fa-eye" id="togglePassword"></i>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 float-end me-3" name="daftar">Daftar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center my-3">
            <span class="lato-regular">Sudah punya akun??</span> <a href="login.php" class="lato-bold biru" style="text-decoration: none">Masuk</a>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="JS/script.js"></script>
</body>

</html>