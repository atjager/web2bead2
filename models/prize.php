<?php
class Prize {
    public $value;
    public $week;
    public $year;


    public function __construct($value,$year,$week){
        $this->value = $value;
        $this->week = $week;
        $this->year = $year;
    }

    public static function _6prizes(){
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT nyeremeny.talalat, nyeremeny.ertek, huzas.ev, huzas.het FROM nyeremeny INNER JOIN huzas ON nyeremeny.huzasid=huzas.id WHERE talalat="6";');

        
        foreach($req->fetchAll() as $prize) {
            $list[] = new Prize($prize['ertek'],$prize['ev'],$prize['het']);
        }

        return $list;
        }
    }

?>