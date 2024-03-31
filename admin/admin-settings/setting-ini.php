<?php
  include '../../functions.php';
  $fitur_peminjaman = '0';
  if($data = query("SELECT sett2 FROM admin_settings WHERE id = '1' AND sett2 = '1'")){
    $fitur_peminjaman = $data[0]['sett2'];

  }

  // if($data = query("SELECT sett1 FROM admin_settings WHERE id = '1' AND sett1 = '1'")){
  //   $kondisi = $data[0]['sett1'];

  // }
  // if(mysqli_num_rows($data) === 1){
  // }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Contoh Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
  <div class="form-check form-switch">
    <form action="" method="post">
      <input class="form-check-input" id="p" name="p" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php
        if($fitur_peminjaman === '1'){ echo 'checked';}
      ?>>
      <label class="form-check-label" for="p">Auto Confirm</label>
      <br>
      <span><p style="font-size: 12px; margin-left:7px; font-style: italic;">memungkinkan pengguna  <br>
        otomatis meminjam buku tanpa <br>
        persetujuan admin, log tetap direkam</p></span>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    var checkbox = document.getElementById("p");
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
xhr.open('POST', 'admin-settings/setting-proses.php');

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
</body>
</html>
