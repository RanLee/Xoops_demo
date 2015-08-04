<?php

include "header.php";
include_once "include/functions.php";

$item_id = empty($_GET['item']) ? 0 : intval($_GET['item']);
$uid = (is_object($xoopsUser)) ? $xoopsUser->getVar("uid") : 0;
$ip = item_getIP();
if (empty($item_id)) return;
if (item_getcookie("item_" . $item_id) > 0) return;
$item_handler =& xoops_getmodulehandler('item', 'catalog');

$counter_handler =& xoops_getmodulehandler('itemcounter', 'catalog');
$counter_obj =& $counter_handler->create();
$counter_obj->setVar("item_id", $item_id );
$counter_obj->setVar("uid", $uid);
$counter_obj->setVar("ip", $ip);
$counter_obj->setVar("counter_time",  time());
$counter_handler->insert($counter_obj, true);


$item_obj =& $item_handler->get($item_id);
$item_obj->setVar( "item_counter", $item_obj->getVar("item_counter") + 1, true );
$item_handler->insert($item_obj, true);
item_setcookie("item_" . $item_id, time());

return;
?>