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
.style3 {font-size: 12}
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
      <h2 class="col1">แสดงเอกสารทั้งหมด</h2>
	  <div id="search">
        <form action="" method="get">
          <fieldset>
          <legend>Site Search</legend>
            <input name="txt" type="text" id="txt"  onfocus="this.value=(this.value=='Search Documents')? '' : this.value ;" value="Search Documents" style="padding:2px; width:300px;" />
          <input type="submit" name="go" id="go" value="ค้นหา" />
          </fieldset>
        </form>
      </div>
	  <table width="100%" border="0">
        <tr>
          <th class="col7" scope="col">ลำดับ</th>
          <th class="col7" scope="col">ชื่อเอกสาร</th>        
          <th class="col7" scope="col">วันที่อัพโหลด</th>
          <th class="col7" scope="col">View</th>
          <th class="col7" scope="col">ดาวน์โหลด</th>
          <th class="col7" scope="col">ผู้อัพโหลด</th>
        </tr>
        <? 
		//แสดงข้อมูลปกติ
		if($_REQUEST[txt]==''){
		
		 /* check ว่ามี ค่าตัวแปร $start หรือไม่ ถ้าไม่มีให้ตั้งเป็น 0 
ปล. อันนี้ต้องใช้กับตัวแบ่งนะ ห้ามเอาออก*/
if(!isset($start)){
$start = 0;
}
$limit = '10'; // แสดงผลหน้าละกี่หัวข้อ
/* หาจำนวน record ทั้งหมด
ปล. อันนี้ต้องใช้กับตัวแบ่งนะ ห้ามเอาออก*/
$Qtotal = mysql_query("select * from doc_file d, admin a where d.a_id = a.a_id order by d.doc_id desc"); //คิวรี่ คำสั่ง
$total = mysql_num_rows($Qtotal); // หาจำนวน record

		$sql = mysql_query ("select * from doc_file d, admin a where d.a_id = a.a_id order by d.doc_id desc limit $start,$limit") or die (mysql_error());
  $i = 1;
  }
  
  
  
  //แสดงข้อมูลที่ค้นหา
  else {
		
		 /* check ว่ามี ค่าตัวแปร $start หรือไม่ ถ้าไม่มีให้ตั้งเป็น 0 
ปล. อันนี้ต้องใช้กับตัวแบ่งนะ ห้ามเอาออก*/
if(!isset($start)){
$start = 0;
}
$limit = '10'; // แสดงผลหน้าละกี่หัวข้อ
/* หาจำนวน record ทั้งหมด
ปล. อันนี้ต้องใช้กับตัวแบ่งนะ ห้ามเอาออก*/
$Qtotal = mysql_query("select * from doc_file d, admin a where d.a_id = a.a_id && d.doc_name like '%$_REQUEST[txt]%' order by d.doc_id desc"); //คิวรี่ คำสั่ง
$total = mysql_num_rows($Qtotal); // หาจำนวน record

		$sql = mysql_query ("select * from doc_file d, admin a where d.a_id = a.a_id && d.doc_name like '%$_REQUEST[txt]%' order by d.doc_id desc limit $start,$limit") or die (mysql_error());
  $i = 1;
  }
  while ($show = mysql_fetch_assoc ($sql)){
  ?>
        <tr>
          <th class="style1" scope="col"><span class="style3"><? echo $i++;?></span></th>
          <th class="style1" scope="col" align="left"><span class="style3"><? echo $show[doc_name];?></span></th> 
          <th class="style1" scope="col"><span class="style3"><? echo $show[doc_date];?></span></th>
          <th scope="col"><div align="center" class="style3"><a href="view_docs.php?id=<? echo $show[doc_id];?>" target="_blank"><img src="images/icon/4.jpg" width="25" height="23" /></a></div></th>
          <th scope="col" align="center"><a href="docs/<? echo $show[doc_file];?>" class="style3"><img src="images/icon/Download-icon.png" width="25" height="23" /></a></th>
          <th class="style1" scope="col"><span class="style3">ผู้ดูแลระบบ : <? echo $show[a_name];?></span></th>
        </tr>
        <? }?>
        <tr>
          <th colspan="6" scope="col"><? if(mysql_num_rows($sql)==0){echo "<font color=red>ไม่พบข้อมูล!</font>";}?>
            <hr />
			<span class="style3">
            <? /* ตัวแบ่งหน้า */
$page = ceil($total/$limit); // เอา record ทั้งหมด หารด้วย จำนวนที่จะแสดงของแต่ละหน้า

/* เอาผลหาร มาวน เป็นตัวเลข เรียงกัน เช่น สมมุติว่าหารได้ 3 เอามาวลก็จะได้ 1 2 3 */
for($i=1;$i<=$page;$i++){
if($_GET['page']==$i){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
echo "[<a href='?start=".$limit*($i-1)."&page=$i'><B>$i</B></A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
}else{
echo "<span>[<a href='?start=".$limit*($i-1)."&page=$i'>$i</a>]</span>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
}
}?>     </span>     </th>
        </tr>
      </table>
    </div>
  </div>
</div>

<? include "footer.php";?>
</body>
</html>
