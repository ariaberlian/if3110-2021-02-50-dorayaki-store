<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <link rel="shortcut icon" type="image/jpg" href="<?= BASEURL; ?>img/favicon.png" />
    <link rel="stylesheet" href="../css/search_result.css">

</head>

<body>
    <button class="back_button" onclick="window.history.back()">
        <h3>Go Back</h3>
    </button>
    <div class="center">
    <h1>Hasil Pencarian</h1>
    <h3 id="daftar-varian">Daftar Variant Dorayaki</h3>
        <div class="container-card">
            <?php
            if(isset($data['variant'])){
                foreach ($data['variant'] as $variant) {
                    echo "<a href='" . BASEURL . "detail/" . urlencode($variant['nama']) . "'> <div class='container' style='background:url(" . BASEURL . $variant['gambar'] . ");background-repeat: no-repeat;background-position: center;background-size: cover;'> <div class='container__profile'> <div class='container__profile__text'> <h2>" . $variant['nama'] .  "</h2><p class='harga'>Rp. " . $variant['harga'] . "</p></div></div></div></a>";
                }
            }else{
                echo "<h1 class='sorry'>Maaf, yang Anda cari tidak ada</h1>";
            }
            ?>
        </div>
    <div class="container-page-number">
    <?php
    if(isset($data['variant'])){
        if ($data['page_number'] != 1) {
            echo " <a href=" . BASEURL . "search?q=". $_GET['q'] . "/". ($data['page_number'] - 1) . ">" . "<" . "</a> ";
        }
    }
    ?>
    <?php
    if(isset($data['variant'])){
        echo " <a href=''>" . $data['page_number'] . "</a>";    
    }
    ?>
    <?php
    if(isset($data['variant'])){
        if ($data['page_number'] != $data['max_page_number']) {
            echo " <a href=" . BASEURL . "search?q=" . $_GET['q'] . "/" .($data['page_number'] + 1) . ">" . ">" . "</a> ";
        }
    }
    ?>
    </div>


    </div>

</body>

</html>