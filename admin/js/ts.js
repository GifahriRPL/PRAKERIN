//mencari elemen
const inputCari = document.getElementById('cari')
const table = document.getElementById('container') 

//event ketika di ketik
inputCari.addEventListener('keyup', function () {
    
    // ajax
    const ajax = new XMLHttpRequest()
    ajax.onreadystatechange = function () {
        if ( ajax.readyState == 4 && ajax.status == 200 ) {
            table.innerHTML = ajax.responseText
        }
    }

    // eksekusi
    ajax.open('GET', `js/livestreaming.php?pencet=${inputCari.value}`, true)
    ajax.send()
})