<?php 
    session_start();
    if(isset($_SESSION['id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['id'];
        $incoming_id = (string) $_POST['incoming_id'];
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN user ON user.user_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = $db->query($sql);
        $query->execute();
        $rowCount = $query->rowCount();

        if($rowCount > 0){
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                if($row['outgoing_msg_id'] == $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="'. get_user_image($row['user_id']).'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ". SITE_URL);
    }

?>