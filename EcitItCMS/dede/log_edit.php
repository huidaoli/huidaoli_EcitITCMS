<?php
/**
 * �༭��־
 *
 * @version        $Id: log_edit.php 1 8:48 2010��7��13��Z tianya $
 * @package        EcitITCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/config.php");
CheckPurview('sys_Log');
if(empty($dopost))
{
    ShowMsg("��ûָ���κβ�����","javascript:;");
    exit();
}

//���������־
if($dopost=="clear")
{
    $dsql->ExecuteNoneQuery("DELETE FROM #@__log");
    ShowMsg("�ɹ����������־��","log_list.php");
    exit();
}
else if($dopost=="del")
{
    $bkurl = isset($_COOKIE['ENV_GOBACK_URL']) ? $_COOKIE['ENV_GOBACK_URL'] : "log_list.php";
    $ids = explode('`',$ids);
    $dquery = "";
    foreach($ids as $id)
    {
        if($dquery=="")
        {
            $dquery .= " lid='$id' ";
        }
        else
        {
            $dquery .= " Or lid='$id' ";
        }
    }
    if($dquery!="") $dquery = " where ".$dquery;
    $dsql->ExecuteNoneQuery("DELETE FROM #@__log $dquery");
    ShowMsg("�ɹ�ɾ��ָ������־��",$bkurl);
    exit();
}
else
{
    ShowMsg("�޷�ʶ���������","javascript:;");
    exit();
}