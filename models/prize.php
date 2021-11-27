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

class PrizeQuery{


    public $value;
    public $week;
    public $year;
    public $nums;
    public $hit;

    public function __construct($value, $year, $week, $nums, $hit){
        $this->value = $value;
        $this->year = $year;
        $this->week = $week;
        $this->nums = $nums;
        $this->hit = $hit;

    }

    public static function getPrizes($hit_){
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT huzas.ev, huzas.het, huzott.szam, nyeremeny.talalat, nyeremeny.ertek, nyeremeny.huzasid FROM huzas INNER JOIN huzott on huzas.id=huzott.huzasid INNER JOIN nyeremeny on huzas.id=nyeremeny.huzasid WHERE nyeremeny.talalat='.$hit_.' GROUP BY nyeremeny.huzasid  
        ORDER BY `nyeremeny`.`huzasid`  ASC');

        
        foreach($req->fetchAll() as $prize) {
            $req2 = $db->query('SELECT szam from huzott where huzasid='.$prize['huzasid'].';');
            $nums= array();
            foreach($req2->fetchAll() as $num){
                $nums[]=$num['szam'];
            }
            $list[] = new PrizeQuery($prize['ertek'],$prize['ev'],$prize['het'],$nums,$prize['talalat']);
        }

        return $list;
        }
    }
    

?>