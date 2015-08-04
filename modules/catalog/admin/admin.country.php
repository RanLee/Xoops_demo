<?php
include 'header.php';
xoops_cp_header();
loadModuleAdminMenu(2, "");

$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : 'list';
$country_id = isset($_REQUEST['country_id']) ? trim($_REQUEST['country_id']) : '';

$country_handler = xoops_getmodulehandler('country','catalog');
$brand_handler = xoops_getmodulehandler('brand','catalog');
$item_handler = xoops_getmodulehandler('item','catalog');

switch($op) {
default:
case "list":
    include_once XOOPS_ROOT_PATH . "/class/pagenav.php";

    $start = isset($_GET["start"]) ? intval($_GET["start"]) : 0;     
   	$items_perpage = $xoopsModuleConfig['countries'];
    
    $total = intval($country_handler->getCount());
    $pagenav = new XoopsPageNav($total, $items_perpage, $start, "start");

    include_once dirname(dirname(__FILE__)) . "/include/functions.php";
    $country_weight = isset($_POST['country_weight']) ? $_POST['country_weight'] : ''; 
    if($country_weight) ContentOrder($country_weight, 'country', 'country_weight');   
     
    $country = isset($_POST['country']) ? $_POST['country'] : ''; 
    if($country){ 
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('country_id','('.implode(',',$country).')','IN'));
    $country_handler->deleteAll($criteria, true);
    redirect_header('admin.country.php', 3, _AM_CATALOG_ACTIVSUCCESS);   
    } 
          
    $criteria = new CriteriaCompo();
    $criteria->setSort('country_weight');
    $criteria->setOrder('ASC');
    $criteria->setLimit($items_perpage);
    $criteria->setStart($start);
    $country = $country_handler->getAll($criteria, null, false, false);
    foreach($country as $k=>$v){            
    $country[$k]['add_time'] = formatTimestamp($v['add_time'],'Y/m/d');         
    }
    $xoopsTpl->assign('pagenav', $pagenav->renderNav());
    $xoopsTpl->assign('countries',$country);
    $template_main = "catalog_admin_country.html";
    break;

case "new":
    $country_obj =& $country_handler->create();
    $form = $country_obj->countryForm();
    $form->display();
    break;

case "edit":
    $country_obj = $country_handler->get($country_id);
    $form = $country_obj->countryForm();
    $form->display();
    break;

case "save":
    if (!$GLOBALS['xoopsSecurity']->check()) {
        redirect_header('admin.country.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
    }
    if (isset($country_id)) {
        $country_obj =& $country_handler->get($country_id);
    } else {
        $country_obj =& $country_handler->create();
    }

        foreach(array_keys($country_obj->vars) as $key) {
        if(isset($_POST[$key])) {
            $country_obj->setVar($key, $_POST[$key]);
        }
    }
    
    if ($country_handler->insert($country_obj)) {
        redirect_header('admin.country.php', 3, _AM_CATALOG_ACTIVSUCCESS);
    }else{
        redirect_header('admin.country.php', 3, _AM_CATALOG_ACTIVEERROR);
    }
    break;

case "delete":
    $country_obj =& $country_handler->get($country_id);
    if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('admin.country.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $criteria = new Criteria('country_id', $country_id);        
        if($brand_handler->getCount($criteria) > 0 ) redirect_header('admin.country.php', 3, _AM_CATALOG_DELETECOUNTRY_BRANDTIPS);        
        if($item_handler->getCount($criteria) > 0 ) redirect_header('admin.country.php', 3, _AM_CATALOG_DELETECOUNTRY_ITEMTIPS);
        if ($country_handler->delete($country_obj)) {
            redirect_header('admin.country.php', 3, _AM_CATALOG_DELETESUCCESS);
        } else {
            echo $country_obj->getHtmlErrors();
        }
        
    } else {
        xoops_confirm(array('ok' => 1, 'id' => $country_id, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_CATALOG_RESUREDELIT,$country_obj->getVar('country_name')));
    }
    break;                                                                                               
}

include 'footer.php';
?>