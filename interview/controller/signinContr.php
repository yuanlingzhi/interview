<?php 
session_start();
include_once "../service/signin_service.php";
if(isset($_POST['signin']) && isset($_POST['pwd']))
{
	$name=$_POST['signin'];
	$pwd=$_POST['pwd'];
	$flag=judge_signin($name, $pwd);
	if($flag==1){
		$_SESSION['user']=$name;
		header("Location: ../search.html");
	}
    else{
		header("Location: ../index.php?s=n");
	}
}
else //username and password is not set
{
	header("Location: ../index.php");
}
?>