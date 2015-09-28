<?php
session_start();
include_once "../service/findPassword_service.php";
	if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['password1'])&&isset($_POST['password2']))
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];		
		
		$flag=findPassword($name, $email, $password1);
		echo $flag;
		
	}else{
		header("Location: ../index.php");
	}

?>