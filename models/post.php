<?php
  class Post {
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $id;
    public $author;
    public $content;
    public $title;
    public $date;

    public function __construct($id, $author, $content, $title, $date) {
      $this->id      = $id;
      $this->author  = $author;
      $this->content = $content;
      $this->title   = $title;
      $this ->date   = $date;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM posts');

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $post) {
        $list[] = new Post($post['id'], $post['author'], $post['content'], $post['title'], $post['date']);
      }

      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $post = $req->fetch();

      return  new Post($post['id'], $post['author'], $post['content'], $post['title'], $post['date']);
    }

    public static function insertNews($author, $title, $content){
      $db = Db::getInstance();
      
      $req = $db->query("INSERT INTO posts (author, title, content) VALUES ('$author','$title','$content')");
      
    }

    
  }
?>