<?php
  include "../functions.php";
    //Cek Aapakah Sudah Login

    //page
    $page = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
    if($page == 0){
      $page = 1;
    }

    $jumlahData = count(query("SELECT * FROM tb_buku"));
    $jumlahHalaman = ceil($jumlahData / 20);
    $pembagianHalaman = ceil($jumlahHalaman / 5);
    $halamanTampil = 7;
    $beng = ( 20 * $page ) - 20;

    // query database

    $pager = "SELECT * FROM tb_buku ORDER BY id DESC LIMIT 0, 20";
    $kuntul = pagination($pager);
    $key = mysqli_query($conn, $kuntul);


    //======= admin settings =======//
    $fitur_peminjaman = '0';
    if($data = query("SELECT sett1 FROM admin_settings WHERE id = '1' AND sett1 = '1'")){
      $fitur_peminjaman = $data[0]['sett1'];
  
    }
    $autoconfirm = '0';
    if($data = query("SELECT sett2 FROM admin_settings WHERE id = '1' AND sett2 = '1'")){
      $autoconfirm = $data[0]['sett2'];
    }

    $password_setting = '0';
    if($data = query("SELECT sett3 FROM admin_settings WHERE id = '1' AND sett3 = '1'")){
      $password_setting = $data[0]['sett3'];
    }
    //======= admin settings =======//

?>
<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>
        <link rel="shortcut icon" href="../asset/img/icon-web.png" type="image/x-icon">
        <!-- <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.min.css"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
        
    </head>
    
    <body style="background-color: #f5f5f5;">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #02006a; height: 64px;">
  <!-- <div class="container-fluid"> -->
    <div class="container">
          <h2 class="navbar-brand" style="color: #d9d9d9;">P-SMAM25  ADMIN</h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        </li>
      </ul>
      
      <a class="nav-link active mr-2 js-scroll-trigger " href="logout.php" style="color: #d9d9d9; margin-right: 20px;">LOGOUT<span class="sr-only"></span></a>
      <a class="nav-link active mr-2 js-scroll-trigger text-light " href="#" style="color: #d9d9d9; margin-right: 20px;">DATA BUKU<span class="sr-only"></span></a>
      <a class="nav-link active mr-2 js-scroll-trigger " href="daftar_siswa.php" style="color: #d9d9d9; margin-right: 50px;">DATA SISWA<span class="sr-only"></span></a>
    
      <form class="d-flex" role="search">
        <input id="cari" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" autocomplete="on">
      </form>
    </div>
  </div>
</nav>



     <!-- Modal Settings -->
<div class="modal fade" id="exampleModall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 20 20">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
</svg> Settings Page
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <a  style="color: white; float: right;" type="button" href="admin-settings/setting-pass-admin.php" class="btn btn-dark">Ubah Password Admin</a>
           </div>

           <div class="col-md-6">
             <a style="margin-right:px;" type="button" href="admin-settings/setting-pass-user.php"  class="btn btn-dark <?php if($password_setting === '1'){ echo 'disabled';}?>">Ubah Password Anggota</a>
       </div>
      </div>
        <br><br>
        <div class="row">
          <div class="col-md-6">
          <div class="form-check form-switch">
           <form action="" method="post">
             <input class="form-check-input" id="fiturpinjam" name="fiturpinjam" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php if($fitur_peminjaman === '1'){ echo 'checked';}?>>
             <label class="form-check-label" for="fiturpinjam">Pinjam Buku</label>
               <br>
             <span><p id="fiturpinjam" style="font-size: 12px; margin-left:7px; font-style: italic;">jika fitur ini diaktifkan <br>
                maka anggota dapat<br>
                meminjam buku yang tersedia</p></span>
          </form>
          </div>
          </div>

      <!-- End Modal Settings -->

          <div class="col-md-6">
          <div class="form-check form-switch">
           <form action="" method="post">
             <input class="form-check-input" id="autoconfirm" name="autoconfirm" type="checkbox" role="switch" id="flexSwitchCheckDefault" 
             <?php if($fitur_peminjaman === '0'){ echo 'disabled';}?>
             <?php if($autoconfirm === '1'){ echo 'checked';}?>>
             <label class="form-check-label" for="autoconfirm">Auto Confirm</label>
               <br>
             <span><p style="font-size: 12px; margin-left:7px; font-style: italic;">memungkinkan pengguna  <br>
                otomatis meminjam buku tanpa <br>
                persetujuan admin, log tetap direkam</p></span>
          </form>
          </div>
          </div>

          <div class="col-md-6">
          <div class="form-check form-switch">
           <form action="" method="post">
             <input class="form-check-input" id="user_password" name="user_password" type="checkbox" role="switch" id="flexSwitchCheckDefault" 
             <?php if($password_setting === '1'){ echo 'checked';}?>>
             <label class="form-check-label" for="user_password">User Password</label>
               <br>
             <span><p style="font-size: 12px; margin-left:7px; font-style: italic;">mengizinkan semua anggota  <br>
                untuk mengganti password sendiri  <br>
          </form>
          </div>
          </div>


        </div>

        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

           <!-- bread crumbs -->
  <div class="w-100 h-30 d-inline-block" style="background-color: #d9d9d9 ;">
    <div class="container">
      <h6 class=" mt-1" style="color: #3d1e7e;"></h6>
    </div>
  </div>
  
  <div class="container">
    <br>
    <h2 style="margin-top: 30px; margin-left: 15px;">DAFTAR BUKU</h2>
    
		<div class="row">
		  <div class="col-6">
      <a class="btn btn-dark" role="button" data-toggle="modal" data-target="#exampleModall"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
