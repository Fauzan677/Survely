<?php
session_start();

// Hancurkan semua sesi
session_unset();
session_destroy();

// Arahkan pengguna ke halaman login
header("Location: login.php");
exit;