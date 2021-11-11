<?php
class Login extends Controller
{
    public function index()
    {
        $data['gagalMasuk'] = false; // belum dicek
        if (isset($_SESSION['username'])) { // Bila sudah login redirect ke dashboard
            header("location: " . BASEURL);
        }

        if (isset($_POST['username']) && isset($_POST['password'])) { //cek username passwordnya
            $data_user =  $this->model('User_model')->getAllUser();
            foreach ($data_user as $record){
                if ($record['username'] == $_POST['username']){
                    if($record['password']== hash("sha256", $_POST['password'])){
                        $_SESSION['username'] = $_POST['username'];
                        $_SESSION['is_admin'] = $record['is_admin'];
                        header("Location: ". BASEURL);
                    }
                }
            }
            $data['gagalMasuk'] = true; //username atau password tidak sesuai
        }

        $this->view("login/index", $data);
    }

}
