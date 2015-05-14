<?
session_start ();
include "conn.php";
chk_login ();

if($_REQUEST['admin']=='update'){

@mysql_query ("update member set mem_no = '$_REQUEST[mem_no]',mem_pass = '$_REQUEST[pass]',mem_name = '$_REQUEST[name]',mem_lastname = '$_REQUEST[lastname]',mem_email = '$_REQUEST[email]',mem_year = '$_REQUEST[year]',mem_privilege = '$_REQUEST[privilege]' where mem_id = '$_REQUEST[id]'") or die (mysql_error());


echo "<script language=\"javascript\">";
	echo "alert('แก้ไขข้อมูลเรียบร้อย!');";
	echo "history.back();";
	echo "</script>";	
	}
	
	
	
if($_REQUEST['admin']=='insert'){

if($_REQUEST['pass']!=$_REQUEST['pass2']){

$error = "<font color=red>รหัสผ่านของท่านไม่ตรงกัน!</font>";


}
else if ($_REQUEST['year']=='โปรดเลือก'){

$error3 = "<font color=red>กรุณาเลือกปีการศึกษาด้วยครับ!</font>";

}


else {

@mysql_query ("insert member set mem_no = '$_REQUEST[mem_no]',mem_pass = '$_REQUEST[pass]',mem_name = '$_REQUEST[name]',mem_lastname = '$_REQUEST[lastname]',mem_email = '$_REQUEST[email]',mem_year = '$_REQUEST[year]',mem_privilege = 1 ") or die (mysql_error());

echo "<script language=\"javascript\">";
	echo "alert('เพิ่มข้อมูลเรียบร้อย!');";
	echo "window.location='manage_student.php'";
	echo "</script>";	
	}
}	
	
	
	if($_REQUEST['admin']=='del'){
	
	@mysql_query ("delete from member where mem_id = '$_REQUEST[id]'");
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
    
      <h2 class="col1">จัดการข้อมูลนิสิต</h2>
	  
	  <? 
	  if($_REQUEST['admin']=='edit'){
	  
	  $sql = mysql_query ("select * from member where mem_id = '$_REQUEST[id]'");
	  $show = mysql_fetch_assoc ($sql);
	  ?>
	  <div  class="form">
        <form id="contactform" action="?admin=update&id=<? echo $_REQUEST['id'];?>" method="post" enctype="multipart/form-data">
          <p class="contact"><strong>รหัสนิสิต</strong></p>
          <input id="mem_no" name="mem_no" placeholder="รหัสนิสิต" required="required" tabindex="1" type="text" value="<? echo $show[mem_no];?>" />
          <p class="contact"><strong>ชื่อ</strong></p>
          <input id="name" name="name" placeholder="ชื่อจริง" required="required" tabindex="1" type="text" value="<? echo $show[mem_name];?>" />
          <p class="contact">
            <label for="label"><span class="style1">นามสกุล</span></label>
          </p>
          <input id="lastname" name="lastname" placeholder="นามสกุล" required="required" type="text" value="<? echo $show[mem_lastname];?>" />
          <p class="contact">
            <label for="password"><span class="style1">รหัสผ่าน</span></label>
          </p>
          <input type="password" id="pass2" name="pass" placeholder="password" required="required" value="<? echo $show[mem_pass];?>" />
		  
		  <p class="contact">
            <label for="password"><span class="style1">Email</span></label>
          </p>
          <input type="text" id="pass2" name="email" placeholder="password" required="required" value="<? echo $show[mem_email];?>" />


		  <p class="contact">
      <label for="password"><span class="style1">ปีการศึกษา</span></label>
      <span class="style1">&nbsp;</span></p>
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

		  <p class="contact">
      <label for="password"><span class="style1">สิทธิ์การใช้งาน</span></label>
      <span class="style1">&nbsp;</span></p>
    <select name="privilege" id="privilege">
	<option value="1" <? if($show[mem_privilege]==1){echo 'selected';}?>>ใช้งานปกติ</option>
	<option value="2" <? if($show[mem_privilege]==2){echo 'selected';}?>>ยกเลิกการใช้งาน</option>
     
    </select>
	<div style="padding:5px 1px;"></div>
          <p class="contact"> </p>
          <input class="buttom" name="submit2" id="submit2" tabindex="5" value="บันทึก" type="submit" />
        </form>
    </div>
	  <div style="padding:15px 1px;"></div>
	<? }?>
	
	<a href="?admin=add">เพิ่มนักศึกษา ++</a>
	<table width="100%" border="1">
  <tr>
    <th width="auto" class="col7" scope="col"><div align="center">ลำดับ</div></th>
    <th width="auto" class="col7" scope="col"><div align="center">ชื่อ-นามสกุล</div></th>
    <th class="col7" scope="col"><div align="center">รหัสนิสิต</div>      <div align="center"></div></th>
    <th width="-1" class="col7" scope="col"><div align="center">Email</div></th>
    <th class="col7" scope="col"><div align="center">ปีการศึกษา</div></th>
    <th class="col7" scope="col"><div align="center">สิทธิ์การใช้งาน</div></th>
    <th width="auto" class="col7" scope="col"><div align="center">แก้ไข</div></th>
    <th width="auto" class="col7" scope="col"><div align="center">ลบ</div></th>
  </tr>
  <? $sql = mysql_query ("select * from member m order by mem_no asc");
  $i = 1;
  while ($show = mysql_fetch_assoc ($sql)){
  ?>
  <tr>
    <th scope="col"><div align="center"><? echo $i++;?></div></th>
    <th scope="col"><div align="center"><? echo $show[mem_name].'&nbsp;'.$show[mem_lastname];?></div></th>
    <th scope="col"><div align="center"><? echo $show[mem_no];?></div>      <div align="center"></div></th>
    <th scope="col"><div align="center"><? echo $show[mem_email];?></div></th>
    <th scope="col"><div align="center"><? echo $show[mem_year];?></div></th>
    <th scope="col"><div align="center"><? if($show[mem_privilege]==1){echo '<font color=blue>ใช้งานปกติ</font>';} else {echo '<font color=red>ยกเลิกใช้งาน</font>';}?>
      </div></th>
    <th scope="col"><div align="center"><a href="?admin=edit&id=<? echo $show[mem_id];?>"><img src="images/icon/4.jpg" width="25" height="25" /></a></div></th>
    <th scope="col"><div align="center"><a href="?admin=del&id=<? echo $show[mem_id];?>" onclick="return confirm ('คุณแน่ใจที่จะลบข้อมูลนี้!');"><img src="images/icon/imagess.jpg" width="23" height="20" /></a></div></th>
  </tr>
  <? }?>
  <tr>
    <th colspan="8" scope="col"><div align="center">
      <? if(mysql_num_rows ($sql)==0){echo "<font color=red>ไม่พบข้อมูล</font>";}?>
    </div></th>
  </tr>
</table>



<? if($_REQUEST['admin']=='add'){?>
<div style="padding:15px 1px;"></div>
<h2 class="col1">เพิ่มข้อมูลนิสิต</h2>
<div  class="form">
  <form id="contactform" action="?admin=insert" method="post" enctype="multipart/form-data">
    <p class="contact"><strong>รหัสนักศึกษา</strong></p>
    <input name="mem_no" type="text" id="mem_no" tabindex="1" maxlength="10" placeholder="รหัสนักศึกษา 10 หลัก" required="required" />
    <p class="contact"><strong>ชื่อ</strong></p>
    <input id="name" name="name" placeholder="ชื่อจริง" required="required" tabindex="1" type="text" />
    <p class="contact">
      <label for="email"><span class="style1">นามสกุล</span></label>
    </p>
    <input id="lastname" name="lastname" placeholder="นามสกุล" required="required" type="text" />
 
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
    </select>
    <div style="padding:5px 1px;"></div>
	
	
    <p class="contact"> </p>
    <input class="buttom" name="submit22" id="submit22" tabindex="5" value="บันทึก" type="submit" />
  </form>
</div>
<? }?>
  </div>
</div>

<? include "footer.php";?>
</body>
</html>
