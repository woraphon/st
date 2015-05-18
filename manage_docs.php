<?
session_start ();
include "conn.php";
chk_login ();

//อัพโหลดเอกสาร
if($_REQUEST['up']=='insert'){

$file = strrchr($_FILES["file"]["name"], "."); //ตัดนามสกุลไฟล์เก็บไว้
$newfilename = ($_REQUEST[name].$file); //ตั้งเป็น วันที่_เวลา.นามสกุล
move_uploaded_file ($_FILES['file']['tmp_name'],"docs/".$newfilename);

//เพิ่มข้อมูลลงตาราง docs
@mysql_query ("insert doc_file set a_id = '$_SESSION[m_id]',doc_name = '$_REQUEST[name]',doc_detail = '$_REQUEST[detail]',doc_file = '$newfilename',doc_date = now(), doc_status = 1") or die (mysql_error());

echo "<script language=\"javascript\">";
echo "alert('อัพโหลดเรียบร้อย!');";
echo "window.location='manage_docs.php'";
echo "</script>";

}



//แก้ไขเอกสาร
if($_REQUEST['up']=='update'){

$file = strrchr($_FILES["file"]["name"], "."); //ตัดนามสกุลไฟล์เก็บไว้
$newfilename = (Date("dmy_His").$file); //ตั้งเป็น วันที่_เวลา.นามสกุล


if($file!=''){
move_uploaded_file ($_FILES['file']['tmp_name'],"docs/".$newfilename);

//แก้ไขข้อมูลตาราง docs
@mysql_query ("update doc_file set doc_name = '$_REQUEST[name]',doc_detail = '$_REQUEST[detail]',doc_file = '$newfilename',doc_status = '$_REQUEST[status]' where doc_id = '$_REQUEST[id]'") or die (mysql_error());

}

else {
//แก้ไขข้อมูลตาราง docs
@mysql_query ("update doc_file set doc_name = '$_REQUEST[name]',doc_detail = '$_REQUEST[detail]',doc_status = '$_REQUEST[status]' where doc_id ='$_REQUEST[doc_id]'") or die (mysql_error());



}
echo "<script language=\"javascript\">";
echo "alert('แก้ไขข้อมูลเรียบร้อย!');";
echo "history.back();";
echo "</script>";

}



