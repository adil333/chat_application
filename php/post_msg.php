<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("Location : ../login.php");
}
require "Dbconnexion.php";

$instance = Dbconnection::getInstance();
(int)$outgoing_id= htmlentities($_POST['incoming_id']);
(int)$incoming_id  = $_SESSION['unique_id'];
(string) $msg = htmlentities($_POST['message']);

$instance->PostMsg($incoming_id, $outgoing_id, $msg);