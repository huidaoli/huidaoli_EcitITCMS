<?php  if(!defined('DEDEINC')) exit('dedecms');
/**
 * ��֤С����
 *
 * @version        $Id: validate.helper.php 1 2010-07-05 11:43:09Z tianya $ * @package        EcitITCMS.Helpers
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */

//�����ʽ���
if ( ! function_exists('CheckEmail'))
{
    function CheckEmail($email)
    {
        if (!empty($email))
        {
            return preg_match('/^[a-z0-9]+([\+_\-\.]?[a-z0-9]+)*@([a-z0-9]+[\-]?[a-z0-9]+\.)+[a-z]{2,6}$/i', $email);
        }
        return FALSE;
    }
}

