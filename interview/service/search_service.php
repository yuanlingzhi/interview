<?php
include_once "../include/DatabaseClass.php";
session_start();
if(isset($_REQUEST["info"])&&isset($_SESSION["user"])){
	
	$info=explode("-*-", $_REQUEST["info"]);
	$cate=$info[1];
	$key=$info[0];
	$cate=addslashes($cate);
    $key=str_replace("\\","\\\\",$key);
	$key=addslashes($key);
	
	
    $key=str_replace("_","\_",$key);
    $key=str_replace("%","\%",$key);
    $key=htmlspecialchars($key);
	$db=new database();
    $db->connect();
    
    
    //search
    $sql="select q_id, content, question.user_id, username, date, category from question, user where question.user_id = user.user_id and category = $cate and content like '%$key%' and user.display = 1";

    $res=$db->send_sql($sql);
   
    $str='{"info":';  //category
    if($res->num_rows!=0)
    {
        $i=0;
        while($r=$res->fetch_assoc())
        {
            $row[$i++]=$r;
        }
        $str = $str."[";
        foreach($row as $e)
        {
            $str = $str.json_encode($e).",";
        }
        $str[strlen($str)-1]="]";
    }
    else $str = $str."\"\"";
    $str = $str."}";
	$db->disconnect();

	
	echo $str;
}else{
	echo "";
}


?>