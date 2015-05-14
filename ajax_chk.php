<?
session_start ();
?>
<?
header("Content-Type: text/plain; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");   
header("Cache-Control: post-check=0, pre-check=0", false);  

if($_REQUEST['id']=='ปีการศึกษา'){
?>
<select name="year" style="width:100px; height:28px;">
<? 
$year = date ('Y');
for($i=2560;$i>=2520;$i--){?>
<option value="<? echo $i;?>"><? echo $i;?></option>
<? }?>
</select>
<? }?>


<? if($_REQUEST['id']=='ภาคการศึกษา'){?>
<select name="sector" style="width:100px; height:28px;">
<option value="ภาคปกติ">ภาคปกติ</option>
<option value="ภาคพิเศษ">ภาคพิเศษ</option>
</select>
<? } ?>
