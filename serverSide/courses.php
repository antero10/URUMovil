<?php
	$id  = $_GET['user'];
	$con=mysql_connect('localhost','root','');
	if(!mysqli_connect_errno()){
		mysql_select_db('tesis',$con);
		$query = 'SELECT * FROM courses WHERE student_id = '.intval($id);
		$rs = mysql_query($query,$con) or die(http_response_code(300));
		$rows = array();
		while($r = mysql_fetch_assoc($rs)) {
    		$rows[] = $r;
		}
		echo json_encode($rows);
		
	}
	else{
		http_response_code(300);
	}
?>