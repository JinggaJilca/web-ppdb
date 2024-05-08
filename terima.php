<?php
require_once "core/init.php";
if (!isset($_SESSION['user'])) {
  $_SESSION['msg'] = "";
  $error = "Anda Harus Masuk Terlebih Dahulu";
  header('Location: masuk.php');
}

if (isset($_SESSION['logout'])) {
  $error = "Anda Harus Keluar Terlebih Dahulu";
  unset($_SESSION['logout']);
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
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.css">
      
      <!-- Boxicons -->
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

      <!-- External CSS -->
      <link rel="stylesheet" href="css/style-sekolaku.css">

      <!-- Internal CSS -->
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400;1,600&display=swap');

        /* Datatables */
        div.dataTables_wrapper {
        margin: 0 auto;
        }      
        
        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
          .sidebar-full{
            display:none;
          }
          .card-title{
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
      <title>Terima - Sekolaku</title>
      </head>

        <!-- Admin Page Start -->
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
                <!-- Sidebar Small Start -->
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
                <!-- Sidebar Small End -->
                <h4 class="fw-bold">Diterima</h4>
                <div class="text-muted">Data di bawah ini merupakan calon peserta didik baru</div>
                </div>
            </div>    
          
            <!-- Main Content -->
            <div class="row">
              <div class="col-lg-10 offset-lg-2 mb-3">
                <!-- Error Start -->
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
              </div>

            <div class="row">
              <div class="col-lg-10 col-md-12 offset-lg-2">
              <div class="w-100 p-3 rounded-3 bg-white shadow-md">
                  <!-- Table Start -->
                  <h6>Tabel Pendaftar Diterima</h6>
                  <hr>
                  <!-- <a href="peserta-diterima.php" class="btn btn-primary">Unduh Semua</a> -->
                  <!-- <div class="mb-3"><button type="button" class="btn btn-success"><i class="bi bi-plus-circle me-2 text-white"></i>Unduh Tabel</button></div> -->
                  <table id="allData" class="display nowrap table table-striped" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No.Telepon</th>
                                <th>L/P</th>
                                <th>Tgl Lahir</th>
                                <th>Alamat</th>
                                <th>Jurusan</th>
                                <th>Kode Buku</th>
                                <th>Kode Seragam</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $data = tampilkan_terima(); ?>
                          <?php $no = 0; ?>
                          <?php while ($row = mysqli_fetch_assoc($data)): ?>
                            <?php $no++; ?>
                              <tr>
                              <td><?= $no; ?></td>
                              <td>
                                
                                    <!-- Modal Ubah Start -->
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn text-light" style="background-color:#32B47D;" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $row['id']; ?>"><i class="bi bi-eye-fill"></i></button>
                                    <a href="bukti-penerimaan.php?id=<?= $row['id'] ?>" type="button" class="btn text-light link-underline link-underline-opacity-0 text-white" style="background-color:#4982F5;"><i class="bi bi-download me-2"></i>Unduh Bukti</a>

                                      <!-- Modal -->
                                      <form action="" method="post" class="needs-validation" novalidate>
                                  
                                      <!-- Modal -->
                                      <div class="modal fade text-dark" id="staticBackdrop<?= $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <img src="asset/logo.png" class="me-3" style="width:50px;" alt="">
                                              <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Peserta Didik Baru</h1>
                                              <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body p-3">
                                            <form action="" method="post" class="needs-validation" novalidate>
                                                <div class="row mb-3 g-3 d-flex align-items-center">
                                                    <div class="col-4">
                                                        <input hidden type="text" class="form-control" id="id" name="id" value="<?= $row['id']; ?>" required>
                                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control border-0" id="nama" name="nama" value="<?= $row['nama']; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 g-3 d-flex align-items-center">
                                                    <div class="col-4">
                                                    <label for="nama" class="form-label">Email</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control border-0" id="nama" name="nama" value="<?= $row['email']; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 g-3 d-flex align-items-center">
                                                    <div class="col-4">
                                                    <label for="nama" class="form-label">No.Telepon</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control border-0" id="nama" name="nama" value="<?= $row['telp']; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 g-3 d-flex align-items-center">
                                                    <div class="col-4">
                                                    <label for="nama" class="form-label">L/P</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control border-0" id="nama" name="nama" value="<?= $row['gender']; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 g-3 d-flex align-items-center">
                                                    <div class="col-4">
                                                    <label for="nama" class="form-label">Tgl Lahir</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control border-0" id="nama" name="nama" value="<?= $row['tanggal']; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 g-3 d-flex align-items-center">
                                                        <div class="col-4">
                                                          <label for="nama" class="form-label">Alamat</label>
                                                        </div>
                                                        <div class="col-8">
                                                          <textarea class="form-control" id="alamat"name="alamat" rows="2" readonly disabled><?= $row['alamat']; ?></textarea>
                                                        </div>
                                                    </div>
                                                <div class="row mb-3 g-3 d-flex align-items-center">
                                                    <div class="col-4">
                                                    <label for="nama" class="form-label">Jurusan</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control border-0" id="nama" name="nama" value="<?= $row['jurusan']; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 g-3 d-flex align-items-center">
                                                    <div class="col-4">
                                                    <label for="kode_buku" class="form-label">Kode Buku</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control border-0" id="kode_buku" name="kode_buku" value="<?= $row['kode_buku']; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 g-3 d-flex align-items-center">
                                                    <div class="col-4">
                                                    <label for="kode_seragam" class="form-label">Kode Seragam</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control border-0" id="kode_seragam" name="kode_seragam" value="<?= $row['kode_seragam']; ?>" readonly disabled>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>  
                                    <!-- Modal Ubah End -->
                                  </td> 
                                  </td>
                              
                              
                                  <td> <?= $row['nama']; ?> </td>
                                  <td><?= $row['email']; ?></td>
                                  <td> <?= $row['telp']; ?></td>
                                  <td><?= $row['gender']; ?></td>
                                  <td><?= $row['tanggal']; ?></td>
                                  <td><?= excerpt($row['alamat']); ?></td>
                                  <td><?= $row['jurusan']; ?></td>
                                  <td><?= $row['kode_buku']; ?></td>
                                  <td><?= $row['kode_seragam']; ?></td>
                              
                              </tr>   
                            <?php endwhile; ?>                       
                        </tbody>
                    </table>
                  <!-- Table End -->
              </div>
            </div>

                <!-- Sidebar End -->
              </div>
            </div>
          </div>
        <?php } ?>
        <!-- Admin page End -->

        
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