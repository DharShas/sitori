<?php
    session_start();

    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    
    require "functions.php";

    // Ambil data di URL
    $id = $_GET["id"];

    // query data pegawai berdasarkan id
    $pgw = query("SELECT*FROM pegawai WHERE id = $id")[0];
    // var_dump($mhs["id"]);
    
    // cek apakah tombol submit sudah ditekan atau belum
    if(isset($_POST["submit"])){
        
        // Cek apakah data berhasil diubah atau tidak
        if(ubah($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil diubah.');
                    document.location.href = 'index.php'
                </script>
            ";

        }else{
            echo "
            <script>
                alert('Data gagal diubah.');
                document.location.href = 'index.php'
            </script>";
            // echo("Error description: " . $conn -> error);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Pegawai</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="reg">
    <!--membuat halaman ubah-->
    <div class="card-reg">
        <div class="container regist">
            <div class="card-registrasi">
                <h1 class="reg">Ubah Data Pegawai</h1>

                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $pgw["id"];?>">
                    <input type="hidden" name="fotoLama" value="<?= $pgw["foto"];?>">
                    
                        <div class="mb-3">
                            <label for="id_pgw" class="form-label">ID Pegawai</label>
                            <input type="text" class="form-control" id="id_pgw" name="id_pgw"
                                value="<?=$pgw["id_pgw"];?>">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?=$pgw["nama"];?>">
                        </div>
                        <div class="mb-3">
                            <label for="shift">Shift :</label>
                            <select class="form-select" aria-label="Default select example" name="shift" id="shift"
                                value="<?=$pgw["shift"];?>">
                                <!-- <option selected>Tidak Ada</option> -->
                                <option value="Pagi">Pagi</option>
                                <option value="Malam">Malam</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="<?=$pgw["alamat"];?>">
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
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