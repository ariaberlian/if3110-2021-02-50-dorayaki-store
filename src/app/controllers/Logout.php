<?php
class Logout extends Controller{
    public function index()
    {
        if (!isset($_SESSION["username"])) { // Kalau belum login balikin ke login
            header("location: " . BASEURL . "login");
            exit;
        }
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();

        header("location: " . BASEURL . "login"); //redirect ke login
        exit;
    }
}