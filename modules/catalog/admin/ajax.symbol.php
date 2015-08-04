<?php
include_once '../../../mainfile.php';
header('Content-Type:text/html; charset='._CHARSET);

global $xoopsLogger;
$xoopsLogger->activated = false;

$link_id = isset($_GET['link_id']) ? intval($_GET['link_id']) : '';

$link_handler = xoops_getmodulehandler('symbol', 'symbol');

$link_obj =& $link_handler->get($link_id);

$link_img = XOOPS_URL . "/uploads/symbol/" . $link_obj->getVar("link_image");

echo '<img src="'.$link_img.'" />';

?>
