<?php
session_start();
include_once "../service/like_service.php";

	if(isset($_SESSION['user']) && isset($_POST['qid']) && isset($_POST['aid']) && isset($_POST['like']) ){
		$u=$_SESSION['user'];
		$q_id=$_POST['qid'];
        $a_id=$_POST['aid'];
        $like=$_POST['like'];
		$flag=updateLike($u, $q_id, $a_id, $like);
		
		echo $flag;
		
	}else{
		echo "-1";
		header("Location: ../index.php");exit();
	}

?>