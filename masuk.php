<?php
require_once "core/init.php";
if (isset($_SESSION['user'])) {
  $_SESSION['logout'] = "";
  header('Location: index.php');
}
if (isset($_SESSION['msg'])) {
  $error = "Anda Harus Login Terlebih Dahulu!";
  unset($_SESSION['msg']);
}
// Validasi Masuk
if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $pass = $_POST['password'];

  if (!empty(trim($nama)) && !empty(trim($pass))) {
    if (cek_pengguna($nama)) {
      if (cek_data($nama, $pass)) redirect_login($nama);
      else $error = "Terjadi kesalahan";
    } else
      $error = "Pengguna tidak terdaftar";
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Icon Tab -->
  <link rel="shorcut icon" type="x-icon" href="asset/logo.png">

  <!-- Icon Boostrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">

  <!-- Boxicons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400;1,600&display=swap');

    .login-bg {
      width: 100%;
      height: 100%;
      background-image: url(asset/sekolaku.png);
      background-size: 1045px;
      background-position: -110px;
      background-repeat: no-repeat;
    }

    body {
      font-family: 'Poppins', sans-serif;
    }

    @media only screen and (max-width: 600px) {
      .title {
        font-size: 25px;
      }

      .desc {
        display: none;
      }

      .desc-sm {
        display: "";
        color: #fff;
        text-align: center;
        font-size: 14px;
        margin-bottom: 15px;
        margin-top: -35px;

      }
    }

    @media only screen and (min-width: 600px) {
      .desc-sm {
        display: none;
      }
    }
  </style>

  <title>Masuk - Sekolahku</title>

</head>

<body style="height: 100vh; width:100vw;">
  <div class="container-fluid login-bg">
    <div class="row">
      <!-- ========== Start Headline ========== -->
      <div class="col-lg-7 col-sm-12 p-5 text-white d-flex align-items-center justify-content-center">
        <div class="d-inline-flex">
          <img src="asset/logo-01.png" alt="" style="width: 50px;">
          <h1 class="title p-2 fw-bold">SEKOLAHKU</h1>
        </div>
        <div class="desc p-2 border-start">Portal layanan sistem informasi PPDB secara <br> online SMK Negeri 1
          Kertosono</div>
      </div>
      <!-- ========== End Headline ========== -->
      <div class="desc-sm">Portal layanan sistem informasi PPDB secara online SMK Negeri 1 Kertosono</div>
      <!-- ========== Start Masuk Form ========== -->
      <div class="col-lg-5 col-sm-12 bg-white d-flex flex-column align-items-center justify-content-center"
        style="height:100vh; border-radius: 25px 0 0 25px;">

        <h2 class="mb-4 fw-bold" style="color:#232a34;">Masuk</h2>
        <!-- Login Form Start -->
        <div class="w-75">
          <!-- Error -->
          <?php if (isset($error)) { ?>
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path
                  d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
              </svg>
              <div>
                <?= $error ?>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php } ?>
          <!-- Error End -->
          <form class="row g-3 needs-validation" novalidate action="masuk.php" method="post">
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingName" placeholder="Nama Lengkap" name="nama"
                  required>
                <label for="floatingName">Nama Lengkap</label>
                <div class="invalid-feedback">
                  Nama wajib diisi!
                </div>
              </div>
              <div class="col-12 my-3">
                <div class="form-floating">
                  <input type="password" class="form-control" id="floatingpw" placeholder="Kata Sandi" name="password"
                    required>
                  <label for="floatingpw">Kata Sandi</label>
                  <div class="invalid-feedback">
                    Kata sandi wajib diisi!
                  </div>
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-primary w-100 p-2" type="submit" name="submit">Masuk</button>
              </div>
              <div class="w-100 mt-3 d-inline-flex justify-content-center gap-2">
                <p>Belum punya akun?</p>
                <a href="daftar.php">Daftar</a>
              </div>
          </form>

        </div>
      </div>
      <!-- ========== End Masuk Form ========== -->
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <script src="js/sekolahku.js"></script>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/bootstrap.js"></script>
  <script src="js/popper.min.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    -->
</body>

</html>