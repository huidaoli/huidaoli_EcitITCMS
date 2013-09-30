<?php
/**
 * @version        $Id: story_content_edit.php 1 9:02 2010��9��25��Z ��ɫ���� $ * @package        EcitITCMS.Module.Book
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */

require_once(dirname(__FILE__). "/config.php");
require_once(DEDEROOT. "/book/include/story.func.php");
CheckPurview('story_Edit');
if(!isset($action)) $action = '';

if(empty($cid))
{
    ShowMsg("��������", "-1");
    exit();
}

//��ȡ������Ŀ
$dsql->SetQuery("Select id,classname,pid,rank From #@__story_catalog order by rank asc");
$dsql->Execute();
$ranks = Array();
$btypes = Array();
$stypes = Array();
while($row = $dsql->GetArray()){
    if($row['pid']==0) $btypes[$row['id']] = $row['classname'];
    else $stypes[$row['pid']][$row['id']] = $row['classname'];
    $ranks[$row['id']] = $row['rank'];
}
$lastid = $row['id'];


$contents = $dsql->GetOne("SELECT * FROM #@__story_content WHERE id='$cid' ");

$bookinfos = $dsql->GetOne("SELECT catid,bcatid,bookname,booktype FROM #@__story_books WHERE bid='{$contents['bookid']}' ");
$catid = $bookinfos['catid'];
$bcatid = $bookinfos['bcatid'];
$bookname = $bookinfos['bookname'];
$booktype = $bookinfos['booktype'];
$bookid = $contents['bookid'];

$dsql->SetQuery("SELECT id,chapnum,chaptername FROM #@__story_chapter WHERE bookid='{$contents['bookid']}' ORDER BY chapnum DESC");
$dsql->Execute();
$chapters = Array();
$chapnums = Array();
while($row = $dsql->GetArray()){
    $chapters[$row['id']] = $row['chaptername'];
    $chapnums[$row['id']] = $row['chapnum'];
}

require_once DedeInclude('/templets/story_content_edit.htm');

//ClearAllLink();