<?php
include "../functions.php";

if(!isset($_SESSION["login"]) && !isset($_SESSION["user"])){
  header("Location: ../login.php");
}

$user = $_SESSION["user"];
$account = query("SELECT * FROM tb_anggota WHERE nis = '$user'")[0];
$query = query("SELECT id FROM tb_anggota WHERE nis  = '$user'")[0];
$id_user = $query["id"];
$id_buku = mysqli_real_escape_string($conn, $_GET["id"]);

$query = ("SELECT * FROM tb_buku LEFT JOIN buku_penulis ON buku_penulis.id = tb_buku.id LEFT JOIN penulis ON penulis.author_id = buku_penulis.author_id LEFT JOIN tempat ON tempat.place_id = tb_buku.place_id WHERE tb_buku.id = '$id_buku'");
$baru = query($query)[0];
$judul_buku = $baru["judul"];
$jmlhbuku = $baru["jumlah_buku"];

$fitur_peminjaman = '0';
 if($data = query("SELECT sett1 FROM admin_settings WHERE id = '1' AND sett1 = '1'")){
  $fitur_peminjaman = $data[0]['sett1'];
  
    }


if(isset($_POST["pinjambuku"])){
  if($baru["jumlah_buku"] == 0){
    echo "<script>
        alert('BUKU TIDAK TERSEDIA SAAT INI');
    </script>";

  } else{
    if(pinjamBuku($id_buku, $id_user, $judul_buku, $user, $jmlhbuku) > 0){
      echo "<script>
        alert('Silahkan Cek Dafrar List');
        window.location = 'index.php';
    </script>";

    }else{
      echo "<script>
      alert('Silahkan Cek Daftar List');
      window.location = 'index.php';
    </script>";

    } 
  }
}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../asset/img/icon-web.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="home.css">
    <title>PUSTAKA DIGITAL SMAM 25</title>
    <style>
          /* CSS untuk tampilan desktop */
    .form-group {
        display: block;
    }
    .form-group-2{
      display: none;
    }
   
    .judul{
      margin-right: 50px;
    }
    .bar-user{
      margin-right: 10px;
    }

    /* CSS untuk tampilan mobile */
    @media (max-width: 768px) {
        .form-group {
            display: none;
        }
        .form-group-2{
            display: block;
        }
        .judul{
          margin-right: 40px;
        }
        .bar-notif{
          margin-left: -30px;
        }
        .bar-user{
          margin-right: 20px;
        }
    }
    
    </style>
  </head>
  <body style="background-color: #f5f5f5;">
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top" style="background-color: #02006a;">
      <div class="container">
        <h6 class="navbar-brand judul" href="#" style="color: #d9d9d9;">P-SMAM 25</h6>

        <a class="btn btn-light bar-user" href="" role="button" style="display: inline; margin-left:-10px;" data-toggle="modal" data-target="#modal-user"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill text-dark" viewBox="0 -1 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
</svg></a>
<!-- &nbsp; -->
        <a class="btn btn-light bar-notif" href="" role="button" style="display: inline; " data-toggle="modal" data-target="#exampleModal">   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill text-dark" viewBox="0 0 16 16">
				<path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
			  </svg>&nbsp;<span class="badge badge-light bg-dark" style="color: white;" id="notif-user-active"></span></a>
			
        

        <a href="index.php" class="navbar-toggler" style="margin-left: 0px;">
          <span><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671z"/>
</svg></span>
        </a>

     <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link active mr-2 js-scroll-trigger" href="index.php" style="color: #d9d9d9;"><svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
  <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
</svg><span class="sr-only">(current)</span></a>
              </li>
            </ul>
         </div>
    </nav>
 
             <div class="w-100 h-30 d-inline-block" style="background-color: #d9d9d9 ;">
                <div class="container">
                    <br><br><br>
                    <h6 class=" mt-1" style="color: #3d1e7e;">DETAIL BUKU</h6>
                </div>
              </div>
              <br>
            
              <!--gambar-->
              <div class="container"><br><br>
                <div class="d-flex justify-content-center"><img src="../asset/img/thumb-book/<?= $baru["gambar"]; ?>" alt="tidak ada gambar" width="200">
              </div>
              <center>
            <form action="" method="post">
              <br>
              <button class="btn btn-sm btn-dark disabled">Buku Tersedia <?=$baru["jumlah_buku"]?></button>
             <?php if($fitur_peminjaman === '1'){ echo '<button class="btn btn-sm btn-outline-primary" type="submit" name="pinjambuku">Pinjam Buku</button>';}?>
              
           </form>
          </center>
              </div>
              

 <!-- Modal notification-->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="margin-left: 20px;" class="modal-title" id="exampleModalLabel">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-card-list" viewBox="0 -1 16 16">
  <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
</svg> List Today
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="content1"></div>
          <br>
          <div id="content2"></div>
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal user-->
<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="margin-left: 20px;" class="modal-title" id="exampleModalLabel">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-card-list" viewBox="0 -1 16 16">
  <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
