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
<!-- -------------------------------------------------------------------------------------- -->
	<form action="?s1=show" method="get">
      <h2 class="col1">ตารางเรียน
        <label>
        <input name="date" type="date" id="date" value="<? echo $_REQUEST[date];?>" />
        
        </label>
        <label>
        <input type="submit" name="Submit2" value="ค้นหา"/>
        </label>
      </h2>
	 </form>
<!-- -------------------------------------------------------------------------------------- -->
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
<!-- -------------------------------------------------------------------------------------- -->
<?php
if(!isset($_POST[Submit]))
	{ /* if (1) */
		?>

</span>
<form action="?insert=add&date=<? echo $_REQUEST[date];?>" method="post" name="time_table_set" class="style2"> <!-- end form (1) -->
<table width="75%" border="0" cellspacing="0" cellpadding="0" align="center"> <!-- table (1) -->
  <tr>
    <td bgcolor="#ffffff"> 
    	<table width="100%" border="0" cellspacing="1" cellpadding="2"> <!-- tabble (2) -->
      		<?php
			for($i=0;$i<=7;$i++) //for (1)
				{
					if($i==0) //สีของวัน จันทร์ - อาทิตย์
						{
							$color="#CC6666";
						}
						elseif($i==1)
							{
								$color="#FFFF99";						
							}
						elseif($i==2)
							{
								$color="#FF99CC";
							}
						elseif($i==3)
							{
								$color="#339900";
							}
						elseif($i==4)
							{
								$color="#FF9966";
							}
						elseif($i==5)
							{
								$color="#66CCFF";
							}
						elseif($i==6)
							{
								$color="#CC99FF";
							}
						elseif($i==7)
							{
								$color="#FF3399";
							}
						?>
      		<tr> <!-- tr (2) -->
        		<td align="left" bgcolor="<?php echo  $color?>"><span class="style3">
          			<!-- <?php echo  $msg[$i]?> -->
            		<!--<?php echo  $date_t[$i]?> -->
            			<?php
						if($i==0)
							{
								echo"วันที่ / เวลา";
							}
							else
							{
								echo $L_w[$i];
							}
						?>
          			&nbsp;</span>
          		</td>
        		<?php
    			for($t=7;$t<=15;$t++) // for (2)
    				{
						$sql2 = mysql_query ("select * from schedule where time='".$t."' and week='".$i."' and date = '$_REQUEST[date]'");
						
						$num=mysql_num_rows($sql2);
						$show_data2=mysql_fetch_array($sql2);
						
					if($i==0) //สี bg ทั้งหมดของตาราง
						{
							$bg="#66CCFF";//สีฟ้า
						}
						elseif($num==1)
							{
								$bg="#CB7BED";//สีน้ำเงิน#CC9999
								$borc="red";
							}
							elseif($num==0)
								{
									$bg="#009900";//สีเขียว
								}
							?>
        		<?php
    			if($num==1 and $show_data2[setting]==1) //if (2)
    				{ ?>
        				<td align="center" bgcolor="<?php echo  $bg?>" colspan="<?php echo  $show_data2[col]?>" bordercolor="<?php echo  $borc?>">
        					<span class="style3">
          			<?
    				if($i==0)
    					{
							$time_next=$t+1;
							$time_list=$t.".00"."-".$time_next.".00";
							echo $time_list;
						}
						else
							{  
								echo  $show_data2[subject];
							}	?>
          			&nbsp;</span>
          				</td>
        		<?
					} //end if (2)
					elseif($num==0) //elseif (1)
						{ ?>
        					<label for="<?php echo  $t.$i?>"> </label>
        					<td align="center" id="<?php echo  $i.".".$t?>" bgcolor="<?php echo  $bg?>">
        						<span class="style3">
          				<?
    						if($i==0)
    							{
									$time_next=$t+1;
									$time_list=$t.".00"."-".$time_next.".00";
									echo $time_list;
								}
								else
									{ ?>
            							<input type="checkbox" id="<?php echo  $t.$i?>" name="use_time[]2" value="<?php echo  $i."##".$t."###".$C_DG?>" onclick="change_bg(this,'<?php echo  $i.".".$t?>')" />
            					  <?}?>
          				&nbsp;</span>
          					</td>
        				<?
						} //end elseif (1)
    				}//end for (2)
					?>
     		</tr> <!-- tr (2) -->
     <?
  		} //end for (1)
  		?>
    		</table> <!-- end table (2) -->
    	</td>
  	</tr>
  	<tr>
  		<td align="center">
  		<input name="Submit" type="submit"  value=" ตกลง "/>  </td>
  	</tr>
</table> <!--end table (1) -->
</form> <!-- end form (1) -->
		<?
		}//end if (1)
