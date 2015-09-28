<?php 
session_start();
include_once "../service/signup_service.php";
if(isset($_POST['signin']) && isset($_POST['pwd'])&& isset($_POST['email']) &&isset($_POST['pwdcfm']))
{
	$name=$_POST['signin'];
	$email=$_POST['email'];
	$pwd=$_POST['pwd'];
	$pwdcfm=$_POST['pwdcfm'];
    if($pwd==$pwdcfm)
    {
        $flag=judge_signup($name, $pwd, $email );
        if($flag==1){
            $_SESSION['user']=$name;
            header("Location: ../search.html");
        }else{
            header("Location: ../index.php?s=w");
        }
    }
    else header("Location: ../index.php");
}
else //username and password is not set
{
	header("Location: ../index.php");
}
?>