<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>">
<title>�㿨ҵ���¼</title>
<link href="css/base.css" rel="stylesheet" type="text/css" />
<script language="javascript">
//���ѡ����
function getCheckboxItem()
{
	var allSel="";
	if(document.form1.aids.value) return document.form1.aids.value;
	for(i=0;i<document.form1.aids.length;i++)
	{
		if(document.form1.aids[i].checked)
		{
			if(allSel=="")
				allSel=document.form1.aids[i].value;
			else
				allSel=allSel+"`"+document.form1.aids[i].value;
		}
	}
	return allSel;
}
function ReSel()
{
	for(i=0;i<document.form1.aids.length;i++)
	{
		if(document.form1.aids[i].checked) document.form1.aids[i].checked = false;
		else document.form1.aids[i].checked = true;
	}
}
function DelSel()
{
	var nid = getCheckboxItem();
	if(nid==""){
		alert("��ѡ��Ҫɾ���Ŀ�!\r\n");
		return ;
	}
	location.href="cards_manage.php?dopost=delete&aids="+nid;
}
</script>
</head>
<body background='images/allbg.gif' leftmargin='8' topmargin='8'>
<table width="98%" border="0" cellpadding="1" cellspacing="1" align="center" class="tbtitle" style="	background:#cfcfcf;">
  <tr>
    <td height="20" colspan="7" bgcolor="#EDF9D5" background='images/tbg.gif'>
    	<table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="30%" style="padding-left:10px;"><strong>�㿨ҵ�������</strong> </td>
          <td width="45%" align="right" style="padding-top:4px;"> <input type="button" class='np coolbg' name="ss13" value="δʹ��" style="width:50px;margin-right:6px" onClick="location='cards_manage.php?isexp=0';" >
            <input type="button" class='np coolbg inputbut' name="ss14" value="���۳�" style="width:50px;margin-right:6px" onClick="location='cards_manage.php?isexp=1';" >
            <input type="button" class='np coolbg inputbut' name="ss15" value="��ʹ��" style="width:50px;margin-right:6px" onClick="location='cards_manage.php?isexp=-1';">
            <input type="button" class='np coolbg inputbut' name="ss16" value="ȫ��" style="width:40px;margin-right:6px" onClick="location='cards_manage.php';">
          </td>
          <td width="25%" align="right" style="padding-top:4px;"> <input type="button" class='np coolbg inputbut' name="ss1" value="���ɵ㿨" style="width:70px;margin-right:6px" onClick="location='cards_make.php';">
            <input type="button" class='np coolbg inputbut' name="ss12" value="�㿨��Ʒ����" style="width:90px;margin-right:6px" onClick="location='cards_type.php';">
          </td>
        </tr>
    </table></td>
  </tr>
  <tr align="center"  bgcolor="#FBFCE2">
    <td width="8%">ѡ��</td>
    <td width="28%">����</td>
    <td width="18%">�㿨����</td>
    <td width="12%">��������</td>
    <td width="12%">ʹ������</td>
    <td width="8%">״̬</td>
    <td width="14%">ʹ�û�Ա</td>
  </tr>
  <form name="form1">
 <?php
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
?>
  <tr align="center" bgcolor="#FFFFFF" height="26" align="center" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
    <td><input type='checkbox' name='aids' value='<?php echo $fields['aid']; ?>' class='np'></td>
      <td><?php echo $fields['cardid']; ?></td>
      <td><?php echo $TypeNames[$fields['ctid']]?></td>
      <td><?php echo GetDateMk($fields['mtime']); ?></td>
      <td><?php echo GetUseDate($fields['utime']); ?></td>
      <td><?php echo GetSta($fields['isexp']); ?></td>
      <td><?php echo GetMemberID($fields['uid']); ?></td>
  </tr>
 <?php
}
}?>
</form>
  <tr>
    <td height="30" colspan="7" bgcolor="#ffffff">&nbsp;
<input type="button" class='np coolbg inputbut' name="b7" value="��ѡ" style="width:40" onClick="ReSel();">
<input type="button" class='np coolbg inputbut' name="b7" value="ɾ��" style="width:40" onClick="DelSel();">
      �������� </td>
  </tr>
  <tr>
    <td height="36" colspan="7" align="center" bgcolor="#F9FCEF">
    <?php
$atts = array();
$atts['tagname'] = 'pagelist';
$atts['listitem'] = 'info,index,end,pre,next,pageno';
$atts['listsize'] = '5';
 echo $this->refObj->GetPageList($atts,$this->refObj,$fields); 
?>

    </td>
  </tr>
</table>
</body>
</html>