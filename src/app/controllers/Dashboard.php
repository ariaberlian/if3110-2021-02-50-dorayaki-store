<?php

class Dashboard extends Controller
{
    public function index($page = 1)
    {
        if (!isset($_SESSION['username'])) { // Bila tidak login redirect ke login
            header("Location: " . BASEURL . "login");
            exit;
        }
        $data["username"] = $_SESSION['username'];
        $data['is_admin'] = $_SESSION['is_admin'];
        $variant = $this->model("VarDorayaki_model")->getAllVariant();

        //pagination
        $MAXIMUM_PAGE = 8; // maksimum data yang ditampilkan dalam satu page
        $size = sizeof($variant);
        $data['max_page_number'] = ceil($size / $MAXIMUM_PAGE);

        if ($size != 0) {
            if ($page > $data['max_page_number']) {
                header("Location: " . BASEURL . ($data['max_page_number']));
            } else if ($page < 1) {
                header("Location: " . BASEURL);
            }
            $variant = array_chunk($variant, $MAXIMUM_PAGE, false); //different page per 2 variant name
            $data['variant'] = $variant[$page - 1];
            $data['page_number'] = $page;
        }

        // render
        $this->view('dashboard/index', $data);
    }

    public function search($page = 1)
    {
        if (!isset($_SESSION['username'])) { // Bila tidak login redirect ke login
            header("Location: " . BASEURL . "login");
        }

        $data["username"] = $_SESSION['username'];
        $data['is_admin'] = $_SESSION['is_admin'];

        // var_dump($_GET['q']);

        $key = $_GET["q"];
        $variant = $this->model("VarDorayaki_model")->findVariant($key);

        //pagination
        $MAXIMUM_PAGE = 4; // maksimum data yang ditampilkan dalam satu page
        $size = sizeof($variant);
        $data['max_page_number'] = ceil($size / $MAXIMUM_PAGE);

        if ($size != 0) {
            if ($page > $data['max_page_number']) {
                header("Location: " . BASEURL . "search/" . ($data['max_page_number']));
            } else if ($page < 1) {
                header("Location: " . BASEURL);
            }
            $variant = array_chunk($variant, $MAXIMUM_PAGE, false); //different page per 2 variant name
            $data['variant'] = $variant[$page - 1];
            $data['page_number'] = $page;
        }


        // render
        $this->view('dashboard/search_result', $data);
    }
}
