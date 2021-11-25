<?php

class AutoReadReq extends Controller
{
    function index(){

        //consume SOAP API : GET Request LIST
        $soapclient = new SoapClient("http://localhost:8080/JayenInterface/services/SeeRequestStatusServiceImpl?wsdl");
    
        $ip = getenv('HTTP_CLIENT_IP') ?:
            getenv('HTTP_X_FORWARDED_FOR') ?:
            getenv('HTTP_X_FORWARDED') ?:
            getenv('HTTP_FORWARDED_FOR') ?:
            getenv('HTTP_FORWARDED') ?:
            getenv('REMOTE_ADDR');
    
        $param = array('ip' => $ip);
    
        $response = $soapclient->see_request_status($param);
        $array = json_decode(json_encode($response), true);

        $isi = $array["see_request_statusReturn"];
        $arr_req = json_decode($isi);

        if (json_last_error() === JSON_ERROR_NONE) {
            $arr_req = json_decode(json_encode($arr_req), true);


            for($i=0; $i<sizeof($arr_req); $i++){
                if((time() - strtotime($arr_req[$i]['updated_at']) <= 300)){
                    if($arr_req[$i]['status'] == 0){
                        echo "Permintaan penambahan stok dengan\nid request:" . $arr_req[$i]['id_request'] . "\nvarian : " .  $arr_req[$i]['varian'] . "\njumlah :" . $arr_req[$i]['jumlah_penambahan'] . "\nDITOLAK!";

                      


                    }else if($arr_req[$i]['status'] == 1){
                        echo "Permintaan penambahan stok dengan\nid request:" . $arr_req[$i]['id_request'] . "\nvarian : " .  $arr_req[$i]['varian'] . "\njumlah :" . $arr_req[$i]['jumlah_penambahan'] . "\nDITERIMA!";

                        // update stok db
                        $success = $this->model("VarDorayaki_model")->addStok($arr_req[$i]['varian'], 'blabalabala', $arr_req[$i]['jumlah_penambahan']);


                    }
                } 

            }
          




         
        } else {
            $data['limited'] = $isi;
            $this->view('tambaheditvarian/limited', $data);
            http_response_code(429);
            exit;
        }



    }
}
