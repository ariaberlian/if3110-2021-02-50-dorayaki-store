<?php

class Register extends Controller{
    public function index()
    {
        $data['gagalMasuk'] = false; // belum dicek
        if (isset($_SESSION['username'])) { // Bila sudah login redirect ke dashboard
            header("location: " . BASEURL);
        }
        
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) 
        { //cek username
            $data_user =  $this->model('User_model')->getAllUser();
            foreach ($data_user as $record){
                if ($record['username'] == $_POST['username']){
                    $data['gagalMasuk'] = true; //username atau password tidak sesuai
                    break;
                }
            }
            if (!$data['gagalMasuk'])
            {
                $pwd = hash("sha256", $_POST['password']);
                $this->model('User_model')->insertUser($_POST['username'], $_POST['email'], $pwd);
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['is_admin'] = 0;
                header("Location: ". BASEURL);
            }
        }


        $this->view("register/index", $data);
    }

    public function getUserCount($nama_var=''){
        // if (!isset($_SESSION['username'])) { // Bila tidak login redirect ke login
        //     header("Location: " . BASEURL . "login");
        //     exit;
        // }
        if ($nama_var == '') {
            header("Location: " . BASEURL);
            exit;
        }
        $count = $this->model("User_model")->getUserCount($nama_var);
        echo($count['count']);
    }
}