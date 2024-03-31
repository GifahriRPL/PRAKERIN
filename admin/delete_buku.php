<?php
    include "../functions.php";

        //Cek Aapakah Sudah Login
        if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
            header("Location: ../login.php");
          }
      
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    
    $query = ("SELECT * FROM tb_buku LEFT JOIN buku_penulis ON buku_penulis.id = tb_buku.id LEFT JOIN penulis ON penulis.author_id = buku_penulis.author_id LEFT JOIN tempat ON tempat.place_id = tb_buku.place_id WHERE tb_buku.id = '$id'");
    $data = query($query)[0];

    $id_tempat = $data["place_id"];
    $id_penulis = $data["author_id"];
    $gambar = $data['gambar'];

    $path = "../asset/img/thumb-book/". $data["gambar"];


    if(!unlink($path)){
        echo "gambar gagal dihapus";
    }


    $result = mysqli_multi_query($conn, "DELETE FROM tb_buku WHERE id = $id;
            DELETE FROM buku_penulis WHERE id = $id;
            DELETE FROM penulis WHERE author_id = $id_penulis;
            DELETE FROM tempat WHERE place_id = $id_tempat;");
        if($result === true){
            echo "<script>
            alert('Data Berhasil Di Hapus!');
            window.location = 'index.php';
            </script>";
        }else{
            echo "<script>
            alert('Data Gagal Di Hapus!');
            </script>";
        }
        exit;

?>