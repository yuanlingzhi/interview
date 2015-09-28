<?php    session_start();
include_once "../include/DatabaseClass.php";

if(   isset($_POST['cate']) && isset($_POST['key']) && isset($_SESSION['user'])     )
{
	$uname=$_SESSION['user'];
	$cate=$_POST['cate'];
    $cate=addslashes($cate);
    $key=$_POST['key'];
	$db=new database();
    $db->connect();
    //add question to database
	$sql="select user_id from user where username='$uname'";
	$res=$db->send_sql($sql);
	$r=$res->fetch_row();
	$uid=$r[0];
	$key = htmlspecialchars($key);
	$key = addslashes($key);
	$sql="insert into question(content,user_id,category) values('$key','$uid','$cate')";
    $res=$db->send_sql($sql);    
    
    //get latest q_id
	$sql="select q_id from question order by date desc limit 1";
	$res=$db->send_sql($sql);
	$r= $res->fetch_row();
	$qid=$r[0];
    
	
	$db->disconnect();
	echo $qid;
}
else
{
    echo "-1";
}


?>