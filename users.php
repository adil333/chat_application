<?php 
    session_start();
    if (!isset( $_SESSION['unique_id'])){
        header('Location:login.php');
    }
    require "php/Dbconnexion.php";
    $instance = Dbconnection::getInstance();
    $user = $instance->getUserConnected($_SESSION['unique_id']);
    $users = $instance->getAllUsers($_SESSION['unique_id']);
    
    include_once "includes\head.php"; 
?>

<body>
    <div class="wrapper">
        <section class="users">   
                <header>
                <div class="content">
                    <img src="img\<?= $user->img?>" alt="image">
                    <div class="details">
                        <span><?= $user->fname?> <?= $user->lname?></span>
                        <p><?= $user->status ?></p>
                    </div>
                </div>
                    <a href="" class="Logout">Logout</a>
                </header>
                <div class="search">
                    <span class="text">Select an user to start chat</span>
                    <input type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">
                <?php foreach ($users as $user) :?>
                    <a onclick="ajax_GetMsg()" href="chat.php?user_id= <?= $user['user_id']?>">
                        <div class="content">
                            <img src="img\<?=$user['img']?>" alt="image">
                            <div class="details">
                                <span><?=$user['fname']?> <?=$user['lname']?>  <?=$user['user_id']?></span>
                                <p>This is a test message</p>
                            </div>
                        </div>
                         <div class="statu-dot"><i class="fas fa-circle"></i></div>
                    </a>
                    <?php endforeach?>
                </div>
        </section>
    </div>
    <script src="javascript\show-hid-search.js"></script>
</body>
</html>