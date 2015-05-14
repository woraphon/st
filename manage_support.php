<?
session_start ();
include "conn.php";
chk_login ();

if($_REQUEST['support']=='add'){

$sql = mysql_query ("select * from support where 1");
if(mysql_num_rows ($sql)==0){

@mysql_query ("insert support set detail = '$_REQUEST[detail]'") or die (mysql_error());

}

else {

@mysql_query ("update support set detail = '$_REQUEST[detail]' where id = '$_REQUEST[id]'") or die (mysql_error());

}

echo "<script language=\"javascript\">";
	echo "alert('เพิ่มข้อมูลเรียบร้อย!');";
	echo "window.location='manage_support.php'";
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


<style type="text/css">
<!--
.style1 {color: #666666}
-->
</style>

<!-- เรียกใช้ cheditor-->
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

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
    
      <h2 class="col1">ข้อมูลแนะนำการใช้งานระบบ</h2>

	    
		<? $sql = mysql_query ("select * from support");
		$show = mysql_fetch_assoc ($sql);
		?>
		<form id="form1" name="form1" method="post" action="?support=add&id=<? echo $show[id];?>">
	    <textarea name="detail" class="ckeditor" id="detail"><? echo $show[detail];?></textarea>
		<div style="padding:10px 5px;"></div>
		
	    <center><input name="" type="submit" value="บันทึก" style="width:50px;" /></center>
    </form>
	  </div>
</div>

<? include "footer.php";?>
</body>
</html>
