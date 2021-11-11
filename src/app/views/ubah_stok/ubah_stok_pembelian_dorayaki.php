<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if ($data['is_admin'] == 1) echo ("Halaman Ubah Stok");
            else echo ("Halaman Pembelian"); ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/ubahstok.css">
    <link rel="shortcut icon" type="image/jpg" href="<?= BASEURL; ?>img/favicon.png" />

</head>

<body>
    <button class="back_button" onclick="window.history.back()">
        <h3>Go Back</h3>
    </button>
    <div class="center">

        <h1>Varian <span id='nama_var'> <?= $data['detail']['nama'] ?> </span></h1>
        <img src="<?= BASEURL . $data['detail']['gambar'] ?>" alt="gambar">
        <p>
            Jumlah terjual : <?= $data['detail']['penjualan'] ?> <br>
            Harga : <span id="harga"><?= $data['detail']['harga'] ?> </span> <br>
            Deskripsi : <?= $data['detail']['desc'] ?> <br>
            Stok : <span id="stok"><?= $data['detail']['stok'] ?></span>
        </p>

        <?php
        if ($data['is_admin'] == 1) {
            echo "
        <form action='' method='post'>
        <label for='ubah'><b>Ubah Stok menjadi</b></label>
        <input type='number' name='ubah' id='ubah' value='" . $data['detail']['stok'] . "' min='0' autofocus>
        <input type='submit' value='Ubah' name='submit'>
        </form> 
        ";
        } else {
            echo "
        <form action='' method='post'>
        <label for='beli'><b>Beli dorayaki varian " . $data['detail']['nama'] . " dengan jumlah </b></label>
        <input type='number' name='beli' id='beli' value='0' min='0' max='" . $data['detail']['stok'] . "' autofocus>
        <br>Total Biaya : <span id='total-harga'></span>
        <input type='submit' value='Beli' name='submit'>
        </form>
        ";
        }


        ?>
    </div>
    <script>
        let baseURL = "<?= BASEURL ?>";
    </script>
    <script src="<?= BASEURL ?>js/script_ubah_beli.js"></script>
</body>

</html>