<?php
/**
 * @version        $Id: login.php 1 8:38 2010年7月9日Z tianya $ * @package        EcitITCMS.Member
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/config.php");
if($cfg_ml->IsLogin())
{
    ShowMsg('你已经登陆系统，无需重新注册！', 'index.php');
    exit();
}
require_once(dirname(__FILE__)."/templets/login.htm");