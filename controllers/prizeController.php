<?php
    class PrizeController{


    public function home(){
        $prizes = Prize::_6prizes();
        require_once('views/prizes/index.php');
    }
}



?>