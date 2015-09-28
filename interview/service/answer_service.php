<?php

include_once "../include/DatabaseClass.php";
 function answer($n,$qid,$content){
 	
 	$content=htmlspecialchars($content);
 	$content=addslashes($content);
 	$qid=addslashes($qid);
 	$db=new database();
 	
 	//get max a_id

 	if(!is_numeric($qid) || $qid<=0) return -1;;
 	
 	$db->connect();
 	$sql="select max(a_id) as m from answer limit 1";
 	$res=$db->send_sql($sql);
 	$row=$res->fetch_assoc();
 	$a_id=$row['m'];
 	$a_id++;
 	
 	//get user_id
 	$sql="select user_id from user where username='$n'";
 	$res=$db->send_sql($sql);
 	$row=$res->fetch_assoc();
 	$user_id=$row['user_id'];
 	
 	if(!is_numeric($user_id) || $user_id<=0) return -1; //user not exist
 	
 	$sql="insert into answer (a_id,q_id,user_id,content) values($a_id,$qid,$user_id,'$content')";
 	$db->send_sql($sql);
 	
 	return 1;
 	$db->disconnect();
 }
?>