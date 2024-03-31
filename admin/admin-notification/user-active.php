<?php
    include '../../functions.php';
    //Cek Aapakah Sudah Login
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
        header("Location: ../../login.php");
      }
         
    $query = query("SELECT * FROM user_active,tb_buku WHERE  tb_buku.id = user_active.id_buku");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <title>Daftar Peminjaman Buku</title>
  <style>
    .kotak{
        width: 50%;
        margin: auto;
    }
    li{
        margin-top: 7px;
    }
    h2{
        text-align: center;
        margin-top: 20px;
    }
    hr{
        margin-bottom: 25px;
    }
    .back{
        float: right;
        margin-top: -35px;
        margin-right: 40px;
    }
    a{
        color: black;
    }
    li:hover{
        background-color: #f0f0f0;
    }
  </style>
</head>
<body>
  <div class="kotak">
  <h2>PEMINJAMAN</h2> <a href="../index.php"><svg class="back" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
</svg></a>
  <hr>
    <ul class="list-group">
    <?php foreach($query as $data): ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?=$data["username"]?> | <?php  $judul = displayLimitedWords($data["judul"], 4);
        echo $judul;?>
        <div>
          <a href="detail-user-active.php?id=<?=$data["id_get_anggota"]?>&id_buku=<?=$data["id_buku"]?>" class="btn btn-success btn-sm">Detail</a>
          <a href="return-book.php?id=<?=$data["id_get_anggota"]?>&id_buku=<?=$data["id_buku"]?>" class="btn btn-dark btn-sm mr-2">Kembalikan</a>
        </div>
      </li>
   <?php endforeach; ?>
    </ul>
  </div>
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
   
</html>