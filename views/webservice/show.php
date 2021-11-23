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

        <div id="hiddenNumber">
      
        </div>

        <div id="hiddenData">

        </div>
    </div>
</div>


<?php

$result = [
    "darab" => "",
    "ertek" => "",
    "szam" => array()
];
$db =  Db::getInstance();

try {
  $stmt = $db->prepare('SELECT darab, ertek FROM nyeremeny WHERE huzasid = :huzasid AND id = :id');
  $stmt -> execute(Array(":huzasid" => '547', ":id" => '1'));
  $row = $stmt -> fetch(PDO::FETCH_ASSOC);
  $result["darab"] = $row['darab'];
  $result["ertek"] = $row['ertek'];
  }


catch(PDOException $e) {

} 

 try {    
  $stmt1 = $db->prepare('SELECT szam FROM huzott WHERE huzasid = :huzasid');
  $stmt1 -> execute(Array(":huzasid" => "547"));
  while($row1 = $stmt1 -> fetch(PDO::FETCH_ASSOC)){
    $re[] =  $row1['szam'];
  }
  $result["szam"] = $re;
}
catch(PDOException $e) {

}  
echo  json_encode($result);
?>
