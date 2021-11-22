<?php
class Menu
{
    public $url;
    public $name;
    public $parent;
    public $permission;
    public $orderOfElements;


    public function __construct($url, $name, $parent, $permission, $orderOfElements)
    {
        $this->url              = $url;
        $this->name             = $name;
        $this->parent           = $parent;
        $this->permission       = $permission;
        $this->orderOfElements  = $orderOfElements;

        
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req=$db->query('SELECT * FROM menu');

        foreach($req->fetchAll() as $menuElement){
            $list[] = new Menu(
                $menuElement['url'],
                $menuElement['name'],
                $menuElement['parent'],
                $menuElement['permission'],
                $menuElement['orderOfElements']
            );
        }
        return $list;
    }

    public static function generateMenu(){
        $staticMenus = [];
        $parentMenus = [];
        $menuString = "";
        
        
        
        foreach(Menu::all() as $menuElement){
            //echo $menuElement->url;
            if($menuElement->parent == ""){
                $hasChild = false;
                foreach(Menu::all() as $menuToFind){
                    if($menuToFind->parent == $menuElement->name){
                        $hasChild = true;
                    }
                }
                if($hasChild == false)
                    $staticMenus[] = $menuElement;
                else
                    $parentMenus [] = $menuElement;
                
                }
        }
        foreach($staticMenus as $menu){
            $menuString .= '<a class="navbar-item" href="'.$menu->url.'">
            '.$menu->name.'
          </a>';
        }
        foreach($parentMenus as $menu){
            $menuString.='<div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link" href="https://bulma.io/documentation/overview/start/">'.$menu->name.'<a><div class="navbar-dropdown is-boxed">';
            foreach(Menu::all() as $menuElement){
                if($menu->name == $menuElement->parent){
                   $menuString.='  <a class="navbar-item" href="'.$menuElement->url.'">
                   '.$menuElement->name.'
                 </a>';
                }
            }
            $menuString.='</div></div>';
        }
        return $menuString;
    }
}
