<div class='container is-max-desktop'>
    <div class='box'>

        <label>Choose a year:</label>
        <select id = "yearSelect"> </select>

        <br><br>

        <label>Choose a week:</label>
        <select id = 'weekSelect'></select>

        <br><br>

        <label>Choose a result:</label>
        <select id = 'resultSelect'></select>

    </div>


    <div id="hiddenNumbers">
      
    </div>

    <p id="hiddenDatas">

    </p>


</div>


<?php

$result = array("results" => array());
                    try {
                      $db =  Db::getInstance();
                      $stmt = $db->prepare('SELECT id, talalat FROM nyeremeny WHERE huzasid = :huzasid ');
                      $stmt -> execute(Array(":huzasid" => "47" ));
                      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $result["results"][] = array("id" => $row['id'], "result" => $row['talalat']);
                      }
                    }
                    catch(PDOException $e) {
    
                    } 
                    echo json_encode($result);
  ?>
