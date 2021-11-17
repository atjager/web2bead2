<div class='container is-max-desktop'>
    <div class='box'>

        <label>Válasszon egy évet:</label>
        <select id = 'yearSelect'></select>

        <br><br>

        <label>Város:</label>
        <select id = 'varosselect'></select>

        <br><br>

        <label>Intézmény:</label>
        <select id = 'intezmenyselect'></select>

    </div>
</div>


<?php

$result = array("years" => array());
try {
  $db =  Db::getInstance();
  $db->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
  $stmt = $db->query('SELECT id, ev, het FROM huzas');
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $result["years"][] = array("id" => $row['id'], "year" => $row['ev'], "week" => $row['het']);
  }
}
catch(PDOException $e) {
  $result["years"] = $e;
} 

echo json_encode($result);
?>
