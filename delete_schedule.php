<?
session_start ();
include "conn.php";
chk_login ();
?>
<?php

$mem_no=$_REQUEST[member];
$col=$_REQUEST[col];
$id=$_REQUEST[id];
$week=$_REQUEST[week];

/* echo $mem_no."-".$col."-".$id."<br>"; */


for ($x = $col; $x > 0; $x--) {
/* 	
    echo "The number is: $x <br>";
    echo "The id is: $id <br>";
    echo "The mem_no is: $mem_no <br>";
    echo "------------------------<br>"; */
    if ($x != " ")
    {
    	$sql = "DELETE FROM schedule WHERE id='$id' and mem_no='$mem_no'";
    	$query=mysql_query($sql) or die("ไม่สามารถลบข้อมูลได้");
    }
    

    $id = $id + 1 ;
    
	}
	
	$query = mysql_query($sql);
	if($query)
	{
		/* echo "Record Deleted."; */
		echo "<script language=\"javascript\">";
		echo "alert('ลบข้อมูลเรียบร้อย!');";
		echo "window.location='manage_schedule.php?member=$_REQUEST[member]&Submit2=ค้นหา';";
		echo "</script>";
	}
	else
	{
		echo "Error Delete [".$sql."]";
	}