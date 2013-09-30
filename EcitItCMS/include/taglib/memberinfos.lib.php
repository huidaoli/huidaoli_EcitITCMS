<?php
if(!defined('DEDEINC'))
{
    exit("Request Error!");
}
/**
 * �ĵ��������û���Ϣ
 *
 * @version        $Id: memberinfos.lib.php 1 9:29 2010��7��6��Z tianya $ * @package        EcitITCMS.Taglib
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
 
/*>>dede>>
<name>�û���Ϣ</name>
<type>ȫ�ֱ��</type>
<for>V55,V56,V57</for>
<description>�ĵ��������û���Ϣ</description>
<demo>
{dede:memberinfos mid = '' /}
</demo>
<attributes>
    <iterm>mid:�û�ID</iterm> 
</attributes> 
>>dede>>*/
 
function lib_memberinfos(&$ctag,&$refObj)
{
    global $dsql,$sqlCt;
    $attlist="mid|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    
    if(empty($mid))
    {
        if(!empty($refObj->Fields['mid'])) $mid =  $refObj->Fields['mid'];
        else $mid = 1;
    }
    else
    {
            $mid = intval($mid);
    }

    $revalue = '';
    $innerText = trim($ctag->GetInnerText());
    if(empty($innerText)) $innerText = GetSysTemplets('memberinfos.htm');

    $sql = "SELECT mb.*,ms.spacename,ms.sign,ar.membername as rankname FROM `#@__member` mb
        LEFT JOIN `#@__member_space` ms ON ms.mid = mb.mid 
        LEFT JOIN `#@__arcrank` ar ON ar.rank = mb.rank
        WHERE mb.mid='{$mid}' LIMIT 0,1 ";

    $ctp = new DedeTagParse();
    $ctp->SetNameSpace('field','[',']');
    $ctp->LoadSource($innerText);

    $dsql->Execute('mb',$sql);
    while($row = $dsql->GetArray('mb'))
    {
        if($row['matt']==10) return '';
        $row['spaceurl'] = $GLOBALS['cfg_basehost'].'/member/index.php?uid='.$row['userid'];
        if(empty($row['face'])) {
            $row['face']=($row['sex']=='Ů')?  $GLOBALS['cfg_memberurl'].'/templets/images/dfgirl.png' : $GLOBALS['cfg_memberurl'].'/templets/images/dfboy.png';
        }
        foreach($ctp->CTags as $tagid=>$ctag)
        {
            if(isset($row[$ctag->GetName()])){ $ctp->Assign($tagid,$row[$ctag->GetName()]); }
        }
        $revalue .= $ctp->GetResult();
    }
    return $revalue;
}