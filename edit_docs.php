<?
session_start ();
if(!isset($_SESSION['m_no'])){
		echo "<script language=\"javascript\">";
	echo "alert('กรุณาเข้าสู่ระบบก่อนครับ!');";
	echo "window.location='index.php';";
	echo "</script>";
		
		}
include "conn.php";

if($_REQUEST['up']=='insert'){
$date = date ('d-m-Y_His');
$file = $date.'_'.$_FILES['file']['name'];

//เช็คนามสกุลไฟล์
if(strchr($file,".")!=".pdf"){
	echo "<script language=\"javascript\">";
	echo "alert('กรุณาอัพโหลดไฟล์ที่เป็นนามสกุล .pdf เท่านั้น!');";
	echo "history.back()";
	echo "</script>";
	
	}
	else {
move_uploaded_file ($_FILES['file']['tmp_name'],"pdf_docs/".$file);
@mysql_query ("insert doc_file set d_id = '$_REQUEST[id]',file = '$file'") or die (mysql_error());
echo "<script language=\"javascript\">";
echo "alert('อัพโหลดเรียบร้อย!');";
echo "window.location='edit_docs.php'";
echo "</script>";

}
}

if($_REQUEST['docs']=='del'){
@mysql_query ("delete from docs where d_id = '$_REQUEST[id]'");
@mysql_query ("delete from doc_objective where d_id = '$_REQUEST[id]'");
@mysql_query ("delete from doc_scope where d_id = '$_REQUEST[id]'");
@mysql_query ("delete from doc_review where d_id = '$_REQUEST[id]'");
@mysql_query ("delete from doc_materials_equipments where d_id = '$_REQUEST[id]'");
@mysql_query ("delete from doc_method where d_id = '$_REQUEST[id]'");
@mysql_query ("delete from doc_place where d_id = '$_REQUEST[id]'");
@mysql_query ("delete from doc_timetable where d_id = '$_REQUEST[id]'");
@mysql_query ("delete from doc_benefits where d_id = '$_REQUEST[id]'");
@mysql_query ("delete from doc_literature where d_id = '$_REQUEST[id]'");

echo "<script language=\"javascript\">";
	echo "alert('ลบข้อมูลเรียบร้อย!');";
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
<script language="javascript">
function js_popup(theURL,width,height) { //v2.0
	leftpos = (screen.availWidth - width) / 2;
    	toppos = (screen.availHeight - height) / 2;
  	window.open(theURL, "viewdetails","width=" + width + ",height=" + height + ",left=" + leftpos + ",top=" + toppos);
}
</script>

<style type="text/css">
<!--
.style1 {font-size: 14px}
.style2 {font-size: 12px}
.style3 {color: #FF0000}
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
      <h2 class="col1">จัดการเอกสาร</h2>
	  <table width="100%" border="1">
  <tr>
    <th width="auto" class="col7" scope="col">ลำดับ</th>
    <th width="auto" class="col7" scope="col">ชื่อเอกสาร</th>
    <th width="auto" class="col7" scope="col">ผู้สร้าง</th>
    <th width="auto" class="col7" scope="col">วันที่สร้าง</th>
    <th width="auto" class="col7" scope="col">ปีการศึกษา</th>
    <th width="auto" class="col7" scope="col">View</th>
    <th width="auto" class="col7" scope="col">Export PDF </th>
    <th width="auto" class="col7" scope="col">แก้ไข</th>
    <th width="auto" class="col7" scope="col">Upload</th>
    <th width="auto" class="col7" scope="col">Download</th>
    <th width="auto" class="col7" scope="col">ลบ</th>
  </tr>
  <? $sql = mysql_query ("select * from docs d ,member m where d.mem_no = m.mem_no && d.mem_no = '$_SESSION[m_no]' && d.year !=0 order by d.d_id desc");
  $i = 1;
  while ($show = mysql_fetch_assoc ($sql)){
  
  $sql2 = mysql_query ("select * from doc_file where d_id = '$show[d_id]'");
  $show2 = mysql_fetch_assoc ($sql2);
  ?>
  <tr>
    <th class="style2" style="padding:7px 3px;" scope="col"><span class="style1"><? echo $i++;?></span></th>
    <th align="left" class="style2" scope="col"><span class="style2"><? echo $show[subject_thai];?></span></th>
    <th class="style2" scope="col"><span class="style2"><? echo $show[mem_name].'&nbsp;'.$show[mem_lastname];?></span></th>
    <th class="style2" scope="col"><span class="style2"><? echo $show[date_create];?></span></th>
    <th class="style2" scope="col"><span class="style2"><? echo $show[year];?></span></th>
    <th scope="col"><div align="center"><a href="#" onClick="js_popup('view_docs.php?id=<? echo $show[d_id];?>',1000,800); return false;" title="ดูเอกสาร" ><img src="images/icon/4.jpg" width="25" height="23" /></a></div></th>
    <th scope="col"><div align="center"><a href="pdf_docs.php?id=<? echo $show[d_id];?>&title=<? echo $show[subject_thai];?>"><img src="images/icon/pdf_button.png" width="25" height="23" /></a></div></th>
    <th scope="col"><div align="center"><a href="#" onClick="js_popup('edit_docs_show.php?id=<? echo $show[d_id];?>',1000,800); return false;" title="แก้ไขเอกสาร" ><img src="images/icon/Text-Edit-icon.png" width="25" height="20" /></a></div></th>
    <th scope="col"><div align="center"><a href="?up=file&id=<? echo $show[d_id];?>"><img src="images/icon/Upload-Folder-icon.png" width="23" height="20" /></a></div></th>
    <th scope="col" align="center"><a href="pdf_docs/<? echo $show2[file];?>"><img src="images/icon/Download-icon.png" width="25" height="23" /></a></th>
    <th scope="col"><div align="center"><a href="?docs=del&id=<? echo $show[d_id];?>"><img src="images/icon/imagess.jpg" width="25" height="20" onclick="return confirm ('คุณแน่ใจที่จะลบเอกสารนี้');" /></a></div></th>
  </tr>
  <? }?>
  <tr>
    <th colspan="11" scope="col"><? if(mysql_num_rows($sql)==0){echo "<font color=red>ยังไม่มีข้อมูล!</font>";}?></th>
    </tr>
</table>
<div style="padding:15px 1px;"></div>
<? if($_REQUEST['up']=='file'){?>
      <form action="?up=insert&id=<? echo $_REQUEST['id'];?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table width="60%" border="1">
          <tr>
            <th colspan="2" class="col1" scope="col">อัพโหลดไฟล์ PDF </th>
          </tr>
          <tr>
            <th width="45%" scope="col" style="padding:10px 1px;"><div align="right">ไฟล์ :</div></th>
            <th width="55%" scope="col" style="padding:10px 3px;"><div align="left">
              <label>
              <input type="file" name="file" />
              </label>
              <span class="style2">* <span class="style3">เฉพาะไฟล์ pdf </span></span></div></th>
          </tr>
          <tr>
            <th scope="col" style="padding:5px 1px;"><div align="right">
              <label>
              <input type="submit" name="Submit" value="Upload" />
              </label>
            </div></th>
            <th scope="col" style="padding:5px 3px;"><div align="left">
              <label>
              <input type="reset" name="Submit2" value="Cancel" />
              </label>
            </div></th>
          </tr>
        </table>
      </form>
	  <? }?>
    </div>
  </div>
</div>

<? include "footer.php";?>
</body>
</html>
