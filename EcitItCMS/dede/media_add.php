<?php
/**
 * ��������
 *
 * @version        $Id: media_add.php 2 15:25 2011-6-2 tianya $
 * @package        EcitITCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */
require_once(dirname(__FILE__)."/config.php");

//����Ȩ�޼��
if(empty($dopost)) $dopost = "";

//�ϴ�
if($dopost=="upload")
{
    require_once(DEDEINC."/image.func.php");
    $sparr_image = Array("image/pjpeg","image/jpeg","image/gif","image/png","image/x-png","image/wbmp");
    $sparr_flash = Array("application/xshockwaveflash");
    $okdd = 0;
    $uptime = time();
    $adminid = $cuserLogin->getUserID();
    $width = $height = '';
    
    for($i=0; $i<=40; $i++)
    {
        if(isset(${"upfile".$i}) && is_uploaded_file(${"upfile".$i}))
        {
            $filesize = ${"upfile".$i."_size"};
            $upfile_type = ${"upfile".$i."_type"};
            $upfile_name = ${"upfile".$i."_name"};
            $dpath = MyDate("ymd", $uptime);

            if(in_array($upfile_type, $sparr_image))
            {
                $mediatype = 1;
                $savePath = $cfg_image_dir."/".$dpath;
            }
            else if(in_array($upfile_type, $sparr_flash)){
                $mediatype = 2;
                $savePath = $cfg_other_medias."/".$dpath;
            }
            // 2011-6-2 �޸������޷��ϴ��Ĵ���(by:tianya)
            else if(preg_match('#audio|media|video#i', $upfile_type) && preg_match("#\.".$cfg_mediatype."$#i", $upfile_name))
            {
                $mediatype=3;
                $savePath = $cfg_other_medias."/".$dpath;
            }
            else if(preg_match("#\.".$cfg_softtype."+\.".$cfg_softtype."$#i", $upfile_name))
            {
                $mediatype=4;
                $savePath = $cfg_soft_dir."/".$dpath;
            }
            else
            {
                continue;
            }
            $filename = "{$adminid}_".MyDate("His",$uptime).mt_rand(100,999).$i;
            $fs = explode(".",${"upfile".$i."_name"});
            $filename = $filename.".".$fs[count($fs)-1];
            $filename = $savePath."/".$filename;
            if(!is_dir($cfg_basedir.$savePath))
            {
                MkdirAll($cfg_basedir.$savePath,777);
                CloseFtp();
            }
            $fullfilename = $cfg_basedir.$filename;
            if($mediatype==1)
            {
                @move_uploaded_file(${"upfile".$i}, $fullfilename);
                $info = '';
                $data = getImagesize($fullfilename, $info);
                $width = $data[0];
                $height = $data[1];
                if(in_array($upfile_type, $cfg_photo_typenames)) WaterImg($fullfilename, 'up');
            }else
            {
                @move_uploaded_file(${"upfile".$i}, $fullfilename);
            }
            if($i>1)
            {
                $ntitle = $title."_".$i;
            }
            else
            {
                $ntitle = $title;
            }
            $inquery = "INSERT INTO `#@__uploads`(title,url,mediatype,width,height,playtime,filesize,uptime,mid)
       VALUES ('$ntitle','$filename','$mediatype','$width','$height','$playtime','$filesize','$uptime','$adminid'); ";
            $okdd++;
            $dsql->ExecuteNoneQuery($inquery);
        }
    }
    ShowMsg("�ɹ��ϴ� {$okdd} ���ļ���","media_main.php");
    exit();
}
include DedeInclude('templets/media_add.htm');