</svg> Settings</a>

    
    <a class="btn btn-primary" href="tambah_buku.php" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">
  <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
</svg> Tambah Buku</a>

     
    <a class="btn btn-danger" href="daftar_siswa.php" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
</svg> Daftar Siswa</a>
  </div>

		  <div class="col-6">
		    	<!-- notifikasi -->
    <div class="dropdown">
         <button type="button" class="btn btn-primary" data-toggle="dropdown">
         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
</svg>   <span class="badge badge-light bg-dark" style="color: white;" id="notiff"></span>
          </button>

          <!-- <a class="btn btn-primary" href="admin-notification/track-book-user.php" role="button"><svg  xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill-exclamation text-light" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5Zm0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Z"/>
</svg>&nbsp;<span class="badge badge-light bg-dark" style="color: white;" id="notif"></span></a>
 -->

<a class="btn btn-primary" href="admin-notification/user-active.php" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill-up" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 0 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
  <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
</svg>&nbsp;<span class="badge badge-light bg-dark" style="color: white;" id="notif-user-active"></span></a>



   <div id="pesan" class="dropdown-menu" aria-labelledby="dropdownMenuButton">

		  </div>
		</div>
	  </div>
	



    <!-- table -->
  <div id="container" style="margin-top: 40px;">
    <div class="container">
      <h5>Jumlah Buku : <?= $jumlahData ?></h5>
      <div class="row">
        <div class="col-md">
        <div class="table-responsive">
          <table class="table table-bordered text-center">
            <thead style="background-color: #02006a; color: #d9d9d9">
              <tr>
                <th scope="col">#</th>
                <th scope="col">JUDUL BUKU</th>
                <th scope="col">KODE BUKU</th>
                <th scope="col">PENERBIT</th>
                <th scope="col">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = $beng+1; ?>
              <?php  ?>
              <?php while($rows = mysqli_fetch_assoc($key)) : ?>
               <tr>
                <th scope="row"><?=$i++?></th>
                <td><?=$rows["judul"]; ?></td>
                <td><?=$rows["kode_buku"]; ?></td>
                <td><?=$rows["penerbit"];?></td>
                <td><a class="btn btn-sm btn-outline-primary" href="detail_buku.php?id=<?=$rows["id"]?>" role="button">Lihat</a> <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin Hapus?')" href="delete_buku.php?id=<?=$rows["id"];?>" role="button">Hapus</a></td> 
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
              </div>
        </div>
      </div>
    </div>
  </div>


  <br>
  <br>

  <!-- Navigasi -->
