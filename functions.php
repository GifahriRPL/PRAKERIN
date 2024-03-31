<?php
    session_start();
    //koneksi database
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "db_perpustakaan";

    $conn = mysqli_connect($server, $username, $password, $db);

    if(!$conn){
        echo "Eror database" . mysqli_error($conn);
    }

    //query
    function query($query) {
        global $conn;
   
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ( $row = mysqli_fetch_assoc($result) ) {
         $rows[] = $row;
        }

        
        return $rows;
    }
    //cari buku
    function buku($keyword) {
        global $conn;
    
        $a = "SELECT * FROM tb_buku WHERE 
                  judul LIKE  '%$keyword%' OR
                  penerbit LIKE  '%$keyword%' OR
                  kode_buku LIKE  '%$keyword%' OR
                  isbn LIKE  '%$keyword%'
                    ORDER BY id DESC
                  ";
        
        $hasil = mysqli_query($conn, $a);
        if($hasil == false){
            echo "adf";
        }


        return $hasil;
    }


    //Registrasi
    function registrasiSiswa($data) {
        global $conn;

        $db = query("SELECT password_anggota FROM tb_admin")[0];
        $password = $db["password_anggota"];
    
        $NIS = htmlspecialchars($data["nis"]);
        $username = htmlspecialchars(strtoupper($data["username"]));
        $panggilan = htmlspecialchars(strtoupper($data["nama_panggilan"]));
        $kelas = htmlspecialchars(strtoupper($data["kelas"]));
        
        //validasi data
    if(strlen($NIS) == 10) {
        $cek_nis = mysqli_query($conn, "SELECT nis FROM tb_anggota WHERE nis = '$NIS'");
        if(mysqli_fetch_assoc($cek_nis)) {
            echo "<script>alert('NISN sudah dipakai')</script>";
            return false;
        }
            
    } else {
        echo "<script>alert('Panjang NISN tidak boleh kurang dari 10')</script>";
        return false;
    }
    if($kelas == "nol"){
        echo "<script>alert('Kelas wajib di isi')</script>";
        return false;
    } else{
        //tambahkan user baru
        $result = mysqli_query($conn, "INSERT INTO tb_anggota VALUES('', '$username', '$panggilan', '$password', '$NIS', '$kelas')");
        return mysqli_affected_rows($conn);    
    }
        
     

    }

    //Tambah buku
    
    function tambahBuku($data) {
        global $conn;

        $judul = htmlspecialchars($data["judul"]);
        $penulis = htmlspecialchars($data["penulis"]);
        $penerbit = htmlspecialchars($data["penerbit"]);
        $cetak = htmlspecialchars($data["cetak"]);
        $genre = htmlspecialchars($data["genre"]);
        $isbn = htmlspecialchars($data["isbn"]);
        $tmptTerbit = htmlspecialchars($data["tmptTerbit"]);
        $kd_buku = htmlspecialchars($data["kd_buku"]);
        $thnTerbit = htmlspecialchars($data["thnTerbit"]);
        $jmlhbuku = htmlspecialchars($data["jmlhbuku"]);
        $gambar = upload();
        $date = waktu($_POST);
      
        // tabel ketiga
        $ytyt = mysqli_query($conn, "SELECT * FROM tempat WHERE tempat_terbit = '$tmptTerbit'");
        if (mysqli_fetch_assoc($ytyt)) {
            $query = mysqli_query($conn, "SELECT place_id FROM tempat WHERE tempat_terbit = '$tmptTerbit'");
            $id1 =  mysqli_fetch_assoc($query)["place_id"];
        } else {
            $pecel = mysqli_query($conn, "INSERT INTO tempat VALUES ('', '$tmptTerbit')");
            $id1 = mysqli_insert_id($conn);
        }
       
      // tabel pertama
        mysqli_query($conn, "INSERT INTO tb_buku VALUES('', '$judul', '$penerbit', '$cetak', '$isbn',
        '$thnTerbit', '$genre', '$id1', '$kd_buku', '$gambar', '$jmlhbuku', '$date')");
        $id2 = mysqli_insert_id($conn);

      //tabel kedua
      $tyty = mysqli_query($conn, "SELECT * FROM penulis WHERE penulis = '$penulis'");
        if (mysqli_fetch_assoc($tyty)) {
            $query = mysqli_query($conn, "SELECT author_id FROM penulis WHERE penulis = '$penulis'");
            $id3 =  mysqli_fetch_assoc($query)["author_id"];
        } else {
            mysqli_query($conn, "INSERT INTO penulis VALUES('', '$penulis', 'p')");
            $id3 = mysqli_insert_id($conn);
        }

       // tabel keempat
        mysqli_query($conn, "INSERT INTO buku_penulis VALUES('$id2', '$id3', '1')");
        
    }
    //upload gambar
    function upload(){
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg', 'jfif', 'PNG', 'JPG', 'JPEG', 'JFIF');
        $gambar = $_FILES['file']['name'];
    
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];	
        $gambar = uniqid() .'.'. $ekstensi;

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            move_uploaded_file($file_tmp, '../asset/img/thumb-book/'.$gambar);
            if($ukuran < 3044070){		
              
              return $gambar;
        
            }else{
                echo "<script>UKURAN GAMBAR TERLALU BESAR</script>";
            }
        }else{
            echo "<script>EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN</script>";
        }
        
    }
    

    // ubah data buku
    function ubah($data) {
        global $conn;

        $id = $data["id"];
        $idtempat = $data["place_id"];
        $idpenulis = $data["author_id"];
        $judul = htmlspecialchars($data["judul"]);
        $penulis = htmlspecialchars($data["penulis"]);
        $penerbit = htmlspecialchars($data["penerbit"]);
        $cetak = htmlspecialchars($data["cetak"]);
        $genre = htmlspecialchars($data["genre"]);
        $isbn = htmlspecialchars($data["isbn"]);
        $tmptTerbit = htmlspecialchars($data["terbit"]);
        $kd_buku = htmlspecialchars($data["kode_buku"]);
        $thnTerbit = htmlspecialchars($data["tahun_terbit"]);
        $jmlhbuku = htmlspecialchars($data["jumlah_buku"]);
        $gambar = upload();
        $date = waktu($_POST);

        //  mengahpus gambar lama di folder img untuk mengganti dgn gambar yg baru
        if($gambar){
        $namaGambarLama = query("SELECT gambar FROM tb_buku WHERE id = '$id'")[0];
   
        $path = "../asset/img/thumb-book/". $namaGambarLama["gambar"];


        if(!unlink($path)){
            echo "gambar gagal dihapus";
        }

        $update_gmbr = mysqli_query($conn, "UPDATE tb_buku SET gambar = '$gambar' WHERE id = '$id'");
        
    }
       // Query update
       $pucu = mysqli_query($conn, "SELECT * FROM penulis WHERE penulis = '$penulis'");
       $ucup = mysqli_query($conn, "SELECT * FROM tempat WHERE tempat_terbit = '$tmptTerbit'");

       mysqli_query($conn, "UPDATE tb_buku SET judul = '$judul', 
       genre = '$genre',
       penerbit = '$penerbit',
       isbn = '$isbn',
       cetak = '$cetak',
       kode_buku = '$kd_buku',
       tahun_terbit = '$thnTerbit',
       jumlah_buku = '$jmlhbuku'
        WHERE id = $id");

       
        if(mysqli_fetch_assoc($pucu)){
            $query = mysqli_query($conn, "SELECT author_id FROM penulis WHERE penulis = '$penulis'");
            $id_penulis =  mysqli_fetch_assoc($query)["author_id"];

           $update_penulis = mysqli_query($conn, "UPDATE buku_penulis SET author_id = '$id_penulis' WHERE id = '$id'");
           mysqli_query($conn, "UPDATE tb_buku SET pembaruan_terakhir = '$date' WHERE id = '$id'");
           
        }  else{
            $update_penulis = mysqli_query($conn, "UPDATE penulis SET penulis = '$penulis' WHERE author_id = $idpenulis");
        } 


        if(mysqli_fetch_assoc($ucup)){

            $query1 = mysqli_query($conn, "SELECT place_id FROM tempat WHERE tempat_terbit = '$tmptTerbit'");
            $id_tempat =  mysqli_fetch_assoc($query1)["place_id"];
 
            mysqli_query($conn, "UPDATE tb_buku SET place_id = '$id_tempat' WHERE id = $id");
  
        } else{
          mysqli_query($conn, "UPDATE tempat SET tempat_terbit = '$tmptTerbit' WHERE place_id = $idtempat");
        }

        mysqli_query($conn, "UPDATE tb_buku SET pembaruan_terakhir = '$date' WHERE id = '$id'");
        return 1;
       }

     // $a = mysqli_query($conn, "UPDATE tb_buku SET pembaruan_terakhir = '$date' WHERE id = '$id'");
  //   return mysqli_affected_rows($conn);
        

    function waktu($data){
          date_default_timezone_set("Asia/Jakarta");
          $tanggal = date("l, d-m-Y");
          $jam  = date("H:i:s");
          $date = $tanggal." "."Pukul"." ".$jam;
          
          return $date;
    }


    //cari siswa
        function SearchSiswa($baru) {
            global $conn;
    
            $query = "SELECT * FROM tb_anggota WHERE 
                      username LIKE  '%$baru%' OR
                      nis LIKE  '%$baru%' OR
                      kelas LIKE  '%$baru%'
                      ";
                      
            
            $hasil = mysqli_query($conn, $query);
         
            return $hasil;
        }



        // page

        function pagination($page) {
            global $conn;


            $Hakhir = 20;
            $result = count(query("SELECT * FROM tb_buku"));
            $hasil = ceil($result / $Hakhir);
            $data = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
            if($data == 0){
                $data = 1;
            }

            $Hawal = ( $Hakhir * $data) - $Hakhir;
            
            $page = "SELECT * FROM tb_buku ORDER BY id DESC LIMIT $Hawal, $Hakhir";

            return $page;
        }

        //pinjam buku
        function pinjamBuku($id_buku, $id_user, $judul_buku, $user, $jmlhbuku){
            global $conn;
            $date = waktu($_POST);
            $jmlhbuku = $jmlhbuku - 1;
            

            if(query("SELECT * FROM list WHERE username = '$user' AND judul = '$judul_buku'")){
                return false;
            }elseif(query("SELECT * FROM user_active WHERE username = '$user' AND judul = '$judul_buku'")){
                return false;
            }

            if(query("SELECT id FROM admin_settings WHERE sett2 = 1")){
                $date = date("l, d-m-Y");
                $jatuh_tempo = date("l, d-m-Y", strtotime($date.'+3 days'));
                
                mysqli_query($conn, "UPDATE tb_buku SET jumlah_buku = '$jmlhbuku' WHERE id = '$id_buku'");
                mysqli_query($conn, "INSERT INTO user_active VALUES('', '$user', '$judul_buku', '$id_buku', '$id_user', '$date', '$jatuh_tempo')");
                return mysqli_affected_rows($conn);
                
            }else{
                mysqli_query($conn, "INSERT INTO list VALUES('', '$id_user', '$id_buku', '$judul_buku', '$user', '$date', '0')");
                return mysqli_affected_rows($conn);
            
            }
        }

        //set password admin
        function setPassAdmin($data){
            global $conn;
            $pass = $data["pass"];
            $kpass = $data["kpass"];

            if($pass === $kpass){
                password_hash($pass, PASSWORD_DEFAULT);
                 mysqli_query($conn, "UPDATE tb_admin SET password = '$password'");
                return mysqli_affected_rows($conn);

            } else{
                echo "<script>
                alert('Konfirmasi Password Tidak Sesuai');
                </script>";
            }


        }

        
        //set password user
        function setPassUser($data, $id_anggota){
            global $conn;
            
            $pass = $data["pass"];
            $kpass = $data["kpass"];

            if($pass === $kpass){
                if(query("SELECT sett3 FROM admin_settings WHERE sett3 = '1'")){
                    $password = password_hash($pass, PASSWORD_DEFAULT);
                    mysqli_query($conn, "UPDATE tb_anggota SET password = '$password' WHERE id = $id_anggota");
                    return mysqli_affected_rows($conn);

                }
                    $password = password_hash($pass, PASSWORD_DEFAULT);
                    mysqli_query($conn, "UPDATE tb_anggota SET password = '$password'");
                    mysqli_query($conn, "UPDATE tb_admin SET password_anggota = '$password'");
                    return mysqli_affected_rows($conn);
                

            } else{
                echo "<script>
                alert('Konfirmasi Password Tidak Sesuai');
                </script>";
            }
        }

        //set password user dari halaman daftar_siswa.php
        function setPassUser2($data, $id_anggota){
            global $conn;

            $pass = $data["pass"];
            $kpass = $data["kpass"];

            if($pass === $kpass){
            $password = password_hash($pass, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE tb_anggota SET password = '$password' WHERE id = $id_anggota");
            return mysqli_affected_rows($conn);
            } else{
                echo "<script>
                alert('Konfirmasi Password Tidak Sesuai');
                </script>";
            }
        }


        function displayLimitedWords($text, $limit) {
            $words = explode(' ', $text);
            $limitedWords = array_slice($words, 0, $limit);
          
            $limitedText = implode(' ', $limitedWords);
          
            if (count($words) > $limit) {
              $limitedText .= '...';
            }
          
            return $limitedText;
            
          }
          
        //   $limitedText = displayLimitedWords($text, 20);
          
        //   return $limitedText
          
?> 