<?php
/**
 * @version        $Id: login.php 1 8:38 2010��7��9��Z tianya $ * @package        EcitITCMS.Member
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/config.php");
if($cfg_ml->IsLogin())
{
    ShowMsg('���Ѿ���½ϵͳ����������ע�ᣡ', 'index.php');
    exit();
}
require_once(dirname(__FILE__)."/templets/login.htm");