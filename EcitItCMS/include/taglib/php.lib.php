<?php
if (!defined('DEDEINC'))
    exit('Request Error!');
/**
 * 
 *
 * @version        $Id: php.lib.php1 9:29 2010��7��6��Z tianya $ * @package        EcitITCMS.Taglib
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
 
 /*>>dede>>
<name>PHP�����ǩ</name>
<type>ȫ�ֱ��</type>
<for>V55,V56,V57</for>
<description>����PHP����</description>
<demo>
{dede:php}
$a = "dede";
echo $a;
{/dede:php}
</demo>
<attributes>
</attributes> 
>>dede>>*/
 
function lib_php(&$ctag, &$refObj)
{
    global $dsql;
    global $db;
    $phpcode = trim($ctag->GetInnerText());
    if ($phpcode == '')
        return '';
    ob_start();
    extract($GLOBALS, EXTR_SKIP);
    @eval($phpcode);
    $revalue = ob_get_contents();
    ob_clean();
    return $revalue;
}