<?php


include_once "../include/DatabaseClass.php";

function updateLike($u, $q, $a, $l)
{
	$uname=$u;
    $q_id=$q;
    $a_id=$a;     
    $like=$l;
    
    $uname=addslashes($uname);
    $q_id=addslashes($q_id);
    $a_id=addslashes($a_id);
    $like=addslashes($like);
    
	$db=new database();
    $db->connect();
	
    //get username
	$sql="select user_id from user where username='$uname'";
	$res=$db->send_sql($sql);
	$r=$res->fetch_row();
	$u_id=$r[0];
	
    $sql="SELECT `like` FROM review WHERE q_id = $q_id AND a_id = $a_id AND user_id = $u_id";
    $res=$db->send_sql($sql);
    if(($r=$res->fetch_row())!=false) // user has reviewd, need update
    {
        $like_db=$r[0];  //get old like value in db
        $sql="UPDATE review SET `like` = $like WHERE q_id = $q_id AND a_id = $a_id AND user_id = $u_id;";
        $res=$db->send_sql($sql);
        $db->disconnect();

        if($like_db==="1")
        	return "like";
        else 
        	return "dislike";
    }
    else //user has never reviewed the answer before
    {
        $sql="INSERT INTO review values('$q_id','$a_id','$u_id','$like')";
        $res=$db->send_sql($sql);
        $db->disconnect();
        return "new";
    }
    //get the added question content
    
    return 1;
}


?>