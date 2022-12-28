<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE NOT user_id = {$outgoing_id} ORDER BY user_id DESC";
$query = $db->query($sql);
$query->execute();
$output = "";
$rowCount = $query->rowCount();
if($rowCount == 0){
    $output .= "No users are available to chat";
}elseif($rowCount > 0){
    include_once('data.php');
}
echo $output;
?>