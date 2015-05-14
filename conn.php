<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

//connect db
mysql_connect ("localhost","root","1234") or die (mysql_error());
mysql_select_db ("system_teacher");
mysql_query ("SET NAMES UTF8");
date_default_timezone_set('Asia/Bangkok');
$title = "ระบบจัดเก็บฐานข้อมูลครูสอนพิเศษ";

// chk login
function chk_login (){
if(!isset($_SESSION['m_id'])){
		echo "<script language=\"javascript\">";
	echo "alert('กรุณาเข้าสู่ระบบก่อนครับ!');";
	echo "window.location='index.php';";
	echo "</script>";
		
		}

}


?>






