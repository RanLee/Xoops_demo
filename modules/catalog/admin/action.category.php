<?php
include 'header.php';
xoops_cp_header();

$ac = isset($_REQUEST['ac']) ? $_REQUEST['ac'] : ' ';
$cat_id = isset($_REQUEST['cat_id']) ? $_REQUEST['cat_id'] : '';
$category_handler = xoops_getmodulehandler('category','catalog');
$item_handler =& xoops_getmodulehandler('item', 'catalog');
$catbrand_handler = xoops_getmodulehandler('catbrand','catalog');
$brand_handler = xoops_getmodulehandler('brand','catalog');
switch ($ac) {
default:
case "save":
    xoops_load("cache");
    if (XoopsCache::read('config_categories')) {
        XoopsCache::delete('config_categories');
    }
    if (XoopsCache::read('config_menu_categories')) {
        XoopsCache::delete('config_menu_categories');
    }

    if (!$GLOBALS['xoopsSecurity']->check()) {
        redirect_header('admin.category.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
    }   
 
    if (isset($cat_id)) {
        $category_obj =& $category_handler->get($cat_id);
    } else {
        $category_obj =& $category_handler->create();
    }
    $cat_name = isset($_POST['cat_name']) ? $_POST['cat_name'] : '';
    foreach(array_keys($category_obj->vars) as $key) {
        if(isset($_POST[$key])) {
            $category_obj->setVar($key, $_POST[$key]);
        }
    }
    
    //level
    $pid = $_POST['cat_pid'];
    $cat_level = 1;
    if(!empty($pid)) {
        $pid_object = $category_handler->get($pid);
        $cat_level = $pid_object->getVar('cat_level')+1;
    }
    $category_obj->setVar('cat_level', $cat_level);
        
    if ($cat_id = $category_handler->insert($category_obj)) {
        $brand_ids = isset($_REQUEST['brand_ids']) ? $_REQUEST['brand_ids'] : '';
        $criteria = new Criteria('cat_id', $cat_id);
        if($catbrand_handler->getCount($criteria)) $catbrand_handler->deleteAll($criteria, true);
        if(is_array($brand_ids)){
            $criteria = new CriteriaCompo(new Criteria("brand_id","(".implode(", ",$brand_ids). ")","in"));
            $brands = $brand_handler->getList($criteria);
            foreach($brands as $brand_id=>$brand_name){
                $catbrand_obj =& $catbrand_handler->create();
                $catbrand_obj->setVar('cat_id', $cat_id);
                $catbrand_obj->setVar('brand_id', $brand_id);
                $catbrand_obj->setVar('brand_name', $brand_name);
                $catbrand_handler->insert($catbrand_obj);
                unset($catbrand_obj);
            }
        }else{
            $brand_object = $brand_handler->get($brand_ids);
            $brand_name = $brand_object->getVar('brand_name');
            $catbrand_obj =& $catbrand_handler->create();
            $catbrand_obj->setVar('cat_id', $cat_id);
            $catbrand_obj->setVar('brand_id', $brand_ids);
            $catbrand_obj->setVar('brand_name', $brand_name);
            $catbrand_handler->insert($catbrand_obj);
            unset($catbrand_obj);                 
        }    
        redirect_header('admin.category.php', 3, _AM_CATALOG_ACTIVSUCCESS);
    }else{
        redirect_header('admin.category.php', 3, _AM_CATALOG_ACTIVEERROR);
    }    
    break;

case 'delete':
    xoops_load("cache");
    if (XoopsCache::read('config_categories')) {
        XoopsCache::delete('config_categories');
    }
    if (XoopsCache::read('config_menu_categories')) {
        XoopsCache::delete('config_menu_categories');
    }
    $category_obj =& $category_handler->get($cat_id);
    if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {

        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('admin.category.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $category_image = $category_obj->getVar('cat_image');
        $logo_dir = XOOPS_ROOT_PATH . "/uploads/";
  
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('cat_pid', $cat_id));
        $criteria1 = new CriteriaCompo();
        $criteria1->add(new Criteria('cat_id', $cat_id),'OR');
        $criteria1->add(new Criteria('cat_pid', $cat_id),'OR');        
        if($category_handler->getCount($criteria) > 0 || $item_handler->getCount($criteria1) > 0 ) {
        redirect_header('admin.category.php', 3, _AM_CATALOG_DELETECATTIPS);
        }else{
              if ($category_handler->delete($category_obj)) {
                  if($category_image) unlink($logo_dir.$category_image);
                  redirect_header('admin.category.php', 3, _AM_CATALOG_DELETESUCCESS);
              } else {
                  echo $category_obj->getHtmlErrors();
              }        
        }

    } else {
        xoops_confirm(array('ok' => 1, 'cat_id' => $cat_id, 'ac' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_CATALOG_RESUREDELIT,$category_obj->getVar('cat_name')));
    }
    break;

}
    
include 'footer.php';

?>
