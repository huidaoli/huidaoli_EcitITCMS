<?php
/**
 * @version        $Id: story_edit.php 1 9:02 2010��9��25��Z ��ɫ���� $ * @package        EcitITCMS.Module.Book
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */

require_once(dirname(__FILE__). "/config.php");
CheckPurview('story_Edit');
if(!isset($action)) $action = '';


//��ȡ������Ŀ
$dsql->SetQuery("SELECT id,classname,pid,rank FROM #@__story_catalog ORDER BY rank ASC");
$dsql->Execute();
$ranks = Array();
$btypes = Array();
$stypes = Array();
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
}
$lastid = $row['id'];
$msg = '';
$books = $dsql->GetOne("SELECT S.*,A.membername FROM #@__arcrank AS A LEFT JOIN #@__story_books AS S ON A.rank=S.arcrank WHERE S.bid='$bookid' ");
require_once(DEDEADMIN. '/templets/story_edit.htm');
?>