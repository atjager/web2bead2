<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . 'Controller.php');

    switch($controller) {
      case 'pages':
        $controller = new PagesController();
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
      case 'admin':
        require_once('models/user.php');
        $controller= new AdminController();
        break;
      case 'prize':
        require_once('models/prize.php');
        $controller = new PrizeController();
        break;
      case 'pdf':
        require_once('models/prize.php');
        require_once('tcpdf/tcpdf.php');
        $controller = new PdfController();
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

                       'reqres' => ['show'],

                       'admin' => ['show', 'deleteUser'],
                       'prize' => ['home'],
                       'pdf' => ['home', 'export']
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