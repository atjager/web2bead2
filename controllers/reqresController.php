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

        public function postReqres(){
            $url = "https://reqres.in/api/users";  
            $user = [
                "name" => "Morpheus",
                "job" => "tester"
            ];
            $curlPost = curl_init($url);
            curl_setopt($curlPost, CURLOPT_POST, 1);
            curl_setopt($curlPost, CURLOPT_POSTFIELDS, http_build_query($user));
            curl_setopt($curlPost, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($curlPost);
            curl_close($curlPost);
            
            $arrayResult = json_decode($result, true);
            return $arrayResult;
        }

        public function putReqres(){
            $url = "https://reqres.in/api/users/2";  
            $user = [
                "name" => "Morpheus",
                "job" => "Progremmer"
            ];

            $curlPut = curl_init($url);
            curl_setopt($curlPut, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curlPut, CURLOPT_POSTFIELDS, http_build_query($user));
            curl_setopt($curlPut, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($curlPut);
            curl_close($curlPut);
            $arrayResult = json_decode($result, true);
            return $arrayResult;            
        }

        public function deleteReqres(){
            $url = "https://reqres.in/api/users/2";  

            $curlDelete = curl_init($url);
            curl_setopt($curlDelete, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curlDelete, CURLOPT_HEADER, true);
            curl_setopt($curlDelete, CURLOPT_NOBODY, true);
            curl_setopt($curlDelete, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($curlDelete);
            curl_close($curlDelete);

            $stringResult = explode(" ", $result);
            $responde = $stringResult[1];
            return $responde;          
        }


    }

?>