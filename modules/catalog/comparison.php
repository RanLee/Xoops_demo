<?php
include_once 'header.php';
include_once "include/functions.php";

$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : 'list';
$item_id = isset($_REQUEST['item_id']) ? intval($_REQUEST['item_id']) : '';

$item_handler =& xoops_getmodulehandler('item', 'catalog');

$cookie_item_ids = item_getcookie('favorites');
$item_ids = '';
if(!empty($cookie_item_ids)) {
    foreach($cookie_item_ids as $k=>$v){
        $item_ids[$k] = $k;
    }
    if (!empty($item_id)){
        item_setcookie("favorites[" . $item_id . "]", time());
        $item_ids[$item_id] = $item_id;
        $item_ids = array_unique($item_ids);
    }
} else {
    $op = 'notcookie';
}
switch ($op) {
    case 'list':
    $xoopsOption['template_main'] = 'catalog_comparison.html';
    include_once XOOPS_ROOT_PATH.'/header.php';
    
    $sort = isset($_POST['sort']) ? trim($_POST['sort']) : '';    
    $order = isset($_POST['order']) ? trim($_POST['order']) : '';

    
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria("item_id","(".implode(", ",$item_ids). ")","in"), 'AND');
    
    if ($sort == 'greenep_id'){
        $criteria->setSort('greenep_id');
    } elseif ($sort == 'rating'){
        $criteria->setSort('rating');
    } elseif ($sort == 'item_size'){
        $criteria->setSort('item_size');
    } elseif ($sort == 'item_weight'){
        $criteria->setSort('item_weight'); 
    } elseif ($sort == 'item_repairtime'){
        $criteria->setSort('item_repairtime');
    } else {
        $criteria->setSort('shop_price');
    }
    
    if ($order == 'desc'){
        $criteria->setOrder('DESC');
    } else {
        $criteria->setOrder('ASC');
    }
    
    $items = $item_handler->getAll($criteria, null, false);    
    foreach($items as $k=>$v) {
        $_item_ids[] = $k;
            if($v['rates']) $items[$k]['rating'] = number_format($v['rating']/$v['rates'], 2);         
    }
    if(array_diff($item_ids, $_item_ids)) {
        foreach (array_diff($item_ids, $_item_ids) as $id) {
            item_setcookie("favorites[" . $id . "]", '',time()-1);
        }
    }
    $xoopsTpl->assign('items', $items);
    $xoopsOption['xoops_pagetitle'] = _MD_CATALOG_ITEMCOMPARE;
    $xoBreadcrumbs[] = array('title' => _MD_CATALOG_ITEMCOMPARE);
    break;
    
    case 'delete':
    include_once XOOPS_ROOT_PATH.'/header.php';
    
    if (in_array($item_id, $item_ids)) {
        item_setcookie("favorites[" . $item_id . "]", '',time()-1);
        redirect_header('comparison.php', 3, _MD_CATALOG_DELETESUCCESS);
    } else {
        redirect_header('comparison.php', 3, _MD_CATALOG_NOITEM);
    }
    break;
    
    case 'deleteAll':
    include_once XOOPS_ROOT_PATH.'/header.php';
    
    $del_ids = isset($_REQUEST['item']) ? $_REQUEST['item'] : '';
    foreach ($del_ids as $id) {
        if (in_array($id, $item_ids)) {
            item_setcookie("favorites[" . $id . "]", '',time()-1);
        }
    }
    redirect_header('comparison.php#A', 3, _MD_CATALOG_DELETESUCCESS);
    break;
    
    case 'notcookie':
    $xoopsOption['template_main'] = 'catalog_comparison.html';
    include_once XOOPS_ROOT_PATH.'/header.php';
    $xoopsOption['xoops_pagetitle'] = _MD_CATALOG_ITEMCOMPARE;
    $xoBreadcrumbs[] = array('title' => _MD_CATALOG_ITEMCOMPARE);
    break;
}

if (!empty($xoopsUser)) {
    $name = $xoopsUser->getVar('name');
    if(empty($name)) $name = $xoopsUser->getVar('uname');
    $xoopsTpl->assign('name', $name);
}

include_once 'footer.php';
?>
