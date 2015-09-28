<?php

include_once "RegExp_Judge.php";
include_once "../include/DatabaseClass.php";

function judge_signin($u,$p){
	$dbobj=new database();
	$u=addslashes($u);
	$p=addslashes($p);
	
	$flag=verifySignIn($u, $p);
	if($flag!=1)
	{
		return -1;
	}

	$dbobj->connect();
	//check if it is existed
	$sql="select * from user where username='$u'";
	$res=$dbobj->send_sql($sql);
	
	if($res->num_rows>0)	//username exists
	{
		$sql1="select password from user where username='$u'";
		$res1=$dbobj->send_sql($sql1);
		$row=$dbobj->next_row();
		if($row['password']===sha1($p))	//password match
		{
			$dbobj->disconnect();
			return 1;
		}
	}
	
	//otherwise, username not exists in database	
	$dbobj->disconnect();
	return 0;
}
?>