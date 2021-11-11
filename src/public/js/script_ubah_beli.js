
function loadDoc() {
    // console.log("Getting stok.....");
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    res = this.responseText;
    document.getElementById("stok").innerHTML = this.responseText;
    let beli = document.getElementById("beli");

 if(beli){
        beli.max = this.responseText;
        document.getElementById("total-harga").innerText = document.getElementById("harga").innerText * beli.value; // hitung total harga
    }


  }
  let nama_var = document.getElementById("nama_var").innerText;
  nama_var = encodeURI(nama_var);
  // console.log("http://localhost/tubes1/public/ubahstok/getStok/"+nama_var);
  xhttp.open("GET",  baseURL+"/ubahstok/getStok/"+nama_var, true);
  xhttp.send();
};

setInterval(function(){
    loadDoc();
}, 1000); // reload getStok setiap 0.2 detik