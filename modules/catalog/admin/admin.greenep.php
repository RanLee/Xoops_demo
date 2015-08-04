<?php
include 'header.php';
xoops_cp_header();
loadModuleAdminMenu(5, "");

$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : 'list';
$greenep_id = isset($_REQUEST['greenep_id']) ? trim($_REQUEST['greenep_id']) : '';

$greenep_handler = xoops_getmodulehandler('greenep','catalog');
$item_handler = xoops_getmodulehandler('item','catalog');

switch($op) {
default:
case "list":
    $criteria = new CriteriaCompo();
    $criteria->setSort('greenep_rank');
    $criteria->setOrder('ASC');
    $greenep = $greenep_handler->getAll($criteria, null, false, false);

    $xoopsTpl->assign('greeneps',$greenep);
    $template_main = "catalog_admin_greenep.html";
    break;

case "new":
    $greenep_obj =& $greenep_handler->create();
    $form = $greenep_obj->greenepForm();
    $form->display();
    break;

case "edit":
    $greenep_obj = $greenep_handler->get($greenep_id);
    $form = $greenep_obj->greenepForm();
    $form->display();
    break;

case "save":
    if (!$GLOBALS['xoopsSecurity']->check()) {
        redirect_header('admin.greenep.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
    }
    if (isset($greenep_id)) {
        $greenep_obj =& $greenep_handler->get($greenep_id);
        $greenep_logo = $greenep_obj->getVar('greenep_logo');
    } else {
        $greenep_obj =& $greenep_handler->create();
    }

        foreach(array_keys($greenep_obj->vars) as $key) {
        if(isset($_POST[$key])) {
            $greenep_obj->setVar($key, $_POST[$key]);
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
        if ($uploader->fetchMedia('greenep_logo')) {
        $uploader->setPrefix('greenep_');
            if (!$uploader->upload()) {
                echo $uploader->getErrors();
            } else {
                $greenep_obj->setVar('greenep_logo', $uploader->getSavedFileName());
                if(!empty($greenep_logo)) unlink(str_replace("\\", "/", realpath($logo_dir.$greenep_logo)));
            }
        }
    }
    
    if ($greenep_handler->insert($greenep_obj)) {
        redirect_header('admin.greenep.php', 3, _AM_CATALOG_ACTIVSUCCESS);
    }else{
        redirect_header('admin.greenep.php', 3, _AM_CATALOG_ACTIVEERROR);
    }
    break;

case "delete":
    $greenep_obj =& $greenep_handler->get($greenep_id);
    $greenep_logo = $greenep_obj->getVar('greenep_logo');
    $logo_dir = XOOPS_ROOT_PATH . "/uploads/";
    if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('admin.greenep.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $criteria = new Criteria('greenep_id', $greenep_id);        
        if($item_handler->getCount($criteria) > 0 ) redirect_header('admin.greenep.php', 3, _AM_CATALOG_DELETEGREENTIPS);        
        if ($greenep_handler->delete($greenep_obj)) {
            if($greenep_logo) unlink($logo_dir.$greenep_logo);
            redirect_header('admin.greenep.php', 3, _AM_CATALOG_DELETESUCCESS);
        } else {
            echo $greenep_obj->getHtmlErrors();
        }
    } else {
        xoops_confirm(array('ok' => 1, 'id' => $greenep_id, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_CATALOG_RESUREDELIT,$greenep_obj->getVar('greenep_rank')));
    }
    break;                                                                                               
}

include 'footer.php';
?>