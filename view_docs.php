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
            <div align="left" class="style3">
                <label></label>
              </div></th>
          </tr>
          <tr>
            <th style="padding:10px 3px;" scope="col"><div align="left" class="style3">ผู้สร้าง : <? echo $show[a_name];?></div> </th>
          </tr>
      </table>
    </div>
  </div>
</div>

<? include "footer.php";?>
</body>
</html>
