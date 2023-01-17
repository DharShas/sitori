<?php 
    require 'functions.php';
    session_start();

    // cek cookie
    if(isset($_COOKIE['set']) && isset($_COOKIE['key'])){
        $id = $_COOKIE['set'];
        $key = $_COOKIE['key'];
        
        //  ambil username berdasarkan id
        $result = mysqli_query($conn, "SELECT username FROM admin WHERE id = $id");

        $row = mysqli_fetch_assoc($result);

        // cek cookie dan username
        if($key === hash('sha256', $row['username'])){
            $_SESSION['login'] = true;
        }

    }

    if (isset($_SESSION["login"])){
        header("Location: index.php");
        exit;
    }

    if(isset($_POST["login"])){

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username';");

        // cek username
        if(mysqli_num_rows($user) === 1){

            // cek password
            $row = mysqli_fetch_assoc($user);
            if(password_verify($password, $row["password"])){
                // set session
                $_SESSION["login"] = true;
                // check remember me
                if(isset($_POST['ingat'])){

                    // Buat cookie
                    setcookie('set', $row['id'], time()+60);
                    setcookie('key', hash('sha256',$row['username']), time()+60);
                }
                header("Location: index.php");
                exit;
            }
        }
        $error = true;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman login</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="login">
    <!--pembuatan halaman login-->
    <div class="card-by">
        <div class="card-body">
            <?php if (isset($error)) :?>
            <p style="color: red; font-style: italic;">Nama Pengguna atau Kata Sandi Salah!</p>
            <?php endif;?>

            <h1 class="login">Masuk</h1>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="ingat" name="ingat">
                    <label class="form-check-label" for="ingat">Ingatkan Saya!</label>
                </div>
                <div class="text-center">
                    <button  type="submit" name="login" class="btn btn-primary">Kirim</button>
                </div>
            </form>
            <div class="text-center">
                <p class="regis"><a class="registrasi"href="registrasi.php">Daftar Untuk Memiliki akun</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>