<?php
require_once(dirname(__FILE__).'/../../include/common.inc.php');
//�ɹ�������Ϣ
$dsql->ExecuteNoneQuery("Update `#@__sys_task` set sta='�ɹ�' where dourl='dede-maketimehtml.php' ");
echo "Welcome to EcitITCMS!";
exit();
?>