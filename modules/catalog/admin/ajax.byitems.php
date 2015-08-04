<?php
include 'header.php';
header('Content-Type:text/html; charset='._CHARSET);

global $xoopsLogger;
//$xoopsLogger->activated = false;

$cat_id = isset($_REQUEST['cat_id']) ? trim($_REQUEST['cat_id']) : '';
$item_id = isset($_REQUEST['item_id']) ? $_REQUEST['item_id'] : '';

$item_handler = xoops_getmodulehandler('item','catalog');
$byitem_handler = xoops_getmodulehandler('itembyitems','catalog');
$brand_handler = xoops_getmodulehandler('brand','catalog');

//item
$item_obj = $item_handler->get($item_id);
$item = $item_obj->getValues(null, 'n');
$xoopsTpl->assign('item', $item);

//by_itmes
$byitemsids = '';
$criteria = new Criteria('item_id', $item_id);
$byitemsids = $byitem_handler->getAll($criteria, null, false);

if(!empty($byitemsids)) {
    foreach($byitemsids as $v) {
        $byitem_ids[$v['by_item_id']] = $v['by_item_id'];
    }
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria("item_id","(".implode(", ",$byitem_ids). ")","in"), 'AND');
    $by_items = $item_handler->getList($criteria);
    
    $xoopsTpl->assign('by_items', $by_items);
}

$criteria = new Criteria('cat_id', $cat_id);
$items = $item_handler->getAll($criteria, array('cat_id', 'brand_id', 'item_name'), false);
if(!empty($items)) {
    $byitem_ids[$item_id] = $item_id;
    foreach ($items as $k=>$v) {
        $ids[$v['brand_id']] = $v['brand_id'];
    }
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria("brand_id","(".implode(", ",$ids). ")","in"), 'AND');
    $brands = $brand_handler->getList($criteria);
    foreach ($items as $k=>$v) {
        $items[$k]['brand'] = $brands[$v['brand_id']];
        $items[$k]['checkbox'] = isset($byitem_ids[$k]) ? 0 : 1;
    }
}

$xoopsTpl->assign('cat_id', $cat_id);
$xoopsTpl->assign('item_id', $item_id);
$xoopsTpl->assign('items', $items);
$xoopsTpl->assign('byitem_ids', $byitem_ids);
$xoopsTpl->display("db:catalog_admin_ajax_byitems.html");
?>
