<?php
if(!defined('DEDEINC'))
{
    exit("Request Error!");
}
/**
 * ����˵����ǩ
 *
 * @version        $Id: softmsg.lib.php 1 9:29 2010��7��6��Z tianya $ * @package        EcitITCMS.Taglib
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
 
/*>>dede>>
<name>����˵��</name>
<type>�������ģ��</type>
<for>V55,V56,V57</for>
<description>����˵����ǩ</description>
<demo>
{dede:softmsg /}
</demo>
<attributes>
</attributes> 
>>dede>>*/
 
function lib_softmsg(&$ctag,&$refObj)
{
    global $dsql;
    //$attlist="type|textall,row|24,titlelen|24,linktype|1";
    //FillAttsDefault($ctag->CAttribute->Items,$attlist);
    //extract($ctag->CAttribute->Items, EXTR_SKIP);
    $revalue = '';
    $row = $dsql->GetOne(" SELECT * FROM `#@__softconfig` ");
    if(is_array($row)) $revalue = $row['downmsg'];
    return $revalue;
}