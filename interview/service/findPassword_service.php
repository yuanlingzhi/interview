<?php
include_once "RegExp_Judge.php";
include_once "../include/DatabaseClass.php";

	function findPassword($n,$e,$p){
		$dbobj=new database();
		$u=addslashes($n);
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
		//check if it is existed
		$sql="select * from user where username='$u' and email='$e'";
		$res=$dbobj->send_sql($sql);
		
		
		if($res->num_rows>0)         //change password
		{
			$tempsql="update user set password=sha1('$p') where username='$u' ";
			$dbobj->send_sql($tempsql);
			
			$dbobj->disconnect();
			return 1;
		}
		else{						//not match 
			return -1;
		}
	}
?>