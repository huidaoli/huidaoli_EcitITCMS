<?php  if(!defined('DEDEINC')) exit('dedecms');
/**
 * ��չС����
 *
 * @version        $Id: extend.helper.php 1 13:58 2010��7��5��Z tianya $ * @package        EcitITCMS.Helpers
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */

/**
 *  ����ָ�����ַ�
 *
 * @param     string  $n  �ַ�ID
 * @return    string
 */
if ( ! function_exists('ParCv'))
{
    function ParCv($n)
    {
        return chr($n);
    }
}


/**
 *  ��ʾһ������
 *
 * @return    void
 */
if ( ! function_exists('ParamError'))
{
    function ParamError()
    {
        ShowMsg('�Բ���������Ĳ�������','javascript:;');
        exit();
    }
}

/**
 *  Ĭ������
 *
 * @param     string  $oldvar  �ɵ�ֵ
 * @param     string  $nv      ��ֵ
 * @return    string
 */
if ( ! function_exists('AttDef'))
{
    function AttDef($oldvar, $nv)
    {
        return empty($oldvar) ? $nv : $oldvar;
    }
}


/**
 *  ����Ajaxͷ��Ϣ
 *
 * @return     void
 */
if ( ! function_exists('AjaxHead'))
{
    function AjaxHead()
    {
        @header("Pragma:no-cache\r\n");
        @header("Cache-Control:no-cache\r\n");
        @header("Expires:0\r\n");
    }
}

/**
 *  ȥ��html��php���
 *
 * @return     string
 */
if ( ! function_exists('dede_strip_tags'))
{
	function dede_strip_tags($str) { 
	    $strs=explode('<',$str); 
	    $res=$strs[0]; 
	    for($i=1;$i<count($strs);$i++) 
	    { 
	        if(!strpos($strs[$i],'>')) 
	            $res = $res.'&lt;'.$strs[$i]; 
	        else 
	            $res = $res.'<'.$strs[$i]; 
	    } 
	    return strip_tags($res);    
	} 
}

