<?php
/**
 * ��������
 *
 * @version        $Id: action_search.php 1 8:26 2010��7��12��Z tianya $
 * @package        EcitITCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/config.php");
require_once(dirname(__FILE__)."/actionsearch_class.php");

//����Ȩ�޼��
if(empty($dopost)) $dopost = "";

$keyword=empty($keyword)? "" : $keyword;
$actsearch = new ActionSearch($keyword);
$asresult = $actsearch->Search();
include DedeInclude('templets/action_search.htm');
