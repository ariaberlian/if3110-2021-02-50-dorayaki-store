<?php

class Detail extends Controller
{

    public function index($nama_var='')
    {
        if (!isset($_SESSION['username'])) { // Bila tidak login redirect ke login
            header("Location: " . BASEURL . "login");
            exit;
        }
        if($nama_var==''){
            header("Location: ". BASEURL);
            exit;
        }
        $data['detail'] = $this->model("VarDorayaki_model")->getDetailVariant($nama_var);
        $this->view('detail/index', $data);
    }

    public function delete($nama_var = ''){
        if (!isset($_SESSION['username'])) { // Bila tidak login redirect ke login
            header("Location: " . BASEURL . "login");
            exit;
        }
        if ($nama_var == '') {
            header("Location: " . BASEURL);
            exit;
        }
        if ($_SESSION['is_admin'] == 0) { //Bila bukan admin redirect ke dashboard
            header("Location: " . BASEURL);
        }
        $success = $this->model("VarDorayaki_model")->deleteVariant($nama_var);
        if($success){
            header("Location: " . BASEURL);
            exit;
        }else{
            echo "<script>alert('Gagal menghapus varian.... kembali ke <a href='".BASEURL."detail/". $nama_var ."'>detail variant</a>');</script>";
        }
    }

    public function edit($nama_var = ''){
        if (!isset($_SESSION['username'])) { // Bila tidak login redirect ke login
            header("Location: " . BASEURL . "login");
            exit;
        }
        if ($nama_var == '') {
            header("Location: " . BASEURL);
            exit;
        }
        if ($_SESSION['is_admin'] == 0) { //Bila bukan admin redirect ke dashboard
            header("Location: " . BASEURL);
        }

        $data['detail'] = $this->model("VarDorayaki_model")->getDetailVariant($nama_var);

        if (isset($_POST["submit"])) {
            $nama = $_POST['nama'];
            $desc = $_POST['desc'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
          
            $gambar = null;
            // upload gambar nih gan
            $target_dir = "img/";
            if( isset($_FILES["gambar"]["name"]) && !empty($_FILES["gambar"]["name"])){
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
                    echo
                    "<script>
                    alert('File gambar sudah ada!');
                </script>";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["gambar"]["size"] > 1000000) { //maks 1MB
                    echo
                    "<script>
                    alert('File terlalu besar!');
                </script>";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    echo
                    "<script>
                    alert('Format file tidak didukung');
                </script>";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if (
                    $uploadOk == 0
                ) {
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                        $gambar = $target_file;
                     
                    } else {
                        echo
                        "<script>
                        alert('Gagal mengupload gambar');
                    </script>";
                    }
                }

     

            }
           
            $this->model('VarDorayaki_model')->editVariant($nama, $gambar, $desc, $harga, $stok);
            echo
            "<script>
                            alert('Variant telah diedit');
                        </script>";
        }
        

        $data['halaman'] = 'Edit Varian';
        $this->view('tambaheditvarian/index', $data);
    }
}
