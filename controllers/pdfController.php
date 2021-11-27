<?php
class PdfController {
    public function home(){
        require_once('views/pdf/index.php');
       
        $html ='
 <html>
     <head>
 
     </head>
     <body>
         <h1>Ez egy próba</h1>
     </body>
 </html>';
    }

    public function export(){
        $result = PrizeQuery::getPrizes($_POST['hit']);
        foreach($result as $prize){
            echo $prize->year.' '.$prize->week.' '.$prize-> value.' '.implode(',',$prize->nums).'<br>';
       }
    }
}

?>
