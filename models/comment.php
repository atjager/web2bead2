<?php
  class Comment {
    // we define 3 attributes
    // they are public so that we can access them using $comment->author directly
    public $id;
    public $author;
    public $content;
    public $date;
    public $to;

    public function __construct($id, $author, $content, $to, $date) {
      $this->id      = $id;
      $this->author  = $author;
      $this->content = $content;
      $this->to      = $to;
      $this ->date   = $date;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM comments');

      // we create a list of comment objects from the database results
      foreach($req->fetchAll() as $comment) {
        $list[] = new Comment($comment['id'], $comment['author'], $comment['content'], $comment['to'], $comment['date']);
      }

      return $list;
    }

    public static function find($to) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $to = intval($to);
      $req = $db->prepare('SELECT * FROM `comments` WHERE `to` = :to');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('to' => $to));
      foreach($req->fetchAll() as $comment) {
        $list[] = new Comment($comment['id'], $comment['author'], $comment['content'], $comment['to'], $comment['date']);
      }
      if(isset($list[0]))
        return $list;
      else
        return null;
    }

    public static function insertComment($author, $content, $to){
      $db = Db::getInstance();
      
      $req = $db->query("INSERT INTO `comments` (`author`, `content`, `to`) VALUES ('$author', '$content', $to)");
      
    }

  }
?>