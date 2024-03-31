<?php
include '../../functions.php';
if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
  header("Location: ../../login.php");
}
   
$baru = mysqli_real_escape_string($conn, $_GET["pencet"]);
$data = searchSiswa($baru);

if($baru === '20'){
  $query = "SELECT * FROM tb_anggota ORDER BY id LIMIT 20";
  $data = mysqli_query($conn, $query);
  
}
?>
<div class="container">
      <table class="table table-bordered text-center">
        <thead style="background-color: #02006a; color: #d9d9d9">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">NISN</th>
            <th scope="col">Kelas</th>
            <th scope="col" style="width: 180px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
        <?php while($rows = mysqli_fetch_assoc($data)) {?>
          <tr>
            <th scope="row"><?=$i++?></th>
            <td><?=$rows["username"]; ?></td>
            <td><?=$rows["nis"]; ?></td>
            <td><?=$rows["kelas"]; ?></td>
            <td><a class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin Hapus?')" href="delete_siswa.php?id=<?=$rows["id"];?>" role="button">Hapus</a></td> 
          </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>