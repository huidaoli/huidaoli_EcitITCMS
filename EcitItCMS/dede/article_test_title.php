<?php
/**
 * ����ظ��ĵ�
 *
 * @version        $Id: article_test_same.php 1 14:31 2010��7��12��Z tianya $
 * @package        EcitITCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/config.php");
AjaxHead();
if(empty($t) || $cfg_check_title=='N') exit;

$row = $dsql->GetOne("SELECT id FROM `#@__archives` WHERE title LIKE '$t' ");
if(is_array($row))
{
    echo "��ʾ��ϵͳ�Ѿ����ڱ���Ϊ '<a href='../plus/view.php?aid={$row['id']}' style='color:red' target='_blank'><u>$t</u></a>' ���ĵ���[<a href='#' onclick='javascript:HideObj(\"mytitle\")'>�ر�</a>]";
}