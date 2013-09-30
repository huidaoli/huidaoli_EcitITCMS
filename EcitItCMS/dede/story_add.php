<?php
/**
 * @version        $Id: story_add.php 1 9:02 2010年9月25日Z 蓝色随想 $ * @package        EcitITCMS.Module.Book
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */

require_once(dirname(__FILE__). "/config.php");
CheckPurview('story_Catalog');
if(!isset($action)) $action = '';

$keywords = $writer = '';
//读取所有栏目
$dsql->SetQuery("SELECT id,classname,pid,rank,booktype FROM #@__story_catalog ORDER BY rank ASC");
$dsql->Execute();
$ranks = Array();
$btypes = Array();
$stypes = Array();
$booktypes = Array();
while($row = $dsql->GetArray())
{
    if($row['pid']==0)
    {
        $btypes[$row['id']] = $row['classname'];
    }
    else
    {
        $stypes[$row['pid']][$row['id']] = $row['classname'];
    }
    $ranks[$row['id']] = $row['rank'];
    if($row['booktype']=='0')
    {
        $booktypes[$row['id']] = '小说';
    }
    else
    {
        $booktypes[$row['id']] = '漫画';
    }
}
$lastid = $row['id'];
$msg = '';
require_once(dirname(__FILE__). "/templets/story_add.htm");
