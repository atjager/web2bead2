<?php 
    class Webservice{
        public function getgep() {
            $result = array();
            
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $db = new PDO('mysql:host=localhost;dbname=web2bead1', 'root', '', $pdo_options);
            //$db = Db::getInstance();
            $sql = 'SELECT id, hely, tipus, ipcim FROM gep ORDER BY id';
            $req = $db->prepare($sql);
            $req->execute(array());
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        public function getszoftver() {
            $result = array();

            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $db = new PDO('mysql:host=localhost;dbname=web2bead1', 'root', '', $pdo_options);
            $sql = 'SELECT id, nev, kategoria  FROM szoftver ORDER BY id';
            $req = $db->prepare($sql);
            $req->execute(array());
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }
        
        public function gettelepites() {
            $result = array();

            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $db = new PDO('mysql:host=localhost;dbname=web2bead1', 'root', '', $pdo_options);
            $sql = 'SELECT id, gepid, szoftverid, verzio, datum  FROM telepites ORDER BY id'; 
            $req = $db->prepare($sql);
            $req->execute(array());
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;

        }

    }

    $options = array("uri" => "http://localhost/web2bead1/models/webservice.php");
    $server = new SoapServer(null, $options);
    $server->setClass('Webservice');
    $server->handle();
    
?>