<?php
class Tambahvarian extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['username'])) { // Bila tidak login redirect ke login
            header("Location: " . BASEURL . "login");
        }
        if($_SESSION['is_admin'] == 0){ //Bila bukan admin redirect ke dashboard
            header("Location: ".BASEURL);
        }
        
        if (isset($_POST["submit"])) {
            $nama = $_POST['nama'];
            $desc = $_POST['desc'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];

            // upload gambar nih gan
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if ($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                // echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                // echo "Sorry, file already exists.";
                $uploadOk = 0;
                echo 
                "<script>
                    alert('File gambar sudah ada!');
                </script>";
            }

            // Check file size
            if ($_FILES["gambar"]["size"] > 1000000) { //maks 1MB
                $uploadOk = 0;
                echo 
                "<script>
                    alert('File terlalu besar!');
                </script>";
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $uploadOk = 0;
                echo 
                "<script>
                    alert('Format file tidak didukung');
                </script>";
            }

            // Check if $uploadOk is set to 0 by an error
            if (
                $uploadOk == 0
            ) {
                // echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                    $gambar = $target_file;

                    $this->model('VarDorayaki_model')->addVariant($nama, $gambar, $desc, $harga, $stok);
                    echo 
                    "<script>
                        alert('Variant telah ditambahkan');
                    </script>";
                    // header("Location: ".BASEURL);
    
                } else {
                    echo 
                    "<script>
                        alert('Gagal mengupload gambar');
                    </script>";
                }
            } 
        }

        $data['halaman'] = 'Tambah Varian';
        $this->view('tambaheditvarian/index', $data);
    }
}
