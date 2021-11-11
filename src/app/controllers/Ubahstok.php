<?php
class Ubahstok extends Controller
{
    public function index($nama_var = '')
    {
        if (!isset($_SESSION['username'])) { // Bila tidak login redirect ke login
            header("Location: " . BASEURL . "login");
            exit;
        }
        if ($nama_var == '') {
            header("Location: " . BASEURL);
            exit;
        }
        $data['is_admin'] = $_SESSION['is_admin'];
        $data['username'] = $_SESSION['username'];
        $data['detail'] = $this->model("VarDorayaki_model")->getDetailVariant($nama_var);
        if (isset($_POST['submit'])) {
            if (isset($_POST['ubah'])) {
                $stok_akhir = $_POST['ubah'];
                $stok_awal = $data['detail']['stok'];
                $perubahan = $stok_akhir - $stok_awal;
            } else if (isset($_POST['beli'])) {
                $stok_awal = $data['detail']['stok'];
                $perubahan = $_POST['beli'];
                $stok_akhir = $stok_awal - $perubahan;
                $perubahan = -$perubahan; // pembelian dicatat sebagai pengurangan stok
            }

            $success = $this->model("VarDorayaki_model")->ubahStok($nama_var, $data['username'], $stok_akhir, $perubahan);
            if ($data['is_admin'] == 1) {
                if ($success) {
                    echo "<script>alert('Pengubahan stok berhasil');</script>";
                } else {
                    echo "<script>alert('Terjadi kegagalan pengubahan stok');</script>";
                }
            } else {
                if ($success) {
                    echo "<script>alert('Pembelian berhasil');</script>";
                } else {
                    echo "<script>alert('Terjadi kegagalan pembelian');</script>";
                }
            }
        }
        $this->view("ubah_stok/ubah_stok_pembelian_dorayaki", $data);
    }
    public function getStok($nama_var = '')
    {
        if (!isset($_SESSION['username'])) { // Bila tidak login redirect ke login
            header("Location: " . BASEURL . "login");
            exit;
        }
        if ($nama_var == '') {
            header("Location: " . BASEURL);
            exit;
        }
        $stok = $this->model("VarDorayaki_model")->getStok($nama_var);
        echo ($stok['stok']);
    }
}
