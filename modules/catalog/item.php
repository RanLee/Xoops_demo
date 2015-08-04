<?php

include_once 'header.php';

$item_id = isset($_REQUEST['item_id']) ? intval($_REQUEST['item_id']) : '';

$item_handler =& xoops_getmodulehandler('item', 'catalog');
$brand_handler = xoops_getmodulehandler('brand','catalog');
$search_handler =& xoops_getmodulehandler('search', 'catalog');
$greenep_handler = xoops_getmodulehandler('greenep','catalog');
$link_handler =& xoops_getmodulehandler('symbol', 'symbol');
$category_handler = xoops_getmodulehandler('category','catalog');
$reseller_handler =& xoops_getmodulehandler('reseller', 'reseller');
$byitem_handler = xoops_getmodulehandler('itembyitems','catalog');
$att_handler =& xoops_getmodulehandler('attachment', 'catalog');
include_once "include/functions.php";

$item_obj = $item_handler->get($item_id);
if(!is_object($item_obj)) redirect_header('index.php', 3, _MD_CATALOG_NOTHISITEM);
$item = $item_obj->getValues(null, 'n');

$comparison = isset($_REQUEST['comparison']) ? intval($_REQUEST['comparison']) : '';
$action = isset($_REQUEST['action']) ? intval($_REQUEST['action']) : '';

if(!empty($action) && $action == 1) {
    if(!empty($comparison)) {
        item_setcookie("favorites[" . $item_id . "]", $item_id, 3600*24);
    } else {
        item_setcookie("favorites[" . $item_id . "]", '',time()-1);
    }
    redirect_header('item.php?item_id='.$item_id.'&#A', 3, _MD_CATALOG_SAVED);
}

$xoopsOption['template_main'] = catalog_getTemplate('item', $item['item_tpl']);
include_once XOOPS_ROOT_PATH.'/header.php';

/*
//set pid
if($item['cat_pid']){
    $category_obj = $category_handler->get($item['cat_pid']);
    $item['cat_pname'] = $category_obj->getVar('cat_name');
    $xoBreadcrumbs[] = array("title" => $item['cat_pname'], 'link' =>  'itemlist.php?cat_id='. $item['cat_pid'] );
} else {
    $item['cat_name'] = '沒有選擇類別';
}

//set cid
if($item['cat_id']){
    $category_obj = $category_handler->get($item['cat_id']);
    $item['cat_name'] = $category_obj->getVar('cat_name');
    $xoBreadcrumbs[] = array("title" => $item['cat_name'], 'link' =>  'itemlist.php?cat_id='. $item['cat_id'] );
} else {
    $item['cat_name'] = _MD_CATALOG_NOCHOICECAT;
}
*/
// get bread
xoops_load("cache");
if (!$menu = XoopsCache::read('config_menu_categories')) {
    $menu = $category_handler->getAll(null, null, false);
    $menu = XoopsCache::write('config_menu_categories', $menu);
}

$beand = array_reverse($category_handler->getBread($menu,$item['cat_id']), true);

if(!empty($beand)) {
    foreach($beand as $k=>$v) {
        if($k != $cat_id) {
            $xoBreadcrumbs[] = array("title" => $v, 'link' =>  XOOPS_URL . '/modules/catalog/itemlist.php?cat_id='.$k);
        } else {
            $xoBreadcrumbs[] = array("title" => $v);
        }
        $tree_open[$k] = $k;
    }
    $xoopsTpl->assign('tree_open',  $tree_open);
}

$item['cat_name'] = '';
if(!empty($item['cat_id'])) {
    $category_obj = $category_handler->get($item['cat_id']);
    if(is_object($category_obj)) $item['cat_name'] = $category_obj->getVar('cat_name');
}

//set brand
if($item['brand_id']){
    $brand_obj = $brand_handler->get($item['brand_id']);
    $item['brand_name'] = $brand_obj->getVar('brand_name');
}           
//set greenep
if($item['greenep_id']){
    $greenep_obj = $greenep_handler->get($item['greenep_id']);
    $item['greenep_logo'] = $greenep_obj->getVar('greenep_logo');
}
 
/*
if($item['link_id']){
    $link_obj = $link_handler->get($item['link_id']);
    $item['symbol_logo'] = $link_obj->getVar('link_image');
}
*/
//set symbol_logo=link_image
if($item['link_id']){
    $criteria = new Criteria('link_id','('.$item['link_id'].')', 'IN');                
    $link_objs = $link_handler->getAll($criteria, null, false);
    foreach($link_objs as $k => $v) {
        $link_objs[$k]['link_image'] = XOOPS_URL . '/uploads/symbol/' . $v['link_image'];
    }
    $xoopsTpl->assign('symbols',$link_objs); 
}
//set reseller
if($item['reseller_ids']){
    $module_handler =& xoops_gethandler('module');
    $mod_links = $module_handler->getByDirname('reseller');
    $mid = $mod_links->getVar('mid');
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('conf_modid', $mid));
    $criteria->add(new Criteria('conf_name', 'logo'));
    $config_handler =& xoops_gethandler('config');
    $config = current($config_handler->getConfigs($criteria, true));
    $con_log = $config->getVar('conf_value');
    
    $reseller_handler =& xoops_getmodulehandler('reseller', 'reseller');
    $criteria = new Criteria('link_id','('.$item['reseller_ids'].')', 'IN');                
    $reseller_objs = $reseller_handler->getAll($criteria, null, false);
    foreach($reseller_objs as $k => $v) {
        if($con_log) {
            $reseller_objs[$k]['link_image'] = XOOPS_URL . '/uploads/reseller/' . $v['link_image'];
        } else {
            $reseller_objs[$k]['link_image'] = $v['link_dir'];
        }
            if($v['reseller_rates']) $reseller_objs[$k]['reseller_rating'] = number_format($v['reseller_rating']/$v['reseller_rates'], 2);
    }
    $xoopsTpl->assign('resellers',$reseller_objs); 
}

