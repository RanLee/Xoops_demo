<?php
include_once 'header.php';

$cat_id = isset($_REQUEST['cat_id']) ? intval($_REQUEST['cat_id']) : '';
$brand_id = isset($_REQUEST['brand_id']) ? intval($_REQUEST['brand_id']) : '';
$seltype = isset($_REQUEST['seltype']) ? $_REQUEST['seltype'] : '';
$selweight = isset($_REQUEST['selweight']) ? $_REQUEST['selweight'] : '';

$cat_handler =& xoops_getmodulehandler('category', 'catalog');
$item_handler =& xoops_getmodulehandler('item', 'catalog');
$brand_handler =& xoops_getmodulehandler('brand', 'catalog');


$cat_obj =& $cat_handler->get($cat_id);
if(!is_object($cat_obj) || (empty($cat_id)  && empty($brand_id)) ) redirect_header('index.php', 3, _MD_CATALOG_NOCATEGORY);

$brand_obj =& $brand_handler->get($brand_id);
if(!is_object($brand_obj) || (empty($cat_id)  && empty($brand_id)) ) redirect_header('index.php', 3, _MD_CATALOG_NOBRAND);

$category = $cat_obj->getValues(null, 'n');
$xoopsOption['template_main'] = catalog_getTemplate("category", $category['cat_tpl']);
include_once XOOPS_ROOT_PATH.'/header.php';


global  $xoopsDB;	
$dbnane=$xoopsDB->prefix('catalog_category');
   
$sql="select  *  from  $dbnane where `cat_id`= '$cat_id'";  
$result = $xoopsDB -> query($sql) or die($sql);
list($cat_id,$cat_name,$cat_unit,$cat_image,$cat_pid,$type_id,$cat_keywords,$cat_description,$isnav,$cat_status,$cat_weight,$cat_level,$cat_properties,$cat_tpl,$cat_tpl_css,$cat_published,$cattext) = $xoopsDB -> fetchRow($result);
$xoopsTpl->assign('cattext', $cattext);


$criteria = new CriteriaCompo();
if (!empty($cat_id)){
    include_once XOOPS_ROOT_PATH . "/class/pagenav.php";
    $ext = 'cat_id='.$cat_id.'&seltype='.$seltype.'&selweight='.$selweight;

        $category_ids = $cat_handler->getTrees($cat_id);
        foreach($category_ids as $k=>$v) {
            $cat_ids[] = $k;
        }        
        if(count($cat_ids) != 1) {
            $criteria->add(new Criteria("cat_id","(".implode(", ",$cat_ids). ")","in"), 'AND');
        } else {
            $criteria->add(new Criteria("cat_id", current($cat_ids)), 'AND');
        }  
    $items_perpage =  $xoopsModuleConfig['index_item_limit'];
    $criteria->setLimit($items_perpage);    
}

if (!empty($brand_id)){
    include_once XOOPS_ROOT_PATH . "/class/pagenav.php";
    $ext = 'brand_id='.$brand_id;
    $criteria->add(new Criteria('brand_id', $brand_id));
    $items_perpage =  $xoopsModuleConfig['branditems'];
    $criteria->setLimit($items_perpage);
}

$start = isset($_GET["start"]) ? intval($_GET["start"]) : 0;
$criteria->setStart($start);
$total = intval($item_handler->getCount($criteria));
$pagenav = new XoopsPageNav($total, $items_perpage, $start, "start", @$ext);
$xoopsTpl->assign('pagenav', $pagenav->renderNav());
     
if($selweight == 'descending'){ 
    $itemsort =  'DESC';
}else{
    $itemsort =  'ASC';
}
     
if($seltype == 'shop_price'){
    $criteria->setSort('shop_price');
    $criteria->setOrder($itemsort);
}elseif($seltype == 'rating'){
    $criteria->setSort('rating');
    $criteria->setOrder($itemsort);
}else{
    $criteria->setSort('create_time');
    $criteria->setOrder($itemsort);
}

$seltype_list = array(
    'create_time'=>_MD_CATALOG_BULIDDATE,
    'shop_price'=>_MD_CATALOG_PRICE,
    'rating'=>_MD_CATALOG_RATING,
    );
$selweight_list = array(
    'ascending'=>_MD_CATALOG_ASC,
    'descending'=>_MD_CATALOG_DESC
    );    


$items = $item_handler->getAll($criteria,null,false);
foreach($items as $k=>$v) {
    //rates 
    $items[$k]['rating'] = !empty($v['rates']) ? number_format($v['rating']/$v['rates'], 2) : 0;
    $items[$k]['type1'] = !empty($v['rates']) ? number_format($v['type1']/$v['rates'], 2) : 0;
    $items[$k]['type2'] = !empty($v['rates']) ? number_format($v['type2']/$v['rates'], 2) : 0;
    $items[$k]['type3'] = !empty($v['rates']) ? number_format($v['type3']/$v['rates'], 2) : 0;
    $items[$k]['type4'] = !empty($v['rates']) ? number_format($v['type4']/$v['rates'], 2) : 0;
    $items[$k]['type5'] = !empty($v['rates']) ? number_format($v['type5']/$v['rates'], 2) : 0;
}

$xoopsTpl->assign('seltype_list', $seltype_list);
$xoopsTpl->assign('selweight_list', $selweight_list);
$xoopsTpl->assign('cat_id', $cat_id);
$xoopsTpl->assign('brand_id', $brand_id);
$xoopsTpl->assign('seltype', $seltype);
$xoopsTpl->assign('selweight', $selweight);
$xoopsTpl->assign('items', $items);
$xoopsTpl->assign('items_width', $xoopsModuleConfig['picturewidth']);

// get bread
xoops_load("cache");
if (!$menu = XoopsCache::read('config_menu_categories')) {
    $menu = $cat_handler->getAll(null, null, false);
    $menu = XoopsCache::write('config_menu_categories', $menu);
}
//$menu = $cat_handler->getAll(null, null, false);
$beand = array_reverse($cat_handler->getBread($menu,$cat_id), true);
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

xoops_load("cache");
if (!$categories = XoopsCache::read('config_categories')) {
    $categories =& $cat_handler->getTrees($pid = 0, $prefix = "--");
    $categories = XoopsCache::write('config_categories', $categories);
}
foreach ($categories as $id => $cat) {
    $cat_options[$id] = $cat["prefix"] . $cat["cat_name"];
}
$xoopsTpl->assign('cat_options', $cat_options);
$xoopsTpl->assign('cat_id', $cat_id);

include 'footer.php'; 
?>
