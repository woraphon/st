<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: บันทึกตารางเรียนตารางสอน ::</title>
</head>

<body>

<?php 
include "conn.php";
$count_max=count($_POST[use_time])-1;
for($i=0;$i<count($_POST[use_time]);$i++){
//echo $_POST[use_time][$i];
$ex=split("##",$_POST[use_time][$i]);
$ex1=split("##",$_POST[use_time][0]);
$ex2=split("##",$_POST[use_time][$count_max]);
$ex_time_max=$ex2[1]+1;
//echo $ex[1];

@mysql_query ("insert schedule set subject = '$_REQUEST[subject]',time = '".$ex[1]."', time_min = '".$ex1[1]."', time_max = '$ex_time_max', col = '$_REQUEST[cols_table]',week = '".$ex[0]."', date = '$_REQUEST[date]' ,setting = 0, ids = '$_REQUEST[set_term]'")or die(mysql_error());

/*$sql = mysql_query ("INSERT INTO schedule ('subject', 'time', 'time_min', 'time_max', 'col', 'week', 'date', 'setting', 'ids') VALUES (NULL, '".$_POST[subject]."', '".$ex[1]."', '".$ex1[1]."', '".$ex_time_max."', '".$_POST[cols_table]."', '".$ex[0]."', '', '0', '".$_POST[set_term]."')")or die(mysql_error());*/
}
$sql3= mysql_query ("select max(id)maximum from schedule")or die(mysql_error());
$show_data3=mysql_fetch_array($sql3);
$update_t=$show_data3[maximum]-$count_max;
$sql2= mysql_query ("UPDATE schedule SET setting = '1' WHERE id ='".$update_t."'")or die(mysql_error());
mysql_close();
?>

<?php
echo "<script language=\"javascript\">";
	echo "alert('เพิ่มตารางเรียนเรียบร้อย!');";
	echo "window.location='manage_schedule.php'";
	echo "</script>";	
?>
<?php 
?>

</body>
</html>