if($_REQUEST['doc']=='del'){
@mysql_query ("delete from doc_file where doc_id = '$_REQUEST[id]' ");

}
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
.style3 {font-size: 12px}
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
    <div id="services"><a href="?up=file">อัพโหลดเอกสารใหม่ ++</a>
      <h2 class="col1">เอกสารที่เคยอัพโหลด</h2>
	  <table width="100%" border="1">
        <tr>
          <th class="col7" scope="col">ลำดับ</th>
          <th class="col7" scope="col">ชื่อเอกสาร</th> 
          <th class="col7" scope="col">วันที่อัพโหลด</th>
          <th class="col7" scope="col">View</th>
          <th class="col7" scope="col">Edit</th>
          <th class="col7" scope="col">Download</th>
          <th class="col7" scope="col">Delete</th>
          <th class="col7" scope="col">ผู้อัพโหลด</th>
        </tr>
        <? $sql = mysql_query ("select * from doc_file f , admin a where f.a_id = a.a_id order by f.doc_id desc") or die (mysql_error());
  $i = 1;
  while ($show = mysql_fetch_assoc ($sql)){
  ?>
        <tr>
          <th class="style3" scope="col"><? echo $i++;?></th>
          <th class="style3" scope="col" align="left"><? echo $show[doc_name];?></th> 
          <th class="style3" scope="col"><? echo $show[doc_date];?></th>
          <th align="center" class="style3" scope="col"><a href="?doc=show&id=<? echo $show[doc_id];?>"><img src="images/icon/4.jpg" width="25" height="23" /></a></th>
          <th align="center" class="style3" scope="col"><a href="?doc=edit&id=<? echo $show[doc_id];?>"><img src="images/icon/Text-Edit-icon.png" width="25" height="23" /></a></th>
          <th class="style3" scope="col"><div align="center"><a href="docs/<? echo $show[doc_file];?>"><img src="images/icon/Download-icon.png" width="25" height="23" /></a></div></th>
          <th class="style3" scope="col" align="center"><a href="?doc=del&id=<? echo $show[doc_id];?>" onclick="return confirm ('ยืนยันการลบ');"><img src="images/icon/imagess.jpg" width="25" height="23" /></a></th>
          <th class="style3" scope="col">ผู้ดูแลระบบ : <? echo $show[a_name];?></th>
        </tr>
        <? }?>
        <tr>
          <th colspan="8" scope="col"><? if(mysql_num_rows($sql)==0){echo "<font color=red>ยังไม่มีข้อมูล!</font>";}?></th>
        </tr>
      </table>
	  
	  <? if($_REQUEST['doc']=='show'){?>
	  <div style="padding:15px 1px;"></div>
      <form action="?up=insert" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table width="60%" border="1">
		<? $sql = mysql_query ("select * from doc_file d, admin a where d.a_id = a.a_id && d.doc_id = '$_REQUEST[id]'");
		  $show = mysql_fetch_assoc ($sql);
		  ?>
          <tr>
            <th class="col1" scope="col" style="padding:10px 3px;"><div align="left">ชื่อเอกสาร : <? echo $show[doc_name];?></div></th>
          </tr>
          <tr>
            <th style="padding:10px 3px;" scope="col"><div align="left" class="style3">รายละเอียด :</div></th>
          </tr>
          
          <tr>
            <th style="padding:10px 10px;" scope="col"><div align="left" class="style3"><? echo $show[doc_detail];?></div></th>
          </tr>
          <tr>
            <th style="padding:10px 3px;" scope="col"><div align="left" class="style3">วันที่ลง : <? echo $show[doc_date];?></div>              
            <div align="left">
                <label></label>
              </div></th>
          </tr>
          <tr>
            <th style="padding:10px 3px;" scope="col"><div align="left" class="style3">ผู้สร้าง : <? echo $show[a_name];?></div> </th>
          </tr>
        </table>
      </form>
	  <? }?>
	  
	  
	  
	  
	  
	  
	  <? if($_REQUEST['up']=='file'){?>
	  <div style="padding:15px 1px;"></div>
      <form action="?up=insert" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table width="60%" border="1">
          <tr>
            <th colspan="2" class="col1" scope="col">อัพโหลดไฟล์เอกสาร </th>
          </tr>
          <tr>
            <th width="34%" class="style3" style="padding:10px 1px;" scope="col"><div align="right">ชื่อเอกสาร :</div></th>
            <th width="66%" class="style3" style="padding:10px 3px;" scope="col"><div align="left">
              <label></label>
              <label>
              <input name="name" type="text" id="name" style="padding:3px 1px;" size="50" required="required" placeholder="ระบุชื่อเอกสาร" />
              </label>
            *</div></th>
          </tr>
          <tr>
            <th valign="top" class="style3" style="padding:10px 1px;" scope="col"><div align="right">รายละเอียด :</div></th>
            <th width="66%" class="style3" style="padding:10px 3px;" scope="col"><div align="left">
              <label>
              <textarea name="detail" cols="50" rows="7" id="detail" style="padding:3px 1px;" required="required" placeholder="ระบุรายละเอียด"></textarea>
              </label>
*</div></th>
          </tr>
          <tr>
            <th class="style3" style="padding:10px 1px;" scope="col"><div align="right">ชื่อไฟล์ :</div></th>
            <th width="66%" class="style3" style="padding:10px 3px;" scope="col"><div align="left">
              <label>
              <input type="file" name="file" required="required" />
              *              </label>
            </div></th>
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
	  
	  
	  
	  
	  <? if($_REQUEST['doc']=='edit'){?>
	  <div style="padding:15px 1px;"></div>
      <form action="?up=update" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table width="60%" border="1">
          <tr>
            <th colspan="2" class="col1" scope="col">แก้ไขไฟล์เอกสาร </th>
          </tr>
		  <? $sql = mysql_query ("select * from doc_file where doc_id = '$_REQUEST[id]'");
		  $show = mysql_fetch_assoc ($sql);
		  ?>
          <tr>
            <th width="34%" scope="col" style="padding:10px 1px;"><div align="right" class="style3">ชื่อเอกสาร :</div></th>
            <th width="66%" style="padding:10px 3px;" scope="col"><div align="left" class="style3">
              <label></label>
              <label>
              <input name="name" type="text" id="name" style="padding:3px 1px;" size="50" required="required" placeholder="ระบุชื่อเอกสาร" value="<? echo $show[doc_name];?>" />
              </label>
            *</div></th>
          </tr>
          <tr>
            <th valign="top" style="padding:10px 1px;" scope="col"><div align="right" class="style3">รายละเอียด :</div></th>
            <th width="66%" style="padding:10px 3px;" scope="col"><div align="left" class="style3">
              <label>
              <textarea name="detail" cols="50" rows="7" id="detail" style="padding:3px 1px;" required="required" ><? echo $show[doc_detail];?></textarea>
              </label>
*</div></th>
          </tr>
          <tr>
            <th scope="col" style="padding:10px 1px;"><div align="right" class="style3">ชื่อไฟล์ :</div></th>
            <th width="66%" style="padding:10px 3px;" scope="col"><div align="left" class="style3">
			<? echo $show[doc_file];?> | แก้ไข
              <label>
              <input type="file" name="file" />
              *              </label>
            </div></th>
          </tr>
          <tr>
            <th scope="col" style="padding:5px 1px;"><div align="right">
              <label>
              <input type="submit" name="Submit" value="Edit" />
               <input type="hidden" name="doc_id" value="<?php echo $_REQUEST[id];?>" />
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
