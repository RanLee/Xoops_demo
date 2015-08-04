<?php
include 'header.php';
xoops_cp_header();
loadModuleAdminMenu(4, "");
include_once dirname(dirname(__FILE__)) . "/include/functions.php";

$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : 'list';
$cat_id = isset($_REQUEST['cat_id']) ? trim($_REQUEST['cat_id']) : '';

$category_handler = xoops_getmodulehandler('category','catalog');

switch ($op) {
default:
case 'list':
    $cat_weight = isset($_REQUEST['cat_weight']) ? $_REQUEST['cat_weight'] : '';
    if(!empty($cat_weight)){
        $ac_weight = ContentOrder($cat_weight, 'category', 'cat_weight');
        if(!empty($ac_weight)) redirect_header('admin.category.php', 3, _AM_CATALOG_UPDATEDSUCCESS);
    }

    $categories =& $category_handler->getTrees(0, "&nbsp;&nbsp;&nbsp;&nbsp;"); 
    foreach($categories as $k=>$v){            
        $categories[$k]['cat_published'] = formatTimestamp($v['cat_published'],'Y/m/d');          
    }
    $xoopsTpl->assign('categories', $categories);
    $xoopsTpl->assign('xoops_dirname', $xoopsModule->dirname());
    $template_main = "catalog_admin_category.html";
    break;

case 'new':
    $category_obj =& $category_handler->create();
    $action = 'action.category.php';
    $form = $category_obj->getForm($action);
    $form->display();
    break;

case 'edit':
    $category_obj =& $category_handler->get($cat_id);
    $action = 'action.category.php';
    $form = $category_obj->getForm($action);
    $form->display();
    break;

}
    
include 'footer.php';

?>