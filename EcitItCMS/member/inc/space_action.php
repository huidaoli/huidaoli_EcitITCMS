<?php   if(!defined('DEDEMEMBER')) exit('dedecms');
/**
 * �ռ����
 * 
 * @version        $Id: space_action.php 1 15:18 2010��7��9��Z tianya $ * @package        EcitITCMS.Member
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */

//�Ƿ������û��ռ���ʾδ����ĵ�
$addqSql = '';
if($cfg_mb_allowncarc=='N') $addqSql .= " And arc.arcrank > -1 ";
if(isset($mtype)) $mtype = intval($mtype);
if(!empty($mtype)) $addqSql .= " And arc.mtype = '$mtype' ";

/*---------------------------------
�����б�
function list_article(){ }
-------------------------------------*/
if($action=='article')
{
    if(empty($mtype)) $mtype = 0;

    include_once(DEDEINC.'/arc.memberlistview.class.php');
    include_once(DEDEINC.'/channelunit.func.php');
    $query = "SELECT arc.*,mt.mtypename,addt.body,tp.typedir,tp.typename,tp.isdefault,tp.defaultname,tp.namerule,tp.namerule2,tp.ispart,tp.moresite,tp.siteurl,tp.sitepath
          FROM `#@__archives` arc 
          LEFT JOIN `#@__addonarticle` addt ON addt.aid=arc.id
          LEFT JOIN `#@__arctype` tp ON tp.id=arc.typeid 
          LEFT JOIN `#@__mtypes` mt ON mt.mtypeid=arc.mtype
          WHERE arc.mid='{$_vars['mid']}' $addqSql AND arc.channel=1 ORDER BY arc.id DESC";
    $dlist = new MemberListview();
    $dlist->pageSize = $_vars['pagesize'];
    $dlist->SetParameter("mtype",$mtype);
    $dlist->SetParameter("uid",$_vars['userid']);
    $dlist->SetParameter("action",$action);
    $dlist->SetTemplate(DEDEMEMBER."/space/{$_vars['spacestyle']}/listarticle.htm");
    $dlist->SetSource($query);
    $dlist->Display();
    exit();
}
/*---------------------------------
��ƪ������ʾ
function view_archives(){ }
-------------------------------------*/
else if($action=='viewarchives' && !empty($aid) && is_numeric($aid))
{
    if(empty($mtype)) $mtype = 0;

    include_once(DEDEINC.'/arc.memberlistview.class.php');
    include_once(DEDEINC.'/channelunit.func.php');
    
    //��ȡ���µ�����
    $sql = "SELECT fb.*,mb.userid,mb.face as mface,mb.spacesta,mb.scores FROM `#@__feedback` fb
        LEFT JOIN `#@__member` mb ON mb.mid = fb.mid
        WHERE fb.aid='$aid' and fb.ischeck='1' ORDER BY fb.id DESC LIMIT 0, 50";
    $msgs = array();
    $dsql->Execute('fb', $sql);
    while ($row = $dsql->GetArray('fb'))
    {
        $msgs[] = $row;
    }
    
    //��ȡ��������
    $query = "SELECT arc.*,tp.typedir,tp.typename,tp.isdefault,tp.defaultname,tp.namerule,tp.namerule2,
            tp.ispart,tp.moresite,tp.siteurl,tp.sitepath,ar.body FROM `#@__archives` arc
            LEFT JOIN `#@__arctype` tp ON arc.typeid=tp.id
            LEFT JOIN `#@__addonarticle` ar ON ar.aid=arc.id 
            WHERE arc.mid='{$_vars['mid']}' AND arc.channel=1 AND ar.typeid=tp.id AND ar.aid='$aid' ";
    $arcrow = $dsql->GetOne($query);
    if( !is_array($arcrow) )
    {
        ShowMsg(' ��ȡ�ĵ�ʱ����δ֪����! ', '-1');
        exit();
    }
    
    //����ģ��
    $dlist = new MemberListview();
    $dlist->SetTemplate(DEDEMEMBER."/space/{$_vars['spacestyle']}/blog.htm");
    $dlist->Display();
    exit();
}
/*---------------------------------
�����ĵ��б�
function list_archives(){ }
-------------------------------------*/
else if($action=='archives')
{
    if(empty($mtype)) $mtype = 0;
    include_once(DEDEINC.'/arc.memberlistview.class.php');
    include_once(DEDEINC.'/channelunit.func.php');
    
    //���ûָ��Ƶ��ID������£��г����зǵ���ģ���ĵ�
    if($cfg_mb_spaceallarc > 0 && empty($channelid)) $channelid = intval($cfg_mb_spaceallarc);

    if(empty($channelid))
    {
        $channelid = 0;
        $query = "SELECT arc.*,mt.mtypename,tp.typedir,tp.typename,tp.isdefault,tp.defaultname,tp.namerule,tp.namerule2,tp.ispart,tp.moresite,tp.siteurl,tp.sitepath
                 FROM `#@__archives` arc 
                 LEFT JOIN `#@__arctype` tp ON arc.typeid=tp.id
                 LEFT JOIN `#@__mtypes` mt ON mt.mtypeid=arc.mtype
                 WHERE arc.mid='{$_vars['mid']}' $addqSql ORDER BY arc.id DESC";
    }
    else
    {
        $channelid = intval($channelid);
        $chRow = $dsql->GetOne("SELECT issystem,addtable,listfields From `#@__channeltype` WHERE id='$channelid' ");
        if(!is_array($chRow)) die(' Channel Error! ');
        if($chRow['issystem']==-1)
        {
            $addtable = trim($chRow['addtable']);
            $listfields = explode(',', $chRow['listfields']);
            $listfields_str = 'arc.'.join(',arc.', $listfields);
            if($listfields_str!='arc.') 
            {
                $listfields_str = $listfields_str.',';
            }
            else {
                $listfields_str = '';
            }
            $query = "SELECT arc.aid,arc.aid as id,arc.typeid,'' as mtypename,1 as ismake,0 as money,'' as filename,{$listfields_str}
                   tp.typedir,tp.typename,tp.isdefault,tp.defaultname,tp.namerule,tp.namerule2,tp.ispart,tp.moresite,tp.siteurl,tp.sitepath
                   FROM `{$addtable}` arc 
                   LEFT JOIN `#@__arctype` tp ON arc.typeid=tp.id
                 WHERE arc.mid='{$_vars['mid']}' And arc.channel='$channelid' $addqSql ORDER BY arc.aid DESC";
        }
        else
        {
            $query = "SELECT arc.*,mt.mtypename,tp.typedir,tp.typename,tp.isdefault,tp.defaultname,tp.namerule,tp.namerule2,tp.ispart,tp.moresite,tp.siteurl,tp.sitepath
                    from `#@__archives` arc
                    LEFT JOIN `#@__arctype` tp on arc.typeid=tp.id
                    LEFT JOIN `#@__mtypes` mt on mt.mtypeid=arc.mtype
                 WHERE arc.mid='{$_vars['mid']}' And arc.channel='$channelid' $addqSql order by arc.id desc";
        }
    }
    $dlist = new MemberListview();
    $dlist->pageSize = $_vars['pagesize'];
    $dlist->SetParameter("mtype", $mtype);
    $dlist->SetParameter("uid", $_vars['userid']);
    $dlist->SetParameter("channelid", $channelid);
    $dlist->SetParameter("action", $action);
    $dlist->SetTemplate(DEDEMEMBER."/space/{$_vars['spacestyle']}/listarchives.htm");
    $dlist->SetSource($query);
    $dlist->Display();
    exit();
}

