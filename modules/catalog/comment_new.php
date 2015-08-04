<?php
include '../../mainfile.php';

$com_itemid = isset($_REQUEST['com_itemid']) ? intval($_REQUEST['com_itemid']) : 0;
$item_handler =& xoops_getmodulehandler('item', 'catalog');
$item_obj = $item_handler->get($com_itemid);
$com_replytitle = $item_obj->getVar('item_name');

include XOOPS_ROOT_PATH.'/include/comment_new.php';

?>
