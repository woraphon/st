<?
session_start ();
include "conn.php";


if($_REQUEST['member']=='add'){


if($_REQUEST['pass']!=$_REQUEST['pass2']){

$error = "<font color=red>รหัสผ่านของท่านไม่ตรงกัน!</font>";


}
else if ($_REQUEST['teacher']=='โปรดเลือก'){

$error2 = "<font color=red>กรุณาเลือกอาจารย์ด้วยครับ!</font>";

}

else if ($_REQUEST['year']=='โปรดเลือก'){

$error3 = "<font color=red>กรุณาเลือกปีการศึกษาด้วยครับ!</font>";

}

else {

$sql = mysql_query ("select * from member where mem_no = '$_REQUEST[mem_no]'");
if(mysql_num_rows($sql)>0){

echo "<script language=\"javascript\">";
	echo "alert('รหัสนิสิตนี้ซ้ำกับในระบบ!');";
	echo "history.back();";
	echo "</script>";	
}

else {
@mysql_query ("insert member set mem_no = '$_REQUEST[mem_no]',mem_pass = '$_REQUEST[pass]',mem_name = '$_REQUEST[name]',mem_lastname = '$_REQUEST[lastname]',mem_email = '$_REQUEST[email]',mem_year = '$_REQUEST[year]',mem_privilege = 1 ") or die (mysql_error());

echo "<script language=\"javascript\">";
	echo "alert('ลงทะเบียนเรียบร้อย');";
	echo "window.location='index.php'";
	echo "</script>";	
	}}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title><? echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />

<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="styles/demoregis.css" media="all" />
<link rel="stylesheet" type="text/css" href="styles/styleregis.css" media="all" />
<style type="text/css">
body,td,th {
	color: #FFFFFF;
}
#apDiv1 {
	position: absolute;
	width: 556px;
	height: 115px;
	z-index: 1001;
	left: 8px;
	top: 296px;
}
.style1 {color: #666666}
</style>
</head>
<body id="top">
<div class="wrapper col1">
  <div id="header">
  <? include "header.php";?>

  </div>
</div>
<div class="wrapper col2">
  <div id="topbar">
    <div id="topnav">
       <ul>
         </li>
      </ul>
      <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงทะเบียนเข้าใช้งาน</center></div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col3"></div>
<div class="wrapper col5">
  <div id="container">
    </p>
    <div  class="form">
      <form id="contactform" action="?member=add" method="post" enctype="multipart/form-data">
	  <p class="contact"><strong>รหัสนิสิต</strong></p>
        <input name="mem_no" type="text" id="mem_no" tabindex="1" maxlength="6" placeholder="รหัสนักศึกษา 10 หลัก" required="required" />
	  
        <p class="contact"><strong>ชื่อ</strong></p>
        <input id="name" name="name" placeholder="ชื่อจริง" required="required" tabindex="1" type="text" />
        <p class="contact">
          <label for="email"><span class="style1">นามสกุล</span></label>
        </p>
        <input id="lastname" name="lastname" placeholder="นามสกุล" required="required" type="text" />
        
        <p class="contact">
          <label for="password"><span class="style1">รหัสผ่าน</span></label>
        </p>
        <input type="password" id="pass" name="pass" placeholder="password" required="required" />
		<p class="contact">
          <label for="password"><span class="style1">ยืนยันรหัสผ่าน</span></label>
          &nbsp;<? echo $error;?></p>
        <input type="password" id="pass2" name="pass2" placeholder="Re-password" required="required" />
		
		<p class="contact">
          <label for="repassword"><span class="style1">E-Mail</span></label>
        </p>
        <input type="email" id="email" name="email" placeholder="example@domain.com" required="required" />
       
		<p class="contact">
          <label for="password"><span class="style1">ปีการศึกษา</span></label>
          <span class="style1">&nbsp;<? echo $error3;?></span></p>
        <select name="year" id="year">
		<option value="โปรดเลือก">โปรดเลือก</option>
		<? for ($i=2560;$i>=2530;$i--){
		?>
		<option value="<? echo $i;?>"><? echo $i;?></option>
		
		<? }?>
		</select><div style="padding:5px 1px;"></div>
		
		
        <p class="contact">
          
        </p>
        <input class="buttom" name="submit2" id="submit2" tabindex="5" value="บันทึก" type="submit" />
      </form>
    </div>
    <p>&nbsp;</p>
 
  </div>
</div>
<div class="wrapper col6"></div>
<? include "footer.php";?>
</body>
</html>