/*---------------------------------
�����ĵ��б�
function list_album(){ }
-------------------------------------*/
else if($action=='album')
{
    if(empty($mtype)) {
        $mtype = 0;
    }
    include_once(DEDEINC.'/arc.memberlistview.class.php');
    include_once(DEDEINC.'/channelunit.func.php');
    $query = "SELECT arc.*,mt.mtypename,tp.typedir,tp.typename,tp.isdefault,tp.defaultname,tp.namerule,tp.namerule2,tp.ispart,tp.moresite,tp.siteurl,tp.sitepath
          from `#@__archives` arc 
          left join `#@__arctype` tp on arc.typeid=tp.id
          left join `#@__mtypes` mt on mt.mtypeid=arc.mtype
          where arc.mid='{$_vars['mid']}' And arc.channel=2 $addqSql order by arc.id desc";
    $dlist = new MemberListview();
    $dlist->pageSize = $_vars['pagesize'];
    $dlist->SetParameter("mtype",$mtype);
    $dlist->SetParameter("uid",$_vars['userid']);
    $dlist->SetParameter("action",$action);
    $dlist->SetTemplate(DEDEMEMBER."/space/{$_vars['spacestyle']}/listalbum.htm");
    $dlist->SetSource($query);
    $dlist->Display();
    exit();
}

