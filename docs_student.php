<?
session_start ();
if(!isset($_SESSION['m_no'])){
		echo "<script language=\"javascript\">";
	echo "alert('กรุณาเข้าสู่ระบบก่อนครับ!');";
	echo "window.location='index.php';";
	echo "</script>";
		
		}
include "conn.php";
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

<script language="javascript">
function js_popup(theURL,width,height) { //v2.0
	leftpos = (screen.availWidth - width) / 2;
    	toppos = (screen.availHeight - height) / 2;
  	window.open(theURL, "viewdetails","width=" + width + ",height=" + height + ",left=" + leftpos + ",top=" + toppos);
}
</script>
<body id="top">
<div class="wrapper col1">
  
</div>
<div class="wrapper col2">
  
</div>

<div class="wrapper col4"></div>
<div class="wrapper col5">


  <div id="container">
    <div id="services">
      <h2 class="col1">เอกสารที่นักศึกษาสร้าง</h2>
	  <table width="100%" border="1">
        <tr>
          <th width="auto" class="col7" scope="col">ลำดับ</th>
          <th width="auto" class="col7" scope="col">ชื่อเอกสาร</th>
          <th width="auto" class="col7" scope="col">View</th>
        </tr>
        <? $sql = mysql_query ("select * from docs d, member m where d.mem_no = m.mem_no && d.mem_no = '$_REQUEST[id]' order by d.d_id desc");
  $i = 1;
  while ($show = mysql_fetch_assoc ($sql)){
  ?>
        <tr>
          <th class="style1" scope="col"><? echo $i++;?></th>
          <th class="style1" scope="col" align="center"><? echo $show[subject_thai];?></th>
          <th class="style1" scope="col" align="center">
          <a href="view_pdf.php?id=<? echo $show[d_id];?>&pdf_name=<? echo $show[subject_thai];?>" target="_blank"><img src="images/icon/pdf_button.png" width="25" height="23" /></a></th>
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
