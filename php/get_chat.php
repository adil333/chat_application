<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header('Location:../login.php');
}
require "Dbconnexion.php";
$instance = Dbconnection::getInstance();
(int)$outgoing_id= htmlentities($_POST['incoming_id']);

(int)$incoming_id  = $_SESSION['unique_id'];
$output="";
$rowsConversation = $instance->getConversation($incoming_id, $outgoing_id);
foreach($rowsConversation as $conversation){
    if ($conversation['incoming_msg_id'] == $outgoing_id){
        $output .= '<div class="chat incoming">
                        <img src="img/'.$conversation['img'].'" alt="img">
                        <div class="details">
                        <p>'.$conversation['msg'].'</p>
                        </div>
                     </div>';
    }else{
        $output .= '<div class="chat outgoing">
        
        <div class="details">
        <p>'.$conversation['msg'].'</p>
        </div>
     </div>';
    }
    
}
echo $output;

    // if(isset($_SESSION['unique_id'])){
    //     $hostname = "localhost";
    //     $username = "root";
    //     $password = "";
    //     $dbname = "chat_app";
      
    //     $conn = mysqli_connect($hostname, $username, $password, $dbname);
    //     if(!$conn){
    //       echo "Database connection error".mysqli_connect_error();
    //     }
     
    //     $outgoing_id = $_SESSION['unique_id'];
    //     $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    //     $output = "";
    //     $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.incoming_msg_id
    //             WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
    //             OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id ";
    //     $query = mysqli_query($conn, $sql);
    //     if(mysqli_num_rows($query) > 0){
    //         while($row = mysqli_fetch_assoc($query)){
    //             if($row['outgoing_msg_id'] === $incoming_id){
    //                 $output .= '<div class="chat outgoing">
    //                             <div class="details">
    //                                 <p>'. $row['msg'] .'</p>
    //                             </div>
    //                             </div>';
    //             }else{

    //                 $output .= '<div class="chat incoming">
    //                             <img src="img/'.$row['img'].'" alt="">
    //                             <div class="details">
    //                                 <p>'. $row['msg'] .'</p>
    //                             </div>
    //                             </div>';
    //             }
    //         }
    //     }else{
    //         $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    //     }
    //     echo $output ;
    // }else{
    //     header("location: ../login.php");
    // }