/*---------------------------------
���Ա�
function guestbook(){ }
-------------------------------------*/
else if($action=='guestbook')
{
    if(empty($mtype)) {
        $mtype = 0;
    }
    include_once(DEDEINC.'/datalistcp.class.php');
    $query = "SELECT mg.*,mb.face,mb.userid,mb.sex From `#@__member_guestbook` mg 
    left join `#@__member` mb on mb.userid=mg.gid 
    where mg.mid='{$_vars['mid']}' order by mg.aid desc";
    $dlist = new DataListCP();
    $dlist->pageSize = 10;
    $dlist->SetParameter("uid",$_vars['userid']);
    $dlist->SetParameter("action",$action);
    $dlist->SetTemplate(DEDEMEMBER."/space/{$_vars['spacestyle']}/guestbook.htm");
    $dlist->SetSource($query);
    $dlist->Display();
    exit();
}

/*---------------------------------
�ҵĺ���
function friend(){ }
-------------------------------------*/
else if($action=='friend')
{
    if(empty($mtype)) {
        $mtype = 0;
    }
    include_once(DEDEINC.'/arc.memberlistview.class.php');
    include_once(DEDEINC.'/channelunit.func.php');
    $query = "SELECT arc.*,tp.typedir,tp.typename,tp.isdefault,tp.defaultname,tp.namerule,tp.namerule2,tp.ispart,tp.moresite,tp.siteurl,tp.sitepath
          from `#@__archives` arc
          left join `#@__arctype` tp on arc.typeid=tp.id
          where arc.mid='{$_vars['mid']}' $addqSql order by arc.id desc";
    $dlist = new MemberListview();
    $dlist->pageSize = 8;
    $dlist->SetParameter("mtype",$mtype);
    $dlist->SetParameter("uid",$_vars['userid']);
    $dlist->SetParameter("action",$action);
    $dlist->SetTemplate(DEDEMEMBER."/space/{$_vars['spacestyle']}/friend.htm");
    $dlist->SetSource($query);
    $dlist->Display();
    exit();
}

/*---------------------------------
��������
function infos(){ }
-------------------------------------*/
else if($action=='infos')
{
    include_once(DEDEDATA.'/enums/nativeplace.php');
    include_once(DEDEINC."/enums.func.php");
    $row = $dsql->GetOne("SELECT  * from `#@__member_person` where mid='{$_vars['mid']}' ");
    $dpl = new DedeTemplate();
    $dpl->LoadTemplate(DEDEMEMBER."/space/{$_vars['spacestyle']}/infos.htm");
    $dpl->display();
}

/*---------------------------------
��������
function guestbook_save(){ }
-------------------------------------*/
else if($action=='guestbooksave')
{
    CheckRank(0,0);
    $svali = GetCkVdValue();
    if(strtolower($vdcode)!=$svali || $svali=='')
    {
        ResetVdValue();
        ShowMsg('��֤�����', '-1');
        exit();
    }
    $uidnum = intval($uidnum);
    if(empty($uidnum))
    {
        ShowMsg('��������', '-1');
        exit();
    }
    if(strlen($msg)<6)
    {
        ShowMsg('�����������̫�̣�', '-1');
        exit();
    }
    $uname = HtmlReplace($uname, 1);
    $msg = cn_substrR(HtmlReplace($msg), 2048);
    $title = cn_substrR(HtmlReplace($title), 255);
    if($cfg_ml->M_UserName != '' && $cfg_ml->M_ID != $uidnum)
    {
        $gid = $cfg_ml->M_UserName;
    }
    else
    {
        $gid = '';
    }
    $inquery = "INSERT INTO `#@__member_guestbook`(mid,gid,title,msg,uname,ip,dtime)
   VALUES ('$uidnum','$gid','$title','$msg','$uname','".GetIP()."',".time()."); ";
    $dsql->ExecuteNoneQuery($inquery);
    ShowMsg('�ɹ��ύ������ԣ�', "index.php?uid={$uid}&action=guestbook");
    exit();
}

