<?php
  class AdminController {
    

    public function show() {
      require_once('views/admin/index.php');
    }

    public function deleteUser(){
      if(isset($_GET['username'])){
        $user=User::deleteUser($_GET['username']);
      }
    }
  }
?>