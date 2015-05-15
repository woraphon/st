<?
session_start ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />

<title>Untitled Document</title>
<link rel="stylesheet" href="styles/layout.css" type="text/css" />

</head>

<body>
<div id="header">
    <div id="logo">
      <h1><a href="index.php"><strong><img src="images/logo/logo.png" width="302" height="auto" /></strong></a></h1>
    </div>
    <p>&nbsp;</p>
	<? 
	//ถ้าสถานะ = student ให้แสดงข้อมูลนี้
	if($_SESSION['m_status']=='student'){?>
    <div id="newsletter">
<fieldset>
          <legend>NewsLetter</legend>
    นักศึกษา&nbsp;(<? echo $_SESSION['m_name'];?>&nbsp;<? echo $_SESSION['m_lastname'];?>)&nbsp;&nbsp;
          <strong><span class="col2"><a href="logout.php">ออกจากระบบ</a></span></strong>
        </fieldset>
      </div><? }?>
	  
	  
	  
	  <? 
	//ถ้าสถานะ = admin ให้แสดงข้อมูลนี้
	if($_SESSION['m_status']=='admin'){?>
    <div id="newsletter">
<fieldset>
          <legend>NewsLetter</legend>
 ผู้ดูแลระบบ&nbsp;(<? echo $_SESSION['m_name'];?>&nbsp;<? echo $_SESSION['m_lastname'];?>)&nbsp;&nbsp;
          <strong><span class="col2"><a href="logout.php">ออกจากระบบ</a></span></strong>
        </fieldset>
      </div><? }?>
    <br class="clear" />
  </div>
</body>
</html>
