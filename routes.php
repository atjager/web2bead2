<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . 'Controller.php');

    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
      case 'posts':
        // we need the model to query the database later in the controller
        require_once('models/post.php');
        $controller = new PostsController();
      break;
      case 'news':
        $controller= new NewsController();
        require_once('models/post.php');
        require_once('models/comment.php');
        break;

      case 'user':
        require_once('models/user.php');
        $controller= new UserController();
        break;
      case 'webservice':
        $controller= new WebserviceController();
        break;
      case 'lottery':
        $controller= new LotteryController();
        break;
      case 'reqres':
        $controller= new ReqresController();
        break;  
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('pages' => ['home', 'error','login', 'register', 'authDone'],

                       'posts' => ['index', 'show'],
                       'news' => ['home', 'createComment', 'createNews'],
                       'user'=>['login','logout','register'],
                       'webservice' => ['show'],
                       'lottery' => ['show'],
                       'reqres' => ['show']
                      );


  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>