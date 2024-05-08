<?php
require_once "core/init.php";
if (!isset($_SESSION['user'])) {
  $_SESSION['msg'] = "";
  header('Location: masuk.php');
}

if (isset($_SESSION['logout'])) {
  $error = "Anda Harus Keluar Terlebih Dahulu";
  unset($_SESSION['logout']);
}

// Admin Tambah Data
if (isset($_POST['submit-tambah'])) {
  $nama = $_POST['nama'];
  $pass = $_POST['pass'];
  $email = $_POST['email'];
  $tanggal = date('d-m-Y', strtotime($_POST['tanggal']));
  $telp = $_POST['telp'];
  $gender = $_POST['gender'];
  $alamat = $_POST['alamat'];
  $jurusan = $_POST['jurusan'];
  $kode_buku = $_POST['kode_buku'];
  $kode_seragam = $_POST['kode_seragam'];

  if (
    !empty(trim($nama)) &&
    !empty(trim($email)) &&
    !empty(trim($telp)) &&
    !empty(trim($tanggal)) &&
    !empty(trim($alamat))
  ) {

    if (tambah_data($nama, $pass, $email, $tanggal, $telp, $gender, $alamat, $jurusan, $kode_buku, $kode_seragam)) {
      header('Location: index.php');
    } else {
      $error = "Gagal Menambah Data!";
    }
  }
}
// Admin - Ubah
if (isset($_POST['submit-ubah'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $tanggal = date('d-m-Y', strtotime($_POST['tanggal']));
  $telp = $_POST['telp'];
  $gender = $_POST['gender'];
  $alamat = $_POST['alamat'];
  $jurusan = $_POST['jurusan'];

  if (
    !empty(trim($nama)) &&
    !empty(trim($email)) &&
    !empty(trim($telp)) &&
    !empty(trim($tanggal)) &&
    !empty(trim($alamat))
  ) {
    if (ubah_data($id, $nama, $email, $tanggal, $telp, $gender, $alamat, $jurusan)) {
      header('Location: index.php');
    } else
      $error = "Gagal mengubah";

  } else
    $error = "Terjadi kesalahan";
}
// Admin Terima
if (isset($_POST['submit-terima'])) {
  $id = $_POST['id'];
  if (terima($id)) {
    header('Location: index.php');
  }
  $error = "Gagal menerima, coba lagi!";
}
// Admin Menolak
if (isset($_POST['submit-tolak'])) {
  $id = $_POST['id'];
  if (tolak($id)) {
    header('Location: index.php');
  }
  $error = "Gagal menolak, coba lagi!";
}



// Guest Daftar
if (isset($_POST['submit-daftar'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $tanggal = date('d-m-Y', strtotime($_POST['tanggal']));
  $telp = $_POST['telp'];
  $gender = $_POST['gender'];
  $alamat = $_POST['alamat'];
  $jurusan = $_POST['jurusan'];
  $kode_buku = $_POST['kode_buku'];
  $kode_seragam = $_POST['kode_seragam'];

  if (
    !empty(trim($nama)) &&
    !empty(trim($email)) &&
    !empty(trim($telp)) &&
    !empty(trim($tanggal)) &&
    !empty(trim($alamat))
  ) {
    if (daftar_siswa($nama, $email, $tanggal, $telp, $gender, $alamat, $jurusan, $kode_buku, $kode_seragam)) {
      header('Location: index.php');
    } else
      $error = "Ada masalah saat menambah data";

  } else
    $error = "Terjadi kesalahan";
}


?>

<!doctype html>
<html lang="en">
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="shorcut icon" type="x-icon" href="asset/logo.png">
      
      <!-- Icon Boost -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

      <!-- Boxicons -->
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.css">

      <!-- Internal CSS -->
      <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400;1,600&display=swap');
        /* Datatables */
        div.dataTables_wrapper {
        margin: 0 auto;
        }     

        /* Extra small devices */
        @media only screen and (max-width: 600px) {
          .diterima-container{
            margin-bottom:25px;
          }
          .guest-img{
            margin-left: -30px;
            height: 500px;
          }
          #detail-container{
            margin-top: 20px;
            margin-bottom: 20px;
          }
          .sidebar-full{
            display:none;
          }
          .kartu{
            flex-wrap: wrap;
          }
          .sidebar-small{
            display: flex;
          }

        }

        /* Medium */
        @media only screen and (max-width: 991px) {
          .sidebar-full{
            display: none;
          }
          .sidebar-small{
            display: flex;
          }
          
        }

        /* Large */
        @media only screen and (min-width: 992px) {
          .sidebar-small{
            display: none;
          }
        }

      </style>

        <!-- Datatables -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
      
        <title>Sekolahku</title>
      </head>
    <!-- ========== Start Admin Page ========== -->
      <?php if (cek_role($_SESSION['user'])) { ?>
              <body style="background-color: #EDEEF0; font-family: 'Poppins', sans-serif;" >
                <div class="container-fluid">
                  <div class="row">
                    <!-- ========== Start Sidebar ========== -->
                    <div class="sidebar-full col-2 p-3 shadow-md position-fixed" style="z-index:3;">
                        <div class="min-vh-100" style="background-color: #EDEEF0; ">
                            <ul class="list-group list-group-flush list-unstyled">
                              <li class="list-group-item w-100 d-inline-flex justify-content-center align-items-center bg-transparent" style="border:none;">
                              <a href="index.php" class="link-underline link-underline-opacity-0">
                                <div class="text-center">
                                  <img src="asset/logo.png" alt="" class="w-50">
                                </div>    
                                  <h5 class="fw-bold text-secondary">SEKOLAHKU</h5>
                              </a>
                            </li>
                            <li class="list-group-item mt-3 rounded-3 mb-2 bg-transparent" style="border: none;">
                              <a href="index.php" class="d-flex justify-content-between text-secondary link-underline link-underline-opacity-0">
                                <div class="d-inline-flex align-items-center"><i class='bx bxs-dashboard fs-5 me-2'></i>Dashboard</div>
                              </a>
                            </li>
                            <li class="rounded-3 mb-2 bg-transparent" style="border: none;">
                              <div class="accordion p-0">
                                <div class="accordion-item bg-transparent" style="border:none;">
                                  <h2 class="accordion-header rounded-3" id="panelsStayOpen-pendaftar">
                                    <button style="border:none;" class="accordion-button text-secondary bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-isiPendaftar" aria-expanded="true" aria-controls="panelsStayOpen-isiPendaftar">
                                      <div class="d-inline-flex align-items-center" style="border:none;"><i class='bi bi-person-fill fs-5 me-2'></i>Pendaftar</div>
                                    </button>
                                  </h2>
                                  <div id="panelsStayOpen-isiPendaftar" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-pendaftar">
                                    <div class="accordion-body bg-transparent ms-3">
                                      <a href="terima.php" style="text-decoration:none;" class="text-secondary mb-2"><div class="d-inline-flex align-items-center mb-2"><i class='bi bi-person-fill-check fs-5 me-2'></i>Diterima</div></a>
                                      <a href="tolak.php" style="text-decoration:none;" class="text-secondary"><div class="d-inline-flex align-items-center mb-2"><i class='bi bi-person-fill-x fs-5 me-2'></i>Ditolak</div></a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="rounded-3 mb-2 bg-transparent" style="border: none;">
                              <div class="accordion">
                                <div class="accordion-item bg-transparent" style="border:none;">
                                  <h2 class="accordion-header rounded-3" id="panelsStayOpen-barang">
                                    <button style="border:none;" class="accordion-button text-secondary bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-Barang" aria-expanded="true" aria-controls="panelsStayOpen-Barang">
                                      <div class="d-inline-flex align-items-center" style="border:none;"><i class='bx bxs-package fs-5 me-2'></i>Barang</div>
                                    </button>
                                  </h2>
                                  <div id="panelsStayOpen-Barang" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-barang">
                                    <div class="accordion-body bg-transparent ms-3">
                                      <a href="seragam.php" style="text-decoration:none;" class="text-secondary"><div class="d-inline-flex align-items-center mb-2"><i class='bx bxs-t-shirt fs-5 me-2'></i>Seragam</div></a>
                                      <a href="buku.php" style="text-decoration:none;" class="text-secondary"><div class="d-inline-flex align-items-center mb-2"><i class='bx bxs-book-bookmark fs-5 me-2'></i>Buku</div></a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item rounded-3 mb-2 bg-transparent" style="border: none;">
                              <a href="keluar.php" class="d-flex justify-content-between text-secondary link-underline link-underline-opacity-0">
                                <div class="d-inline-flex align-items-center"><i class='bx bx-log-out-circle fs-5 me-2'></i>Keluar</div>
                              </a>
                            </li>
                        </ul>              
                      </div>
                    </div>
                    <!-- ========== End Sidebar ========== -->  

                    <div class="col-lg-10 col-md-12 offset-lg-2 px-3 mt-3">
                      <!-- ========== Start Sidebar Small ========== -->
                      <div class="sidebar-small mb-1">
                        <button style="margin-left:-15px;" class="btn text-start" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarSmall" aria-controls="sidebarSmall"><i class="bi bi-list fs-1"></i></button>
                          <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarSmall" aria-labelledby="sidebarSmallLabel">
                            <div class="offcanvas-header">
                              <div class="offcanvas-title" id="sidebarSmallLabel">
                                <div class="d-inline-flex align-items-center">
                                  <img src="asset/logo.png" alt="" class="w-50 me-2">
                                  <a href="index.php" class="fs-5 fw-bold text-secondary link-underline link-underline-opacity-0">SEKOLAHKU</a>
                                </div>    
                              </div>
                              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                              <ul class="list-group list-group-flush list-unstyled">
                              <li class="list-group-item mt-3 rounded-3 mb-2 bg-transparent" style="border: none;">
                                <a href="index.php" class="d-flex justify-content-between text-secondary link-underline link-underline-opacity-0">
                                  <div class="d-inline-flex align-items-center"><i class='bx bxs-dashboard fs-5 me-2'></i>Dashboard</div>
                                </a>
                              </li>
                              <li class="rounded-3 mb-2 bg-transparent" style="border: none;">
                                <div class="accordion p-0">
                                  <div class="accordion-item bg-transparent" style="border:none;">
                                    <h2 class="accordion-header rounded-3" id="panelsStayOpen-pendaftar">
                                      <button style="border:none;" class="accordion-button text-secondary bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-isiPendaftar" aria-expanded="true" aria-controls="panelsStayOpen-isiPendaftar">
                                        <div class="d-inline-flex align-items-center" style="border:none;"><i class='bi bi-person-fill fs-5 me-2'></i>Pendaftar</div>
                                      </button>
                                    </h2>
                                    <div id="panelsStayOpen-isiPendaftar" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-pendaftar">
                                      <div class="accordion-body bg-transparent ms-3">
                                        <a href="terima.php" style="text-decoration:none;" class="text-secondary mb-2"><div class="d-inline-flex align-items-center mb-2"><i class='bi bi-person-fill-check fs-5 me-2'></i>Diterima</div></a><br>
                                        <a href="tolak.php" style="text-decoration:none;" class="text-secondary"><div class="d-inline-flex align-items-center mb-2"><i class='bi bi-person-fill-x fs-5 me-2'></i>Ditolak</div></a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                              <li class="rounded-3 mb-2 bg-transparent" style="border: none;">
                                <div class="accordion">
                                  <div class="accordion-item bg-transparent" style="border:none;">
                                    <h2 class="accordion-header rounded-3" id="panelsStayOpen-barang">
                                      <button style="border:none;" class="accordion-button text-secondary bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-Barang" aria-expanded="true" aria-controls="panelsStayOpen-Barang">
                                        <div class="d-inline-flex align-items-center" style="border:none;"><i class='bx bxs-package fs-5 me-2'></i>Barang</div>
                                      </button>
                                    </h2>
                                    <div id="panelsStayOpen-Barang" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-barang">
                                      <div class="accordion-body bg-transparent ms-3">
                                        <a href="seragam.php" style="text-decoration:none;" class="text-secondary"><div class="d-inline-flex align-items-center mb-2"><i class='bx bxs-t-shirt fs-5 me-2'></i>Seragam</div></a><br>
                                        <a href="buku.php" style="text-decoration:none;" class="text-secondary"><div class="d-inline-flex align-items-center mb-2"><i class='bx bxs-book-bookmark fs-5 me-2'></i>Buku</div></a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                              <li class="list-group-item rounded-3 mb-2 bg-transparent" style="border: none;">
                                <a href="keluar.php" class="d-flex justify-content-between text-secondary link-underline link-underline-opacity-0">
                                  <div class="d-inline-flex align-items-center"><i class='bx bx-log-out-circle fs-5 me-2'></i>Keluar</div>
                                </a>
                              </li>
                            </ul>     
                            </div>
                          </div>
                      </div>
                      <!-- ========== End Sidebar Small ========== -->

                      <!-- ========== Start Judul Halaman ========== -->
                      <h4 class="fw-bold">Dashboard</h4>
                      <div class="text-muted mb-3">Hi, <?= $_SESSION['user']; ?> welcome back</div>
                      <!-- ========== End Judul Halaman ========== -->
                    </div>
                  </div>    
          
                  <!-- ========== Start Card Row ========== -->
                  <div class="row">
                    <div class="col-lg-10 col-md-12 offset-lg-2 mb-3">
                      <!-- ========== Start Error ========== -->
                      <?php if (isset($error)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                  </svg>
                                  <div>
                                    <?= $error ?>
                                  </div>
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                          <?php } ?>
                      <!-- ========== End Error ========== -->
                      <!-- ========== Start Card ========== -->
                      <div class="kartu card-full d-inline-flex gap-2 w-100">

                        <!-- ========== Start Jumlah Pengguna ========== -->
                        <div class=" card p-3 w-100 rounded-3 border-0 shadow-md text-light" style="background-image: url(asset/bg-pengguna.png); background-position:center; background-size:250px;">
                          <div class="d-inline-flex align-items-center">
                            <i class="bi bi-person-circle" style="font-size: 1.5rem; margin-top:-15px; margin-right: 10px;"></i>
                              <p>Jumlah Pengguna</p>
                          </div>
                          <h3 class="text-end" style="font-weight: 600;"><?= hitung_user(); ?></h3>
                        </div>
                        <!-- ========== End Jumlah Pengguna ========== -->

                        <!-- ========== Start Menunggu Konfirmasi ========== -->
                        <div class="card p-3 w-100 rounded-3 border-0 shadow-md text-light" style="background-image: url(asset/bg-konfir.png); background-position:center; background-size:250px;">
                          <div class="d-inline-flex align-items-center">
                            <i class="bi bi-person-fill-exclamation" style="font-size: 1.5rem; margin-top:-15px; margin-right: 10px;"></i>
                              <p>Menunggu Konfirmasi</p>
                          </div>
                
                          <h3 class="text-end" style="font-weight: 600;"><?= hitung_daftar(); ?></h3>
                        </div>
                        <!-- ========== End Menunggu Konfirmasi ========== -->

                        <!-- ========== Start Diterima ========== -->
                        <div class="card p-3 w-100 rounded-3 border-0 shadow-md text-light" style="background-image: url(asset/bg-terima.png); background-position:center; background-size:250px;">
                          <div class="d-inline-flex align-items-center">
                            <i class="bi bi-person-fill-check" style="font-size: 1.5rem; margin-top:-15px; margin-right: 10px;"></i>
                              <p>Diterima</p>
                          </div>
                          <h3 class="text-end" style="font-weight: 600;"><?= hitung_terima(); ?></h3>
                        </div>
                        <!-- ========== End Diterima ========== -->

                        <!-- ========== Start Ditolak ========== -->
                        <div class="card p-3 w-100 rounded-3 border-0 shadow-md text-light" style="background-image: url(asset/bg-tolak.png); background-position:center; background-size:250px;">
                          <div class="d-inline-flex align-items-center">
                            <i class="bi bi-person-fill-x" style="font-size: 1.5rem; margin-top:-15px; margin-right: 10px;"></i>
                              <p>Ditolak</p>
                          </div>
                          <h3 class="text-end" style="font-weight: 600;"><?= hitung_tolak(); ?></h3>
                        </div>
                        <!-- ========== End Ditolak ========== -->
                      </div>
                      <!-- ========== End Card ========== -->
                    </div>
                  </div>
                  <!-- ========== End Card Row ========== -->
          
                  <!-- ========== Start Tabel Pengguna Row ========== -->
                  <div class="row">
                    <div class="col-lg-10 col-md-12 offset-lg-2">
                    <div class="w-100 p-3 rounded-3 bg-white shadow-md">
                      <h6>Tabel Pengguna Sekolaku</h6>
                      <hr>
                      <!-- ========== Start Modal Tambah ========== -->
                      <!-- ========== Start Tombol Tambah ========== -->
                      <div class="mb-3"><button type="button" class="btn text-white" style="background-color:#4982F5;" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-plus-circle me-2 text-white"></i>Tambah Data</button></div>
                      <!-- ========== End Tombol Tambah ========== -->
                      <div class="modal fade text-dark" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <img src="asset/logo.png" class="me-3" style="width:50px;" alt="">
                              <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel" >Tambah Data</h1>
                              <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body p-3">
                            <form action="" method="post" class="needs-validation" novalidate>
                              <div class="row mb-3 g-3">
                                <div class="col-6">
                                  <label for="nama" class="form-label">Nama Lengkap</label>
                                  <input type="text" class="form-control" id="nama" name="nama" required>
                                  <div class="invalid-feedback">
                                    Nama wajib diisi!
                                  </div>
                                </div>
                                <div class="col-6">
                                  <label for="pass" class="form-label">Password</label>
                                  <input type="password" class="form-control" id="pass" name="pass" required>
                                  <div class="invalid-feedback">
                                    Password wajib diisi!
                                  </div>
                                </div>
                              </div>
                              <div class="row mb-3 g-3">
                                <div class="col-6">
                                  <label for="tanggal" class="form-label">Tanggal Lahir</label>
                                  <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                  <div class="invalid-feedback">
                                    Tanggal lahir wajib diisi!
                                  </div>
                                </div>
                                <div class="col-6">
                                <label for="telp" class="form-label">Nomor Telepon</label>
                                  <input type="tel" class="form-control" id="telp" name="telp" maxlength="15" required>
                                  <div class="invalid-feedback">
                                    No.Telepon wajib diisi!
                                  </div>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col-12">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="email" name="email" required>
                                  <div class="invalid-feedback">
                                    Email wajib diisi!
                                  </div>
                                </div>
                              </div>
                              <fieldset class="row mb-3">
                                <legend class="col-form-label col-2 pt-0">Gender</legend>
                                <div class="col-10">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="L" checked>
                                    <label class="form-check-label" for="gender1">
                                      Laki - Laki
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="P" >
                                    <label class="form-check-label" for="gender2">
                                      Perempuan
                                    </label>
                                  </div>
                                </div>
                              </fieldset>
                              <div class="row mb-3 g-3">
                                <div class="col-12">
                                  <label for="alamat" class="form-label">Alamat</label>
                                  <textarea class="form-control" id="alamat"name="alamat" rows="2" required></textarea>
                                  <div class="invalid-feedback">
                                    Alamat wajib diisi!
                                  </div>
                                </div>
                              </div>
                              <div class="row mb-3 g-3">
                                <div class="col-12">
                                  <label for="jurusan" class="form-label">Jurusan</label>
                                  <select class="form-select" aria-label="Default select example" name="jurusan" required>
                                    <option value="" selected>Pilih Jurusan</option>
                                    <option value="Kuliner">Kuliner</option>
                                    <option value="Desain Produksi Busana">Desain Produksi Busana</option>
                                    <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                    <option value="Teknik Mesin">Teknik Mesin</option>
                                    <option value="Teknik Intalasi Tenaga Listrik">Teknik Intalasi Tenaga Listrik</option>
                                    <option value="Teknik Otomasi Industri">Teknik Otomasi Industri</option>
                                  </select>
                                  <div class="invalid-feedback">
                                    Jurusan wajib diisi!
                                  </div>
                                </div>
                              </div>
                              <div class="row" style="display: none;">
                                <div class="col-12">
                                <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="<?= code(); ?>" hiddden required>
                                <input type="text" class="form-control" id="kode_seragam" name="kode_seragam" value="<?= code(); ?>" hiddden required>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-dark py-2 px-4" data-bs-dismiss="modal">Tutup</button>
                              <button type="submit" name="submit-tambah" class="btn btn-primary py-2 px-4">Tambah Data</button>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>  
                      <!-- ========== End Modal Tambah ========== -->
                      <!-- ========== Start Tabel Pengguna ========== -->
                      <table id="allData" class="display nowrap table table-striped" style="width:100%;">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Aksi</th>
                                      <th>Status</th>
                                      <th>Nama Lengkap</th>
                                      <th>Email</th>
                                      <th>No.Telepon</th>
                                      <th>L/P</th>
                                      <th>Tgl Lahir</th>
                                      <th>Alamat</th>
                                      <th>Jurusan</th>
                              
                                  </tr>
                              </thead>
                              <tbody>
                                <?php $data = tampilkan_all(); ?>
                                <?php $no = 0; ?>
                                <?php while ($row = mysqli_fetch_assoc($data)): ?>
                                        <?php $no++; ?>
                                          <tr>
                                              <td><?= $no; ?></td>
                                              <td>
                                
                                                <!-- ========== Start Modal Ubah ========== -->
                                                <button type="button" class="btn text-light me-1" style="background-color:#4982F5;" data-bs-toggle="modal" data-bs-target="#data<?= $row['id']; ?>"><i class="bi bi-eye-fill"></i></button>

                                                  <!-- Modal -->
                                                  <div class="modal fade text-dark" id="data<?= $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dataLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <img src="asset/logo.png" class="me-3" style="width:50px;" alt="">
                                                          <h1 class="modal-title fs-5 fw-bold" id="dataLabel">Data Pengguna</h1>
                                                          <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body p-3">
                                                        <form action="" method="post" class="needs-validation" novalidate>
                                                          <div class="row mb-3 g-3">
                                                            <div class="col-6">
                                                              <input hidden type="text" class="form-control" id="id" name="id" value="<?= $row['id']; ?>" required>
                                                              <label for="nama" class="form-label">Nama Lengkap</label>
                                                              <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama']; ?>" required>
                                                              <div class="invalid-feedback">
                                                                Nama wajib diisi!
                                                              </div>
                                                            </div>
                                                            <div class="col-6">
                                                              <label for="email" class="form-label">Email</label>
                                                              <input type="text" class="form-control" id="email" name="email" value="<?= $row['email']; ?>" required>
                                                              <div class="invalid-feedback">
                                                                Email wajib diisi!
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="row mb-3 g-3">
                                                            <div class="col-6">
                                                              <!-- Reverse Tanggal -->
                                                              <?php $newDate = date('Y-m-d', strtotime($row['tanggal'])); ?>
                                                              <label for="tanggal" class="form-label">Tanggal Lahir</label>
                                                              <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $newDate; ?>" required>
                                                              <div class="invalid-feedback">
                                                                Tanggal lahir wajib diisi!
                                                              </div>
                                                            </div>
                                                            <div class="col-6">
                                                            <label for="telp" class="form-label">Nomor Telepon</label>                                              
                                                              <input type="tel" class="form-control" id="telp" name="telp" maxlength="15" value="<?= $row['telp']; ?>" required>
                                                              <div class="invalid-feedback">
                                                                No.Telepon wajib diisi!
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <fieldset class="row mb-3">
                                                            <legend class="col-form-label col-2 pt-0">Gender</legend>
                                                            <div class="col-10">
                                                              <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="L" 
                                                                <?php if ($row['gender'] == "L") { ?> checked <?php } ?>>
                                                                <label class="form-check-label" for="gender1">
                                                                  Laki - Laki
                                                                </label>
                                                              </div>
                                                              <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="P"
                                                                <?php if ($row['gender'] == "P") { ?> checked <?php } ?>>
                                                                <label class="form-check-label" for="gender2">
                                                                  Perempuan
                                                                </label>
                                                              </div>
                                                            </div>
                                                          </fieldset>
                                                          <div class="row mb-3 g-3">
                                                            <div class="col-12">
                                                              <label for="alamat" class="form-label">Alamat</label>
                                                              <textarea class="form-control" id="alamat"name="alamat" rows="2" required><?= $row['alamat']; ?></textarea>
                                                              <div class="invalid-feedback">
                                                                Alamat wajib diisi!
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="row mb-3 g-3">
                                                            <div class="col-12">
                                                              <label for="jurusan" class="form-label">Jurusan</label>
                                                              <select class="form-select" aria-label="Default select example" name="jurusan" required>
                                                                <option value="<?= $row['jurusan']; ?>" hidden selected><?= $row['jurusan']; ?></option>
                                                                <option value="Kuliner">Kuliner</option>
                                                                <option value="Desain Produksi Busana">Desain Produksi Busana</option>
                                                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                                                <option value="Teknik Mesin">Teknik Mesin</option>
                                                                <option value="Teknik Intalasi Tenaga Listrik">Teknik Intalasi Tenaga Listrik</option>
                                                                <option value="Teknik Otomasi Industri">Teknik Otomasi Industri</option>
                                                              </select>
                                                              <div class="invalid-feedback">
                                                                Jurusan wajib diisi!
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="submit-ubah" class="btn btn-dark py-2 px-4">Simpan Perubahan</button>
                                                          <?php if ($row['terima'] == 0 && $row['tolak'] == 0 && $row['daftar'] == 1) { ?>
                                                                  <button type="submit" name="submit-tolak" class="btn btn-danger py-2 px-4">Tolak</button>
                                                                  <button type="submit" name="submit-terima" class="btn btn-success py-2 px-4">Terima</button>
                                                          <?php } ?>
                                                        </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>  
                                                  <!-- ========== End Modal Ubah ========== -->
                                
                                                  <!-- ========== Start Hapus ========== -->
                                                    <button type="button" style="background-color:#F5465C;" class="btn text-light me-1" data-bs-toggle="modal" data-bs-target="#delete<?= $row['id']; ?>"><i class="bi bi-trash-fill"></i></button>

                                                      <!-- Modal -->
                                                      <div class="modal fade text-dark" id="delete<?= $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <img src="asset/logo.png" class="me-3" style="width:50px;" alt="">
                                                              <h1 class="modal-title fs-5 fw-bold" id="deleteLabel">Hapus Data</h1>
                                                              <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                                                            </div>
                                                            <div class="modal-body p-3">
                                                              <p>Anda yakin ingin menghapus data?<p>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-dark py-2 px-4" data-bs-dismiss="modal">Tutup</button>
                                                              <a href="hapus_data.php?id=<?= $row['id']; ?>" class="btn btn-primary text-light py-2 px-4">Hapus</a>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>  
                                                  <!-- ========== End Hapus ========== -->
                                              </td>
                                              <td>
                                                <?php
                                                if ($row['daftar'] == 1 && $row['terima'] == 1) { ?>
                                                          <span class="rounded-pill px-3 py-1 text-light" style="background-color:#32B47D; font-size: 13px;">Diterima</span>
                                                <?php } elseif ($row['daftar'] == 1 && $row['tolak'] == 1) { ?>
                                                          <span class="rounded-pill px-3 py-1 text-light" style="background-color:#F5465C; font-size: 13px;">Ditolak</span>
                                                <?php } elseif ($row['daftar'] == 1) { ?>
                                                          <span class="rounded-pill px-3 py-1 text-light" style="background-color:#F59520; font-size: 13px;">Menunggu..</span>
                                                <?php } else { ?>
                                                          <span class="rounded-pill px-3 py-1 text-light" style="background-color:#8540F5; font-size: 13px;">Tamu</span>
                                                <?php } ?>
                                              </td>
                                              <td><?= $row['nama']; ?></td>
                                              <td><?= $row['email']; ?></td>
                                              <td>
                                                <?php if ($row['daftar'] == "0") { ?>
                                                          <p>-</p>
                                                  <?php } else { ?>
                                                        <?= $row['telp']; ?></td>
                                                <?php } ?>
                                              <td>
                                                <?php if ($row['daftar'] == "0") { ?>
                                                            <p>-</p>
                                                    <?php } else { ?>
                                                              <?= $row['gender']; ?>
                                                  <?php } ?>
                                              </td>
                                              <td>
                                              <?php if ($row['daftar'] == "0") { ?>
                                                          <p>-</p>
                                                  <?php } else { ?>
                                                            <?= $row['tanggal']; ?>
                                                <?php } ?>
                                              </td>
                                              <td>
                                              <?php if ($row['daftar'] == "0") { ?>
                                                          <p>-</p>
                                                  <?php } else { ?>
                                                            <?= excerpt($row['alamat']); ?>
                                                <?php } ?>
                                              </td>
                                              <td>
                                              <?php if ($row['daftar'] == "0") { ?>
                                                          <p>-</p>
                                                  <?php } else { ?>
                                                            <?= $row['jurusan']; ?>                   
                                                <?php } ?>
                                              </td>
                              
                                          </tr>   
                                  <?php endwhile; ?>                       
                              </tbody>
                          </table>
                          <!-- ========== End Tabel Pengguna ========== -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- ========== End Tabel Pengguna Row ========== -->      
                </div>
                <!-- ========== End Admin Page ========== -->

                <!-- ========== Start Diterima Page ========== -->
        <?php } elseif (cek_terima($_SESSION['user'])) { ?>
                  <?php $table = tampilkan('nama', $_SESSION['user']); ?>
                  <?php while ($row = mysqli_fetch_assoc($table)): ?>
                          <body style="background-color: #32B47D; font-family: 'Poppins', sans-serif;">
                            <div class="container mt-5" style="height:600px; width:100%;">
                              <div class="row">
                                <div class="col-lg-7 col-md-12">
                                  <div class="row">
                                    <div class="col-12 mb-3">
                                    <div class="accordion" id="accordionPanelsStayOpenExample">
                                      <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-diterima">
                                          <button class="accordion-button bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-isiDiterima" aria-expanded="true" aria-controls="panelsStayOpen-isiDiterima">
                                            <span class="fw-bold fs-3" style="color:#26875e;">SELAMAT ANDA DITERIMA!</span>
                                          </button>
                                        </h2>
                                        <div id="panelsStayOpen-isiDiterima" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-diterima">
                                          <div class="accordion-body">
                                          <div class="d-inline-flex text-dark">
                                            <i class="bi bi-1-circle fs-3"></i>
                                            <p class="m-2">Jangan lupa untuk mencetak <a href="bukti-penerimaan.php" class="fw-bold" style="color:#26875e; text-decoration:none;">Bukti Penerimaan</a></p>
                                          </div>
                                          <div class="d-inline-flex text-dark">
                                            <i class="bi bi-2-circle fs-3"></i>
                                            <p class="m-2">Pengambilan buku & seragam dimulai tanggal 01 Juli 2023</p>
                                          </div>
                                          <div class="d-inline-flex text-dark">
                                            <i class="bi bi-3-circle fs-3"></i>
                                            <p class="m-2">Daftar ulang dengan membawa dokumen :
                                              </p>
                                            </div>
                                              <ul class="ms-4 text-dark">
                                                <li>Surat Keterangan Lulus (SKL)</li>
                                                <li>Ijazah</li>
                                                <li>Bukti Penerimaan</li>
                                              </ul>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                  <div class="row">
                                    <div class="col-6">
                                        <div class="alert alert-primary text-dark alert-light fade show border-0 shadow-md" role="alert">
                                            <div class="header">
                                              <h3 class="fw-bold fs-4" style="color:#26875e;"><i class='bx bxs-t-shirt me-2' ></i>SERAGAM</h3>
                                              <hr>
                                              <div class="w-100 d-flex justify-content-between">Kode 
                                                <?php if ($row['seragam'] == '1') { ?>
                                                          <span class="rounded-pill text-light px-3 py-1 bg-primary" style="font-size:12px;">Diterima</span>
                                                  <?php } else { ?>
                                                            <span class="rounded-pill text-light px-3 py-1" style="background-color:#F59520;font-size:12px;">Belum diterima</span>
                                                    <?php } ?>
                                              </div>
                                              <div class="fs-1 fw-bold"><?= $row['kode_seragam']; ?></div>
                              
                                              <div class="d-inline-flex">
                                                <div class="d-inline-flex w-50">
                                                  <i class="bi bi-geo-alt-fill me-2"></i>
                                                  <div class="me-2">Lokasi :</div>
                                                </div>
                                                <div class="text-muted">Ruang Kesiswaan  (Bu Suryani, SP.d)</div>
                                              </div>
                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                    <div class="alert alert-primary text-dark alert-light fade show border-0 shadow-md" role="alert">
                                            <div class="header">
                                              <h3 class="fw-bold fs-4" style="color:#26875e;"><i class='bx bxs-book-bookmark me-2'></i>BUKU</h3>
                                              <hr>
                                              <div class="w-100 d-flex justify-content-between">Kode 
                                                <?php if ($row['buku'] == '1') { ?>
                                                          <span class="rounded-pill text-light px-3 py-1 bg-primary" style="font-size:12px;">Diterima</span>
                                                  <?php } else { ?>
                                                            <span class="rounded-pill text-light px-3 py-1" style="background-color:#F59520;font-size:12px;">Belum diterima</span>
                                                    <?php } ?>
                                              </div>
                                              <div class="fs-1 fw-bold"><?= $row['kode_buku']; ?></div>
                              
                                              <div class="d-inline-flex">
                                                <div class="d-inline-flex w-50">
                                                  <i class="bi bi-geo-alt-fill me-2"></i>
                                                  <div class="me-2">Lokasi :</div>
                                                </div>
                                                <div class="text-muted">Ruang Perpustakaan  (Bu Yuni, SP.d)</div>
                                              </div>
                              
                                            </div>
                                        </div>
                                    </div>
                      
                                    </div>

                                </div>
                                <div class="diterima-container col-lg-5 col-md-12 mb-sm-5 mb-xs-5">
                                  <div class="bg-white shadow-md p-3 rounded-3">
                                      <div class="w-100 d-flex flex-column justify-content-center mb-2">
                                        <i class="bi bi-person-circle text-center" style="font-size: 5rem;"></i>
                                          <h5 class="fs-3 text-center fw-bold"><?= $row['nama']; ?></h5>
                                      </div>
                                        <div>
                                          <table class="table">
                                            <tbody>
                                              <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td class="text-muted"><?= $row['email']; ?></td>
                                              </tr>
                                              <tr>
                                                <td>Tgl Lahir</td>
                                                <td>:</td>
                                                <td class="text-muted"><?= $row['tanggal']; ?></td>
                                              </tr>
                                              <tr>
                                                <td>Telepon</td>
                                                <td>:</td>
                                                <td class="text-muted"><?= $row['telp']; ?></td>
                                              </tr>
                                              <tr>
                                                <td>Gender</td>
                                                <td>:</td>
                                                <td class="text-muted"><?= $row['gender']; ?></td>
                                              </tr>
                                              <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td class="text-muted"><?= $row['alamat']; ?></td>
                                              </tr>
                                              <tr>
                                                <td>Jurusan</td>
                                                <td>:</td>
                                                <td class="text-muted"><?= $row['jurusan']; ?></td>
                                              </tr>
                                              <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td><span class="rounded-pill text-light px-3 py-1" style="background-color:#32B47D;">Diterima</button></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                          <div class="row g-2">
                                            <div class="col-6">
                                            <a class="btn py-2 w-100 text-light" style="background-color:#32B47D;" href="bukti-penerimaan.php">Bukti Penerimaan</a>
                                            </div>
                                            <div class="col-6">
                                            <a class="btn btn-dark py-2 w-100" href="keluar.php">
                                              <i class="bi bi-box-arrow-right"></i>
                                                Keluar
                                            </a>
                                            </div>
                                        </div>
                                      </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                  <?php endwhile; ?>
                <!-- ========== End Diterima Page ========== -->

                <!-- ========== Start Ditolak Page ========== -->
        <?php } elseif (cek_tolak($_SESSION['user'])) { ?>
                  <body style="background-color: #f5f5f5; font-family: 'Poppins', sans-serif;">
                      <div class="container" style="width:100vw;">
                      <div class="row" style="margin-top:100px;">
                        <div class="col-lg-6 col-md-12">
                          <img src="asset/bg-ditolak(2).png" alt="" style="width:500px">
                        </div>
                        <div class="col-lg-6 col-md-12  d-flex flex-column justify-content-center">
                        <h1 class="fw-bold" style="font-size: 3.5rem;">MAAF</h1>
                        <h1 class="fw-bold text-warning" style="font-size: 3.5rem;">ANDA DITOLAK <i class="bi bi-x-circle-fill"></i></h1>
                        <p class="">Jangan cepat menyerah! Karena apabila satu pintu tertutup terdapat pintu lain yang terbuka.</p>
                        <p class=" fst-italic m-3">- Tapi ini bukan soal pintu</p>
                        <a href="keluar.php" class="mt-4 mb-sm-5 mb-xs-5 btn btn-warning py-2">Keluar</a>
                        </div>
                    </div>
                <!-- ========== End Ditolak Page ========== -->
        
                <!-- ========== Start Sender Page ========== -->
        <?php } elseif (cek_send($_SESSION['user'])) { ?>
                  <body style="background-color: #3C7DD7; font-family: 'Poppins', sans-serif;">
                    <div class="container mt-4" style="height:600px; width:100%;">
                      <div class="row" style="background-color: #3C7DD7;">
                        <div class="col-7">
                            <div class="alert alert-success" role="alert">
                              <h4 class="alert-heading gap-3">
                              <i class="bi bi-check-circle-fill"></i>
                              <b>Formulir Pendaftaran Terkirim</b>
                              </h4>
                              <hr>
                              <p class="mb-0 text-justify">Tunggu hingga admin mengkonfirmasi pendaftaran anda</p>
                            </div>
                            <img src="asset/send.png" alt="" style="width:500px">
                        </div>
                        <div class="bg-white col-5 p-3 rounded-3 h-50">
                          <div class="w-100 d-flex flex-column justify-content-center mb-2">
                            <i class="bi bi-person-circle text-center" style="font-size: 5rem;"></i>
                            <h2 class="fw-bold text-center">DATA DIRI</h2>
                    
                        <?php $table = tampilkan('nama', $_SESSION['user']); ?>
                        <?php while ($row = mysqli_fetch_assoc($table)): ?>
                                </div>
                                  <div>
                                    <table class="table">
                                      <tbody>
                                        <tr>
                                          <td class="w-25">Nama</td>
                                          <td>:</td>
                                          <td class="text-muted"><?= $row['nama']; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Email</td>
                                          <td>:</td>
                                          <td class="text-muted"><?= $row['email']; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Tgl Lahir</td>
                                          <td>:</td>
                                          <td class="text-muted"><?= $row['tanggal']; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Telepon</td>
                                          <td>:</td>
                                          <td class="text-muted"><?= $row['telp']; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Gender</td>
                                          <td>:</td>
                                          <td class="text-muted"><?= $row['gender']; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Alamat</td>
                                          <td>:</td>
                                          <td class="text-muted"><?= $row['alamat']; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Jurusan</td>
                                          <td>:</td>
                                          <td class="text-muted"><?= $row['jurusan']; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Status</td>
                                          <td>:</td>
                                          <td><span class="rounded-pill bg-warning text-light px-3 py-1">Terkirim</button></td>
                                        </tr>
                        
                                      </tbody>
                                    </table>
                                    <div class="d-inline-flex w-100 justify-content-end">
                                    <a class="btn btn-dark w-25 rounded-3" href="keluar.php">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                      Keluar
                                    </a>
                                  </div>
                                </div>
                                </div>
                            </div>
              <?php endwhile; ?>
                <!-- ========== End Sender Page ========== -->
      
                <!-- ========== Start Guest Page ========== -->
            <?php } else { ?>
                    <body style="background-color: #4982F5; font-family: 'Poppins', sans-serif;">
                    <div class="container mt-4" style="height:600px; width:100%;">
                      <div class="row">
                        <div class="col-lg-7 col-md-12">
                          <!-- ========== Start Error Start ========== -->
                          <?php if (isset($error)) { ?>
                                      <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>
                                        <div>
                                        <?= $error ?>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>
                          <?php } ?>
                          <!-- ========== End Error Start ========== -->
                  
                          <img class="guest-img" src="asset/homepage.png" alt="" style="width:500px;">
                          <h1 class="fw-bold text-white">PPDB SMKN 1 KERTOSONO</h1>
                          <div class="text-white">Selamat datang di portal layanan sistem informasi PPDB</div>
                          <div class="text-white">secara online SMK Negeri 1 Kertosono</div>
                        </div>

                        <!-- ========== Start Detail Sekolah ========== -->
                        <div id="detail-container" class="col-lg-5 col-sm-12 col-xs-12  bg-white p-3 rounded-3 shadow-md h-50">
                          <img src="asset/logo-smk.png " alt="" class="mb-3">
                          <h5 class="fw-bold">SMK NEGERI 1 KERTOSONO</h5>
                          <p class="text-muted text-justify">Adalah sekolah kejuruan tingkat menengah yang berdiri sejak tahun 2001 sebagai alih fungi dari SLTP-PPK bedasarkan penetapan Kepala Dinas Pendidikan Dan Kebudayaan Provinsi Jawa Timur Nomor: 421.5/238/112.09/2001, tanggal 27 Agustus.</p>
                          <hr class="bg-secondary border-top border-secondary">
                          <h5>Detail Sekolah</h5>
                          <div class="detail-sekolah">
                            <table class="table">
                              <tbody>
                              <th scope="row">
                              <i class="bi bi-mortarboard-fill"></i>
                                  </th>
                                  <td>NPSN</td>
                                  <td>:</td>
                                  <td class="text-muted">20538341</td>
                                </tr>
                                <tr>
                                  <th scope="row">
                                  <i class="bi bi-mortarboard-fill"></i>
                                  </th>
                                  <td>Status</td>
                                  <td>:</td>
                                  <td class="text-muted">Negeri
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row">
                                  <i class="bi bi-geo-alt-fill"></i>
                                  </th>
                                  <td>Alamat</td>
                                  <td>:</td>
                                  <td class="text-muted">Jl. Langsep, Desa No.24, Pelem, Kec. Kertosono, Kabupaten Nganjuk, Jawa Timur</td>
                                </tr>
                                <tr>
                                  <th scope="row">
                                  <i class="bi bi-telephone-fill"></i>
                                  </th>
                                  <td>Telepon</td>
                                  <td>:</td>
                                  <td class="text-muted">(0358) 551466</td>
                                </tr>
                                <tr>
                                <th scope="row">
                                <i class="bi bi-globe"></i>
                                  </th>
                                  <td>Website</td>
                                  <td>:</td>
                                  <td><a href="https://smkn1kts.sch.id" class="link-offset-2 link-underline link-underline-opacity-0">https://smkn1kts.sch.id</a></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="d-inline-flex w-100 gap-2">
                            <!-- ========== Start Modal Daftar ========== -->
                          <button type="button" class="w-50 btn btn-warning rounded-3 p-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Daftar</button>
                    
                          <!-- Modal -->
                          <div class="modal fade text-dark" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <img src="asset/logo.png" class="me-3" style="width:50px;" alt="">
                                  <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel" >Formulir Pendaftaran Siswa Baru</h1>
                                  <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body p-3">
                                <form action="" method="post" class="needs-validation" novalidate>
                                  <div class="row mb-3 g-3">
                                    <div class="col-6">
                                      <label for="nama" class="form-label">Nama Lengkap</label>
                                      <input type="text" class="form-control" id="nama" name="nama" value="<?= $_SESSION['user'] ?> " readonly required>
                                      <div class="invalid-feedback">
                                        Nama wajib diisi!
                                      </div>
                                    </div>
                                    <div class="col-6">
                                      <label for="email" class="form-label">Email</label>
                                      <input type="text" class="form-control" id="email" name="email" required>
                                      <div class="invalid-feedback">
                                        Email wajib diisi!
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row mb-3 g-3">
                                    <div class="col-6">
                                      <label for="tanggal" class="form-label">Tanggal Lahir</label>
                                      <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                      <div class="invalid-feedback">
                                        Tanggal lahir wajib diisi!
                                      </div>
                                    </div>
                                    <div class="col-6">
                                    <label for="telp" class="form-label">Nomor Telepon</label>
                                      <input type="tel" class="form-control" id="telp" name="telp" maxlength="15" required>
                                      <div class="invalid-feedback">
                                        No.Telepon wajib diisi!
                                      </div>
                                    </div>
                                  </div>
                                  <fieldset class="row mb-3">
                                    <legend class="col-form-label col-2 pt-0">Gender</legend>
                                    <div class="col-10">
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="L" checked>
                                        <label class="form-check-label" for="gender1">
                                          Laki - Laki
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="P" >
                                        <label class="form-check-label" for="gender2">
                                          Perempuan
                                        </label>
                                      </div>
                                    </div>
                                  </fieldset>
                                  <div class="row mb-3 g-3">
                                    <div class="col-12">
                                      <label for="alamat" class="form-label">Alamat</label>
                                      <textarea class="form-control" id="alamat"name="alamat" rows="2" required></textarea>
                                      <div class="invalid-feedback">
                                        Alamat wajib diisi!
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row mb-3 g-3">
                                    <div class="col-12">
                                      <label for="jurusan" class="form-label">Jurusan</label>
                                      <select class="form-select" aria-label="Default select example" name="jurusan" required>
                                        <option value="" selected>Pilih Jurusan</option>
                                        <option value="Kuliner">Kuliner</option>
                                        <option value="Desain Produksi Busana">Desain Produksi Busana</option>
                                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                        <option value="Teknik Mesin">Teknik Mesin</option>
                                        <option value="Teknik Intalasi Tenaga Listrik">Teknik Intalasi Tenaga Listrik</option>
                                        <option value="Teknik Otomasi Industri">Teknik Otomasi Industri</option>
                                      </select>
                                      <div class="invalid-feedback">
                                        Jurusan wajib diisi!
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row" style="display: none;">
                                    <div class="col-12">
                                    <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="<?= code(); ?>" hiddden required>
                                    <input type="text" class="form-control" id="kode_seragam" name="kode_seragam" value="<?= code(); ?>" hiddden required>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-dark py-2 px-4" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" name="submit-daftar" class="btn btn-primary py-2 px-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                  </svg>
                                    Kirim
                                  </button>
                                </form>
                                </div>
                              </div>
                            </div>
                          </div>  
                          <!-- ========== End Modal Daftar ========== -->
                            <a class="btn btn-dark p-2 w-50 rounded-3" href="keluar.php">Keluar</a>
                          </div>
                        </div>
                        <!-- ========== End Detail Sekolah ========== -->
                    </div>
          <?php } ?>
        <!-- ========== End Guest Page ========== -->

    <!-- Datatables -->
    <script>
      $(document).ready(function () {
          $('#allData').DataTable({
              scrollX: true,
          });
      });
    </script>


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