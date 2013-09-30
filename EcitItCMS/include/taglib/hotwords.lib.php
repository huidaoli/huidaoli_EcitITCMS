<?php
/**
 * ��ȡ��վ���������Źؼ���
 *
 * @version        $Id: hotwords.lib.php 1 9:29 2010��7��6��Z tianya $ * @package        EcitITCMS.Taglib
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
 
/*>>dede>>
<name>���Źؼ���</name>
<type>ȫ�ֱ��</type>
<for>V55,V56,V57</for>
<description>��ȡ��վ���������Źؼ���</description>
<demo>
{dede:hotwords /}
</demo>
<attributes>
    <iterm>num:�ؼ�����Ŀ</iterm> 
    <iterm>subday:����</iterm>
    <iterm>maxlength:�ؼ�����󳤶�</iterm>
</attributes> 
>>dede>>*/
 
function lib_hotwords(&$ctag,&$refObj)
{
    global $cfg_phpurl,$dsql;

    $attlist="num|6,subday|365,maxlength|16";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $nowtime = time();
    if(empty($subday)) $subday = 365;
    if(empty($num)) $num = 6;
    if(empty($maxlength)) $maxlength = 20;
    $maxlength = $maxlength+1;
    $mintime = $nowtime - ($subday * 24 * 3600);
	// 2011-6-28 ������̳����(http://www.ecit-it.com/371416.html)������SQL��Сд����(by:֯�ε���)
    $dsql->SetQuery("SELECT keyword FROM `#@__search_keywords` WHERE lasttime>$mintime AND length(keyword)<$maxlength ORDER BY count DESC LIMIT 0,$num");
    $dsql->Execute('hw');
    $hotword = '';
    while($row=$dsql->GetArray('hw')){
        $hotword .= "��<a href='".$cfg_phpurl."/search.php?keyword=".urlencode($row['keyword'])."'>".$row['keyword']."</a> ";
    }
    return $hotword;
}