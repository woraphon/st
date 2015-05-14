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
      <h2 class="col1">ประวัติการเข้าใช้ระบบ</h2>
	  <table width="100%" border="0">
        <tr>
          <th width="9%" class="col7" scope="col">ลำดับ</th>
          <th width="56%" class="col7" scope="col">ชื่อผู้เข้าระบบ</th>
          <th width="35%" class="col7" scope="col">วันที่/เวลา</th>
        </tr>
        <? $sql = mysql_query ("select * from history_student h, member m where h.mem_id = m.mem_id && h.mem_id = '$_SESSION[m_id]' order by h.h_id desc");
  $i = 1;
  while ($show = mysql_fetch_assoc ($sql)){
  ?>
        <tr>
          <th class="style1" scope="col"><? echo $i++;?></th>
          <th class="style1" scope="col" align="center"><? echo $show[mem_name].'&nbsp;'.$show[mem_lastname];?></th>
          <th class="style1" scope="col"><? echo $show[h_date];?>
           </th>
        </tr>
        <? }?>
        <tr>
          <th colspan="3" scope="col"><? if(mysql_num_rows($sql)==0){echo "<font color=red>ยังไม่มีข้อมูล!</font>";}?></th>
        </tr>
      </table>
    </div>
  </div>
</div>

<? include "footer.php";?>
</body>
</html>
