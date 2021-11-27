<DOCTYPE html>
<html>
  <head>
  <script type="text/javascript" src = "js/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <script src="https://code.highcharts.com/highcharts.js"></script>  
   
  <script type="text/javascript" src="js/lottery.js"></script>
</head>
  <body>
    <header>
    <div class="navbar-start">
    <?php 
    require_once('models/menu.php');
    session_start(); 
    echo Menu::generateMenu();
    
     
      if(isset($_SESSION['user'])){
        echo'<div class="navbar-end">
        <div class="navbar-item">
        <div class="navbar-item">Logged in as &nbsp;'.$_SESSION['last_name'].'&nbsp;'.$_SESSION['first_name'].'&nbsp;'.'<b>'.$_SESSION['user'].'</b></div>
          <div class="buttons">
            <a href="?controller=user&action=logout" class="button is-light">
              Log out
            </a>
          </div>
        </div>
      </div>';
      }else{
        echo '<div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a href="?controller=pages&action=register" class="button is-primary">
              <strong>Register</strong>
            </a>
            <a href="?controller=pages&action=login" class="button is-light">
              Log in
            </a>
          </div>
        </div>
      </div>';
      }
      ?>
    </div>
    </header>

    <?php require_once('routes.php'); ?>

    <footer>
      
    </footer>
  <body>
<html>

