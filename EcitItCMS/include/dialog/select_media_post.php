<?php
/**
 * ��ý�巢��
 *
 * @version        $Id: select_media_post.php 1 9:43 2010��7��8��Z tianya $ * @package        EitITCMS.Dialog
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
include_once(dirname(__FILE__).'/config.php');
$cfg_softtype = $cfg_mediatype;
$cfg_soft_dir = $cfg_other_medias;
$bkurl = 'select_media.php';
$uploadmbtype = "��ý���ļ�����";
require_once(dirname(__FILE__)."/select_soft_post.php");