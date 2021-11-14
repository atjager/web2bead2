<?php 
    class WebserviceController{

        public function show(){

            try{
            
            //ini_set("default_socket_timeout",5000);
            $options = array(
            "location" => "http://localhost/web2bead1/models/webservice.php",
            "uri" =>"http://localhost/web2bead1/models/webservice.php",
            'keep_alive' => false,
            'trace' =>true,
            //'connection_timeout' => 5000,
            //'cache_wsdl' => WSDL_CACHE_NONE,
            );

            $kliens = new SoapClient(null, $options);
            $gepek = $kliens->getgep();  
            $szoftverek = $kliens->getszoftver();
            $telepitesek = $kliens->gettelepites();

            require_once('views/webservice/show.php');

            }
            catch(SoapFault $e){
                print ($kliens->__getLastResponse());
                print ($kliens->__getLastRequest());
            }
        }

      
     }


    

?>