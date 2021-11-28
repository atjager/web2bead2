<?php
class UserController{
    public function __construct()
    {
        //$users=User::all();
        
    }
    public function login(){
        
        if(isset($_POST['username'])&&isset($_POST['password'])){
            $user=User::find($_POST['username']);
            if($user!=null){
                if($_POST['username']==$user->username&&sha1($_POST['password'])==$user->password){
                    echo 'Successfuly logged in';
                    
                    $_SESSION['user']=$user->username;
                    $_SESSION['first_name']=$user->first_name;
                    $_SESSION['last_name']=$user->last_name;
                    $_SESSION['role']=$user->role;
                    //echo $_SESSION['role'];
                    header('Location: ?controller=pages&action=authDone');
                }
                else{
                    echo 'Incorrect username or password';
                }
            }
            else{
                echo 'Incorrect username or password';
            }
            
        }
    }
    public function logout(){
        session_destroy();
        header('Location: ?');
    }

    public function register(){
        if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['passwordAgain'])){
            if($_POST['password']!=$_POST['passwordAgain']){
                return;
            }
            $registerUser=User::find($_POST['username']);
            if($registerUser==null){
                $registerUser=User::insertUser($_POST['username'],$_POST['password'],1,$_POST['first_name'],$_POST['last_name']);

            }
            else{
                echo 'Username already exists.';
            }
        }
    }

 }



?>