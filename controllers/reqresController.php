<?php

    class ReqresController{

        public function show(){
            require_once('views/reqres/show.php');
        }

        public function getReqres(){
                $url = "https://reqres.in/api/users?page=2";  
                $curlGet = curl_init($url);
                curl_setopt($curlGet, CURLOPT_URL, $url);
                curl_setopt($curlGet, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curlGet);
                curl_close($curlGet);
                $objResult = json_decode($result, true);    

                return $objResult;
        }
    }

?>