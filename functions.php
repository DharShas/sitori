<?php
    // koneksi ke database
    $conn = mysqli_connect("localhost","root","","market");

   // fungsi yang mengambil data dari mahasiswa
   function query($query){
    global $conn;
    $result = mysqli_query($conn, $query); // membawa seluruh data
    $rows = []; // membuat wadah untuk data

    // perulangan untuk mengambi satu persatu data dan massukkan ke wadah rows
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    // Ambil data dari tiap elemen form
    $id_pgw = htmlspecialchars($data["id_pgw"]);
    $nama = htmlspecialchars($data["nama"]);
    $shift = htmlspecialchars($data["shift"]);
    $alamat = htmlspecialchars($data["alamat"]);

    // upload gambar
    $foto = upload();
    if(!$foto){
        return false;
    }

    // query insert data
    
    $query = "INSERT INTO pegawai 
                VALUES
                ('','$nama','$id_pgw','$shift','$alamat','$foto')";
    $data = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
//upload gambar
function upload(){
    $namafile = $_FILES['foto']['name'];
    $ukuranfoto = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];

    // cek gambar di upload atau tidak
    if($error === 4){
        echo "<script>
            alert('Pilih foto Terlebih dahulu!');
        </script>";
        return false;
    }

    // cek apakah file gambar atau bukan
    $extensiFotoValid = ['jpg','jpeg','png','gif'];
    $extensiFoto = explode('.',$namafile);
    $extensiFoto = strtolower(end($extensiFoto));
    if(!in_array($extensiFoto,$extensiFotoValid)){
        echo "<script>
            alert('Yang anda upload bukan Foto');
        </script>";
    }

    // cek apakah file terlalu besar atau lebih dari 1000kb
    if($ukuranfoto > 1000000){
        echo "<script>
            alert('Ukuran file yang anda upload terlalu besar/lebih dari 1Mb');
        </script>";
        return false;
    }

    // lulus pengecekan
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensiFoto;
    if(move_uploaded_file($tmpname, 'img/'.$namaFileBaru)){
        
        return $namaFileBaru;
    }

}
//menghapus data
function hapus($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM pegawai WHERE id = $id");
    return mysqli_affected_rows($conn);
}
//mengubah data
function ubah($data){
    global $conn;
    // Ambil data dari tiap elemen form
    $id = $data["id"];
    $id_pgw = htmlspecialchars($data["id_pgw"]);
    $nama = htmlspecialchars($data["nama"]);
    $shift = htmlspecialchars($data["shift"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $fotoLama = htmlspecialchars($data["fotoLama"]);

    // cek apakah gambar baru di upload atau tidak
    if($_FILES['foto']['error'] === 4){
        $foto = $fotoLama;
    }else{
        $foto = upload();
    }

    // query update data
    $query = "UPDATE pegawai SET
                id_pgw ='$id_pgw',
                nama = '$nama',
                shift = '$shift',
                alamat = '$alamat',
                foto = '$foto'
                WHERE id = $id";
    
    $data = mysqli_query($conn, $query);
    // var_dump($id);

    return mysqli_affected_rows($conn);
}
//mencari data
function cari($keyword){
    $query = "SELECT * FROM pegawai
            WHERE nama LIKE '%$keyword%' OR
            id_pgw LIKE '%$keyword%' OR
            shift LIKE '%$keyword%' OR
            alamat LIKE '%$keyword%'";

    return query($query);
}
//untuk menambah data pada user
function registrasi($data){
    global $conn;

    $id_adm = strtolower(stripslashes($data["id_adm"]));
    $nama = strtolower(stripslashes($data["nama"]));
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    
    // cek username sudah ada atau belum
    $result = mysqli_query($conn,"SELECT username FROM admin WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
            alert('Username sudah terdaftar!');
            </script>";
        return false;
    }
    // cek konfirmasi paswword
    if($password !== $password2){
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    

    // tambahkan username dan password ke database
    mysqli_query($conn, "INSERT INTO admin VALUES('', '$id_adm', '$nama', '$username','$password')");

    return mysqli_affected_rows($conn);

}
?>