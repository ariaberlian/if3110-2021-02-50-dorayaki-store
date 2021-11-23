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

        //consume SOAP API : GET VARIANT LIST
        $soapclient = new SoapClient("http://localhost:8080/JayenInterface/services/VariantServiceImpl?wsdl");

        $ip = getenv('HTTP_CLIENT_IP') ?:
        getenv('HTTP_X_FORWARDED_FOR') ?:
        getenv('HTTP_X_FORWARDED') ?:
        getenv('HTTP_FORWARDED_FOR') ?:
        getenv('HTTP_FORWARDED') ?:
        getenv('REMOTE_ADDR');

        $param = array('ip' => $ip);

        $response = $soapclient->getVariantList($param);
        $array = json_decode(json_encode($response), true);
        $isi = $array["getVariantListReturn"];
        $arr_variant = json_decode($isi);
        if (json_last_error() === JSON_ERROR_NONE) {
            $arr_variant = json_decode(json_encode($arr_variant), true);

            for ($i = 0; $i < sizeof($arr_variant); $i++) {
                $variant_list[$i] = $arr_variant[$i]["nama_resep"];
            }
            $data['avail_variant'] = $variant_list;
        } else {
            $data['limited'] = $isi;
            $this->view('tambaheditvarian/limited', $data);
            http_response_code(429);
            exit;
        }



        $data['is_admin'] = $_SESSION['is_admin'];
        $data['username'] = $_SESSION['username'];
        
        
        // Cek ketersediaan resep saat admin ingin meminta tambahan stok
        if($data['is_admin']){
            if(!in_array($nama_var, $data['avail_variant'])){
                $this->view("ubah_stok/norecipe", $data);
                exit;
            }
        }
        
        $data['detail'] = $this->model("VarDorayaki_model")->getDetailVariant($nama_var);


        if (isset($_POST['submit'])) {
            if (isset($_POST['ubah'])) {
                $stok_akhir = $_POST['ubah'];
                $stok_awal = $data['detail']['stok'];
                $perubahan = $stok_akhir - $stok_awal;
                
                $soapclientAddStok = new
                    SoapClient("http://localhost:8080/JayenInterface/services/AddStokServiceImpl?wsdl");
                
                $params = array('ip' => $ip, 'variant' => $nama_var, 'num' => $perubahan);

                $response = $soapclientAddStok->add_stok($params);
                if($response == "Permintaan Anda dibatasi 10/menit"){
                    $data['limited'] = $response;
                    $this->view('tambaheditvarian/limited', $data);
                    http_response_code(429);
                    exit;
                }else if($response == "Exception"){
                    $success = false;
                }else{
                    $success = true;
                }

            } else if (isset($_POST['beli'])) {
                $stok_awal = $data['detail']['stok'];
                $perubahan = $_POST['beli'];
                $stok_akhir = $stok_awal - $perubahan;
                $perubahan = -$perubahan; // pembelian dicatat sebagai pengurangan stok
                $success = $this->model("VarDorayaki_model")->ubahStok($nama_var, $data['username'], $stok_akhir, $perubahan);
            }

            if ($data['is_admin'] == 1) {
                if ($success) {
                    echo "<script>alert('Permintaan pengubahan stok berhasil');</script>";
                } else {
                    echo "<script>alert('Terjadi kegagalan permintaan pengubahan stok');</script>";
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
