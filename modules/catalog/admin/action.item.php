<?php
include "header.php";
xoops_cp_header();

$ac = isset($_REQUEST['ac']) ? $_REQUEST['ac'] : '';
$item_id = isset($_REQUEST['item_id']) ? trim($_REQUEST['item_id']) : '';

$item_handler =& xoops_getmodulehandler('item', 'catalog');
$pictures_handler = xoops_getmodulehandler('picture','catalog');
$att_handler =& xoops_getmodulehandler('attachment', 'catalog');

$item = isset($_REQUEST['item']) ? $_REQUEST['item'] : ''; 
$reseller_ids = isset($_REQUEST['reseller_ids']) ? $_REQUEST['reseller_ids'] : ''; 
$link_id = isset($_REQUEST['link_id']) ? $_REQUEST['link_id'] : ''; 

if($item){
  $criteria = new CriteriaCompo();
  $criteria->add(new Criteria('item_id','('.implode(',',$item).')','IN'));
}

switch ($ac) {      
    case 'insert':
        //if (!$GLOBALS['xoopsSecurity']->check()) redirect_header('admin.item.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        include_once XOOPS_ROOT_PATH."/modules/catalog/include/functions.php";
        $message = !empty($item_id) ? _AM_CATALOG_UPDATEDSUCCESS : _AM_CATALOG_SAVEDSUCCESS;
        if(!empty($item_id)){
            $item_obj =& $item_handler->get($item_id);
            $item_picture = $item_obj->getVar('item_picture');
        }else{
            $item_obj =& $item_handler->create();
        }
        foreach(array_keys($item_obj->vars) as $key) {
            if(isset($_POST[$key]) && $_POST[$key] != $item_obj->getVar($key)) {
                $item_obj->setVar($key, $_POST[$key]);
            }
        }
        if($reseller_ids){
        $item_obj->setVar('reseller_ids', implode(',',$reseller_ids));        
        }else{
        $item_obj->setVar('reseller_ids', '');        
        }
        if($link_id){
        $item_obj->setVar('link_id', implode(',',$link_id));        
        }else{
        $item_obj->setVar('link_id', '');        
        }        
        $create_time["date"] = isset($_POST["create_time"]["date"]) ? strtotime($_POST["create_time"]["date"]) : 0 ;
        $item_obj->setVar('create_time', $create_time["date"] + $_POST["create_time"]["time"]); 

        
        $item_image = '';
        $gallery = '';
        $annex = '';
        if ( !empty($_POST["xoops_upload_file"]) ){
            foreach($_POST["xoops_upload_file"] as $k=>$v){
                if(strstr($v, 'item_image')) $item_image = $v;
                if(strstr($v, 'pic')) $gallery[] = $v;
                if(strstr($v, 'annex')) $annex[] = $v;
            }
        }

        if ( $item_image ){
            include_once XOOPS_ROOT_PATH."/class/uploader.php";
            $dir = XOOPS_ROOT_PATH . "/uploads/gallery/";
            $original_dir = CreateDir( $dir );
            $mid_dir = CreateDir( $dir ); 
            $thumb_dir = CreateDir( $dir ); 
            $item_dir = CreateDir( $dir ); 
            $mid_wh = array(240,240);
            $thumb_wh = array(480,480);
            $item_wh = array(600,600); 
            $allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
            $maxfilesize = 5000000000;
            $maxfilewidth = 20000;
            $maxfileheight = 20000;
            $uploader = new XoopsMediaUploader($original_dir, $allowed_mimetypes, $maxfilesize, $maxfilewidth, $maxfileheight); 
            if ($uploader->fetchMedia($item_image)) {
            $uploader->setPrefix('item_');
                if (!$uploader->upload()) {
                    echo $uploader->getErrors();
                } else {
                    $item_obj->setVar('item_picture', $uploader->getSavedFileName());
                    setImageThumb($original_dir, $uploader->getSavedFileName(), $mid_dir, 'mid_'.$uploader->getSavedFileName(), array($mid_wh[0], $mid_wh[1]));
                    setImageThumb($original_dir, $uploader->getSavedFileName(), $thumb_dir, 'thumb_'.$uploader->getSavedFileName(), array($thumb_wh[0], $thumb_wh[1]));
                    setImageThumb($original_dir, $uploader->getSavedFileName(), $item_dir, ''.$uploader->getSavedFileName(), array($item_wh[0], $item_wh[1])); 
                    if(!empty($item_picture)){
                        unlink(str_replace("\\", "/", realpath($original_dir.$item_picture)));
                        unlink(str_replace("\\", "/", realpath($mid_dir.'mid_'.$item_picture)));
                        unlink(str_replace("\\", "/", realpath($thumb_dir.'thumb_'.$item_picture)));
                    } 
                }
            }

        }     
        $del_pictures_id = !empty($_POST['del_pictures_id']) ? $_POST['del_pictures_id'] :'';
        if(!empty($del_pictures_id)){
            if(is_array($del_pictures_id)) $del_pictures_id = implode(',', $del_pictures_id);
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria('item_id', $item_id), 'AND'); 
            $criteria->add(new Criteria("pic_id","(".$del_pictures_id.")","in"));
            $picture = $pictures_handler->getAll($criteria, array('pic_id','pic_path'), false); 
            if($pictures_handler->deleteAll($criteria)){    
                foreach($picture as $k=>$v){
                    unlink(str_replace("\\", "/", realpath($original_dir.$v['pic_path'])));
                    unlink(str_replace("\\", "/", realpath($mid_dir.'mid_'.$v['pic_path'])));
                    unlink(str_replace("\\", "/", realpath($thumb_dir.'thumb_'.$v['pic_path'])));
                }
            }
        }

        //delete annex        
        $att_ids = !empty($_POST["att_ids"]) ? $_POST["att_ids"] : array();
        if(!is_array($att_ids)) $att_ids = array($att_ids);
        if(!empty($att_ids)) {
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria("att_id","(".implode(", ",$att_ids). ")","in"), 'AND');
            $att_list = $att_handler->getAll($criteria, null ,false);
            foreach ($att_list as $k=>$v) {
                $file = XOOPS_UPLOAD_PATH . '/annex/' . $v['att_attachment'];
                if (file_exists($file)) @unlink($file);        
            }
            $att_handler->deleteAll($criteria, true);
        }        
        //insert       
        if ($item_id = $item_handler->insert($item_obj)) {
            //gallery
            if ( !empty($gallery) ){
                foreach($gallery as $k=>$v){              
                  if ($uploader->fetchMedia($v)) {
                  $uploader->setPrefix('item_pic_');
                      if (!$uploader->upload()) {
                          echo $uploader->getErrors();
                      } else {       
                          $pic_obj =& $pictures_handler->create();
                          $pic_obj->setVar('item_id', $item_id);
                          $pic_obj->setVar('pic_path', $uploader->getSavedFileName());
                          setImageThumb($original_dir, $uploader->getSavedFileName(), $mid_dir, 'mid_'.$uploader->getSavedFileName(), array($mid_wh[0], $mid_wh[1]));
                          setImageThumb($original_dir, $uploader->getSavedFileName(), $thumb_dir, 'thumb_'.$uploader->getSavedFileName(), array($thumb_wh[0], $thumb_wh[1]));
                          setImageThumb($original_dir, $uploader->getSavedFileName(), $item_dir, ''.$uploader->getSavedFileName(), array($item_wh[0], $item_wh[1])); 
                          $pictures_handler->insert($pic_obj); 
                          unset($pic_obj);
                       }
                   }
                   
                }
            }
            //annex
            if ( !empty($annex) ){
                include_once XOOPS_ROOT_PATH."/modules/catalog/include/functions.php";
                //include_once XOOPS_ROOT_PATH."/class/uploader.php";
                include_once XOOPS_ROOT_PATH."/modules/catalog/class/uploader.php";
                
                if(mkdirs(XOOPS_UPLOAD_PATH . '/annex')) $files_dir = XOOPS_UPLOAD_PATH . '/annex';
                $allowed_mimetypes = $att_handler->getTypes();
                $extendmimetypes = array('rar'=>'application/octet-stream');
                $maxfilesize = 500000000;
                $uploader = new CatalogMediaUploader($files_dir, $allowed_mimetypes, $maxfilesize, null, null, $extendmimetypes);

                foreach($annex as $k=>$v){ 
                        if ($uploader->fetchMedia($v)) {
                        $uploader->setPrefix('annex_');
                            if (!$uploader->upload()) {
                                echo $uploader->getErrors();
                            } else {
                                $att_obj =& $att_handler->create();
                                $att_obj->setVar("item_id", $item_id);
                                $att_obj->setVar("att_filename", $uploader->getMediaName());
                                $att_obj->setVar("att_attachment", $uploader->getSavedFileName());
                                $att_obj->setVar("att_type", $uploader->getMediaType());
                                $att_obj->setVar("att_size", $uploader->getMediaSize());
                                $att_handler->insert($att_obj);
                                unset($att_obj);
                             }
                         }                   
                }
            }                        
            redirect_header('admin.item.php', 3, $message);
        }else{
            redirect_header('admin.item.php', 3, _AM_CATALOG_ACTIVEERROR);
        }
              
    break;
    
    case 'delete':
        $item_obj =& $item_handler->get($item_id);
        if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
            if (!$GLOBALS['xoopsSecurity']->check()) redirect_header('admin.item.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));

            $item_picture  = $item_obj->getVar('item_picture');
            $picture_dir = XOOPS_ROOT_PATH . "/uploads/gallery/";
            if($item_handler->delete($item_obj)) {
                $criteria = new Criteria('item_id', $item_id);
                if($pictures_handler->getCount($criteria) > 0 ) {
                    $galleries = $pictures_handler->getAll($criteria, array('pic_path'), false);
                    foreach ($galleries as $k=>$v) {
                        unlink($picture_dir.$v['pic_path']);
                        unlink($picture_dir.'mid_'.$v['pic_path']);
                        unlink($picture_dir.'thumb_'.$v['pic_path']);
                    }
                    $pictures_handler->deleteAll($criteria, true);
                }
                if($item_picture){
                     unlink($picture_dir.$item_picture);
                     unlink($picture_dir.'mid_'.$item_picture);
                     unlink($picture_dir.'thumb_'.$item_picture);
                }
                redirect_header('admin.item.php', 3, _AM_CATALOG_DELETESUCCESS);
            }else{
                echo _AM_CATALOG_ACTIVEERROR;
            }
        }else{
            xoops_confirm(array('ok' => 1, 'item_id' => $item_id, 'ac' => 'delete'), $_SERVER['REQUEST_URI'], _AM_CATALOG_RESUREDEL);
        }
    break;

    default: 
          include_once dirname(dirname(__FILE__)) . "/include/functions.php";
          $weight = isset($_REQUEST['weight']) ? $_REQUEST['weight'] : '';
          if($weight)  ContentOrder($weight, 'item', 'weight');
          redirect_header('admin.item.php', 3, _AM_CATALOG_ACTIVSUCCESS);
    break;
}

include "footer.php";
?>