</svg> Account 
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-7 col-sm-7" style="margin-left: 40px">
          <p>USERNAME: <?=$account['username']?></p>
          <p>KELAS: <?=$account['kelas']?></p>
          <p>NIS: <?=$account['nis']?></p>
            <br>
            </div> 
            <div class="col-md-4 col-sm-4">
             <img src="../asset/img/icon-web.png" width="100" alt="">
            </div>
            
          </div>
          <a class="btn btn-sm btn-dark" style="margin-left: 20px;" href="logout.php">Logout</a>
          <a class="btn btn-sm btn-dark disabled" href="">Change Password</a>
            <br><br>
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




              <!-- table -->
              <div class="container" style="margin-top: -40px;">
                <table class="table" style="margin-top: 100px">
                  <tbody>
                    <tr>
                      <th scope="col">Judul</th>
                      <td><?= $baru["judul"] ?></td>
                    </tr>
                    <tr>
                      <th scope="row">penulis</th>
                      <td><?php if (empty($baru["penulis"])) {
                        echo "tidak ada";
                      } else {
                        echo $baru["penulis"];
                      }?></td>
                    </tr>
                    <tr>
                      <th scope="row">Penerbit</th>
                      <td><?php if (empty($baru["penerbit"])) {
                        echo "tidak ada";
                      } else {
                        echo $baru["penerbit"];
                      }?></td>
                    </tr>
                    <tr>
                      <th scope="row">jumlah buku</th>
                      <td><?php if (empty($baru["jumlah_buku"])) {
                        echo "kosong";
                      } else {
                        echo $baru["jumlah_buku"];
                      }?></td>
                    </tr>
                    <tr>
                      <th scope="row">genre</th>
                      <td><?php if (empty($baru["genre"])) {
                        echo "tidak ada";
                      } else {
                        echo $baru["genre"];
                      }?></td>
                    </tr>
                    <tr>
                      <th scope="row">isbn</th>
                      <td><?php if (empty($baru["isbn"])) {
                        echo "tidak ada";
                      } else {
                        echo $baru["isbn"];
                      }?></td>
                    </tr>
                    <tr>
                      <th scope="row">cetakan ke</th>
                      <td><?php if (empty($baru["cetak"])) {
                        echo "?";
                      } else {
                        echo $baru["cetak"];
                      }?></td>
                    </tr>
                    <tr>
                      <th scope="row">tempat terbit</th>
                      <td><?php if (empty($baru["tempat_terbit"])) {
                        echo "tidak ada";
                      } else {
                        echo $baru["tempat_terbit"];
                      }?></td>
                    </tr>
                    <tr>
                      <th scope="row">tahun terbit</th>
                      <td><?php if (empty($baru["tahun_terbit"])) {
                        echo "tidak ada";
                      } else {
                        echo $baru["tahun_terbit"];
                      }?></td>
                    </tr>
                    <tr>
                      <th scope="row">kode buku</th>
                      <td><?php if (empty($baru["kode_buku"])) {
                        echo "tidak ada";
                      } else {
                        echo $baru["kode_buku"];
                      } ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>


<footer class="text-light" style="background-color: #02006a; fixed-bottom;">
  <div class="container">
    <div class="row" style="padding: 30px 0;">
      <div class="col-xl-6">
        <h5 class="about">ABOUT</h5>
              <p>Web perpustakaan ini ada dikarenakan sulitnya 
             siswa untuk mencari tentang informasi buku
             yang ada di perpustakaan, oleh karena itu pihak
             sekolah memutuskan untuk membuat website 
             perpustakan ini untuk memudahkan siswa mencari 
             buku
              </p>
        </div>
      <div class="col-xl-6">
        <h5 class="medsos">MEDIA SOSIAL</h5>
          <section class="ras suku">
        <!-- Instagram -->
        <a
              class="btn text-white btn-floating"
              href="https://www.instagram.com/smam25pamulang/"
              role="button"
              >
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/> 
      </svg>
          </a>
  
       <!-- Facebook -->
           <a
              class="btn text-white btn-floating"
              href="https://www.facebook.com/dosqi.pamulang"
              role="button"
              >
       <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
      </svg>
            </a>
    
        <!-- youtube -->
      
               <a
              class="btn text-white btn-floating"
              href="https://www.youtube.com/channel/UCWomoPqkhirYT11RDnz2ERw/featured"
              role="button"
              >
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
      </svg>
            </a>

    <!-- web sekull-->

              <a 
              class="btn text-white btn-floating"
              href="https://www.smam25pamulang.sch.id"
              role="button"
              >
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
  <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
</svg>
              </a>
          </section>
        </div>
    </div>
</div>
        </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="../asset/js/jquery.slim.min.js"></script>
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/jquery.js"></script>
    <script src="js/tampil.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>