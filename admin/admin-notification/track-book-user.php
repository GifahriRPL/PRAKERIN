<?php
    include '../../functions.php';
//Cek Aapakah Sudah Login
if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
    header("Location: ../../login.php");
  }
     

  
    $query = query("SELECT * FROM tb_buku,list WHERE tb_buku.id = list.id_get_buku");

    // foreach($query as $row){
    // var_dump($row["username"]);
    // var_dump($row["judul"]);
    // }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   
</head>
<body>
    
<div class="container">
<div class="d-flex justify-content-center">
    <div class="card" style="width: 25rem; margin-top: 100px; border-radius: 20px;">
        <div class="card-body" >
            <?php  foreach($query as $row) :?>
            <div class="alert alert-primary" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" style="margin-left:;" fill="currentColor" class="bi bi-person-fill-exclamation" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5Zm0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Z"/>
</svg>
                <center><?=$row["username"]?> ingin meminjam buku <?=$row["judul"]?></center>
                <br></b>
                <a href="accept-user.php?id=<?=$row["id_get_anggota"]?>" type="button" class="btn btn-success btn-sm" style="float:right;">Terima</a>
                <a href="reject-user.php?id=<?=$row["id"]?>" type="button" class="btn btn-danger btn-sm" >Tolak</a>
            </div>
                <?php endforeach;?>
        </div>
      </div>
    </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
        </script>
    
        <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
   <script>
    $(document).ready(function(){
    $("#nama-modal").modal('show');
});

   </script>
</html>