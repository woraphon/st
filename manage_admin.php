<?
session_start ();
include "conn.php";
chk_login ();

if($_REQUEST['admin']=='update'){

@mysql_query ("update admin set a_name = '$_REQUEST[name]',a_pass = '$_REQUEST[pass]',a_name = '$_REQUEST[name]' where a_id = '$_REQUEST[id]'") or die (mysql_error());

echo "<script language=\"javascript\">";
	echo "alert('แก้ไขข้อมูลเรียบร้อย!');";
	echo "history.back();";
	echo "</script>";	
	}
	
	if($_REQUEST['admin']=='insert'){

@mysql_query ("insert admin set a_user = '$_REQUEST[user]',a_pass = '$_REQUEST[pass]',a_name = '$_REQUEST[name]' ") or die (mysql_error());

echo "<script language=\"javascript\">";
	echo "alert('เพิ่มข้อมูลเรียบร้อย!');";
	echo "window.location='manage_admin.php'";
	echo "</script>";	
	}
	
	
	if($_REQUEST['admin']=='del'){
	
	@mysql_query ("delete from admin where a_id = '$_REQUEST[id]'");
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
    
      <h2 class="col1">จัดการข้อมูลผู้ดูแลระบบ</h2>
	  
	  <? 
	  if($_REQUEST['admin']=='edit'){
	  
	  $sql = mysql_query ("select * from admin where a_id = '$_SESSION[m_id]'");
	  $show = mysql_fetch_assoc ($sql);
	  ?>
      <div  class="form">
        <form id="contactform" action="?admin=update&id=<? echo $_REQUEST[id];?>" method="post" enctype="multipart/form-data">
          <p class="contact"><strong>ชื่อ</strong></p>
          <input id="name" name="name" placeholder="ชื่อจริง" required="required" tabindex="1" type="text" value="<? echo $show[a_name];?>" />
          <p class="contact">
            <label for="email"><span class="style1">Username</span></label>
          </p>
          <input id="user" name="user" placeholder="Username" required="required" type="text" value="<? echo $show[a_user];?>" />
          <p class="contact">
            <label for="password"><span class="style1">รหัสผ่าน</span></label>
          </p>
          <input type="password" id="pass" name="pass" placeholder="password" required="required" value="<? echo $show[a_pass];?>" />
 <p class="contact"> </p>
          <input class="buttom" name="submit2" id="submit2" tabindex="5" value="บันทึก" type="submit" />
        </form>
      
    </div>
	<div style="padding:15px 1px;"></div>
	<? }?>
	
	<a href="?admin=add">เพิ่มผู้ดูแลระบบ ++</a><table width="100%" border="1">
  <tr>
    <th width="8%" class="col7" scope="col"><div align="center">ลำดับ</div></th>
    <th width="41%" class="col7" scope="col"><div align="center">ชื่อ-นามสกุล</div></th>
    <th width="20%" class="col7" scope="col"><div align="center">Username</div></th>
    <th width="20%" class="col7" scope="col"><div align="center">รหัสผ่าน</div></th>
    <th width="5%" class="col7" scope="col"><div align="center">แก้ไข</div></th>
    <th width="6%" class="col7" scope="col"><div align="center">ลบ</div></th>
  </tr>
  <? $sql = mysql_query ("select * from admin order by a_id asc");
  $i = 1;
  while ($show = mysql_fetch_assoc ($sql)){
  ?>
  <tr>
    <th scope="col"><div align="center"><? echo $i++;?></div></th>
    <th scope="col"><div align="center"><? echo $show[a_name];?></div></th>
    <th scope="col"><div align="center"><? echo $show[a_user];?></div></th>
    <th scope="col"><div align="center"><? echo $show[a_pass];?></div></th>
    <th scope="col"><div align="center"><a href="?admin=edit&id=<? echo $show[a_id];?>"><img src="images/icon/4.jpg" width="25" height="25" /></a></div></th>
    <th scope="col"><div align="center"><a href="?admin=del&id=<? echo $show[a_id];?>" onclick="return confirm ('คุณแน่ใจที่จะลบข้อมูลนี้!');"><img src="images/icon/imagess.jpg" width="23" height="20" /></a></div></th>
  </tr>
  <? }?>
  <tr>
    <th colspan="6" scope="col"><div align="center">
      <? if(mysql_num_rows ($sql)==0){echo "<font color=red>ไม่พบข้อมูล</font>";}?>
    </div></th>
  </tr>
</table>



<? if($_REQUEST['admin']=='add'){?>
<div style="padding:15px 1px;"></div>
<h2 class="col1">เพิ่มข้อมูลผู้ดูแลระบบ</h2>
<div  class="form">
<form id="contactform" action="?admin=insert" method="post" enctype="multipart/form-data">
  <p class="contact"><strong>ชื่อ-นามสกุล</strong></p>
          <input id="name" name="name" placeholder="ชื่อจริง" required="required" tabindex="1" type="text"/>
          <p class="contact">
            <label for="email"><span class="style1">Username</span></label>
          </p>
          <input id="user" name="user" placeholder="นามสกุล" required="required" type="text"/>
          <p class="contact">
            <label for="password"><span class="style1">รหัสผ่าน</span></label>
          </p>
          <input type="password" id="pass" name="pass" placeholder="password" required="required"/>
 <p class="contact"> </p>
          <input class="buttom" name="submit2" id="submit2" tabindex="5" value="บันทึก" type="submit" />
      </form>
      
    </div>
<? }?>
  </div>
</div>

<? include "footer.php";?>
</body>
</html>
