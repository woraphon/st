<?
session_start ();
include "conn.php";
chk_login ();

if($_REQUEST['member']=='edit'){

@mysql_query ("update member set mem_pass = '$_REQUEST[pass]',mem_name = '$_REQUEST[name]',mem_lastname = '$_REQUEST[lastname]',mem_email = '$_REQUEST[email]',mem_year = '$_REQUEST[year]'where mem_id = '$_SESSION[m_id]'") or die (mysql_error());

echo "<script language=\"javascript\">";
	echo "alert('แก้ไขข้อมูลเรียบร้อย!');";
	echo "history.back();";
	echo "</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title><? echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="styles/demoregis.css" 
media="all" />
<link rel="stylesheet" type="text/css" href="styles/styleregis.css" 
media="all" />
<script language="javascript">
function js_popup(theURL,width,height) { //v2.0
	leftpos = (screen.availWidth - width) / 2;
    	toppos = (screen.availHeight - height) / 2;
  	window.open(theURL, "viewdetails","width=" + width + ",height=" + height + ",left=" + leftpos + ",top=" + toppos);
}
</script>

<style type="text/css">
<!--
.style1 {color: #666666}
-->
</style>

<body id="top">
<div class="wrapper col1">
  <? include "header.php";?>
</div>
<div class="wrapper col2">
  <? include "menu_header.php";?>
</div>

<div class="wrapper col4"></div>
<div class="wrapper col5">


  <div id="container">
    
      <h2 class="col1">แก้ไขข้อมูลส่วนตัว</h2>
	  <? $sql = mysql_query ("select * from member where mem_id = '$_SESSION[m_id]'");
	  $show = mysql_fetch_assoc ($sql);
	  ?>
      <div  class="form">
        <form id="contactform" action="?member=edit" method="post" enctype="multipart/form-data">
          <p class="contact"><strong>รหัสนิสิต</strong></p>
          <? echo $show[mem_no];?>
          <p class="contact"><strong>ชื่อ</strong></p>
          <input name="name" type="text" id="name" tabindex="1" value="<? echo $show[mem_name];?>" maxlength="6" placeholder="ชื่อจริง" required="required" />
          <p class="contact">
            <label for="email"><span class="style1">นามสกุล</span></label>
          </p>
          <input id="lastname" name="lastname" placeholder="นามสกุล" required="required" type="text" value="<? echo $show[mem_lastname];?>" />
          <p class="contact">
            <label for="password"><span class="style1">รหัสผ่าน</span></label>
          </p>
          <input type="password" id="pass" name="pass" placeholder="password" required="required" value="<? echo $show[mem_pass];?>" />
          
          
          <p class="contact">
            <label for="repassword"><span class="style1">E-Mail</span></label>
          </p>
          <input type="email" id="email" name="email" placeholder="example@domain.com" required="required" value="<? echo $show[mem_email];?>" />
          <p class="contact">
            <label for="password"><span class="style1">ปีการศึกษา</span></label>
            <span class="style1">&nbsp;<? echo $error3;?></span></p>
          <select name="year" id="year">
            <? 
	 for ($i=2560;$i>=2530;$i--) {
				
				if ($show[mem_year]==$i) {
					$select="selected";
				}else{
					$select="";
	}
	echo "<option value=$i $select>$i</option>";
			}?>
          </select>
          <div style="padding:5px 1px;"></div>
		  
		  
          <p class="contact"> </p>
          <input class="buttom" name="submit2" id="submit2" tabindex="5" value="บันทึก" type="submit" />
        </form>
      
    </div>
  </div>
</div>

<? include "footer.php";?>
</body>
</html>
