<?php
/**
 * �ĵ��ؼ���ѡ��
 *
 * @version        $Id: article_keywords_select.php 1 8:26 2010��7��12��Z tianya $
 * @package        EcitITCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/config.php");
require_once(DEDEINC."/datalistcp.class.php");
setcookie("ENV_GOBACK_URL",$dedeNowurl,time()+3600,"/");

if(empty($keywords)) $keywords = "";

$sql = "SELECT * FROM #@__keywords ORDER BY rank DESC";
$dlist = new DataListCP();
$dlist->SetTemplate(DEDEADMIN."/templets/article_keywords_select.htm");
$dlist->pageSize = 300;
$dlist->SetParameter("f",$f);
$dlist->SetSource($sql);
$dlist->Display();

function GetSta($sta)
{
    if($sta==1) return "����";
    else return "<font color='red'>����</font>";
}

function GetMan($sta)
{
    if($sta==1) return "<u>����</u>";
    else return "<u>����</u>";
}