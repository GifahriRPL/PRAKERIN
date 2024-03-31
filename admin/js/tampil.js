
$(document).ready(function() {
    jumlah();
    jumlahh();
    useractive();
    pesan();
    selesai();
});
 

function selesai() {
    setTimeout(function() {
        jumlah();
        jumlahh();
        useractive();
        pesan();
        selesai();
    }, 2000);
}


function jumlah() {
    $.getJSON("admin-notification/count.php", function(datas) {
        $("#notif").html(datas.jumlah);
    });
}


function useractive() {
    $.getJSON("admin-notification/data-user-active.php", function(datas) {
        $("#notif-user-active").html(datas.jumlah);
    });
}


function jumlahh() {
    $.getJSON("admin-notification/count.php", function(datas) {
        $("#notiff").html(datas.jumlah);
    });
}



function pesan() {
    $.getJSON("admin-notification/data_pesan.php", function(data) {
        $("#pesan").empty();
        $.each(data.result, function() {
            $("#pesan").append(`<a href="as.php" id="pesan" class="dropdown-item"></a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill text-warning" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
          </svg>&nbsp;<p style="display: inline;">`+'<a href="admin-notification/track-book-user.php?id='+this['id_get_anggota'].substr(0, 20)+'" style="color: black; text-decoration: none;">'+this['username'].substr(0, 20)+' '+`ingin meminjam buku...</p></a>`);
        });
    });
}