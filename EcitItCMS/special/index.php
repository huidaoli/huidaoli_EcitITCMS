<?php
/**
 * @version        $Id: index.php 1 2010-06-30 11:43:09Z tianya $
 * @package        EcitIT.Site
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/arc.specview.class.php");
if(strlen($art_shortname) > 6) exit("art_shortname too long!");
$specfile = dirname(__FILE__)."spec_1".$art_shortname;
//����Ѿ����뾲̬�б���ֱ�������һ���ļ�
if(file_exists($specfile))
{
    include($specfile);
    exit();
}
else
{
  $sp = new SpecView();
  $sp->Display();
}