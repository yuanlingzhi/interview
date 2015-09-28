<?php
session_start();

include_once "../include/DatabaseClass.php";
include "../service/fbSigninService.php";

if(isset($_POST['id']))
{
    $id=$_POST['id'];
    $_SESSION['fb']=$id;
    $flag = fb_signup($id);
    if($flag !== false)
    {
        $_SESSION['user'] = $flag;
        echo "success";
    }
    else echo "false";
}

if(isset($_POST['user']))
{
    if(!isset($_SESSION['fb'])) echo "You are not logged into facebook.";
    else
    {
        $u=$_POST['user'];
        $f=$_SESSION['fb'];
        $flag = fb_createUser($u, $f);
        if($flag==1)
        {
            $_SESSION['user'] = $u;
            echo "success";
        }
        elseif($flag==-1)
            echo "Username illegal.";
        else echo "Username exists, pick another one.";
    }
}


?>