<?php
/**
 * վ�����ŷ���
 *
 * @version        $Id: mynews_add.php 1 15:27 2010��7��20��Z tianya $
 * @package        EcitITCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/config.php");
CheckPurview('plus_վ�����ŷ���');
if(empty($dopost)) $dopost = "";

if($dopost=="save")
{
    $dtime = GetMkTime($sdate);
    $query = "INSERT INTO `#@__mynews`(title,writer,senddate,body)
     VALUES('$title','$writer','$dtime','$body')";
    $dsql->ExecuteNoneQuery($query);
    ShowMsg("�ɹ�����һ��վ�����ţ�", "mynews_main.php");
    exit();
}
include DedeInclude('templets/mynews_add.htm');