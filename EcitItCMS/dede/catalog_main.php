<?php
/**
 * ��Ŀ����
 *
 * @version        $Id: catalog_main.php 1 14:31 2010��7��12��Z tianya $
 * @package        EcitITCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/config.php");
require_once(DEDEINC."/typeunit.class.admin.php");
$userChannel = $cuserLogin->getUserChannel();
include DedeInclude('templets/catalog_main.htm');