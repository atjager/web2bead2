<?php
  class NewsController {
    public function home() {
      $posts=Post::all();
      require_once('views/news/home.php');
    }

    public function error() {
      require_once('views/news/error.php');
    }

    public function createNews(){

      $insertNews=Post::insertNews($_SESSION['user'],$_POST['title'],$_POST['content']);
      header('Location: ?controller=news&action=home');
    }

    public function createComment(){
      $insertNews=Comment::insertComment($_SESSION['user'],$_POST['content'],$_POST['to']);
      header('Location: ?controller=news&action=home');
    }
  }
?>