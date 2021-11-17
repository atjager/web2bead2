<?php

   
            $eredmeny ="";

            try {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $db = new PDO('mysql:host=localhost;dbname=web2bead2', 'root', '', $pdo_options);
                //$db = Db::getInstance();
                switch($_SERVER['REQUEST_METHOD']) {
                    case "GET":
                            $sql = "SELECT * FROM huzott WHERE id=(SELECT MAX(id) FROM huzott)";     
                            $sth = $db->query($sql);
                            $getRow =  $sth->fetch(PDO::FETCH_ASSOC);
                            $eredmeny .= "<p>".$getRow['szam']."</p> ";

                        break;
                    case "POST":
                            $sql = "insert into felhasznalok values (0, :csn, :un, :bn, :jel)";
                            $sth = $db->prepare($sql);
                            $count = $sth->execute(Array(":csn"=>$_POST["csn"], ":un"=>$_POST["un"], ":bn"=>$_POST["bn"], ":jel"=>$_POST["jel"]));
                            $newid = $db->lastInsertId();
                            $eredmeny .= $count." beszúrt sor: ".$newid;
                        break;
                    case "PUT":
                            $data = array();
                            $incoming = file_get_contents("php://input");
                            parse_str($incoming, $data);
                            $modositando = "id=id"; $params = Array(":id"=>$data["id"]);
                            if($data['csn'] != "") {$modositando .= ", csaladi_nev = :csn"; $params[":csn"] = $data["csn"];}
                            if($data['un'] != "") {$modositando .= ", utonev = :un"; $params[":un"] = $data["un"];}
                            if($data['bn'] != "") {$modositando .= ", bejelentkezes = :bn"; $params[":bn"] = $data["bn"];}
                            if($data['jel'] != "") {$modositando .= ", jelszo = :jel"; $params[":jel"] = sha1($data["jel"]);}
                            $sql = "update felhasznalok set ".$modositando." where id=:id";
                            $sth = $db->prepare($sql);
                            $count = $sth->execute($params);
                            $eredmeny .= $count." módositott sor. Azonosítója:".$data["id"];
                        break;
                    case "DELETE":
                            $data = array();
                            $incoming = file_get_contents("php://input");
                            parse_str($incoming, $data);
                            $sql = "delete from felhasznalok where id=:id";
                            $sth = $db->prepare($sql);
                            $count = $sth->execute(Array(":id" => $data["id"]));
                            $eredmeny .= $count." sor törölve. Azonosítója:".$data["id"];
                        break;
                }
            }
            catch (PDOException $e) {
                $eredmeny = $e->getMessage();
            }

            echo $eredmeny;
?>