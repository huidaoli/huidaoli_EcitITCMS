<?php
/**
 * ����ģ�͵������б����ñ��
 *
 * @version        $Id: arclistsg.lib.php 1 9:29 2010��7��6��Z tianya $ * @package        EcitITCMS.Taglib
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */

 /**
 *  arclistsg������ǩ
 *
 * @access    public
 * @param     object  $ctag  ������ǩ
 * @param     object  $refObj  ���ö���
 * @return    string  �ɹ��󷵻ؽ�����ı�ǩ����
 */
 
/*>>dede>>
<name>��������ģ���б�</name>
<type>ȫ�ֱ��</type>
<for>V55,V56,V57</for>
<description>��������ģ�͵��ĵ��б����ñ��</description>
<demo>
{dede:arclistsg  flag='h' typeid='' row='' col='' titlelen='' orderway='' keyword='' limit='0,1'} 
<a href='[field:arcurl/]'>[field:title/]</a> 
{/dede:arclistsg}
</demo>
<attributes>
    <iterm>row:�����ĵ��б�����</iterm> 
    <iterm>typeid:��ĿID,���б�ģ��͵���ģ����һ�㲻��Ҫָ�����ڷ���ģ����������","�ֿ���ʾ�����Ŀ</iterm>
    <iterm>titlelen:���ⳤ�� ��ͬ��titlelength</iterm>
    <iterm>orderwey:������</iterm>
    <iterm>keyword:����ָ���ؼ��ֵ��ĵ��б�������ؼ�����","��</iterm>
    <iterm>innertext:������¼��ʽ(innertext�Ƿ��ڱ�ǩ֮��Ĵ���)</iterm>
    <iterm>arcid:ָ���ĵ�ID</iterm>
    <iterm>idlist:��ȡ�ض��ĵ����ĵ�ID��</iterm>
    <iterm>channelid: Ƶ��ID</iterm>
    <iterm>limit:��ʾ�޶��ļ�¼��Χ</iterm>
    <iterm>flag:�Զ�������ֵ��ͷ��[h]�Ƽ�[c]ͼƬ[p]�õ�[f]����[s]��ת[j]ͼ��[a]�Ӵ�[b]</iterm>
    <iterm>subday:��ʾ�ڶ��������ڵ��ĵ�</iterm>
</attributes> 
>>dede>>*/

