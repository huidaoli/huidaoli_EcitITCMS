<?php   if(!defined('DEDEINC')) exit("Request Error!");
/**
 * 模型基类
 *
 * @version        $Id: model.class.php 1 13:46 2010-12-1 tianya $ * @package        EcitITCMS.Libraries
* @copyright      Copyright (c) 2007 - 2010, EcitITDev, Inc.
 * @license        http://www.ecit-it.com
 * @link           http://www.ecit-it.com
 */

class Model
{
    var $dsql;
    var $db;
    
    // 析构函数
    function Model()
    {
        global $dsql;
        if ($GLOBALS['cfg_mysql_type'] == 'mysqli')
        {
            $this->dsql = $this->db = isset($dsql)? $dsql : new DedeSqli(FALSE);
        } else {
            $this->dsql = $this->db = isset($dsql)? $dsql : new DedeSql(FALSE);
        }
            
    }
    
    // 释放资源
    function __destruct() 
    {
        $this->dsql->Close(TRUE);
    }
}