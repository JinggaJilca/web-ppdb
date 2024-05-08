<?php 
require_once "core/init.php";

$id = $_GET['id'];
if(isset($_GET['id'])){
    if(hapus_data($id)) header ('Location: index.php');
}else{
    $error = "Gagal";
}
?>