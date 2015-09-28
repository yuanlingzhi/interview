<?php
session_start();
include_once "../service/answer_service.php";

	if(isset($_SESSION['user'])&&isset($_POST['q_id'])&&isset($_POST['content'])){
		
		$u=$_SESSION['user'];
		$q_id=$_POST['q_id'];
		$content=$_POST['content'];
		$flag=answer($u, $q_id,$content);
		if($flag==1)
			echo " ./search.html#/detail/$q_id";
		else
			echo "-1";
			
	}else{
		header("Location: ../index.php");
	}

?>