<?php

function fb_signup($id)
{
    $id=addslashes($id);
    $dbobj=new database();
    if(strlen($id)>100) return false;
    
    $dbobj->connect();
    $sql="select * from user where fb_id='$id'";
    $res=$dbobj->send_sql($sql);

    if($res->num_rows==1)
    {
        $r = $res->fetch_row();
        $dbobj->disconnect();
        return $r[1];
    }
    else return false;
}

function fb_createUser($u,$f)
{
    $u = addslashes($u);
    $f = addslashes($f);
    if(!preg_match("/^[a-zA-Z0-9_][a-zA-Z0-9_]{1,13}[a-zA-Z0-9_]$/", $u))
        return -1;
    if(strlen($f)>100) return -1;
    $dbobj=new database();
    $dbobj->connect();
    $sql="select * from user where username='$u'";
    $res=$dbobj->send_sql($sql);
    
    if($res->num_rows==0)
    {
        $sql="insert into user(username,password,fb_id) values('$u','','$f')";
        $res=$dbobj->send_sql($sql);
        $dbobj->disconnect();
        return 1;
    }
    else
    {
        return 0;
    }
}

?>