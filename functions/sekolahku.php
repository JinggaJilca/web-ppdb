<?php 
// Escape injection
function escape($nama_raw){
    global $link;
    $nama = mysqli_escape_string($link, $nama_raw);
    return $nama;
}

// Register user
function register_user($nama,$pass,$email){
    $nama = escape($nama);
    $pass = escape($pass);
    $email = escape($email);
    // $pass = password_hash($pass, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (nama, password, email) VALUES ('$nama', '$pass', '$email')";
    return run($query);
}

//Check nama double
function cek_nama($nama){
    global $link;
    $nama = escape($nama);
    $query = "SELECT * FROM users WHERE nama = '$nama'";
    if($result = mysqli_query($link,$query)){
        if(mysqli_num_rows($result) == 0) return true;
        else return false;
    }
}

// Masuk
function cek_data($nama, $pass){
    global $link;
    $query = "SELECT password FROM users WHERE nama = '$nama'";
    $result = result($query);
    $result = mysqli_fetch_assoc($result)['password'];

    if($result === $pass) return true;
    else return false;

    // if(password_verify($pass, $result)) return true;
    // else return false;
}

//Cek User Terdaftar
function cek_pengguna($nama){
    global $link;
    $nama = escape($nama);
    $query = "SELECT * FROM users WHERE nama = '$nama'";
    if($result = result($query)){
        if(mysqli_num_rows($result) == 1) return true;
        else return false;
    }
}

// Redirect Login
function redirect_login($nama){
    $_SESSION['user'] = $nama;
    header('Location: index.php');
}

// Seleksi Role
function cek_role($nama){
    global $link;
    $nama = escape($nama);
    $query = "SELECT role FROM users WHERE nama = '$nama'";
    $result = mysqli_query($link,$query);
    $role = mysqli_fetch_assoc($result)['role'];
    
        if($role == 1) return true;
        else return false;
}

// Tampilkan Bedasarkan kolom, kondisi
function tampilkan($kolom, $kondisi){
    $query = "SELECT * FROM users WHERE $kolom = '$kondisi'";
    return result($query);
}

// Hasil
function result($query){
    global $link;
    if($result = mysqli_query($link, $query) or die('Gagal')){
        return $result;
    }
}

// Kode
function code(){
    $number = rand(100,100000); 
    return $number;
}

// Tambah Data - Admin

// Daftar - User
function daftar_siswa($nama, $email, $tanggal, $telp, $gender, $alamat, $jurusan, $kode_buku, $kode_seragam){
    
    $query = "UPDATE users SET 
    email = '$email',
    tanggal = '$tanggal', 
    telp = '$telp', 
    gender = '$gender', 
    alamat = '$alamat', 
    jurusan = '$jurusan', 
    kode_buku = '$kode_buku', 
    kode_seragam = '$kode_seragam', 
    daftar = '1' 
    WHERE users . nama = '$nama'";

    return (run($query));

}
// Cek Terkirim
function cek_send($nama){
error_reporting(0);
    global $link;
    $query = "SELECT daftar FROM users WHERE nama = '$nama'";
    $result = mysqli_query($link,$query);
    $send = mysqli_fetch_assoc($result)['daftar'];
    
        if($send == 1) return true;
        else return false;
}


// Cek Terima
function cek_terima($nama){
    error_reporting(0);
        global $link;
        $query = "SELECT terima FROM users WHERE nama = '$nama'";
        $result = mysqli_query($link,$query);
        $send = mysqli_fetch_assoc($result)['terima'];
        
            if($send == 1) return true;
            else return false;
    }

// Cek Ditolak
function cek_tolak($nama){
    error_reporting(0);
        global $link;
        $query = "SELECT tolak FROM users WHERE nama = '$nama'";
        $result = mysqli_query($link,$query);
        $send = mysqli_fetch_assoc($result)['tolak'];
        
            if($send == 1) return true;
            else return false;
    }
    

//Run Query
function run($query){
    global $link;
        if(mysqli_query($link, $query)) return true;
        else return false;
    }

// Dashboard
function hitung_pinjam($kolom1, $kondisi1){
    $query = "SELECT buku FROM users WHERE $kolom1 = $kondisi1 AND terima = 1 AND role = 0";
    $count = mysqli_num_rows(result($query));
    return $count;
}

function hitung_user(){
    global $link;
    $query = "SELECT role FROM users WHERE role = 0";
    $count = mysqli_num_rows(result($query));
    return $count;
}
function hitung_daftar(){
    global $link;
    $query = "SELECT daftar FROM users WHERE role = 0 AND daftar = 1 AND terima = 0 AND tolak = 0";
    $count = mysqli_num_rows(result($query));
    return $count;
}
function hitung_terima(){
    global $link;
    $query = "SELECT terima FROM users WHERE role = 0 AND terima = 1 AND daftar = 1 AND tolak = 0";
    $count = mysqli_num_rows(result($query));
    return $count;
}
function hitung_tolak(){
    global $link;
    $query = "SELECT tolak FROM users WHERE role = 0 AND tolak = 1 AND daftar = 1 AND terima = 0";
    $count = mysqli_num_rows(result($query));
    return $count;
}

// Admin Ubah
function ubah_data($id, $nama, $email, $tanggal, $telp, $gender, $alamat, $jurusan,){
    
    $query = "UPDATE users SET 
    nama = '$nama',
    email = '$email',
    tanggal = '$tanggal', 
    telp = '$telp', 
    gender = '$gender', 
    alamat = '$alamat', 
    jurusan = '$jurusan'
    WHERE users . id = '$id'";

    return (run($query));
    }

// Admin Hapus
function hapus_data($id){
    $query = "DELETE FROM users WHERE id= $id";
    return run ($query);
}
// Menampilkan Table
function tampilkan_all(){
    $query = "SELECT * FROM users WHERE role = 0 ORDER BY id DESC";
    return result($query);
}

// Menampilkan Data Yang Diterima
function tampilkan_daftar(){
    $query = "SELECT * FROM users WHERE daftar = 1 AND terima = 0 AND tolak = 0";
    return result($query);
}
function tampilkan_tolak(){
    $query = "SELECT * FROM users WHERE daftar = 1 AND terima = 0 AND tolak = 1";
    return result($query);
}
function tampilkan_terima(){
    $query = "SELECT * FROM users WHERE daftar = 1 AND terima = 1 AND tolak = 0";
    return result($query);
}
function terima($id){
    $query = "UPDATE users SET terima = '1' WHERE users . id = '$id' ;";
    return (run($query));
}
function tolak($id){
    $query = "UPDATE users SET tolak = '1' WHERE users . id = '$id' ;";
    return (run($query));
}

function terima_barang($id, $kolom){
    $query = "UPDATE users SET $kolom = '1' WHERE users . id = $id;";
    return run($query);
}
function tampilkan_barang($kolom){
    $query = "SELECT * FROM users WHERE $kolom = 0";
    return result($query);
}
function tampilkan_single($nama){
    $query = "SELECT * FROM users WHERE nama = '$nama'";
    return result($query);
}

function tambah_data($nama, $pass, $email, $tanggal, $telp, $gender, $alamat, $jurusan, $kode_buku, $kode_seragam){
    $query = "INSERT INTO users (nama, password, email, tanggal, telp, gender, alamat, jurusan, kode_buku, kode_seragam, daftar)
    VALUES ('$nama', '$pass', '$email', '$tanggal', '$telp','$gender','$alamat','$jurusan','$kode_buku','$kode_seragam', 1)";
    return run($query);
}

// Excerpt Kolom Alamat
function excerpt($string){
    $string = substr($string,0,20);
    return $string."...";
}

?>