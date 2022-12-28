<?php 
session_start();

include_once "config.php";

if(isset($_SESSION['id'])){

    //var_dump($_POST);
    $outgoing_id = (int) $_SESSION['id'];
    $incoming_id = (int) $_POST['incoming_id'];
    $message = (string) $_POST['message'];
    if(!empty($message)){
        $sql = $db->prepare("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            VALUES(:incoming_id, :outgoing_id, :message)");
        $sql->execute(['incoming_id' => $incoming_id, 'outgoing_id' => $outgoing_id, 'message' => $message]);
    }
}else{
    header("location: ". SITE_URL);
}