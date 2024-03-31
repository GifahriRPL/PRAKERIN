<?php
    include "../functions.php";

        //Cek Aapakah Sudah Login
        if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
            header("Location: ../login.php");
          }
      
             $id = mysqli_real_escape_string($conn, $_GET["id"]);

            $result = mysqli_query($conn, "DELETE FROM tb_anggota WHERE id = $id");
                 if($result === true){
                        echo "<script>
                        alert('Data Berhasil Di Hapus!');
                        window.location = 'daftar_siswa.php';
                        </script>";
                }else{
                        echo "<script>
                        alert('Data Gagal Di Hapus!');
                        </script>";
                }
                    exit;

?>