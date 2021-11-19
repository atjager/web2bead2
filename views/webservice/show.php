<div class='container is-max-desktop'>
    <div class='box'>

        <label>Choose a year:</label>
        <select id = "yearSelect"> </select>

        <br><br>

        <label>Choose a week:</label>
        <select id = 'weekSelect'></select>

        <br><br>

        <label>Intézmény:</label>
        <select id = 'intezmenyselect'></select>

    </div>
</div>


<?php

$re = [];
$result =[];
                  try {
                    $db =  Db::getInstance();
                   // $db->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $db->prepare('SELECT ev FROM huzas');
                    $stmt -> execute();
                    $re = $stmt -> fetchAll(PDO::FETCH_COLUMN);
                    $result = array_unique($re);
                    }
                  catch(PDOException $e) {
                    $result = $e;
                  }
                //  print_r($re);
                  print_r($result);
  ?>