/*---------------------------------
ɾ������
function guestbook_del(){ }
-------------------------------------*/
else if($action=='guestbookdel')
{
    CheckRank(0,0);
    if($cfg_ml->M_LoginID!=$uid)
    {
        ShowMsg('�������Բ��Ǹ���ģ��㲻��ɾ����', -1);
        exit();
    }
	$aid = intval($aid);
    $inquery = "DELETE FROM `#@__member_guestbook` WHERE aid='$aid' AND mid='$mid'"; 
    $dsql->ExecuteNoneQuery($inquery);
    ShowMsg('�ɹ�ɾ����', "index.php?uid={$uid}&action=guestbook");
    exit();
}

/*---------------------------------
ɾ���ҵĶ�̬��Ϣ
function feed_del(){ }
-------------------------------------*/
else if($action=='feeddel')
{
    CheckRank(0,0);
    $fid=(empty($fid))? "" : intval($fid);
    $row = $dsql->GetOne("SELECT mid FROM `#@__member_feed` WHERE fid='$fid'");
    if($cfg_ml->M_ID!=$row['mid'])
    {
        ShowMsg('�˶�̬��Ϣ�����ڣ�', -1);
        exit();
    }
    $inquery = "DELETE FROM `#@__member_feed` WHERE fid='$fid' AND mid='".$cfg_ml->M_ID."'"; 
    $dsql->ExecuteNoneQuery($inquery);
    ShowMsg('�ɹ�ɾ��һ����̬��Ϣ��', "index.php");
    exit();
}
/*---------------------------------
ɾ���ҵ�������Ϣ
function mood_del(){ }
-------------------------------------*/
else if($action=='mooddel')
{
    CheckRank(0,0);
    $id=(empty($id))? "" : intval($id);
    $row = $dsql->GetOne("SELECT mid FROM `#@__member_msg` WHERE id='$id'");
    if($cfg_ml->M_ID!=$row['mid'])
    {
        ShowMsg('�˶�̬��Ϣ�����ڣ�', -1);
        exit();
    }
    $inquery = "DELETE FROM `#@__member_msg` WHERE id='$id' AND mid='".$cfg_ml->M_ID."'"; 
    $dsql->ExecuteNoneQuery($inquery);
    ShowMsg('�ɹ�ɾ��һ�����飡', "index.php");
    exit();
}
/*---------------------------------
�Ӻ���
function newfriend(){ }
-------------------------------------*/
else if($action=='newfriend')
{
    CheckRank(0,0);
    if($_vars['mid']==$cfg_ml->M_ID)
    {
        ShowMsg("�㲻�ܼ��Լ�Ϊ���ѣ�","index.php?uid=".$uid);
        exit();
    }
    $addtime = time();
    $row = $dsql->GetOne("SELECT * FROM `#@__member_friends` where fid='{$_vars['mid']}' And mid='{$cfg_ml->M_ID}' ");
    if(is_array($row))
    {
        ShowMsg("���û��Ѿ�����ĺ��ѣ�","index.php?uid=".$uid);
        exit();
    }
    else
    {
        #api{{
        if(defined('UC_API') && @include_once DEDEROOT.'/uc_client/client.php')
        {
            if($data = uc_get_user($cfg_ml->M_LoginID)) uc_friend_add($uid,$data[0]);
        }
        #/aip}}
    
        $inquery = "INSERT INTO `#@__member_friends` (`fid` , `floginid` , `funame` , `mid` , `addtime` , `ftype`)
                VALUES ('{$_vars['mid']}' , '{$_vars['userid']}' , '{$_vars['uname']}' , '{$cfg_ml->M_ID}' , '$addtime' , '0'); ";
        $dsql->ExecuteNoneQuery($inquery);
        //ͳ���ҵĺ�������
        $row = $dsql->GetOne("SELECT COUNT(*) AS nums FROM `#@__member_friends` WHERE `mid`='".$cfg_ml->M_ID."'");
        $dsql->ExecuteNoneQuery("UPDATE `#@__member_tj` SET friend='$row[nums]' WHERE `mid`='".$cfg_ml->M_ID."'");

        //��Ա��̬��¼
        $cfg_ml->RecordFeeds('addfriends',"","",$_vars['userid']);
        
        ShowMsg("�ɹ����Ӻ��ѣ�","index.php?uid=".$uid);
        exit();
    
    }
}
/*---------------------------------
������ѹ�ϵ
function newfriend(){ }
-------------------------------------*/
else if($action=='delfriend')
{
    CheckRank(0,0);
    if($_vars['mid']==$cfg_ml->M_ID)
    {
        ShowMsg("�㲻�ܺ��Լ�Ϊ�����ϵ��","index.php?uid=".$uid);
        exit();
    }
    $addtime = time();
    $row = $dsql->GetOne("Select * FROM `#@__member_friends` where fid='{$_vars['mid']}' And mid='{$cfg_ml->M_ID}' ");
    if(!is_array($row))
    {
        ShowMsg("���û��Ѿ�������ĺ��ѣ�","index.php?uid=".$uid);
        exit();
    }
    else
    {
        #api{{
        if(defined('UC_API') && @include_once DEDEROOT.'/uc_client/client.php')
        {
            if($data = uc_get_user($cfg_ml->M_LoginID)) uc_friend_add($uid,$data[0]);
        }
        #/aip}}
        $inquery = "DELETE FROM `dede_member_friends` where fid='{$_vars['mid']}' And mid='{$cfg_ml->M_ID}' ";
        $dsql->ExecuteNoneQuery($inquery);
        //ͳ���ҵĺ�������
        $row = $dsql->GetOne("SELECT COUNT(*) AS nums FROM `#@__member_friends` WHERE `mid`='".$cfg_ml->M_ID."'");
        $dsql->ExecuteNoneQuery("UPDATE `#@__member_tj` SET friend='$row[nums]' WHERE `mid`='".$cfg_ml->M_ID."'");
        ShowMsg("�ɹ�������ѹ�ϵ��","myfriend.php");
        exit();
    }
}
/*---------------------------------
�Ӻ�����
function blackfriend(){ }
-------------------------------------*/
else if($action=='blackfriend')
{
    CheckRank(0,0);
    if($_vars['mid']==$cfg_ml->M_ID)
    {
        ShowMsg("�㲻�ܼ��Լ�����������","index.php?uid=".$uid);
        exit();
    }
    $addtime = time();
    $row = $dsql->GetOne("Select * FROM `#@__member_friends` where fid='{$_vars['mid']}' And mid='{$cfg_ml->M_ID}' ");
    if(is_array($row))
    {
        ShowMsg("���û��Ѿ�����ĺ��ѣ�","index.php?uid=".$uid);
        exit();
    }
    else
    {
        $inquery = "INSERT INTO `#@__member_friends` (`fid` , `floginid` , `funame` , `mid` , `addtime` , `ftype`)
                VALUES ('{$cfg_ml->M_ID}' , '{$cfg_ml->M_LoginID}' , '{$cfg_ml->M_UserName}' , '{$_vars['mid']}' , '$addtime' , '-1'); ";
        $dsql->ExecuteNoneQuery($inquery);
        ShowMsg("�ɹ����Ӻ����ں�������","index.php?uid=".$uid);
        exit();
    }
}
/*--------------------
function _contact_introduce() {}
��˾���
---------------------*/
elseif($action == 'introduce')
{
    $dpl = new DedeTemplate();
    $dpl->LoadTemplate(DEDEMEMBER."/space/{$_vars['spacestyle']}/introduce.htm");
    $dpl->display();
}
//��ϵ����
elseif ($action == 'contact')
{
    $dpl = new DedeTemplate();
    $dpl->LoadTemplate(DEDEMEMBER."/space/{$_vars['spacestyle']}/contact.htm");
    $dpl->display();
}
/*-------------------------------
function products() { }
��˾��Ʒ������
--------------------------------*/
elseif($action == 'products')
{
    $mtype = isset($mtype) && is_numeric($mtype) ? $mtype : 0;
    if($action == 'products') {
        $channel = 6;
    }
    include_once(DEDEINC.'/arc.memberlistview.class.php');
    include_once(DEDEINC.'/channelunit.func.php');

    $query = "Select arc.*,tp.typedir,tp.typename,tp.isdefault,tp.defaultname,tp.namerule,
        tp.namerule2,tp.ispart,tp.moresite,tp.siteurl,tp.sitepath FROM `#@__archives` arc
        left join `#@__arctype` tp on arc.typeid=tp.id
        where arc.mid='{$_vars['mid']}' and arc.channel='$channel' $addqSql order by arc.id desc";
    
    $dlist = new MemberListview();
    $dlist->pageSize = 12;
    $dlist->SetParameter('mtype', $mtype);
    $dlist->SetParameter('uid', $_vars['userid']);
    $dlist->SetParameter('action', $action);
    $dlist->SetTemplate(DEDEMEMBER."/space/{$_vars['spacestyle']}/listproducts.htm");
    $dlist->SetSource($query);
    $dlist->Display();
    exit();
}