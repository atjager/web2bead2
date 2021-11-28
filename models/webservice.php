<?php
          require_once($_SERVER['DOCUMENT_ROOT'].'\web2bead2\connection.php');
   
            switch($_POST['lotterySelect']) {
                case 'caseYears':
                  $result =[];
                  try {
                    $db =  Db::getInstance();
                   // $db->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $db->prepare('SELECT ev FROM huzas');
                    $stmt -> execute();
                    $re = $stmt -> fetchAll(PDO::FETCH_COLUMN);
                    $result = array_values(array_unique($re));
                    }
                  catch(PDOException $e) {
                    $result = $e;
                  }
                  echo json_encode($result);
                  break;
                case 'case':
                  $result = array("years" => array());
                  try {
                    $db =  Db::getInstance();
                    $db->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $db->prepare('SELECT id, ev, het FROM huzas');
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          $result["years"][] = array("id" => $row['id'], "year" => $row['ev'], "week" => $row['het']);
                    }
                  }
                  catch(PDOException $e) {

                  } 
                    echo json_encode($result);
                    break;
  
               /*  case 'varos':
                  $eredmeny = array("lista" => array());
                  try {
                    $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                                  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $dbh->prepare("select idvaros, nev from varos where idorszag = :id");
                    $stmt->execute(Array(":id" => $_POST["id"]));
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          $eredmeny["lista"][] = array("id" => $row['idvaros'], "nev" => $row['nev']);
                    }
                  }
                  catch(PDOException $e) {
                  }
                  echo json_encode($eredmeny);
                  break;
                case 'intezmeny':
                  $eredmeny = array("lista" => array());
                  try {
                    $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                                  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $dbh->prepare("select idintezmeny, nev from intezmeny where idvaros = :id");
                    $stmt->execute(Array(":id" => $_POST["id"]));
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          $eredmeny["lista"][] = array("id" => $row['idintezmeny'], "nev" => $row['nev']);
                    }
                  }
                  catch(PDOException $e) {
                  }
                  echo json_encode($eredmeny);
                  break;
                case 'info':
                  $eredmeny = array("nev" => "", "cim" => "", "tel" => "", "email" => "");
                  try {
                    $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                                  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $dbh->prepare("select nev, cim, telefon, email from intezmeny where idintezmeny = :id");
                    $stmt->execute(Array(":id" => $_POST["id"]));
                    if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          $eredmeny = array("nev" => $row['nev'], "cim" => $row['cim'], "tel" => $row['telefon'], "email" => $row['email']);
                    }
                  }
                  catch(PDOException $e) {
                  }
                  echo json_encode($eredmeny);
                  break; */
            
                }
    
?>