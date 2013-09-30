<?php
/**
 * @version        $Id: story_list_chapter.php 1 9:02 2010��9��25��Z ��ɫ���� $ * @package        EcitITCMS.Module.Book
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */

require_once(dirname(__FILE__). "/config.php");
require_once DEDEINC. '/datalistcp.class.php';
setcookie("ENV_GOBACK_URL", $dedeNowurl, time()+3600,"/");
CheckPurview('story_books');
if(!isset($action)) $action = '';

if(!isset($keyword)) $keyword = "";

if(!isset($bid)) $bid = 0;

if(!empty($bookid)) $bid = $bookid;


$addquery = " id>0 ";
$orderby = " ORDER BY id DESC ";
if($keyword!="") $addquery .= " And (bookname LIKE '%$keyword%' OR chaptername LIKE '%$keyword%') ";

if($bid!=0) $addquery .= " And bookid='$bid' ";


$query = "
   SELECT * FROM #@__story_chapter WHERE $addquery $orderby
";
$dlist = new DataListCP();
$dlist->pageSize = 20;
$dlist->SetParameter("keyword", $keyword);
$dlist->SetParameter("bid", $bid);
$dlist->SetTemplate(DEDEADMIN. '/templets/story_list_chapter.htm');
$dlist->SetSource($query);
$dlist->Display();