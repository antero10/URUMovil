<?php
	$data = json_decode(file_get_contents("php://input"));
	$con=mysql_connect('localhost','root','');
	if(!mysqli_connect_errno()){
		mysql_select_db('tesis',$con);
		$query = 'SELECT * FROM student WHERE id = '.intval($data->id).' AND password = \''.$data->pass.'\'';
		$rs = mysql_query($query,$con) or die(http_response_code(300));
		if(mysql_num_rows($rs) == 1){
			http_response_code(200);
		}
		else{
			http_response_code(300);
		}
		
		
	}
?>