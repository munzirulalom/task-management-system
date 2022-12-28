<?php

while($row = $query->fetch(PDO::FETCH_ASSOC)){
	$sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['user_id']}
		OR outgoing_msg_id = {$row['user_id']}) AND (outgoing_msg_id = {$outgoing_id} 
		OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
		$query2 = $db->query($sql2);
		$query2->execute();
		$rowCount = $query2->rowCount();
		$result = $query2->fetchAll();
		$row2 = array_shift( $result );

		($rowCount > 0) ? $result = $row2['msg'] : $result ="No message available";
		(strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
		if(isset($row2['outgoing_msg_id'])){
			($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
		}else{
			$you = "";
		}
		($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
		($outgoing_id == $row['user_id']) ? $hid_me = "hide" : $hid_me = "";

		$output .= '<a href="chat/chat.php?user_id='. $row['user_id'] .'">
		<div class="content">
		<img src="'. get_user_image($row['user_id']).'" alt="">
		<div class="details">
		<span>'. $row['user_name'] .'</span>
		<p>'. $you . $msg .'</p>
		</div>
		</div>
		<div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
		</a>';
	}