function lib_arclistsg(&$ctag,&$refObj)
{
    global $dsql,$PubFields,$cfg_keyword_like,$cfg_index_cache,$_arclistEnv,$envs,$_sys_globals;

    //���Դ���
    $attlist="typeid|0,row|10,col|1,flag|,titlelen|30,sort|default,keyword|,innertext|,arcid|0,idlist|,channelid|0,limit|,orderway|desc,subday|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $line = $row;
    $orderby=strtolower($sort);
    if($col=='') $col = 1;
	if(empty($imgwidth)) $imgwidth = "";
	if(empty($imgheight)) $imgheight = "";
    $innertext = trim($ctag->GetInnerText());
    if($innertext=='') $innertext = GetSysTemplets("part_arclistsg.htm");

    if(empty($channelid) && isset($GLOBALS['envs']['channelid'])) {
        $channelid = $GLOBALS['envs']['channelid'];
    }
    
    if(empty($typeid) && !empty($envs['typeid'])) {
      $typeid = $envs['typeid'];
    }
    
    if(empty($typeid) && empty($channelid))
    {
        return "No channel info!";
    }

    if(!empty($channelid)) $gquery = "SELECT addtable,listfields FROM `#@__channeltype` WHERE id='$channelid' ";
    else $gquery = "SELECT ch.addtable,listfields FROM `#@__arctype` tp LEFT JOIN `#@__channeltype` ch ON ch.id=tp.channeltype WHERE id='$typeid'";

  $row = $dsql->GetOne($gquery);

    $orwheres = array();
    $maintable = trim($row['addtable']);

    if($maintable=='')
    {
        return "No addtable info!";
    }

    //�б������ֶ�
    $listarcs = array('aid', 'typeid');
    if(!empty($row['listfields']))
    {
         $listfields = explode(',', $row['listfields']);
         foreach($listfields as $v)
         {
              if(!in_array($v, $listarcs)) $listarcs[] = $v;
         }
    }
    $arclistquery = join(',', $listarcs);
    $arclistquery .= ",arc.aid AS id,arc.senddate AS pubdate";

    //����ͬ����趨SQL���� ����ʽ
    if($idlist=='')
    {
        if($orderby=='near' && $cfg_keyword_like=='N'){ $keyword=''; }
        //ʱ������(���ڵ�������������¡���������֮��)
        if($subday>0)
        {
            //�����ʱ��ֻ�ܼ��㵽�죬���򻺴湦�ܽ���Ч
            $ntime = gmmktime(0, 0, 0, gmdate('m'), gmdate('d'), gmdate('Y'));
            $limitday = $ntime - ($subday * 24 * 3600);
            $orwheres[] = " arc.senddate > $limitday ";
        }
        
        if($flag!='')
        {
            $flags = explode(',',$flag);
            for($i=0;isset($flags[$i]);$i++) $orwheres[] = " FIND_IN_SET('{$flags[$i]}',flag)>0 ";
        }

        if(!empty($typeid))
        {
            //ָ���˶����Ŀʱ�����ٻ�ȡ�����id
            if(preg_match('#,#',$typeid)) $orwheres[] = " typeid IN ($typeid) ";
            else
            {
                //����������Ŀ
                $CrossID = '';
                if((isset($envs['cross']) || $ctag->GetAtt('cross')=='1' ) && $ctag->GetAtt('nocross')!='1')
                {
                    $arr = $dsql->GetOne("SELECT `id`,`topid`,`cross`,`crossid`,`ispart`,`typename` FROM `#@__arctype` WHERE id='$typeid' ");
                    if($arr['cross']==0 || ($arr['cross']==2 && trim($arr['crossid']=='')))
                    $orwheres[] = ' typeid IN ('.GetSonIds($typeid).')';
                    else
                    {
                        $selquery = '';
                        if($arr['cross']==1) {
                            $selquery = "SELECT id,topid FROM `#@__arctype` WHERE typename like '{$arr['typename']}' AND id<>'{$typeid}' AND topid<>'{$typeid}'  ";
                        }
                        else {
                            $arr['crossid'] = preg_replace('#[^0-9,]#', '', trim($arr['crossid']));
                            if($arr['crossid']!='') $selquery = "SELECT id,topid FROM `#@__arctype` WHERE id IN('{$arr['crossid']}') AND id<>'{$typeid}' AND topid<>'{$typeid}'  ";
                        }

                        if($selquery!='')
                        {
                            $dsql->SetQuery($selquery);
                            $dsql->Execute();
                            while($arr = $dsql->GetArray()) {
                                $CrossID .= ($CrossID=='' ? $arr['id'] : ','.$arr['id']);
                            }
                        }
                    }
                }
                if($CrossID=='') $orwheres[] = ' typeid IN ('.GetSonIds($typeid).')';
                else $orwheres[] = ' typeid IN ('.GetSonIds($typeid).','.$CrossID.')';
            }
        }
        //Ƶ��ID

        if(!empty($channelid)) $orwheres[] = " AND arc.channel = '$channelid' ";

        //������������ᵼ�»��湦��ʧȥ���壬���ȡ��
        //if($arcid!=0) $orwheres[] = " arc.id<>'$arcid' ";
    }
    //�ĵ�����ķ�ʽ
    $ordersql = '';
    if($orderby=='hot'||$orderby=='click') $ordersql = " ORDER BY arc.click $orderway";
    else if($orderby=='id') $ordersql = "  ORDER BY arc.aid $orderway";
    else if($orderby=='near') $ordersql = " ORDER BY ABS(arc.id - ".$arcid.")";
    else if($orderby=='rand') $ordersql = "  ORDER BY rand()";
    else $ordersql=" ORDER BY arc.aid $orderway";
    //limit����
    $limit = trim(preg_replace('#limit#i', '', $limit));
    if($limit!='') $limitsql = " LIMIT $limit ";
    else $limitsql = " LIMIT 0,$line ";

    $orwhere = '';
    if(isset($orwheres[0])) {
        $orwhere = join(' AND ',$orwheres);
        $orwhere = preg_replace("#^ AND#i", '', $orwhere);
        $orwhere = preg_replace("#AND[ ]{1,}AND#i", 'AND ', $orwhere);
    }
    if($orwhere!='') $orwhere = " WHERE $orwhere ";

    $query = "SELECT $arclistquery,tp.typedir,tp.typename,tp.isdefault,tp.defaultname,tp.namerule,
        tp.namerule2,tp.ispart,tp.moresite,tp.siteurl,tp.sitepath
        FROM `$maintable` arc LEFT JOIN `#@__arctype` tp ON arc.typeid=tp.id
        $orwhere AND arc.arcrank > -1 $ordersql $limitsql";

    $md5hash = md5($query);
    $needcache = TRUE;
    if($idlist!='') $needcache = FALSE;
    else{
        $idlist = GetArclistSgCache($md5hash);
        if($idlist!='') $needcache = FALSE;
    }
    //ָ����id��ʹ�û����е�id
    if($idlist!='' && $_arclistEnv != 'index')
    {
        $query = "SELECT $arclistquery,tp.typedir,tp.typename,tp.isdefault,tp.defaultname,tp.namerule,tp.namerule2,tp.ispart,
            tp.moresite,tp.siteurl,tp.sitepath FROM `$maintable` arc LEFT JOIN `#@__arctype` tp ON arc.typeid=tp.id
          WHERE arc.aid IN($idlist) $ordersql $limitsql";
    }
    $dsql->SetQuery($query);
    $dsql->Execute("al");
    $artlist = "";
    $dtp2 = new DedeTagParse();
    $dtp2->SetNameSpace("field","[","]");
    $dtp2->LoadString($innertext);
    $GLOBALS['autoindex'] = 0;
    $ids = array();
    for($i=0;$i<$line;$i++)
    {
        for($j=0;$j<$col;$j++)
        {
            if($col>1) $artlist .= "    <div>\r\n";
            if($row = $dsql->GetArray("al"))
            {
                $ids[] = $row['aid'];

                $row['filename'] = $row['arcurl'] = GetFileUrl($row['id'],$row['typeid'],$row['senddate'],$row['title'],1,
                0,$row['namerule'],$row['typedir'],0,'',$row['moresite'],$row['siteurl'],$row['sitepath']);

                $row['typeurl'] = GetTypeUrl($row['typeid'],$row['typedir'],$row['isdefault'],$row['defaultname'],$row['ispart'],
                $row['namerule2'],$row['moresite'],$row['siteurl'],$row['sitepath']);

                if($row['litpic'] == '-' || $row['litpic'] == '')
                {
                    $row['litpic'] = $GLOBALS['cfg_cmspath'].'/images/defaultpic.gif';
                }
                if(!preg_match("#^http:\/\/#i", $row['litpic']) && $GLOBALS['cfg_multi_site'] == 'Y')
                {
                    $row['litpic'] = $GLOBALS['cfg_mainsite'].$row['litpic'];
                }
                $row['picname'] = $row['litpic'];
                
                $row['image'] = "<img src='".$row['picname']."' border='0' width='{$imgwidth}' height='{$imgheight}' alt='".preg_replace("#['><]#", "", $row['title'])."' />";

                $row['imglink'] = "<a href='".$row['filename']."'>".$row['image']."</a>";

                $row['stime'] = GetDateMK($row['pubdate']);
                $row['typelink'] = "<a href='".$row['typeurl']."'>".$row['typename']."</a>";
                $row['fulltitle'] = $row['title'];
                $row['title'] = cn_substr($row['title'],$titlelen);
                $row['textlink'] = "<a href='".$row['filename']."'>".$row['title']."</a>";
                $row['plusurl'] = $row['phpurl'] = $GLOBALS['cfg_phpurl'];
                $row['memberurl'] = $GLOBALS['cfg_memberurl'];
                $row['templeturl'] = $GLOBALS['cfg_templeturl'];

                if(is_array($dtp2->CTags))
                {
                    foreach($dtp2->CTags as $k=>$ctag)
                    {
                        if($ctag->GetName()=='array')
                        {
                            //�����������飬��runphpģʽ������������
                            $dtp2->Assign($k,$row);
                        }
                        else
                        {
                            if(isset($row[$ctag->GetName()])) $dtp2->Assign($k,$row[$ctag->GetName()]);
                            else $dtp2->Assign($k,'');
                        }
                    }
                    $GLOBALS['autoindex']++;
                }

                $artlist .= $dtp2->GetResult()."\r\n";
            }//if hasRow
            else{
                $artlist .= '';
            }
            if($col>1) $artlist .= "    </div>\r\n";
        }//Loop Col
        if($col>1) $i += $col - 1;
    }//loop line
    $dsql->FreeResult("al");
    //����ID����
    $idsstr = join(',',$ids);
    if($idsstr!='' && $needcache && $cfg_index_cache>0)
    {
        $mintime = time() - ($cfg_index_cache * 3600);
        $inquery = "INSERT INTO `#@__arccache`(`md5hash`,`uptime`,`cachedata`) VALUES ('".$md5hash."', '".time()."', '$idsstr'); ";
        $dsql->ExecuteNoneQuery("DELETE FROM `#@__arccache` WHERE md5hash='".$md5hash."' or uptime < $mintime ");
        $dsql->ExecuteNoneQuery($inquery);
    }
    return $artlist;
}

//��ѯ����
function GetArclistSgCache($md5hash)
{
    global $dsql,$envs,$cfg_makesign_cache,$cfg_index_cache;
    //û���û���
    if($cfg_index_cache<=0) return '';
    //�������½��û���
    if(isset($envs['makesign']) && $cfg_makesign_cache=='N') return '';
    //�������
    $mintime = time() - ($cfg_index_cache * 3600);
    $arr = $dsql->GetOne("SELECT cachedata,uptime FROM `#@__arccache` WHERE md5hash = '$md5hash' AND uptime > $mintime ");
    //û����
    if(!is_array($arr)) return '';
    //���ػ���id����
    else return $arr['cachedata'];
}

function lib_GetAutoChannelID2($sortid,$topid)
{
    global $dsql;
    if(empty($sortid)) $sortid = 1;
    $getstart = $sortid - 1;
    $row = $dsql->GetOne("SELECT id,typename From #@__arctype WHERE reid='{$topid}' AND ispart<2 AND ishidden<>'1' ORDER BY sortrank asc limit $getstart,1");
    if(!is_array($row)) return 0;
    else return $row['id'];
}