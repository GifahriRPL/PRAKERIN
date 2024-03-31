<?php
include '../../functions.php';
 $keyword = mysqli_real_escape_string($conn, $_GET["cari"]);

 $data = buku($keyword);
if($keyword === "20"){  
  $a = "SELECT * FROM tb_buku ORDER BY id DESC LIMIT 20
  ";
  $data = mysqli_query($conn, $a);
}


?>
  <div class="container">
  <div class="table-responsive">
    <table class="table table-borderless">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">JUDUL</th>
      <th scope="col">PENERBIT</th>
      <th scope="col">ACTION</th>
      <!-- <th scope="col"> Dolar</th> -->
    </tr>
  </thead>
  <tbody>
        <?php $i = 1; ?>
        <?php while($rows = mysqli_fetch_assoc($data))  : ?>
          <tr>
            <th scope="row"><?=$i++?></th>
            <td><?=$rows["judul"]; ?></td>
            <td><?=$rows["penerbit"];?></td>
           <td><a class="btn btn-sm btn-outline-primary" href="detail_buku_user.php?id=<?=$rows["id"]?>">Lihat Detail</a></td>
        </tr>
            <?php endwhile; ?>
            
  </tbody>
</table>
    </div>
 
  </div>