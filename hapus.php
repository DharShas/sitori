<?php 
    //memulai sesion
    session_start();
    //mengecek user apakah sudah login atau tidak
    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    //mengambil program dari functions
    require "functions.php";
    $id = $_GET["id"];
    //perintah untuk menghapus dan mengecek apakah penghapusan sudah berhasil atau tidak
    if(hapus($id) > 0){
        echo "
                <script>
                    alert('Data berhasil dihapus.');
                    document.location.href = 'index.php'
                </script>
            ";
    }else{
        echo "
                <script>
                    alert('Data gagal dihapus.');
                    document.location.href = 'index.php'
                </script>
            ";
    }
?>