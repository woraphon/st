<?
session_start ();
include "conn.php";
chk_login ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title><? echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 14px}
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
    <div id="services">
      <h2 class="col1">แนะนำการใช้งานระบบ</h2>
	  <table width="100%" border="0">
        <? $sql = mysql_query ("select * from support");
		$show = mysql_fetch_assoc ($sql);
		?>
        <tr>
          <td scope="col" style="padding:10px 20px;" align="left"><? echo $show[detail];?></td>
        </tr>
      
        <tr>
          <th scope="col"><? if(mysql_num_rows($sql)==0){echo "<font color=red>ยังไม่มีข้อมูล!</font>";}?></th>
        </tr>
      </table>
    </div>
  </div>
</div>

<? include "footer.php";?>
</body>
</html>
