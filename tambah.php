<?php
    session_start();

    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    
    require "functions.php";
    // cek apakah tombol submit sudah ditekan atau belum
    if(isset($_POST["submit"])){
        
        // var_dump($_POST);
        // var_dump($_FILES);die;

        

        // Cek apakah data berhasil ditambahkan atau tidak
        if(tambah($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil ditambahkan.');
                    document.location.href = 'index.php'
                </script>
            ";

        }else{
            echo "
            <script> 
                alert('Data gagal ditambahkan.');
                document.location.href = 'index.php'
            </script>";
            // echo "<br>";
            // echo mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pegawai</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="reg">
    <!--membuat halaman tambah data-->
    <div class="card-reg">
        <div class="container regist">
            <div class="card-registrasi">
                <h1 class="reg">Tambah Data Pegawai</h1>

                <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="id_pgw" class="form-label">ID Pegawai</label>
                            <input type="text" class="form-control" id="id_pgw" name="id_pgw">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="shift">Shift :</label>
                            <select class="form-select" aria-label="Default select example" name="shift" id="shift">
                                <option selected>Tidak Ada</option>
                                <option value="Pagi">Pagi</option>
                                <option value="Malam">Malam</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
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