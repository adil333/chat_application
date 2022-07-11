
<?php 
session_start();
if (!isset( $_SESSION['unique_id'])){
    header('Location:login.php');
}
require "php/Dbconnexion.php";
$instance = Dbconnection::getInstance();
$id_userTo_Chat_with = (int) htmlentities($_GET['user_id']);
$userTo_Chat_with = $instance->getTheUserToChatWith($id_userTo_Chat_with);
include_once "includes\head.php"; 
?>


<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="img\<?=$userTo_Chat_with['img']?>" alt="image">
                    <div class="details">
                        <span><?=$userTo_Chat_with['fname']?> <?=$userTo_Chat_with ['lname']?></span>
                        <p><?=$userTo_Chat_with ['status']?></p>
                    </div>
            </header>
            <div class="chat-box">
               
            </div>
            <form action="php/post_mg.php" method="POST" class="typing-area"  enctype="multipart/form-data">
                <input type="text"  class="text" name="message"  placeholder="Enter Your Message">
                <button type="button"  name="btn" onclick="ajax_SendMsg()"><i class="fa-solid fa-paper-plane"></i></button>
                <input type="text" class="incoming_id" name="incoming_id" value="<?= $userTo_Chat_with['unique_id']?>" hidden>
            </form>
        </section>
    </div>
    <script src="javascript\messages.js"></script>
</body>
</html>