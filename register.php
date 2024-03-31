<?php
 include 'functions.php';

  if ( isset($_POST["submit"])) {
    
    if ( registrasiSiswa($_POST) > 0) {

      if(isset($_SESSION['login']) && isset($_SESSION['admin'])){

        echo "<script>
        alert('Data berhasil didaftarkan');
        window.location = 'admin/daftar_siswa.php';
        </script>";
      } else{

        echo "<script>
        alert('Data berhasil didaftarkan');
        window.location = 'login.php';
        </script>";
      }
    } else {
      echo "<script>alert('Data gagal didaftarkan!');</script>";
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
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
    <link rel="shortcut icon" href="asset/img/icon-web.png" type="image/x-icon">

    <title>REGISTRASI</title>
  </head>
  <body style="background-image: url(user/img/registrasi.jpg); background-size: cover;">
    <div class="container">
        <div class="d-flex justify-content-center">
           <div class="card" style="width: 23rem; margin-top: 85px; border-radius: 20px;">
             <div class="card-body">
                <form method="post" style="padding: 20px;">
                    <div class="form-group">
                        <h4 style="text-align: center;">Register</h4>
                        <br>
                        <div class="form-group">
                            <input required style="appearance: textfield;" placeholder="NISN"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nis" autocomplete="off">
                          </div>
                        <div class="form-group">
                            <input required style="appearance: textfield;" placeholder="Nama Lengkap"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" autocomplete="off">
                          </div>
                      <input required type="text" class="form-control" placeholder="Nama Panggilan" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama_panggilan" autocomplete="off">
                    </div>
                    <div class="form-group">
                          <select name="kelas" class="custom-select">
                              <option selected value="nol">Pilih Kelas</option>
                              <option value="X-IPA">Kelas X-IPA</option>
                              <option value="XI-IPA">Kelas XI-IPA</option>
                              <option value="XII-IPA">Kelas XII-IPA</option>
                              <option value="X-IPS">Kelas X-IPS</option>
                              <option value="XI-IPS">Kelas XI-IPS</option>
                              <option value="XII-IPS">Kelas XII-IPS</option>
                              <option value="XI-PKL">Kelas XI-PKL</option>
                            </select>
                    </div>
                    <br>
                    <button name="submit" type="submit" class="btn btn-primary btn-lg btn-block" style="border-radius: 30px">Submit</button>
                    <p class="mt-4 d-flex justify-content-center">Sudah mempunyai akun? <a href="login.php" style="color: #FC5F5F; padding-left: 1px;"> Login sekarang</a></p>
                  
                  </form>
              </div>
             </div>
          </div>
      </div>
    </div>
      


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