<?php
/**
 * �Զ���ģ�͹���
 *
 * @version        $Id: mychannel_main.php 1 15:26 2010��7��20��Z tianya $
 * @package        EcitITCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__).'/config.php');
CheckPurview('temp_Other');
require_once(DEDEINC.'/datalistcp.class.php');
setcookie("ENV_GOBACK_URL",$dedeNowurl,time()+3600,'/');

$sql = "SELECT myt.aid,myt.tagname,tp.typename,myt.timeset,myt.endtime
        FROM `#@__mytag` myt LEFT JOIN `#@__arctype` tp ON tp.id=myt.typeid ORDER BY myt.aid DESC ";
$dlist = new DataListCP();
$dlist->SetTemplet(DEDEADMIN.'/templets/mytag_main.htm');
$dlist->SetSource($sql);
$dlist->display();

function TestType($tname)
{
    return $tname=='' ? '������Ŀ' : $tname;
}

function TimeSetValue($ts)
{
    return $ts==0 ? '����ʱ��' : '��ʱ���';
}