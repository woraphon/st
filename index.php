<?
session_start ();
include "conn.php";

if($_REQUEST['login']=='chk'){


//สร้างตัวแปรเพื่อรับค่าจาก filed ที่ส่งมา
$user = $_POST ['user'];
$pass = $_POST ['pass'];

if ($_REQUEST['status']=='โปรดเลือก'){

echo "<script language=\"javascript\">";
	echo "alert('กรุณาเลือกสถานะผู้เข้าระบบด้วยครับ');";
	echo "window.location='index.php';";
	echo "</script>";
}

else {
//สร้าง session status เพื่อ เช็คสถานะ แล้วนำไปใช้กับหน้าอื่น
$_SESSION['m_status'] = $_REQUEST['status'];

//ถ้าสถานะที่ login เข้ามา = student ให้ทำงานภายใต้ปลีกกานี้
if ($_SESSION['m_status']=='student'){
//เช็คว่า user กับ pass ที่กรอกเข้ามา มีอยู่ใน db ไหม ถ้าไม่มีให้แจ้งเตือนที่กำหนด
$sql = mysql_query ("select * from member where mem_no = '$user' AND mem_pass = '$pass'");
$show = mysql_fetch_assoc ($sql);
if (mysql_num_rows($sql)!=1){

	$error = "<font color=red>Username หรือ Password ไม่ถูกต้อง</font>";

}

else {
if($show[mem_privilege]==1){

//สร้าง session เพื่อนำไปใช้ และ เข้าสู่ระบบ
$_SESSION['m_id'] = mysql_result($sql, 0, "mem_id");
$_SESSION['m_name'] = mysql_result($sql, 0, "mem_name");
$_SESSION['m_lastname'] = mysql_result($sql, 0, "mem_lastname");
$_SESSION['mem_no'] = mysql_result($sql, 0, "mem_no");


//บันทึกการเข้าระบบ
@mysql_query ("insert history_student set mem_id = '$_SESSION[m_id]', h_date = now()") or die (mysql_error());


echo "<script language=\"javascript\">";
	echo "alert('ยินดีต้อนรับเข้าสู่ระบบ');";
	echo "window.location='home.php';";
	echo "</script>";
}
else {echo "<script language=\"javascript\">";
	echo "alert('Username นี้ถูกปิดการใช้งานแล้ว!');";
	echo "history.back();";
	echo "</script>";}



}
}


//ถ้าสถานะที่ login เข้ามา = admin ให้ทำงานภายใต้ปลีกกานี้
if ($_SESSION['m_status']=='admin'){
//เช็คว่า user กับ pass ที่กรอกเข้ามา มีอยู่ใน db ไหม ถ้าไม่มีให้แจ้งเตือนที่กำหนด
$sql = mysql_query ("select * from admin where a_user = '$user' AND a_pass = '$pass'");
$show = mysql_fetch_assoc ($sql);
if (mysql_num_rows($sql)!=1){

	$error = "<font color=red>Username หรือ Password ไม่ถูกต้อง</font>";

}

else {

//สร้าง session เพื่อนำไปใช้ และ เข้าสู่ระบบ
$_SESSION['m_id'] = mysql_result($sql, 0, "a_id");
$_SESSION['m_name'] = mysql_result($sql, 0, "a_name");

//บันทึกการเข้าระบบ
@mysql_query ("insert history_admin set a_id = '$_SESSION[m_id]', h_date = now()") or die (mysql_error());

echo "<script language=\"javascript\">";
	echo "alert('ยินดีต้อนรับเข้าสู่ระบบ');";
	echo "window.location='home.php';";
	echo "</script>";

}


}
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title><? echo $title;?></title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <style type="text/css">
        body,td,th {
	font-family: "TH SarabunPSK";
	color: #8F9FD1;
}
        a:link {
	color: #3B579D;
	text-decoration: underline;
}
a:visited {
	text-decoration: underline;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: underline;
}
        </style>
        <script src="js/modernizr.custom.63321.js"></script>
        
</head>


<body>
        <div class="container">
		<header>
			
				<h1><img src="images/logo/logo.png" width="auto" height="auto"/></h1>
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				
		  </header>
</div><!--/ Codrops top bar -->

<section class="main">
              <form class="form-1" action="?login=chk" method="post">
			  <div align="center"><? echo $error;?></div>
			  <p class="field">
			  สถานะผู้เข้าระบบ :
			  <select name="status" style="padding:2px; background-color:#CCFFFF; color:#333333;">
			  <option value="โปรดเลือก">โปรดเลือก</option>
			  <option value="student">นิสิต</option>
			  <option value="admin">ผู้ดูแลระบบ</option>
			  </select>
			  </p>
				  <p class="field">
						<input type="text" name="user" placeholder="Username" required="required">
						<i class="icon-user icon-large"></i>
				</p>
						<p class="field">
							<input type="password" name="pass" placeholder="Password" required="required">
							<i class="icon-lock icon-large"></i>
					</p>
					<p class="submit">
						<button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
					</p>
  </form>
</section>
            
           <p>&nbsp;</p>
<p>
<center>
            <div id="wrapper">
</p>
<div id="wrappertop"></div>

		<div id="wrappermiddle">

			

		  <div id="username_input">

				<div id="username_inputleft"></div>

				<div id="username_inputmiddle">
				
			  </div>

				<div id="username_inputright"></div>

		  </div>

			<div id="password_input">

				<div id="password_inputleft"></div>

				<div id="password_inputmiddle"></div>

				<div id="password_inputright"></div>

			</div>

			<strong>*สำหรับนักนิสิต กรุณากรอกรหัสประจำตัว และ รหัสผ่าน เพื่อ</strong><strong>เข้าสู่ระบบ</strong>
			<div id="links_right"><br /><a href="register.php">
			<h2>ลงทะเบียนสำหรับนิสิต</h2>
			</a></div>

		</div>

		
<p>&nbsp;</p>
		<table width="100%" border="0">
		  <tr>
		    
		    <td><div align="center"><strong>Copyright 2015 All Rights Reserved.  <? echo $title; ?><img src="images/icon/stat.gif" /></strong></div></td>
	      </tr>
</table>
		<p>&nbsp;</p>
	   <header>
	     <div class="support-note">
			 <span class="note-ie">Sorry, only modern browsers.</span>
	     </div>
				
</header>     
</body>
</html>
