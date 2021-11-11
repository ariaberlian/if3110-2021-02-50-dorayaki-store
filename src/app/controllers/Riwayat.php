<?php
class Riwayat extends Controller
{
    public function index($variant = '')
    {
        $data['is_admin'] = $_SESSION['is_admin'];
        if($variant != ''){ // kalo user akses variant redirect ke riwayat pembeliannya
            if($data['is_admin'] == 0 ){
                header("Location: " . BASEURL . "riwayat");
                exit;
            }
            else{
                $data['variant_history'] = $this->model('Histori_model')->getHistoryVariant($variant);
                $data['nama_var'] = $this->model('Histori_model')->getVarName();
            }
        } else {
            $user = $_SESSION['username']; // kalau user atau admin mau liat perubahannya sendiri
            if($data['is_admin'] == 1){
                $data['histori'] = $this->model('Histori_model')->getHistoryAdmin($user);
                $data['nama_var'] = $this->model('Histori_model')->getVarName();
            }else{
                $data['histori'] = $this->model('Histori_model')->getHistoryUser($user);
            }
        }
        
        $this->view('riwayat/index', $data);
    }
}
