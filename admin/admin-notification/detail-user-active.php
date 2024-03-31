<?php
    include '../../functions.php';
    //Cek Aapakah Sudah Login
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
        header("Location: ../../login.php");
      }
    $id_buku = mysqli_real_escape_string($conn, $_GET["id_buku"]);
    $id_get_anggota = mysqli_real_escape_string($conn, $_GET["id"]);
    $query = query("SELECT * FROM user_active WHERE id_get_anggota = $id_get_anggota ")[0];
    // $id_buku = $query["id_buku"];
    
    $judul = query("SELECT judul,kode_buku FROM tb_buku WHERE id = $id_buku ")[0];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Detail Peminjaman Buku</title>
  <style>
    h2{
        text-align: center;
        margin-top: 20px;
    }
    hr{
        margin-bottom: 30px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2>DETAIL PEMINJAMAN</h2>
        <hr>

        <div class="form-group">
          <label for="borrower">Peminjam:</label>
          <input type="text" class="form-control" id="borrower" value="<?=$query["username"]?>" readonly>
        </div>

        <div class="form-group">
          <label for="title">Judul Buku:</label>
          <input type="text" class="form-control" id="title" value="<?=$judul["judul"]?>" readonly>
        </div>

        <div class="form-group">
          <label for="kode_buku">Kode Buku:</label>
          <input type="text" class="form-control" id="kode_buku" value="<?=$judul["kode_buku"]?>" readonly>
        </div>

        <div class="form-group">
          <label for="dueDate">Tenggat Waktu:</label>
          <input type="text" class="form-control" id="dueDate" value="<?=$query["waktu_pinjam"]?>" readonly>
        </div>

        <div class="form-group">
          <label for="jatuhtempo">Jatuh Tempo:</label>
          <input type="text" class="form-control" id="jatuhtempo" value="<?=$query["jatuh_tempo"]?>" readonly>
        </div>

        <a style="float: right; margin-right: 30px; margin-top: 10px;" href="user-active.php" class="btn btn-dark">Kembali</a>
      </div>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
        </script>
    
        <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="tampil.js"></script>
    <script src="js/script.js"></script>

</html>