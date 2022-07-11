<?php
session_start();
require "DBconnexion.php";
$email = htmlentities($_POST["email"]);
$password = htmlentities($_POST["password"]);

if(!empty($email) && !empty($password)){
   if (filter_var($email , FILTER_VALIDATE_EMAIL) == true){
    $instance = Dbconnection::getInstance();
    $user = $instance->AuthSuccess($email, $password);
    if (!empty($user)){
        echo "Connexion...";
        $_SESSION['unique_id'] = $user->unique_id;
       
    }else {
        echo "somthing is wrong try again";
    }
   }else{
    echo $email."is not a validate email";
   }
}else{
    echo "Your email or Password are messing";
}
 