const inputCari2 = document.getElementById('carii')
inputCari2.addEventListener('keyup', function () {
    console.log("ready ajax");

    // ajax
    const ajax = new XMLHttpRequest()
    ajax.onreadystatechange = function () {
        if ( ajax.readyState == 4 && ajax.status == 200 ) {
            table.innerHTML = ajax.responseText
        }
    }

    // eksekusi
    if (inputCari2.value === '') {
        ajax.open('GET', `js/livesearch.php?cari=20`, true)
        ajax.send()
    }else{
    
    ajax.open('GET', `js/livesearch.php?cari=${inputCari2.value}`, true)
    ajax.send()
}
})