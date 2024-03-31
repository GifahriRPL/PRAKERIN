<?php
    include "functions.php";

    if(isset($_POST["submit"])){

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    
    //cek ketika yang login admin
    if($_POST["username"] == 'admin'){
  
      $result = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$username'");
      if(mysqli_num_rows($result) === 1){
      
          $data = mysqli_fetch_assoc($result);
          $password_hash = $data["password"];
          
          if(password_verify($password, $password_hash)){
              $_SESSION["login"] = true;
              $_SESSION["admin"] = true;

              header("Location: admin/");
          }else{
              echo "<script>alert('Password salah');
              </script>";
          }
      }else{
        echo "<script>alert('Username tidak terdaftar');
        </script>";
      
    }
  }

  //cek ketika yang login siswa
    $result = mysqli_query($conn, "SELECT * FROM tb_anggota WHERE   nis = '$username'");
    if(mysqli_num_rows($result) === 1){
    
        $data = mysqli_fetch_assoc($result);
        $password_hash = $data["password"];
        
        if(password_verify($password, $password_hash)) {
            $_SESSION["user"] = $username;
            $_SESSION["login"] = true;
            header("Location: user/");
        }else{
            echo "<script>alert('Password salah');
            </script>";
        }
    }else{
      echo "<script>alert('Username tidak terdaftar');
      </script>";
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
    <link rel="stylesheet" href="asset/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="shortcut icon" href="asset/img/icon-web.png" type="image/x-icon">
    <style>
      input{
        margin-top: 20px;
      }
    </style>

    <title>LOGIN</title>
  </head>
  <body style="background-image: url(user/img/login.jpg); background-size: cover;">
<div class="container">
<div class="d-flex justify-content-center">
    <div class="card" style="width: 25rem; margin-top: 100px; border-radius: 20px;">
        <div class="card-body" >
            <form style="padding: 20px;" method="post">
                <div class="form-group">
                    <h2 class="d-flex justify-content-center">Login</h2>
                    <br>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NISN" aria-describedby="emailHelp" name="username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="Password" placeholder="Password" name="password">
                </div>
                <br>
                <button name="submit" type="submit" class="btn btn-primary btn-block" style="border-radius: 30px;">Submit</button>
                <p class="mt-4 d-flex justify-content-center">Belum daftar?<a href="register.php" style="color: #FC5F5F; padding-left: 4px;">Daftar Sekarang</a></p>
                
              </form>
        </div>
      </div>
    </div>
    </div>
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