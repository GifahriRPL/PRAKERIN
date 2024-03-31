<?php
include '../../functions.php';
if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
  header("Location: ../../login.php");
}
   
$keyword = mysqli_real_escape_string($conn, $_GET["cari"]);

$data = buku($keyword);
if($keyword === "20"){  
 $a = "SELECT * FROM tb_buku ORDER BY id DESC LIMIT 20
 ";
 $data = mysqli_query($conn, $a);
}

?>
   <!-- table -->
 <div id="container" style="margin-top: 40px;">
   <div class="container">
     <div class="row">
       <div class="col-md">
         <table class="table table-bordered text-center">
           <thead style="background-color: #02006a; color: #d9d9d9">
             <tr>
               <th scope="col">#</th>
               <th scope="col">JUDUL BUKU</th>
               <th scope="col">KODE BUKU</th>
               <th scope="col">PENERBIT</th>
               <th scope="col" style="width: 180px">AKSI</th>
             </tr>
           </thead>
           <tbody>
             <?php $i = 1; ?>
             <?php while($rows = mysqli_fetch_assoc($data)) : ?>
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

 <script>
    let p = "halo";
    document.write(p);
  </script>

 <br>
 <br>