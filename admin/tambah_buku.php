<?php
  include "../functions.php";
  
  if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
    header("Location: ../login.php");
  }

   
  if ( isset($_POST["submit"])) {
    
    if ( tambahBuku($_POST) > 0) {
        echo "<script>alert('Data Buku berhasil ditambahkan!');
        window.location = 'index.php';
        </script>";

    } else {
      echo "<script>alert('Data Buku gagal ditambahkan!');</script>";
    }
  }


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../asset/img/icon-web.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="home.css">

    <title>Tambah Buku</title>
  </head>
  <body style="background-color: #f5f5f5;">
  <div class="row">
    <div class="col-md">
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color:  #02006a;">
        <div class="container">
          <h2 class="navbar-brand" href="#" style="color: #d9d9d9;">ADMIN</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
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
        </div>
     </nav>
    </div>
  </div>
              <!-- bread  crumbs -->
  <div class="w-100 h-30 d-inline-block" style="background-color: #d9d9d9 ;">
    <div class="container">
      <h6 class=" mt-1" style="color: #3d1e7e;">TAMBAH BUKU</h6>
    </div>
  </div>
<div style="margin-bottom: 40px;"></div>
            <!-- content -->
            <div class="container" style="width: 70%;">
           <center><h3>TAMBAH BUKU BARU</h3></center> 
           <br><br>
    <div class="row">

      <div class="col-md-4">
        <div class="form-group">
          <form action="" method="post" enctype="multipart/form-data">
          <input name="id" type="hidden" style="margin-left: 90px; margin-top: 40px;" autocomplete="off">
          <input name="place_id" type="hidden" style="margin-left: 90px; margin-top: 40px;" autocomplete="off">
          <input name="author_id" type="hidden" style="margin-left: 90px; margin-top: 40px;" autocomplete="off">

          <label for="judul">Judul:</label>
          <input type="text" class="form-control" id="judul" name="judul" required autocomplete="off">
          <label for="penulis">Penulis:</label>
          <input type="text" class="form-control" id="penulis" name="penulis" required autocomplete="off">
          <label for="penerbit">Penerbit:</label>
          <input type="text" class="form-control" id="penerbit" name="penerbit" required autocomplete="off">
          <label for="terbit">Tempat Terbit:</label>
          <input type="text" class="form-control" id="terbit" name="tmptTerbit" required autocomplete="off">

            
        </div>

      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="genre">Genre:</label>
          <input type="text" class="form-control" id="genre" name="genre" required autocomplete="off">
          <label for="cetak">Cetak:</label>
          <input type="text" class="form-control" id="cetak" name="cetak" required autocomplete="off">
          <label for="jumlah_buku">Jumlah Buku:</label>
          <input type="text" class="form-control" id="jumlah_buku" name="jmlhbuku" required autocomplete="off">
        </div>
        <br>
        <label for="gambar">Tambah Gambar:</label>
        <input id="gambar" type="file" name="file">
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="isbn">ISBN:</label>
          <input type="text" class="form-control" id="isbn" name="isbn" required autocomplete="off">
          <label for="kode_buku">Kode Buku:</label>
          <input type="text" class="form-control" id="kode_buku" name="kd_buku" required autocomplete="off">
          <label for="tahun_terbit">Tahun Terbit:</label>
          <input type="text" class="form-control" id="tahun_terbit" name="thnTerbit" required autocomplete="off">
        </div>
        <br>
        <button class="btn btn-success btn-lg" name="submit" role="button" type="submit" >Tambah Data</button>

    </div>
          
          </form>
        </div>

        <!-- footer -->
        <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>