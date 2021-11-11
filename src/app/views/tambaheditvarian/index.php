<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['halaman']; ?> Dorayaki</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/tambaheditvarian.css">
    <link rel="shortcut icon" type="image/jpg" href="<?= BASEURL; ?>img/favicon.png" />

</head>

<body>
    <button class="back_button" onclick="window.history.back()">
        <h3>Go Back</h3>
    </button>
    <div class="center">
        <form method="post" enctype="multipart/form-data">
            <div class="txt_field">
                <input required type="text" name="nama" id="nama" value="<?php if (isset($data['detail'])) echo $data['detail']['nama']; ?>">
                <span></span>
                <label>Nama Varian</label>
            </div>
            <div class="text_field">
                <label for="gambar" class="upload-file">Gambar</label>
                <input type="file" name="gambar" id="gambar" accept=".jpg, .jpeg, .png, .gif" onchange="readURL(this);" <?php if ($data['halaman'] == 'Tambah Varian') echo "required"; ?>>
                <img id="blah" src="<? echo BASEURL;
                                    if (isset($data['detail'])) echo $data['detail']['gambar']; ?>" alt="your image" style="width:100px;height:60px;" />
            </div>
            <label for="desc">Deskripsi</label>
            <div class="text_field">
                <textarea name="desc" id="desc" cols="46"><?php if (isset($data['detail'])) echo $data['detail']['desc']; ?></textarea>
            </div>
            <label for="harga">Harga</label>
            <div class="text_field">
                <input required type="number" name="harga" id="harga" value="<?php if (isset($data['detail'])) echo $data['detail']['harga']; ?>">
            </div>
            <label for="stok">Stok</label>
            <div class="text_field">
                <input required type="number" name="stok" id="stok" value="<?php if (isset($data['detail'])) echo $data['detail']['stok']; ?>">
            </div>
            <input type="submit" name="submit" value="<?= $data['halaman']; ?>">
        </form>
    </div>


    <script>
        let baseURL = "<?= BASEURL ?>";
    </script>
    <script src="<?= BASEURL ?>js/script_tambaheditvarian.js"></script>
</body>

</html>