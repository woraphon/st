<?
session_start ();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
unset($_SESSION['m_id']);
unset($_SESSION['m_user']);
unset($_SESSION['m_status']);
session_destroy(); 
echo "<script language=\"javascript\">";
	echo "alert('ท่านออกจากระบบเรียบร้อย');";
	echo "window.location='index.php';";
	echo "</script>";
exit;
?>
