<?php
          require_once($_SERVER['DOCUMENT_ROOT'].'\web2bead2\connection.php');
   
            switch($_POST['lotterySelect']) {
                case 'caseYears':
                  $result =[];
                  try {
                    $db =  Db::getInstance();
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
                case 'caseWeeks':
                  $result = array("weeks" => array());
                  try {
                    $db =  Db::getInstance();
                    $stmt = $db->prepare('SELECT id, het FROM huzas WHERE ev = :ev ');
                    $stmt -> execute(Array(":ev" => $_POST['selectedYear']));
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          $result["weeks"][] = array("id" => $row['id'], "week" => $row['het']);
                    }
                  }
                  catch(PDOException $e) {

                  } 
                    echo json_encode($result);
                    break;
                  case 'caseResult':
                    $result = array("results" => array());
                    try {
                      $db =  Db::getInstance();
                      $stmt = $db->prepare('SELECT id, talalat FROM nyeremeny WHERE huzasid = :huzasid ');
                      $stmt -> execute(Array(":huzasid" => $_POST['selectedWeekId']));
                      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $result["results"][] = array("id" => $row['id'], "result" => $row['talalat']);
                      }
                    }
                    catch(PDOException $e) {
    
                    } 
                    echo json_encode($result);
                  break;
                  case 'numberResult':
                    $result = [];
                    try {
                      $db =  Db::getInstance();
                      $stmt = $db->prepare('SELECT szam FROM huzott WHERE huzasid = :huzasid');
                      $stmt -> execute(Array(":huzasid" => $_POST['selectedWeekId']));
                      $result = $stmt ->fetchAll(PDO::FETCH_COLUMN);
                    }
                    catch(PDOException $e) {
    
                    } 
                    echo json_encode($result);
                  break;
                  case 'caseShowResult':
                    $result = [
                      "darab" => "",
                      "ertek" => "",
                      "talalat" => "",
                      "szam" => array()
                    ];
                    $db =  Db::getInstance();

                    try {
                      $stmt = $db->prepare('SELECT talalat, darab, ertek FROM nyeremeny WHERE huzasid = :huzasid AND id = :id');
                      $stmt -> execute(Array(":huzasid" => $_POST['selectedWeekId'], ":id" => $_POST['selectedResult']));
                      $row = $stmt -> fetch(PDO::FETCH_ASSOC);
                      $result["darab"] = $row['darab'];
                      $result["ertek"] = $row['ertek'];
                      $result["talalat"] = $row['talalat'];
                      
                    }
                    catch(PDOException $e) {
    
                    } 

                    try {    
                      $stmt1 = $db->prepare('SELECT szam FROM huzott WHERE huzasid = :huzasid');
                      $stmt1 -> execute(Array(":huzasid" => $_POST['selectedWeekId']));
                      while($row1 = $stmt1 -> fetch(PDO::FETCH_ASSOC)){
                        $re[] =  $row1['szam'];
                      }
                      $result["szam"] = $re;
                    }
                    catch(PDOException $e) {
    
                    } 
                    echo json_encode($result);
                  break;         
            
                }
    
?>