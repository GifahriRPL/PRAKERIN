const table = document.getElementById('container') 

const inputCari = document.getElementById('cari')
inputCari.addEventListener('keyup', function () {
    // ajax
    const ajax = new XMLHttpRequest()
    ajax.onreadystatechange = function () {
        if ( ajax.readyState == 4 && ajax.status == 200 ) {
            table.innerHTML = ajax.responseText
        }
    }

    // eksekusi
    console.log("ready ajax");
    if (inputCari.value === '') {
        ajax.open('GET', `js/livesearch.php?cari=20`, true)
        ajax.send()
    }else{
      
    ajax.open('GET', `js/livesearch.php?cari=${inputCari.value}`, true)
    ajax.send()
    }
})
