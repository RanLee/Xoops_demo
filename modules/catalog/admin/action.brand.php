<?php
include 'header.php';
xoops_cp_header();

$ac = isset($_REQUEST['ac']) ? $_REQUEST['ac'] : ' ';
$brand_id = isset($_REQUEST['brand']) ? $_REQUEST['brand'] : '';
$brand_handler = xoops_getmodulehandler('brand','catalog');
$item_handler = xoops_getmodulehandler('item','catalog');
switch ($ac) {
case "save":
    if (!$GLOBALS['xoopsSecurity']->check()) {
        redirect_header('admin.brand.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
    }
    
    if (isset($_REQUEST['brand_id'])) {
        $brand_obj =& $brand_handler->get($_REQUEST['brand_id']);
        $brand_logo = $brand_obj->getVar('brand_logo');
    } else {
        $brand_obj =& $brand_handler->create();
    }
    
    foreach(array_keys($brand_obj->vars) as $key) {
        if(isset($_POST[$key])) {
            $brand_obj->setVar($key, $_POST[$key]);
        }
    }
    
    if ( !empty($_POST["xoops_upload_file"]) ){
        include_once XOOPS_ROOT_PATH."/class/uploader.php";
        $logo_dir = XOOPS_ROOT_PATH . "/uploads/";
        $allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
        $maxfilesize = 500000;
        $maxfilewidth = 2200;
        $maxfileheight = 2200;
        $uploader = new XoopsMediaUploader($logo_dir, $allowed_mimetypes, $maxfilesize, $maxfilewidth, $maxfileheight);
        if ($uploader->fetchMedia('brand_logo')) {
        $uploader->setPrefix('brand_');
            if (!$uploader->upload()) {
                echo $uploader->getErrors();
            } else {
                $brand_obj->setVar('brand_logo', $uploader->getSavedFileName());
                if(!empty($brand_logo)) unlink(str_replace("\\", "/", realpath($logo_dir.$brand_logo)));
            }
        }
    }

    if ($brand_handler->insert($brand_obj)) {
        redirect_header('admin.brand.php', 3, _AM_CATALOG_ACTIVSUCCESS);
    }else{
        redirect_header('admin.brand.php', 3, _AM_CATALOG_ACTIVEERROR);
    }
    
    break;

case 'delete':
        $brand_obj =& $brand_handler->get($brand_id);
        if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
            if (!$GLOBALS['xoopsSecurity']->check()) redirect_header('admin.brand.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria('brand_id', $brand_id));
            if($brand_handler->delete($brand_obj)) {
                redirect_header('admin.brand.php', 3, _AM_CATALOG_DELETESUCCESS);
            }else{
                echo _AM_CATALOG_ACTIVEERROR;
            }
        }else{
            xoops_confirm(array('ok' => 1, 'brand_id' => $brand_id, 'ac' => 'delete'), $_SERVER['REQUEST_URI'], _AM_CATALOG_RESUREDEL);
        }
    break;

default:
      include_once dirname(dirname(__FILE__)) . "/include/functions.php";
      $brand_weight = isset($_REQUEST['brand_weight']) ? $_REQUEST['brand_weight'] : '';
      if($brand_weight)  ContentOrder($brand_weight, 'brand', 'brand_weight');
            
      if($brand_id){
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('brand_id','('.implode(',',$brand_id).')','IN'));
        $brand_handler->deleteAll($criteria, true); 
      } 
      redirect_header('admin.brand.php', 3, _AM_CATALOG_ACTIVSUCCESS);    
    break;

}
    
include 'footer.php';

?>
