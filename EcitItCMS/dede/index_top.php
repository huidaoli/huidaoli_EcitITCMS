<?php
/**
 * �����̨����
 *
 * @version        $Id: index_top.php 1 8:48 2010��7��13��Z tianya $
 * @package        EcitITCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require(dirname(__FILE__)."/config.php");
if($cuserLogin->adminStyle=='dedecms')
{
    include DedeInclude('templets/index_top1.htm');
}
else
{
    include DedeInclude('templets/index_top2.htm');
}
