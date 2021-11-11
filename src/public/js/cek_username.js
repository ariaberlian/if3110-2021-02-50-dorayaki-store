function loadDoc() {
    // console.log("Getting stok.....");
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    res = this.responseText;
    if (res > 0)
        document.getElementById("salah").innerHTML 
            = "Username tidak tersedia";
    else
        document.getElementById("salah").innerHTML
            = ""; 

  }
  let nama_var = document.getElementById("username").value;
  nama_var = encodeURI(nama_var);
  // console.log("http://localhost/tubes1/public/ubahstok/getStok/"+nama_var);
//   console.log(baseURL+"/ubahstok/getStok/"+nama_var);
  xhttp.open("GET",  baseURL+"/register/getUserCount/"+nama_var, true);
  xhttp.send();
};

setInterval(function(){
    loadDoc();
}, 1000); // reload getStok setiap 0.2 detik