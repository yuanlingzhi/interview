<?php
session_start();

include_once "../include/DatabaseClass.php";

if(isset($_REQUEST['qid'])&&isset($_SESSION["user"]))
{
	$qid=$_REQUEST['qid'];
	$u=$_SESSION["user"];
	$flag=getQuestion($qid);
	$s = "{";
	if($flag===false)
	{
		$s = $s."\"status\":\"false\"}";
	}
	else
	{
		$s = $s."\"status\":\"true\",\"question\":";
		$js = json_encode($flag);
		$s = $s.$js.",\"answer\":";
		$ans = getAnswer($qid,$u);
		if(is_array($ans))
		{
			$s = $s."[";
			foreach($ans as $e)
			{
				$s = $s.json_encode($e).",";
			}
			$s[strlen($s)-1]="]";
		}
		else $s = $s."\"\"";
		$s = $s."}";
	}
	echo $s;
}
else{
	echo "";
}

function getQuestion($qid)
{
    $qid=addslashes($qid);
    $db=new database();
    if(!is_numeric($qid) || $qid<=0) return false;
    
    $db->connect();
    $sql="select question.*,user.username from question,user where q_id='$qid' and user.user_id=question.user_id";
    $res=$db->send_sql($sql);
    
    if($res->num_rows==1)
    {
        $r=$res->fetch_assoc();
        $db->disconnect();
        return $r;
    }
    else return false;
}

function getAnswer($qid, $u)
{
    $qid=addslashes($qid);
    $u=addslashes($u);
    $db=new database();
    if(!is_numeric($qid) || $qid<=0 || !preg_match("/^[a-zA-Z0-9_][a-zA-Z0-9_]{1,13}[a-zA-Z0-9_]$/", $u)) return false;
    
    $db->connect();
    $sql="select * from user where username='$u'";
    $res=$db->send_sql($sql);
    if($res->num_rows==0)
    {
        $db->disconnect();
        return false;
    }
    
    $uid=$res->fetch_row()[0];
    
    $sql="select * from answer where q_id='$qid' and user_id='$uid'";
    $res=$db->send_sql($sql);
    $r1=$res->num_rows;
    $sql="select * from question where q_id='$qid' and user_id='$uid'";
    $res=$db->send_sql($sql);
    $r2=$res->num_rows;
    $sql="select * from answer where q_id='$qid'";
    $res=$db->send_sql($sql);
    $r3=$res->num_rows;
    if(($r1==0 && $r2==0) || $r3==0)
    {
        $db->disconnect();
        return false;
    }
    else
    {
        $sql="select a.q_id,a.a_id, user.username, a.content, a.date, a.like as 'like', b.dislike as 'dislike'
            from
            (
            select a.q_id,a.a_id, a.user_id, a.content, a.date, count(r1.like) as 'like'
            from answer as a
            left join review as r1 on a.q_id=r1.q_id and a.a_id=r1.a_id and r1.like=1
            group by a.a_id, a.q_id
            ) as a,
            (
            select a.q_id,a.a_id, a.user_id, a.content, a.date, count(r2.like) as 'dislike'
            from answer as a
            left join review as r2 on a.q_id=r2.q_id and a.a_id=r2.a_id and r2.like=-1
            group by a.a_id, a.q_id
            ) as b,
            user    
            where a.q_id=b.q_id and a.a_id=b.a_id and a.user_id=user.user_id and a.q_id='$qid'
            ";
        $res=$db->send_sql($sql);

        $i=0;
        while($r=$res->fetch_assoc())
        {
            $row[$i++]=$r;
            $row[$i-1]['content']=str_replace("\n","<br/>",$row[$i-1]['content']);
            $row[$i-1]['content']=str_replace(" ","&nbsp",$row[$i-1]['content']);
        }
        
        $db->disconnect();
        return $row;
    }
}

?>