<div class="d-flex justify-content-center">
  <nav aria-label="Page navigation example">
    <ul class="pagination">

    <?php if ($page > 1) : ?>
      <li class="page-item"><a class="page-link" href="?page=<?= $page-2 ?>">&laquo</a></li>
      <li class="page-item"><a class="page-link" href="?page=<?= $page-1 ?>">&lt</a></li>
    <?php endif; ?>

        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) { ?>
          <?php if (($i >= $page) && ($i <= $page+4)) : ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
          <?php endif; ?>
        <?php } ?>

    <?php if ($page < $jumlahHalaman) : ?>
      <li class="page-item"><a class="page-link" href="?page=<?= $page+1 ?>">&gt</a></li>
      <li class="page-item"><a class="page-link" href="?page=<?= $page+2 ?>">&raquo</a></li>
    <?php endif; ?>

    </ul>
  </nav>
</div>
</div>
    </div>

  <!-- footer -->
  <footer class="text-light" style="background-color: #02006a; margin-top: 30px">
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
        <h5 style="margin-left: 330px;">MEDIA SOSIAL</h5>
          <section class="d-flex justify-content-end">
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
    <script src="../asset/js/jquery.slim.min.js"></script>
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/jquery.js"></script>
    <script src="js/tampil.js"></script>
<!-- Live Searching -->
    <script>
      const table = document.getElementById('container') 

const inputCari = document.getElementById('cari')
inputCari.addEventListener('keyup', function () {
    // ajax
    const ajax = new XMLHttpRequest()
    ajax.onreadystatechange = function () {
        if ( ajax.readyState == 4 && ajax.status == 200 ) {
            table.innerHTML = ajax.responseText
        }
    }

    // eksekusi
    console.log("ready ajax");
    if (inputCari.value === '') {
        ajax.open('GET', `js/livesearch.php?cari=20`, true)
        ajax.send()
    }else{
      
    ajax.open('GET', `js/livesearch.php?cari=${inputCari.value}`, true)
    ajax.send()
    }
})

    </script>

<!-- Auto Confirm -->

 <script>
    var checkbox = document.getElementById("autoconfirm");

    checkbox.addEventListener("change", function() {
      if (checkbox.checked) {
        console.log('1');
		var nilai = 1;
      } else {
        console.log('0');
		var nilai = 0;
      }

// membuat objek XMLHttpRequest
var xhr = new XMLHttpRequest();

// menentukan metode dan URL yang akan diakses
xhr.open('POST', 'admin-settings/setting-autoconfirm.php');

// menentukan tipe data yang akan dikirimkan
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

// menangani respon dari server
xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // respon dari server
        console.log(xhr.responseText);
    }
};
console.log(nilai)
// mengirim data ke server
xhr.send('output=' + encodeURIComponent(nilai));
	})
  </script>

<!-- Fitur Pinjam -->

<script>
    var checkboxx = document.getElementById("fiturpinjam");
    checkboxx.addEventListener("change", function() {
      if (checkboxx.checked) {
        console.log('1');
		var nilai = 1;
      } else {
        console.log('0');
		var nilai = 0;
      }

// membuat objek XMLHttpRequest
var xhr = new XMLHttpRequest();

// menentukan metode dan URL yang akan diakses
xhr.open('POST', 'admin-settings/setting-fiturpinjam.php');

// menentukan tipe data yang akan dikirimkan
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

// menangani respon dari server
xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // respon dari server
        console.log(xhr.responseText);
    }
};
console.log(nilai)
// mengirim data ke server
xhr.send('sett1=' + encodeURIComponent(nilai));

// 
        alert('halaman akan di reload untuk menerapkan pengaturan')   
        window.location.reload();   
	})
  </script>

<!-- User Setting -->

<script>
    var checkboxxx = document.getElementById("user_password");
    checkboxxx.addEventListener("change", function() {
      if (checkboxxx.checked) {
        console.log('1');
		var nilai = 1;
      } else {
        console.log('0');
		var nilai = 0;
      }

// membuat objek XMLHttpRequest
var xhr = new XMLHttpRequest();

// menentukan metode dan URL yang akan diakses
xhr.open('POST', 'admin-settings/setting-user-password.php');

// menentukan tipe data yang akan dikirimkan
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

// menangani respon dari server
xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // respon dari server
        console.log(xhr.responseText);
    }
};
console.log(nilai)
// mengirim data ke server
xhr.send('sett3=' + encodeURIComponent(nilai));

// 
        alert('halaman akan di reload untuk menerapkan pengaturan')   
        window.location.reload();   
	})
  </script>


    </body>
    <!-- <script src="../asset/js/jquery.slim.min.js"></script>
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/jquery.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
  
    
    </html>
    
 