/* -------------------------------------------------------------------------------------------------------------- */		
			if($_GET['insert']=='add') //if (insert)
				{
					if(count($_POST[use_time])==0)
						{
							echo"<script>alert('กรุณาเลือกคาบก่อน');history.back();</script>";
						}
						else if($_REQUEST[date]=='') /// ส่วนที่ต้องแก้  --> member_id
							{
								echo"<script>alert('กรุณาเลือกนักเรียนก่อน');history.back();</script>";
							}
						
/* -------------------------------------------------------------------------------------------------------------- */		?>					
		
		<form action="insert_time.php" method="post" name="subject">
			<input name="cols_table" type="hidden" value="<?php echo  count($_POST[use_time])?>" />
				<?
				for($i=0;$i<count($_POST[use_time]);$i++)
					{	?>
						<input name="use_time[]" type="hidden" value="<?php echo  $_POST[use_time][$i]?>" />
					<?
					}	?>
			<table width="40%" border="0" align="center" cellpadding="0" cellspacing="0">
  				<tr>
    				<td bgcolor="#666666">
      					<table width="100%" border="0" cellspacing="1" cellpadding="2">
        					<tr>
          						<td colspan="2" align="center"><span class="style3">รายวิชาที่สอน</span></td>
          					</tr>
        					<tr>
          						<td align="right" bgcolor="#FFFFFF">รายวิชา : </td>
          						<td align="left" bgcolor="#FFFFFF">
          							<label>
          								<select name="subject" id="subject" >
          									<option value="ว่าง">--เลือกวิชา--</option>
											<option value="วิชาคณิตศาสตร์">วิชาคณิตศาสตร์</option>
              								<option value="วิชาภาษาไทย">วิชาภาษาไทย</option>
              								<option value="วิชาภาษาอังกฤษ ">วิชาภาษาอังกฤษ </option>
              								<option value="วิชาคอมพิวเตอร์  ">วิชาคอมพิวเตอร์ </option>
            							</select>
            							<!-- <textarea name="subject" id="subject" cols="35" rows="5"></textarea> -->
          							</label>
          						</td>
        					</tr>
        					<tr>
          						<td colspan="2" align="center" bgcolor="#FFFFFF">
          							<label>
          								<input name="date" type="hidden" id="date" value="<? echo $_REQUEST[date];?>" readonly="true" />
          								<input name="set_term" type="hidden" value="<?php echo  $_POST[set_term]?>" />
            							<input type="submit" name="OK_insert" id="OK_insert" value=" ตกลง " />
                   						<input type="button" name="cancel" id="cancel" value=" ยกเลิก "  onclick="javascript:navigate('<?php echo  $_SERVER['PHP_SELF']?>');"/>
         							</label>
         						</td>
          					</tr>
      					</table>
      				</td>
  				</tr>
			</table>
		</form>
		<?
		} //end if (insert)
		?>

   </div> <!-- end div id=service -->
  </div> <!-- end div id=container -->
</div>

<? include "footer.php";?>
</body>
</html>
