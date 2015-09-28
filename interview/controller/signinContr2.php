<?php 
session_start();
include_once "../service/signin_service.php";
if(isset($_POST['name']) && isset($_POST['pwd']))
{
	$name=$_POST['name'];
	$pwd=$_POST['pwd'];
	$flag=judge_signin($name, $pwd);

    if($flag==1)
    {
        $_SESSION['user']=$name;
    }
    echo $flag;
}
else //username and password is not set
{
	header("Location: ../index.php");
}
?>