//gallery
$search_handler->setItemIds(array($item_id));
$item['relevance'] = $search_handler->getRelevance();
if(empty($item['relevance']['picture'])) {
    $item['relevance']['picture'][0] = array('item_id'=> $item_id, 'pic_path' => $item['item_picture']);
}

//picture 
$item['item_picture'] = !empty($item['item_picture']) ? XOOPS_URL . '/uploads/gallery/' . $item['item_picture'] : XOOPS_URL . '/modules/catalog/images/nopic.gif';

//rates
$item['rating'] = $item_obj->getRatingAverage('rating');
$item['type1'] = $item_obj->getRatingAverage('type1');
$item['type2'] = $item_obj->getRatingAverage('type2');
$item['type3'] = $item_obj->getRatingAverage('type3');
$item['type4'] = $item_obj->getRatingAverage('type4');
$item['type5'] = $item_obj->getRatingAverage('type5');

//create time
$item['create_time'] = formatTimestamp($item['create_time'],'Y/m/d');

//by_itmes
$criteria = new Criteria('item_id', $item_id);
$byitemsids = $byitem_handler->getAll($criteria, null, false);
if(!empty($byitemsids)) {
    foreach($byitemsids as $v) {
        $byitem_ids[$v['by_item_id']] = $v['by_item_id'];
    }
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria("item_id","(".implode(", ",$byitem_ids). ")","in"), 'AND');
    $item['by_items'] = $item_handler->getAll($criteria, null, false);
}

//  cookie favorites
$cookie_item_ids = item_getcookie('favorites');
$item_ids = '';
if($cookie_item_ids) {
    foreach($cookie_item_ids as $k=>$v){
        $item_ids[$k] = $k;
    }
    $item_ids = array_unique($item_ids);
    if (in_array($item_id, $item_ids)) $item['comparison'] = 1;
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria("item_id","(".implode(", ",$item_ids). ")","in"), 'AND');
    $cookie_items = $item_handler->getAll($criteria, array('item_name', 'item_picture'), false);
    $xoopsTpl->assign('cookie_items', $cookie_items);
}

// compare items
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('cat_id', $item['cat_id']));
//$criteria->add(new Criteria('cat_pid', $item['cat_pid']));
$criteria->add(new Criteria('compare_status', $item['compare_status']));
$compare_items = $item_handler->getAll($criteria, array('item_name', 'item_picture'), false); 
unset($compare_items[$item_id]);
$xoopsTpl->assign('compare_items', $compare_items);

//display of item for elements 
$xoopsTpl->assign('item', $item);

//compare_item
unset($criteria);
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('item_id',$item_id,'!='));
$criteria->add(new Criteria('cat_id',$item_obj->getVar('cat_id')));
$criteria->add(new Criteria('shop_price',$item_obj->getVar('shop_price')));
$criteria->add(new Criteria('greenep_id',$item_obj->getVar('greenep_id')));
$criteria->add(new Criteria('rating',$item_obj->getVar('rating')));
$criteria->add(new Criteria('item_size',$item_obj->getVar('item_size')));
$criteria->add(new Criteria('item_weight',$item_obj->getVar('item_weight')));
$criteria->add(new Criteria('item_repairtime',$item_obj->getVar('item_repairtime')));

$compareitem = $item_handler->getAll($criteria, null, false);
$xoopsTpl->assign('compareitem', $compareitem);

$xoBreadcrumbs[] = array("title" => $item['item_name'],"repairtime" => $item['item_repairtime']);

//category
$cat_handler = xoops_getmodulehandler('category','catalog');

$cid = isset( $_REQUEST['cid'] ) ? trim($_REQUEST['cid']) : '';
/*
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('cat_status', 1));
$criteria->setSort('cat_weight');
$criteria->setOrder('ASC');
$categories = $cat_handler->getAll($criteria, null, false);
$_categories = $categories;
foreach ($categories as $k=>$v) {
    foreach ($_categories as $key=>$val) {
        if($val['cat_pid'] == $k) {
            $categories[$k]['child'][$key] = $val;
            unset($categories[$key]);
        }
    }
}
*/
xoops_load("cache");
if (!$categories = XoopsCache::read('config_categories')) {
    $categories =& $cat_handler->getTrees($pid = 0, $prefix = "--");
    $categories = XoopsCache::write('config_categories', $categories);
}
foreach ($categories as $id => $cat) {
    $cat_options[$id] = $cat["prefix"] . $cat["cat_name"];
}
$xoopsTpl->assign('cat_options', $cat_options);
$xoopsTpl->assign('cid', $cid);

global  $xoopsModuleConfig;
$itemdescription = $xoopsModuleConfig['itemdescription'];
$xoopsTpl->assign('itemdescription', $itemdescription);

//reservation
$xoopsTpl->assign('reservationItem', urlencode($item_obj->getVar('item_name')));

//annex
$criteria = new Criteria('item_id', $item_id);
$files = $att_handler->getAll($criteria, null, false);
$xoopsTpl->assign('files', $files);        
//set comment
include XOOPS_ROOT_PATH.'/include/comment_view.php';
include_once 'footer.php';
?>
