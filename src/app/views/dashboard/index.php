<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="shortcut icon" type="image/jpg" href="<?=BASEURL;?>img/favicon.png" />
</head>

<body>
    <!-- <section class="content center"> -->
    <div class="sidenav show-menu">
        <div class="container-x-icon">
            <div class="name-app">
                <img class="img-name-app" src="<?=BASEURL;?>img/favicon.png" alt="">
                <h1 class="title-name-app">Jayen</h1>
            </div>
            <img class="icon x-icon hide-icon" id="nav-close" src="<?=BASEURL;?>img/x-icon-white.png" alt="">
        </div>
        <header>
            <form method="GET" action="<?= BASEURL; ?>dashboard/search">
   <div class="search">
      <input type="text" class="searchTerm" name="q" id="q" placeholder="What are you looking for?">
      <button type="submit" class="searchButton">
          <img class="icon search-icon" src="<?=BASEURL;?>img/searchwhite-icon.png" alt="">
     </button>
   </div>
            
            <!-- <input type="text" name="q" id="q">
                <button type="submit">
                    <span>Cari</span>
                </button> -->
            </form>    
            <!-- <div class="container-riwayat-logout"> -->
                <?php
                if ($data['is_admin'] == 1) {
                    echo "
                    <a class='hover-sidebar' href='" . BASEURL . "tambahvarian' class='a-header'><img class='icon search-icon' src='" . BASEURL . 'img/add-icon.png' . "'>Tambah Varian</a>
                    <a class='hover-sidebar' href='" . BASEURL . "riwayat' class='a-header'><img class='icon search-icon' src='" . BASEURL . 'img/historywhite-icon.png' . "'>Riwayat Perubahan Stok</a> 
                     ";
                } else {
                    echo "
                    <a class='hover-sidebar' href='" . BASEURL . "riwayat' class='a-header'><img class='icon search-icon' src='" . BASEURL . 'img/historywhite-icon.png' . "'>Riwayat Pembelian</a>
                    ";
                }
                ?>
                <a class="hover-sidebar" href='<?= BASEURL; ?>logout' class='a-header'><img class='icon search-icon' src='<?=BASEURL;?>img/logoutwhite-icon.png'>Logout</a>
            <!-- </div> -->
        </header>
        <!-- <img class="img-dorayaki-med rotate" src="../src/public/img/dorayaki.png" alt=""> -->

    </div>
    <div class="main">
        <div class="container-title-name">
            <img class="icon menu-icon hide-icon" id="nav-toggle" src="<?=BASEURL;?>img/menu-icon.png" alt="" class="menu-icon">
            <h1 id="title">Welcome to Dashboard</h1>
            <div class="date-container">
                <img class="icon" src="<?=BASEURL;?>img/calendar-icon.png" alt="" class="date-icon">
                <div id="date"></div>
            </div>
            <h1 id="name"><?= $data["username"]; ?></h1>
        </div>
        <div class="content">
        <h3 id="daftar-varian">Daftar Variant Dorayaki</h3>
        <div class="container-card">
            <?php
            foreach ($data['variant'] as $variant) {
                echo "<a href='" . BASEURL . "detail/" . urlencode($variant['nama']) . "'> <div class='container' style='background:url(" . $variant['gambar'] . ");background-repeat: no-repeat;background-position: center;background-size: cover;'> <div class='container__profile'> <div class='container__profile__text'> <h2>" . $variant['nama'] .  "</h2><p class='harga'>Rp. " . $variant['harga'] . "</p></div></div></div></a>";
            }
            ?>
        </div>
        
        <div class="container-page-number">
        <?php
        if ($data['page_number'] != 1) {
            echo " <a href=" . BASEURL . ($data['page_number'] - 1) . ">" . "<" . "</a> ";
        }
        ?>
        <a href=""><?= $data['page_number'] ?></a>
        <?php
        if ($data['page_number'] != $data['max_page_number']) {
            echo " <a href=" . BASEURL . ($data['page_number'] + 1) . ">" . ">" . "</a> ";
        }
        ?>
        </div>
        

        </div>

    </div>
        

    <!-- </section> -->

</body>
<script>
const navMenu = document.querySelector(".sidenav"),
  navToggle = document.getElementById("nav-toggle"),
  navClose = document.getElementById("nav-close");

  function myFunction(x) {
    if (x.matches) { // If media query matches
      navToggle.classList.remove("hide-icon");
      navClose.classList.remove("hide-icon");
    }else{
        navToggle.classList.add("hide-icon");
      navClose.classList.add("hide-icon");
    }
  }
  
  var x = window.matchMedia("(max-width: 900px)")
  myFunction(x) // Call listener function at run time
  x.addListener(myFunction) // Attach listener function on state changes

/* ======= SHOW MENU  ======= */
navToggle.addEventListener("click", function(){
    navMenu.classList.add('show-menu')
})

navClose.addEventListener("click",function(){
    navMenu.classList.remove("show-menu")
})



/* ======= MENU SHOW  ======= */

/* Validate if constant exist */
/* sebenernya ga usah cek if juga bisa */



/* ======= MENU SHOW  ======= */

/* Validate if constant exist */






function formatAMPM() {
var d = new Date(),
    seconds = d.getSeconds().toString().length == 1 ? '0'+d.getSeconds() : d.getSeconds(),
    minutes = d.getMinutes().toString().length == 1 ? '0'+d.getMinutes() : d.getMinutes(),
    hours = d.getHours().toString().length == 1 ? '0'+d.getHours() : d.getHours(),
    ampm = d.getHours() >= 12 ? 'pm' : 'am',
    months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
return days[d.getDay()]+' '+months[d.getMonth()]+' '+d.getDate()+' '+d.getFullYear()+' '+hours+':'+minutes+':'+seconds+ampm;
}

const displayTime = () => {
    document.getElementById("date").innerHTML = formatAMPM();
}

const updateTime = () => {
    displayTime();
    setInterval(displayTime, 1000)
};

updateTime()

</script>

</html>