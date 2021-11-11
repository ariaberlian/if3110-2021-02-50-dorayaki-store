<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Detail Varian Dorayaki <?= $data['detail']['nama'] ?></title>
    <link rel="stylesheet" href="../css/detailvarian.css">
    <link rel="shortcut icon" type="image/jpg" href="<?= BASEURL; ?>img/favicon.png" />

</head>

<body>
    <button class="back_button" onclick="window.history.back()">
        <h3>Go Back</h3>
    </button>
    <div class="center">
        <div class="container-variant">
            <div class="container-left">
                <img class="image" src="<?= BASEURL . $data['detail']['gambar'] ?>" alt="" srcset="">
            </div>
            <div class="container-right">
                <div class="container-top">
                    <h1 class="title"><?= $data['detail']['nama'] ?></h1>
                    <div class="container-info">
                        <div class="container-small-info">
                            <h3 class="info">Harga</h3>
                            <h4>Rp. <?= $data['detail']['harga'] ?></h4>
                        </div>
                        <div class="container-small-info">
                            <h3 class="info">Terjual</h3>
                            <h4><?= $data['detail']['penjualan'] ?></h4>
                        </div>
                        <div class="container-small-info">
                            <h3 class="info">Stok</h3>
                            <h4><?= $data['detail']['stok'] ?></h4>
                        </div>
                    </div>
                    <div class="container-middle container-desc">
                        <h2 class="info">Deskripsi</h2>
                        <h3><?= $data['detail']['desc'] ?></h3>
                    </div>
                </div>
                <div class="container-button container-bottom">

                    <?php
                    if ($_SESSION['is_admin'] == 0) {
                        echo "<a href='" . BASEURL . "ubahstok/" . urlencode($data['detail']['nama']) . "'><button>Buy</button></a>";
                    } else {
                        echo "<a href='" . BASEURL . "ubahstok/" . urlencode($data['detail']['nama']) . "'><button>Ubah Stok</button></a>";
                        echo "<a href='" . BASEURL . "detail/edit/" . urlencode($data['detail']['nama']) . "'><button>Edit</button></a>";
                        echo "<a onclick='del()'><button>Delete</button></a>";
                    }
                    ?>
                </div>

            </div>
        </div>


        <script>
            function del() {
                let r = confirm('Apakah anda yakin mau menghapus varian ini?');
                if (r == true) {
                    console.log("<?= BASEURL; ?>detail/delete/<?= urlencode($data['detail']['nama']); ?>");
                    window.location.href = "<?= BASEURL; ?>detail/delete/<?= urlencode($data['detail']['nama']); ?>";
                }

            }
        </script>
</body>

</html>