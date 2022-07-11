<?php 
 
class Dbconnection {

    private static $_instance = null;
    private $conn;

    public function __construct()
    {
        try{
            $this->conn = new PDO("mysql:host=localhost; dbname=chat_app", "root", "");
        }catch(PDOException $e){
            echo 'Échec lors de la connexion : ' . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            return new Dbconnection();
        }
        return self::$_instance;
    }
      
  // public function getConnection()
  // {
  //   return $this->conn;
  // }

  public function EmailAlradeyExist(string $email)
  {
    $sql = "SELECT email from users where email = ?";
    $sth = $this->conn->prepare($sql);
    $sth->execute([$email]);
    return $sth->fetchObject();
  }

  public function InsertUser(int $unique_id, string $fname, string $lname, string $email, string $pass, string $img, string $status)
  {
    $sql = "INSERT into users(unique_id, fname, lname, email, password, img, status) VALUES(?, ?, ?, ?, ?, ?, ?)";
    $sth = $this->conn->prepare($sql);
    return $sth->execute([$unique_id, $fname, $lname, $email, $pass, $img, $status]);
  }

  public function AuthSuccess(string $email, string $password){
    $sql ="SELECT unique_id, email ,password from users where email = :email and password = :pass";
    $sth = $this->conn->prepare($sql);
    $sth->execute(array(':email'=> $email , ':pass'=> $password));
   if ($sth->rowCount() == 1){
    $sql ="SELECT unique_id from users where email = :email and password = :pass";
    $sth = $this->conn->prepare($sql);
    $sth->execute(array(':email'=> $email , ':pass'=> $password));
    return $sth->fetchObject();
   }else {
    return "";
   }   
  }
    //this method is used in users.php
  public  function getUserConnected(string $user_id){
    $sql ="SELECT fname, lname, img, status from users  where unique_id = :id ";
    $sth = $this->conn->prepare($sql);
    $sth->execute(['id'=>$user_id]);
    if($sth->rowCount() >= 1){
      return $sth->fetchObject();
    }else{
      header("Location:../login.php");
    }
  }

  public  function getAllUsers(string $user_id){
    $sql ="SELECT user_id, fname, lname, img, status from users  where unique_id != :id ";
    $sth = $this->conn->prepare($sql);
    $sth->execute(['id'=>$user_id]);
    if($sth->rowCount() >= 1){
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }else{
      header("Location:../login.php");
    }
  }

  public function getTheUserToChatWith(int $id_user){
    $sql = "SELECT user_id, unique_id, fname, lname, img, status from users where user_id = :id";
    $sth = $this->conn->prepare($sql);
    $sth->execute([':id'=>$id_user]);
    if($sth->rowCount() == 1){
      return $sth->fetch(PDO::FETCH_ASSOC);
    }else{
      header("Location:../users.php");
    }
  }

  public function getChat($outgoing_id,$incoming_id){
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.incoming_msg_id
                WHERE (outgoing_msg_id = $outgoing_id AND incoming_msg_id = $incoming_id)
                OR (outgoing_msg_id = $incoming_id AND incoming_msg_id = $outgoing_id) ORDER BY msg_id";
  }

  public function PostMsg(int $incoming_id, int $outgoing_id, string $msg)
  {
    $sql = "INSERT into messages(incoming_msg_id, outgoing_msg_id,  msg) VALUES(?, ?, ?)";
    $sth = $this->conn->prepare($sql);
    return $sth->execute([$incoming_id, $outgoing_id, $msg]);
  }

public function getConversation(int $incoming_id, int $outgoing_id){
  $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.incoming_msg_id
  WHERE outgoing_msg_id = ? AND incoming_msg_id = ?
  OR outgoing_msg_id = ? AND incoming_msg_id = ? ORDER BY msg_id";
  $sth = $this->conn->prepare($sql);
  $sth->execute([$outgoing_id, $incoming_id, $incoming_id, $outgoing_id]);
  
  if($sth->rowCount() >= 1){
     while($rows = $sth->fetchAll(PDO::FETCH_ASSOC)){
      return $rows;
    }
  }else{
    return "no message";
  }
}

}