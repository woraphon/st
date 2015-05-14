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
<? 
//ถ้าสถานะ = student ให้แสดงเมนูนี้
if($_SESSION['m_status']=='student'){?>
<div id="topbar">
    <div id="topnav">
    <ul>
        <li><a href="home.php">หน้าแรก</a></li>
        <li><a href="schedule.php">ตารางเรียน</a></li>
		  <li><a href="support.php">แนะนำการใช้งานระบบ</a></li>
        <li><a href="edit_student.php">แก้ไขข้อมูลส่วนตัว</a></li>
        <li><a href="history_student.php">ประวัติการเข้าใช้ระบบ</a></li>
        
      </ul>
    </div>
    <div id="search">
      <form action="home.php" method="get">
        <fieldset>
          <legend>Site Search</legend>
          <input name="txt" type="text" id="txt"  onfocus="this.value=(this.value=='Search Documents')? '' : this.value ;" value="Search Documents" />
          <input type="submit" name="go" id="go" value="Search" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div><? }?>
  
  
  <? 
//ถ้าสถานะ = admin ให้แสดงเมนูนี้
if($_SESSION['m_status']=='admin'){?>
<div id="topbar">
    <div id="topnav">
      <ul>
        <li><a href="home.php">หน้าแรก</a></li>
        <li><a href="#">จัดการข้อมูลผู้ใช้</a>
        <ul>
			<li><a href="manage_admin.php">ข้อมูลผู้ดูแลระบบ</a></li>
            <li><a href="manage_student.php">ข้อมูลนิสิต</a></li>
            
          </ul>
          </li>
		  <li><a href="manage_support.php">แนะนำการใช้งานระบบ</a></li>
        <li><a href="manage_docs.php">จัดการเอกสาร</a></li>
		<li><a href="manage_schedule.php">จัดการตารางเรียน</a></li>
        <li><a href="history_full.php">ประวัติการเข้าใช้ระบบ</a></li>
        
      </ul>
    </div>
    <div id="search">
      <form action="home.php" method="get">
        <fieldset>
          <legend>Site Search</legend>
          <input name="txt" type="text" id="txt"  onfocus="this.value=(this.value=='Search Documents')? '' : this.value ;" value="Search Documents" />
          <input type="submit" name="go" id="go" value="Search" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div><? }?>
</body>
</html>
