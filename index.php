<?php
    session_start();

    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    //memanggil file functions
    require 'functions.php';

    $data_perhalaman = 5;
    $total_data = count(query("SELECT * FROM pegawai"));
    $jum_hal = ceil($total_data / $data_perhalaman);
    $hal_aktif = (isset($_GET["hal"])) ? $_GET["hal"] : 1;
    // halaman $hal_aktif
    $awalData = ($data_perhalaman * $hal_aktif) - $data_perhalaman;

    //untuk menampilkan data pegawai pada database
    $pegawai = query("SELECT * FROM pegawai LIMIT $awalData,$data_perhalaman");

    // tombol cari ditekan
    if(isset($_POST["cari"])){
        $pegawai = cari($_POST["keyword"]);
    }
    
?>
<!--nice-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="ind">
    <!--membuat navbar-->
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
        <div class="container navigator">
            <a class="navbar-brand logo" href="index.php"><b>Numv</b><span class="nav-col">Market</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah.php">Tambah Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container home-container">
        <h1 class="text-center">Daftar Pegawai</h1>
        <br>

        <!-- kode form cari -->
        <form action="" method="POST">
            <div class="container d-flex justify-content-start ">
                <input class="form-control" type="text" name="keyword" size="30" autofocus
                    placeholder="massukan keyword pencarian" autocomplete="off" id="keyword">
                <div class="tombol">
                    <button class="btn btn-primary" type="submit" name="cari" id="tombol-cari">Cari</button>
                </div>
            </div>
        </form>
        <br>
        <!-- //perintah pembuatan table -->
        <div id="container">

            <table class="table table-bordered table-striped" border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>No.</th>
                    <th>Id Pegawai</th>
                    <th>Nama</th>
                    <th>Shift</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
                <!-- //perulangan untuk menampilkan data -->
                <?php $i = 1; ?>
                <?php foreach($pegawai as $row) :?>
                <!-- //program untuk menampilkan data -->
                <tr>
                    <td><?= $i?></td>
                    <td><?= $row["id_pgw"]?></td>
                    <td><?= $row["nama"]?></td>
                    <td><?= $row["shift"]?></td>
                    <td><?= $row["alamat"]?></td>
                    <td class="text-center"><img class="img-thumbnail" src="img/<?= $row["foto"]?>" width="50" alt="">
                    </td>
                    <td>
                        <a class="btn btn-primary" href="ubah.php?id=<?= $row["id"]?>">Ubah</a> |
                        <a class="btn btn-danger" href="hapus.php?id=<?= $row["id"]?>"
                            onclick="return confirm('Yakin ingin menghapus data pegawai ini?')">Hapus</a>
                    </td>
                </tr>
                <?php $i++?>
                <?php endforeach;?>
            </table>

            <div class="d-flex justify-content-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <?php if($hal_aktif > 1) :?>
                            <a class="page-link" href="?hal=<?= $hal_aktif-1;?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            <?php endif;?>
                        </li>

                        <?php for($i = 1; $i <= $jum_hal; $i++) :?>
                        <?php if($i == $hal_aktif) :?>
                        <li class="page-item active"><a class="page-link" href="?hal=<?= $i;?>"><?= $i ?></a></li>
                        <?php else : ?>
                        <li class="page-item"><a class="page-link" href="?hal=<?= $i;?>"><?= $i ?></a></li>
                        <?php endif;?>
                        <?php endfor;?>

                        <?php if($hal_aktif < $jum_hal) :?>
                        <a class="page-link" href="?hal=<?= $hal_aktif+1;?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        <?php endif;?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--membuat footer-->
    <footer class="container-fluid bg-light text-center text-lg-start p-0">
        <div class="text-center p-3 foot">
            © 2021 Copyright:
            <a class="text-dark" href="#">NumvMarket.com</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="js/script.js"> </script>
</body>

</html>