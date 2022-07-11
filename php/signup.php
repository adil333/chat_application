<?php 
require "DBconnexion.php";

 $fname = htmlentities($_POST["fname"]);
 $lname = htmlentities($_POST["lname"]);
 $email = htmlentities($_POST["email"]);
 $password = htmlentities($_POST["password"]);
 $img = $_FILES["img"];

// $submit = htmlentities($_POST["submit"]);
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
    //verification d'email
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        //connexion a la base de donne par instance (singleton)
        $instance = Dbconnection::getInstance();
        //methode verifier l'existance d'email dans notre base de donne 
        $mailExist = $instance->EmailAlradeyExist($email);
        if(empty($mailExist)){
           
            //verification d'image 
            if(isset($_FILES['img'])){
                $img_name = $_FILES['img']['name'];
                $img_type = $_FILES['img']['name'];
                $img_tmp_name = $_FILES['img']['tmp_name'];

                $ext = ["jpeg", "png", "jpg"];
                $exploded_name = explode( '.' ,$img_name);
                $img_ext = end($exploded_name);
                if(in_array($img_ext, $ext) == true){
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($img_tmp_name, "../img/".$new_img_name)){
                        $ran_id = rand(time(), 100000000);
                        $status ="Active Now";
                        $inserted = $instance->InsertUser($ran_id, $fname, $lname, $email, $password, $new_img_name, $status);
                        if($inserted){
                            echo"Account created successfully";
                        }
                    }
                }else {
                    echo "check type of image";
                }

            }
        }else {
            echo "this email alredy exist";
        }

    }else {
        echo "" .$email. " is not a validate email";
    }
  
}else {
    echo "All input are required";
}


