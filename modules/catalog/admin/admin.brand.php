<?php
include 'header.php';
xoops_cp_header();
loadModuleAdminMenu(3, "");

$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : 'list';
$brand_id = isset($_REQUEST['brand_id']) ? trim($_REQUEST['brand_id']) : '';
$brand_name = isset($_REQUEST['brand_name']) ? trim($_REQUEST['brand_name']) : '';

$brand_handler = xoops_getmodulehandler('brand','catalog');
$country_handler = xoops_getmodulehandler('country','catalog');
$item_handler = xoops_getmodulehandler('item','catalog');
switch ($op) {
default:
case 'list':
    include_once XOOPS_ROOT_PATH . "/class/pagenav.php";
    $start = isset($_GET["start"]) ? intval($_GET["start"]) : 0;     
   	$items_perpage = $xoopsModuleConfig['brands'];    
    $total = intval($brand_handler->getCount());
    $pagenav = new XoopsPageNav($total, $items_perpage, $start, "start");
    $criteria = new CriteriaCompo();
    $criteria = new Criteria('brand_name', '%'.$brand_name.'%', 'like');
    $criteria->setSort('brand_weight');
    $criteria->setOrder('ASC');
    $criteria->setLimit($items_perpage);
    $criteria->setStart($start);
    $brands = $brand_handler->getAll($criteria,null,false,true);
    $countries = $country_handler->getList();   
    foreach($brands as $k=>$v){            
    $brands[$k]['brand_published'] = formatTimestamp($v['brand_published'],'Y/m/d');    
    if(!empty($v['country_id']))$brands[$k]['country_name'] = $countries[$v['country_id']];      
    }
    
    $xoopsTpl->assign('pagenav', $pagenav->renderNav());
    $xoopsTpl->assign('brands', $brands);
    $xoopsTpl->assign('brand_name', $brand_name);
    $xoopsTpl->assign('xoops_dirname', $xoopsModule->dirname());
    $template_main = "catalog_admin_brand.html";
    break;

case 'new':
    $brand_obj =& $brand_handler->create();
    $action = 'action.brand.php';
    $form = $brand_obj->brandForm($action);
    $form->display();
    break;

case 'edit':
    $brand_obj =& $brand_handler->get($brand_id);
    $action = 'action.brand.php';
    $form = $brand_obj->brandForm($action);
    $form->display();
    break;

case "delete":
    $brand_obj =& $brand_handler->get($brand_id);
    if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('admin.brand.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $criteria = new Criteria('brand_id', $brand_id);        
        if($item_handler->getCount($criteria) > 0 ) redirect_header('admin.brand.php', 3, _AM_CATALOG_DELETEBRANDTIPS);
        if ($brand_handler->delete($brand_obj)) {
            redirect_header('admin.brand.php', 3, _AM_CATALOG_DELETESUCCESS);
        } else {
            echo $brand_obj->getHtmlErrors();
        }
    } else {
        xoops_confirm(array('ok' => 1, 'id' => $brand_id, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_CATALOG_RESUREDELIT,$brand_obj->getVar('brand_name')));
    }
    break;                                                                                               
}
    
include 'footer.php';

?>