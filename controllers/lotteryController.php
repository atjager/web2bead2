<?php
    class LotteryController{
            public function show(){
                
                require_once('views/lottery/show.php');

            }

            public function getUrl(){
                return "http://localhost/web2bead2/models/lottery.php";
            }

             //Get the last number from the database
            public function lotteryGet(){
                $url = $this->getUrl();
                $curlGet = curl_init($url);
                curl_setopt($curlGet, CURLOPT_URL, $url);
                curl_setopt($curlGet, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curlGet);
                curl_close($curlGet);
                return $result;
            }

            //Get the number from the form and add to database
            public function lotteryPost($number){
                $this->number = $number;
                $data = Array('number' => $number);

                $url = $this->getUrl();
                $curlPost = curl_init($url);
                curl_setopt($curlPost, CURLOPT_POST, 1);
                curl_setopt($curlPost, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curlPost, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curlPost);
                curl_close($curlPost);
                return $result;
                
            }

            //Replace the last element in the database
            public function lotteryPut($number){
                $this->number = $number;
                $data = Array("number" => $number);

                $url = $this->getUrl();
                $curlPut = curl_init($url);
                curl_setopt($curlPut, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($curlPut, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curlPut, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curlPut);
                curl_close($curlPut);
                return $result;
                
            }

            //Delete the last element in the database
            public function lotteryDelete(){
                $url = $this->getUrl();
                $curlDelete = curl_init($url);
                curl_setopt($curlDelete, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($curlDelete, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curlDelete);
                curl_close($curlDelete);
                return $result;        
            }

        
    }
?>