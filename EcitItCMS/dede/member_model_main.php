<?php
/**
 * ��Աģ�͹���
 *
 * @version        $Id: member_model_main.php 1 11:24 2010��7��20��Z tianya $
 * @package        EcitITCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/config.php");
CheckPurview('member_Type');
require_once(DEDEINC."/datalistcp.class.php");
require_once(DEDEINC."/common.func.php");
setcookie("ENV_GOBACK_URL",$dedeNowurl,time()+3600,"/");
function GetTotalMember($mtable=''){
    global $dsql;
    if($dsql->IsTable($mtable)){
        $row =$dsql->GetOne("SELECT COUNT(*) AS nums FROM {$mtable}");
        return empty($row['nums'])? "0" : $row['nums'];        
    }else{
        return '0';
    }
}

$sql = "SELECT `id`,`name`,`table`,`description`,`state`,`issystem` FROM #@__member_model ORDER BY id ASC";
$dlist = new DataListCP();
$dlist->SetTemplet(DEDEADMIN."/templets/member_model_main.htm");
$dlist->SetSource($sql);
$dlist->display();
$dlist->Close();