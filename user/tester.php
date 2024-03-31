<?php
        include "../functions.php";

        $query = query("SELECT * FROM tb_anggota, list WHERE tb_anggota.id = list.id_get_anggota");
        var_dump($query);



?>
   