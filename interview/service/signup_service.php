<?php

include_once "RegExp_Judge.php";
include_once "../include/DatabaseClass.php";

function judge_signup($u,$p,$e){
	$dbobj=new database();
	$u=addslashes($u);
	$p=addslashes($p);
	$e=addslashes($e);
	
	$flag=verifySignIn($u, $p);
	if($flag!=1)
	{
		return -1;
	}
	if(isEmail($e)==0){
		return -1;
	}	
	

	
	
	$dbobj->connect();
	$sql="select * from user where username='$u' or email='$e'";
	$res=$dbobj->send_sql($sql);
	
	
	if($res->num_rows>0)
	{
		$dbobj->disconnect();
		return -1;
	}
	$sql="insert into user(username,email,password)
	values('$u','$e',sha1('$p'))
	";
	
	$res1=$dbobj->send_sql($sql);
	$dbobj->disconnect();
	return 1;
}
?>