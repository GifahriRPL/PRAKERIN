
<?php
    include '../../functions.php';
    //Cek Aapakah Sudah Login
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
      header("Location: ../../login.php");
    }
       
    // melakukan koneksi 
    
    //menghitung jumlah pesan dari tabel pesan
    $query= mysqli_query($conn, "Select Count(id) as id From list");
    
    //menampilkan data
    $hasil = mysqli_fetch_array($query);
    
    //membuat data json
    echo json_encode(array('jumlah' => $hasil['id']));
    
    ?>
