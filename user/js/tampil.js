
$(document).ready(function() {
    useractive();
    loadData1();
    loadData2();
    selesai();
});
 

function selesai() {
    setTimeout(function() {
        useractive();
        loadData1();
        loadData2();
        selesai();
    }, 2000);
} 

function useractive() {
    $.getJSON("user-notification/count.php", function(datas) {
        $("#notif-user-active").html(datas.jumlah);
    });
}

function loadData2(){
    $.get("user-notification/data.php", function(data){
        $('#content2').html(data)
    })
} 

function loadData1(){
    $.get("user-notification/data2.php", function(data){
        $('#content1').html(data)
    })
} 
function confirm(){
    confirm("Apaka yakin ingin membatalkan peminjaman")
}