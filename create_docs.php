<?
session_start ();
include "conn.php";

if($_REQUEST['docs']=='add'){

//เพิ่มข้อมูลลงตาราง docs
@mysql_query ("insert docs set mem_no = '$_SESSION[m_no]',subject_thai = '$_REQUEST[s_thai]',subject_eng = '$_REQUEST[s_eng]',semester = '$_REQUEST[term]',year = '$_REQUEST[year]',control = '$_REQUEST[control]',control2 = '$_REQUEST[control2]',control3 = '$_REQUEST[control3]',date_create = now()") or die (mysql_error());

//เรียก id ล่าสุดที่ทำการเพิ่มข้อมูล เพื่อที่จะนำไปเพิ่มลงตารางอื่น 
$sql = mysql_query ("select max(d_id) as docs_id from docs");
$show = mysql_fetch_assoc ($sql);

//เพิ่มข้อมูลลงตาราง คำนำ
@mysql_query ("insert doc_introduction set d_id = '$show[docs_id]',intro_data = '$_REQUEST[Introduction]'") or die (mysql_error());

//เพิ่มข้อมูลลงตาราง วัตถุประสงค์
@mysql_query ("insert doc_objective set d_id = '$show[docs_id]',ob_data = '$_REQUEST[Objectives]'") or die (mysql_error());

//เพิ่มข้อมูลลงตาราง ขอบเขต
@mysql_query ("insert doc_scope set d_id = '$show[docs_id]',sc_data = '$_REQUEST[Scope]'") or die (mysql_error());

//เพิ่มข้อมูลลงตาราง การตรวจเอกสาร
@mysql_query ("insert doc_review set d_id = '$show[docs_id]',re_data = '$_REQUEST[Review]'") or die (mysql_error());

//เพิ่มข้อมูลลงตาราง การตรวจเอกสาร
@mysql_query ("insert doc_materials_equipments  set d_id = '$show[docs_id]',hardware = '$_REQUEST[hardware]',software = '$_REQUEST[software]'") or die (mysql_error());

//เพิ่มข้อมูลลงตาราง วิธีการ
@mysql_query ("insert doc_method  set d_id = '$show[docs_id]',system_analysis = '$_REQUEST[analysis]',system_design = '$_REQUEST[design]',implementation = '$_REQUEST[Implementation]',testing = '$_REQUEST[Testing]',documentation = '$_REQUEST[Documentation]'") or die (mysql_error());

//เพิ่มข้อมูลลงตาราง สถานที่จัดทำ
@mysql_query ("insert doc_place  set d_id = '$show[docs_id]',pl_data = '$_REQUEST[Places]'") or die (mysql_error());

//เพิ่มข้อมูลลงตาราง ระยะเวลา
@mysql_query ("insert doc_timetable set d_id = '$show[docs_id]',special_problems = '$_REQUEST[time]',timetable = '$_REQUEST[Timetable]'") or die (mysql_error());

//เพิ่มข้อมูลลงตาราง เอกสารประโยชน์
@mysql_query ("insert doc_benefits  set d_id = '$show[docs_id]',benefits = '$_REQUEST[Benefits]'") or die (mysql_error());

//เพิ่มข้อมูลลงตาราง เอกสารอ้างอิง
@mysql_query ("insert doc_literature  set d_id = '$show[docs_id]',literature_cited = '$_REQUEST[Literature]'") or die (mysql_error());

echo "<script language=\"javascript\">";
	echo "alert('ทำการสร้างเอกสารเรียบร้อย!');";
	echo "window.close();';";
	echo "</script>";

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="javascript">
function js_popup(theURL,width,height) { //v2.0
	leftpos = (screen.availWidth - width) / 2;
    	toppos = (screen.availHeight - height) / 2;
  	window.open(theURL, "viewdetails","width=" + width + ",height=" + height + ",left=" + leftpos + ",top=" + toppos);
}
</script>

<!-- เรียกใช้ cheditor-->
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<style type="text/css">
@font-face {  
	  font-family: fontme ;  
	  src: url(font/upcel.ttf) format("truetype");  
}
.style5 {
font-family: fontme ;
font-size:22px;
}
.style7 {
	font-family: fontme;
	font-size: 30px;
	font-weight: bold;
}
.style8 {
	font-size: 26px;
	font-weight: bold;
}
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="?docs=add">
  <table width="95%" border="0" align="center">
    <tr>
      <th scope="col"><fieldset><table width="100%" border="0">
        <tr>
          <th scope="col"><div align="center"><img src="images/logo/logo2.png" width="126" height="121" /></div></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>โครงการปัญหาพิเศษ</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>(Special Problems  Proposal)</strong></p></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th scope="col" style="padding:1px 55px;"><table width="100%" border="0">
            <tr>
              <th width="28%" class="style5" scope="col"><div align="left"><strong>เรื่อง(ภาษาไทย)</strong>  </div></th>
              <th width="72%" class="style5" scope="col"><div align="left">
                <input name="s_thai" type="text" class="ckeditor" id="s_thai" value="" size="70" style="padding:3px 1px;" required />
              *</div></th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col" style="padding:1px 55px;"><table width="100%" border="0">
            <tr>
              <th width="28%" class="style5" scope="col"><div align="left"><strong>เรื่อง(ภาษาอังกฤษ)</strong> </div></th>
              <th width="72%" class="style5" scope="col"><div align="left">
                <input name="s_eng" type="text" class="ckeditor" id="s_eng" value="" size="70" style="padding:3px 1px;" required />
*</div></th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col" style="padding:1px 55px;"><table width="100%" border="0">
            <tr>
              <th width="28%" valign="top" class="style5" scope="col"><div align="left"><strong>เสนอต่อ</strong>                         </div></th>
              <th width="72%" class="style5" scope="col"><div align="left">โครงการจัดตั้งสายวิชาคอมพิวเตอร์ คณะศิลปศาสตร์และวิทยาศาสตร์<br />มหาวิทยาลัยเกษตรศาสตร์ เพื่อขออนุมัติการทำปัญหาพิเศษ</div></th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col" style="padding:1px 55px;"><table width="100%" border="0">
            <tr>
              <th width="28%" class="style5" scope="col"><div align="left"><strong>ปริญญา</strong>      </div></th>
              <th width="30%" class="style5" scope="col"><div align="left">วิทยาศาสตรบัณฑิต</div></th>
              <th width="19%" class="style5" scope="col"><div align="left"><strong>สาขา</strong></div></th>
              <th width="23%" class="style5" scope="col"><div align="left">วิทยาการคอมพิวเตอร์</div></th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col" style="padding:1px 55px;"><table width="100%" border="0">
            <tr>
              <th width="28%" class="style5" scope="col"><div align="left"><strong>ภาคการศึกษา</strong>         </div></th>
              <th width="31%" class="style5" scope="col"><div align="left">
                <input name="term" type="text" class="ckeditor" id="term" value="" size="15" style="padding:3px 1px;" required />
*</div></th>
              <th width="18%" class="style5" scope="col"><div align="left"><strong>ปีการศึกษา</strong></div></th>
              <th width="23%" class="style5" scope="col"><div align="left">
                <input name="year" type="text" class="ckeditor" id="year" value="" size="15" style="padding:3px 1px;" required />
*</div></th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col" style="padding:1px 55px;"><table width="100%" border="0">
            <tr>
              <th width="28%" class="style5" scope="col"><div align="left"><strong>โดย</strong>      </div></th>
              <th width="72%" class="style5" scope="col"><div align="left">
                <input name="from" type="text" class="ckeditor" id="from" value="<? echo $_SESSION['m_name'].'&nbsp;'.$_SESSION['m_lastname'];?>" size="70" style="padding:3px 1px;" required  readonly="true"/>
*</div></th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col" style="padding:1px 55px;"><table width="100%" border="0">
		  <? $sql = mysql_query ("select * from member m , teacher t where m.t_no = t.t_no && m.mem_no = '$_SESSION[m_no]' ");
		  $show  = mysql_fetch_assoc ($sql);
		  ?>
            <tr>
              <th width="28%" rowspan="3" valign="top" class="style5" scope="col"><div align="left"><strong>ภายใต้การควบคุมของ </strong>      </div></th>
              <th width="49%" class="style5" scope="col"><div align="left">
                <input name="control" type="text" class="ckeditor" id="control" value="<? echo $show[t_name].'&nbsp;'.$show[t_lastname];?>" size="40" style="padding:3px 1px;" required />
              </div></th>
              <th width="23%" valign="top" class="style5" scope="col"><div align="left"><strong>ประธานกรรมการ</strong></div></th>
              </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <input name="control2" type="text"id="control2" value="" size="40" style="padding:3px 1px;"/>
              </div></th>
              <th width="23%" valign="top" class="style5" scope="col"><div align="left">กรรมการ</div></th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <input name="control3" type="text" id="control3" value="" size="40" style="padding:3px 1px;"/>
              </div></th>
              <th width="23%" valign="top" class="style5" scope="col"><div align="left">กรรมการ</div></th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col"><span class="style5"></span></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th scope="col"><span class="style7"><strong>คำนำ</strong></span></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>(Introduction)</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><span class="style5">
            <textarea name="Introduction" cols="50" class="ckeditor" id="Introduction" style="padding:3px 1px;"></textarea>
          </span></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>วัตถุประสงค์</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>(Objectives)</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><span class="style5">
            <textarea name="Objectives" cols="50" class="ckeditor" id="Objectives" style="padding:3px 1px;"></textarea>
          </span></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>ขอบเขตของระบบ</strong> </p></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>(System  Scope)</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><span class="style5">
            <textarea name="Scope" cols="50" class="ckeditor" id="Scope" style="padding:3px 1px;"></textarea>
          </span></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>การตรวจเอกสาร</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>(Literature  Review)</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><span class="style5">
            <textarea name="Review" cols="50" class="ckeditor" id="Review" style="padding:3px 1px;"></textarea>
          </span></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>วัสดุและอุปกรณ์</strong> </p></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>(Materials and Equipments)</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><table width="100%" border="0">
            <tr>
              <th class="style5" scope="col">ในการจัดทำโปรแกรมจัดทำรูปแบบเอกสารปัญหาพิเศษ มีการนำระบบคอมพิวเตอร์มาช่วยในการทำงาน<br /><div align="left">โดยระบบที่ใช้ในการพัฒนางานนี้ประกอบด้วย 2 ส่วน คือ</div></th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col"><table width="100%" border="0">
            <tr>
              <th class="style5" scope="col"><div align="left">
                <p class="style8"><strong>1. ด้านฮาร์ดแวร์  (Hardware) มีรายละเอียดดังนี้ </strong></p>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <textarea name="hardware" cols="50" class="ckeditor" id="hardware" style="padding:3px 1px;"></textarea>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col"><table width="100%" border="0">
            <tr>
              <th class="style5" scope="col"><div align="left">
                <p class="style8"><strong>2. ด้านซอฟแวร์  (Software) มีรายละเอียดดังนี้ </strong></p>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <textarea name="software" cols="50" class="ckeditor" id="software" style="padding:3px 1px;"></textarea>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>วิธีการ</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>(Methods)</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><table width="100%" border="0">
            <tr>
              <th class="style5" scope="col"><div align="left">
                <p>ขั้นตอนการดำเนินการประกอบไปด้วย 5 ขึ้นตอน  ดังนี้ </p>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <p class="style8"><strong>1. การวิเคราะห์ระบบ</strong> <strong>(System Analysis)</strong></p>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <textarea name="analysis" cols="50" class="ckeditor" id="analysis" style="padding:3px 1px;"></textarea>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <p class="style8"><strong>2. การออกแบบระบบ</strong> <strong>(System Design)</strong></p>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <textarea name="design" cols="50" class="ckeditor" id="design" style="padding:3px 1px;"></textarea>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <p class="style8"><strong>3. การพัฒนาระบบ (Implementation)</strong> </p>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <textarea name="Implementation" cols="50" class="ckeditor" id="Implementation" style="padding:3px 1px;"></textarea>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left" class="style8"><strong>4. การทดสอบและปรับปรุง (Testing)</strong></div></th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <textarea name="Testing" cols="50" class="ckeditor" id="Testing" style="padding:3px 1px;"></textarea>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left" class="style8"><strong>5. การจัดทำเอกสาร (Documentation)</strong></div></th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="left">
                <textarea name="Documentation" cols="50" class="ckeditor" id="Documentation" style="padding:3px 1px;"></textarea>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>สถานที่จัดทำ</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>(Places)</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><span class="style5">
            <textarea name="Places" cols="50" class="ckeditor" id="Places" style="padding:3px 1px;"></textarea>
          </span></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th scope="col"><table width="100%" border="0">
            <tr>
              <th class="style5" scope="col"><div align="left">
                <p class="style8"><strong>ระยะเวลาการทำปัญหาพิเศษ</strong> </p>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col"><div align="center">
                <textarea name="time" cols="50" class="ckeditor" id="time" style="padding:3px 1px;"></textarea>
              </div></th>
            </tr>
            <tr>
              <th class="style5" scope="col">&nbsp;</th>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th scope="col"><span class="style7"><strong>ตารางแผนปัญหาพิเศษ</strong></span></th>
        </tr>
        <tr>
          <th scope="col"><span class="style7"><strong>(Timetable)</strong></span></th>
        </tr>
        <tr>
          <th scope="col"><textarea name="Timetable" cols="50" class="ckeditor" id="Timetable" style="padding:3px 1px;"></textarea>            <span class="style5"></span></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>ประโยชน์ที่คาดว่าจะได้รับ</strong> </p></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>(Benefits)</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><span class="style5">
            <textarea name="Benefits" cols="50" class="ckeditor" id="Benefits" style="padding:3px 1px;"></textarea>
          </span></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>แหล่งทุนสนับสนุน</strong> </p></th>
        </tr>
        <tr>
          <th scope="col"><p class="style7"><strong>(Funding Source)</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style5">ใช้งบประมาณจากโครงการจัดตั้งสายวิชาคอมพิวเตอร์ คณะศิลปศาสตร์และวิทยาศาสตร์  มหาวิทยาลัยเกษตรศาสตร์ </p></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
        </tr>
        
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>เอกสารและสิ่งอ้างอิง</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><p align="center" class="style7"><strong>(Literature Cited)</strong></p></th>
        </tr>
        <tr>
          <th scope="col"><span class="style5">
            <textarea name="Literature" cols="50" class="ckeditor" id="Literature" style="padding:3px 1px;"></textarea>
          </span></th>
        </tr>
        <tr>
          <th scope="col"><hr /><label>
            <input type="submit" name="Submit" value="บันทึกข้อมูล" />
          </label></th>
        </tr>
      </table>
      </fieldset></th>
    </tr>
  </table>
</form>
</body>
</html>
