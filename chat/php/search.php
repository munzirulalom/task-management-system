<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['id'];
    $searchTerm = (string) $_POST['searchTerm'];

    $sql = "SELECT * FROM user WHERE NOT user_id = {$outgoing_id} AND (user_name LIKE '%{$searchTerm}%')";
    $output = "";
    $query = $db->prepare($sql);
    $query->execute();

    $rowCount = $query->rowCount();

    if($rowCount > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>