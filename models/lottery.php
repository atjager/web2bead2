<?php
            require_once($_SERVER['DOCUMENT_ROOT'].'\web2bead2\connection.php');
   
            $eredmeny ="";

            try {
                //$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                //$db = new PDO('mysql:host=localhost;dbname=web2bead2', 'root', '', $pdo_options);
                $db = Db::getInstance();
                switch($_SERVER['REQUEST_METHOD']) {
                    case "GET":
                            $sql = "SELECT * FROM huzott WHERE id=(SELECT MAX(id) FROM huzott)";     
                            $sth = $db->query($sql);
                            $getRow =  $sth->fetch(PDO::FETCH_ASSOC);
                            $eredmeny .= "The latest draw is: <strong> ".$getRow['szam']."</strong> Whit this id: <strong> ".$getRow['id']. "</strong>";

                        break;
                    case "POST":
                            $sql = "insert into huzott values (0, 0, :number)";
                            $sth = $db->prepare($sql);
                            $count = $sth->execute(Array(":number" => $_POST['number']));
                            $newid = $db->lastInsertId();
                            $eredmeny .= $count." new number add the draw: <strong> ".$_POST['number'].' </strong> With this id: <strong>'.$newid. "</strong>";
                        break;
                    case "PUT":
                            $sqlOld = "SELECT * FROM huzott WHERE id=( SELECT MAX(id) FROM huzott)";
                            $sthOld = $db -> query($sqlOld);
                            $getRow = $sthOld->fetch(PDO::FETCH_ASSOC);

                            $sql = "DELETE FROM huzott WHERE id=( SELECT MAX(id) FROM huzott)";
                            $sth = $db->prepare($sql);
                            $count = $sth->execute();

                            $data = array();
				            $incoming = file_get_contents("php://input");
				            parse_str($incoming, $data);
                            $sqlNew = "insert into huzott values (0, 0, :number)";
                            $sthNew = $db->prepare($sqlNew);
                            $countNew = $sthNew->execute(Array(":number" => $data['number']));
                            $newid = $db->lastInsertId();
                            $eredmeny .= "<strong>".$getRow["szam"]." (id: ".$getRow["id"].")</strong> Is replaced to: <strong> ".$data['number']
                                        .' </strong> With this id: <strong>'.$newid. "</strong>";
                        break;
                    case "DELETE":
                            $sql = "DELETE FROM huzott WHERE id=( SELECT MAX(id) FROM huzott)";
                            $sth = $db->prepare($sql);
                            $count = $sth->execute();

                            $sqlNew = "SELECT * FROM huzott WHERE id=( SELECT MAX(id) FROM huzott)";
                            $sthNew = $db -> query($sqlNew);
                            $getRow = $sthNew->fetch(PDO::FETCH_ASSOC);
                            $eredmeny .= "The last draw is deleted!";
                            $eredmeny .= "<br>";
                            $eredmeny .= "Now the last draw is: <strong>".$getRow['szam']."</strong> Whit this id: ".$getRow["id"]."</strong>";
                        break;
                }
            }
            catch (PDOException $e) {
                $eredmeny = $e->getMessage();
            }

            echo $eredmeny;
?>