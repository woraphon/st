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


<script language="javascript">
function change_bg(obj,id) {
	//alert(obj.checked);
      //alert(obj.value);
	var frm = document.forms[0];
	var message = "";
	var objID = "";
	var chkRow = obj.value;
	chkRow = chkRow.substr(0,2);
	var chkDiff = 0;
	var loop = 0;
	var chkOver = 0;
	for (i = 0; i < frm.elements['use_time[]'].length; i++) {
	   objID = frm.elements['use_time[]'][i].id;
	         if (frm.elements['use_time[]'][i].checked){
         message =  frm.elements['use_time[]'][i].value;
		 loop++;
      } 
	  message = message.substr(0,2);
	  if (message == chkRow) {
	  		if (loop > 5) {
				chkOver = 1;
			} //end if

	  } else {
	  		if (loop > 0) {
	  			chkDiff = 1;
			} //end if
			
	  } //end if	  
	 } //end for 
		if (chkDiff == 1) {
		alert('กรุณาเลือกในวันเดียวกัน หรือแถวเดียวกันเท่านั้น');
		obj.checked = false;
	} //endif
	
	if (chkOver == 1) {
		alert('กรุณาเลือกจำนวนชั่วโมงไม่เกิน 5 ชั่วโมงติดต่อกัน');
		obj.checked = false;
	} //endif
		var color;
	if (obj.checked) {
		//color = "#0099FF";
		 color = "#FF9900";  //สีส้ม
	} else {
		 color = "#009900";  // สีเขียว

	} //end if
	if (document.getElementById)
	{
		 var thestyle= eval ('document.getElementById("'+id+'").style');
	 	 		thestyle.backgroundColor=color;
	 }
	
	
} //end function
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
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
	<form action="?s=show" method="get">
      <h2 class="col1">ตารางเรียน
        <label>
        <input name="date" type="date" id="date" value="<? echo $_REQUEST[date];?>" />
        </label>
        <label>
        <input type="submit" name="Submit2" value="ค้นหา" />
        </label>
      </h2>
	 </form>
<!--ใส่วันที่ได้ที่่ตรงนี้ -->
<?php
$L_w[1]="จันทร์";
 $L_w[]="อังคาร";
 $L_w[]="พุธ";
 $L_w[]="พฤหัส";
 $L_w[]="ศุกร์";
 $L_w[]="เสาร์";
 $L_w[]="อาทิตย์";

?>

<?php
if(!isset($_POST[Submit])){
?>

</span>
<form action="?insert=add&date=<? echo $_REQUEST[date];?>" method="post" name="time_table_set" class="style2">
<table width="75%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#ffffff"><table width="100%" border="0" cellspacing="1" cellpadding="2">
      <?php
for($i=0;$i<=7;$i++){
if($i==0){
$color="#CC6666";
}elseif($i==1){
//$color="#FF9966";
$color="#FFFF99";
//$msg[0]="วันที่ / เวลา";
}elseif($i==2){
$color="#FF99CC";
}elseif($i==3){
$color="#339900";
}elseif($i==4){
$color="#FF9966";
}elseif($i==5){
$color="#66CCFF";
}elseif($i==6){
$color="#CC99FF";
}elseif($i==7){
$color="#FF3399";
}

?>
      <tr>
        <td align="left" bgcolor="<?php echo  $color?>"><span class="style3">
          <!-- <?php echo  $msg[$i]?> -->
            <!--<?php echo  $date_t[$i]?> -->
            <?php
	if($i==0){
echo"วันที่ / เวลา";
}else{
echo $L_w[$i];
}

?>
          &nbsp;</span></td>
        <?php
    for($t=7;$t<=15;$t++){
	$sql2 = mysql_query ("select * from schedule where time='".$t."' and week='".$i."' and date = '$_REQUEST[date]'");
	$num=mysql_num_rows($sql2);
	$show_data2=mysql_fetch_array($sql2);
		if($i==0){
	$bg="#66CCFF";
	}elseif($num==1){
	$bg="#0099FF";//สีน้ำเงิน#CC9999
	//$bg="#CC99CC";//สีม่วง
	//$bg="#CC9999";//สีม่วง2
	$borc="red";
	}elseif($num==0){
	$bg="#009900";
	}
	?>
        <?php
    if($num==1 and $show_data2[setting]==1){
?>
        <td align="center" bgcolor="<?php echo  $bg?>" colspan="<?php echo  $show_data2[col]?>" bordercolor="<?php echo  $borc?>"><span class="style3">
          <?php
    	if($i==0){
	$time_next=$t+1;
	$time_list=$t.".00"."-".$time_next.".00";
	echo $time_list;
	}else{
	?>
            <?php echo  $show_data2[subject]?>
            <?php
	}
	?>
          &nbsp;</span></td>
        <?php
	}elseif($num==0){
?>
        <label for="<?php echo  $t.$i?>"> </label>
        <td align="center" id="<?php echo  $i.".".$t?>" bgcolor="<?php echo  $bg?>"><span class="style3">
          <?php
    	if($i==0){
	$time_next=$t+1;
	$time_list=$t.".00"."-".$time_next.".00";
	echo $time_list;
	}else{
	?>
            <font color="#FFFFFF">ว่าง</font>
            <?php
	}
	?>
          &nbsp;</span></td>
        <?php
	}
	?>
        <?php
    }
	?>
      </tr>
      <?php
  }
  ?>
    </table></td>
  </tr>

</table>
</form>
<?php
}//end if
?>


	  
    </div>
  </div>
</div>

<? include "footer.php";?>
</body>
</html>
