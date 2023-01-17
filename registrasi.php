<?php 

    require 'functions.php';

    if(isset($_POST["Registrasi"])){
        
        if(registrasi($_POST) > 0){
            echo "<script>
                alert('username baru berhasil ditambahkan!');
            </script>";
            header("Location: login.php");
        } else {
            echo mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar Akun</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="reg">
    <!--membuat halaman registrasi-->
    <div class="card-reg">
    <div class="container regist">
        <div class="card-registrasi">
            <h1 class="reg">Halaman Tambah Data</h1>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="id_adm" class="form-label">ID Admin</label>
                    <input type="text" class="form-control" name="id_adm" id="id_adm">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="nama">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" id="password2" name="password2">
                </div>
                <div class="text-center">
                    <button type="submit" name="Registrasi" class="btn btn-primary long">Daftar</button>
                </div>
                
            
            </form>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>