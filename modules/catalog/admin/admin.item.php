<?php
include 'header.php';
xoops_cp_header();
loadModuleAdminMenu(6);

$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : 'list';
$item_id = isset($_REQUEST['item_id']) ? trim($_REQUEST['item_id']) : '';
$weight = isset($_REQUEST['weight']) ? $_REQUEST['weight'] : '';

$item_handler = xoops_getmodulehandler('item','catalog');



$brand_handler = xoops_getmodulehandler('brand','catalog');
$category_handler = xoops_getmodulehandler('category','catalog');
$country_handler = xoops_getmodulehandler('country','catalog');



switch ($op) {
default:
case 'list':
    $start = isset( $_GET['start'] ) ? trim($_GET['start']) : 0;
    $ext = 'weight='.$weight;
   	$limit = $xoopsModuleConfig['items'];
    $criteria = new CriteriaCompo();
    $criteria->setLimit($limit);
    $criteria->setStart($start);

    if($weight == 'item_buildtime'){
        $criteria->setSort('item_buildtime');
        $criteria->setOrder('DESC');         
    }elseif($weight == 'modify_time'){
        $criteria->setSort('modify_time');
        $criteria->setOrder('DESC');        
    }else{
        $criteria->setSort('weight');
        $criteria->setOrder('ASC');
    } 



    $weight_list = array(
        ''=>_AM_CATALOG_DEFAULTSORT,
        'item_buildtime'=>_AM_CATALOG_CREATEITEMSHOW,
        'modify_time'=>_AM_CATALOG_UPDATEITEMSHOW
        );

    if ($item_handler->getCount($criteria) > $limit ){
        include_once XOOPS_ROOT_PATH.'/class/pagenav.php';  
        $pageNav = new XoopsPageNav($item_handler->getCount($criteria), $limit, $start, 'start', @$ext);
        $xoopsTpl->assign('pagenav', $pageNav->renderNav(4));
    }

    $items = $item_handler->getAll($criteria,null,false,true);

    

    
    $categories = $category_handler->getList();
    $brands = $brand_handler->getList();
    $countries = $country_handler->getList();
    foreach($items as $k=>$v){
        if(!empty($v['cat_id'])) $items[$k]['cat_secname'] = $categories[$v['cat_id']];                
        if(!empty($v['brand_id'])) $items[$k]['brand_name'] = $brands[$v['brand_id']];
        if(!empty($v['country_id'])) $items[$k]['country_name'] = $countries[$v['country_id']];        
        $items[$k]['create_time'] = formatTimestamp($v['create_time'],'Y/m/d');
    }
    $xoopsTpl->assign('xoops_dirname', $xoopsModule->dirname());
    $xoopsTpl->assign('weight', $weight);
    $xoopsTpl->assign('start', $start);
    $xoopsTpl->assign('weight_list', $weight_list);
    $xoopsTpl->assign('items', $items);
    $xoopsTpl->assign('showtype', $xoopsModuleConfig['display']);  
    $xoopsTpl->display("db:catalog_admin_item.html");
    break;
    
    case 'new':
    $item_obj =& $item_handler->create();
    $form = $item_obj->itemForm('action.item.php');
    $form->assign($xoopsTpl);
    $xoopsTpl->display("db:catalog_admin_item_form.html");
    break;
    
    case 'edit':
    $item_obj =& $item_handler->get($item_id);
    $form = $item_obj->itemForm('action.item.php');
    $form->assign($xoopsTpl);
    $xoopsTpl->assign('item_id', $item_id);
    $xoopsTpl->display("db:catalog_admin_item_form.html");
    break;
}
    
include 'footer.php';

?>
