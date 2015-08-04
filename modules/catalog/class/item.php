<?php

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class CatalogItem extends XoopsObject
{
    function __construct() 
    {
        $this->initVar('item_id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('item_name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_sn', XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_id', XOBJ_DTYPE_INT, 0);     
        $this->initVar('link_id', XOBJ_DTYPE_TXTBOX); 
        $this->initVar('greenep_id', XOBJ_DTYPE_INT, 0);           
        $this->initVar('reseller_ids',  XOBJ_DTYPE_TXTBOX);            
        $this->initVar('country_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('brand_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('specs_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_keywords', XOBJ_DTYPE_TXTAREA);
        $this->initVar('item_unit', XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_summary', XOBJ_DTYPE_TXTAREA);
        $this->initVar('market_price', XOBJ_DTYPE_TXTBOX);
        $this->initVar('shop_price', XOBJ_DTYPE_TXTBOX);
        $this->initVar('promote_price', XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_number', XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_weight', XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_weights', XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_weightss', XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_weightsss', XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_weight2', XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_inventory', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_description', XOBJ_DTYPE_TXTAREA);
        $this->initVar('item_service', XOBJ_DTYPE_TXTAREA);
        $this->initVar('page_title', XOBJ_DTYPE_TXTBOX);
        $this->initVar('meta_keywords', XOBJ_DTYPE_TXTAREA);
        $this->initVar('meta_description', XOBJ_DTYPE_TXTAREA);
        $this->initVar('item_newarrival', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_best', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_hot', XOBJ_DTYPE_INT, 0);
        $this->initVar('status', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_comments', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_counter', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_type', XOBJ_DTYPE_INT, 0);
        $this->initVar('weight', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_picture', XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_thumbnail', XOBJ_DTYPE_TXTBOX);
        $this->initVar('isgallery', XOBJ_DTYPE_INT, 0);
        $this->initVar('rating', XOBJ_DTYPE_INT, 0);
        $this->initVar('rates', XOBJ_DTYPE_INT, 0);
        $this->initVar('type1', XOBJ_DTYPE_INT, 0);
        $this->initVar('type2', XOBJ_DTYPE_INT, 0);
        $this->initVar('type3', XOBJ_DTYPE_INT, 0);
        $this->initVar('type4', XOBJ_DTYPE_INT, 0);
        $this->initVar('type5', XOBJ_DTYPE_INT, 0);
        $this->initVar('create_time', XOBJ_DTYPE_INT, 0);
        $this->initVar('modify_time', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_tpl', XOBJ_DTYPE_TXTAREA);
        $this->initVar('item_tpl_css', XOBJ_DTYPE_TXTAREA);    
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 0);
        $this->initVar('doxcode', XOBJ_DTYPE_INT, 0);
        $this->initVar('dosmiley', XOBJ_DTYPE_INT, 0);
        $this->initVar('doimage', XOBJ_DTYPE_INT, 0);
        $this->initVar('dobr', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_buildtime', XOBJ_DTYPE_INT, 0); 
        $this->initVar('item_repairtime', XOBJ_DTYPE_TXTBOX); 
        $this->initVar('item_size', XOBJ_DTYPE_TXTBOX);
        $this->initVar('compare_status', XOBJ_DTYPE_INT, 0);                                      
    }

    function CatalogItem()
    {
        $this->__construct();
    }
    
    function getRatingAverage($name='rating', $decimals = 2)
    {
	    $ave = 0;
	    if($this->getVar("rates")){
	    	$ave = number_format($this->getVar($name)/$this->getVar("rates"), $decimals);
    	}
	    return $ave;
    }    
    
    function itemForm($action = false)
    {    
        global $xoopsModuleConfig,$item_id;  
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }  
        include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
        include_once XOOPS_ROOT_PATH . "/modules/catalog/include/functions.render.php";
        $category_handler = xoops_getmodulehandler('category','catalog');
        $brand_handler = xoops_getmodulehandler('brand','catalog');  
        $pictures_handler = xoops_getmodulehandler('picture','catalog');
        $country_handler = xoops_getmodulehandler('country','catalog');
        $link_handler =& xoops_getmodulehandler('symbol', 'symbol');
        $reseller_handler =& xoops_getmodulehandler('reseller', 'reseller');
        $cat_handler =& xoops_getmodulehandler('category', 'catalog'); 
        $greenep_handler = xoops_getmodulehandler('greenep','catalog');
        $att_handler =& xoops_getmodulehandler('attachment', 'catalog');                               
        
        $title = $this->isNew() ? _AM_CATALOG_ADDITEM : _AM_CATALOG_UPDATEITEM;
        $format = empty($format) ? "e" : $format;
        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra("enctype=\"multipart/form-data\"");
        
        if($xoopsModuleConfig['display'] == 1) {
            $countries =& $country_handler->getList();
            $country_select = new XoopsFormSelect(_AM_CATALOG_BELONGCOUNTRY, "country_id", $this->getVar("country_id"));
            $country_select->addOption('',_NONE);
            $country_select->addOptionArray($countries);
            $form->addElement($country_select,true); 
                    
            $brand_select = new XoopsFormSelect(_AM_CATALOG_ITEMBRAND, "brand_id", $this->getVar("brand_id"));
            $brand_select->addOption('', _NONE);
    
            if( $this->getVar("country_id")) {
                $criteria = new CriteriaCompo();
        	    $criteria->add(new Criteria('country_id', $this->getVar("country_id")));
                $brands =& $brand_handler->getList($criteria);
                unset($criteria);                
                $brand_select->addOptionArray($brands);        
            }
            $form->addElement($brand_select,true);
        }
        
        
        //关联分类
        $categories =& $category_handler->getTrees(0, "--");
        $cat_options = array();
        if($categories){
            foreach ($categories as $id => $cat) {
                $cat_options[$id] = $cat["prefix"] . $cat["cat_name"];
            }
        }
      
        $cat_id=(empty($_REQUEST['cat_id']))?"":$_REQUEST['cat_id'];
        $cat_select = new XoopsFormSelect(_AM_CATALOG_ITEMCAT, "cat_id", $this->getVar("cat_id") != 0 ? $this->getVar("cat_id") : $cat_id);
        $cat_select->addOption('', _AM_CATALOG_CHOICE);
        $cat_select->addOptionArray($cat_options);
        $form->addElement($cat_select, true);

        /*
        $form->addElement(new XoopsFormText(_AM_CATALOG_ITEMNAME, 'item_name', 60, 255, $this->getVar('item_name')), true);
        $form->addElement(new XoopsFormDateTime("產品建立日期", 'create_time', 15, $this->getVar('create_time', $format)));
        $form->addElement(new XoopsFormText(_AM_CATALOG_MADEIN, 'shop_price', 40, 60, $this->getVar('shop_price')));  
        $form->addElement(new XoopsFormText(_AM_CATALOG_ITEMPACK, 'item_repairtime', 40, 60, $this->getVar('item_repairtime')));
        $form->addElement(new XoopsFormText(_AM_CATALOG_MAINFUNCTION, 'item_size', 100, 255, $this->getVar('item_size')));
        $form->addElement(new XoopsFormText(_AM_CATALOG_SHOPPRICE, 'item_weight', 40, 60, $this->getVar('item_weight')));
        */
      
        $form->addElement(new XoopsFormText('商品名稱', 'item_name', 60, 255, $this->getVar('item_name')), true);
        $form->addElement(new XoopsFormDateTime("建立日期", 'create_time', 15, $this->getVar('create_time', $format)));
        $form->addElement(new XoopsFormText('型號', 'item_repairtime', 40, 60, $this->getVar('item_repairtime')));
        $form->addElement(new XoopsFormText('產品顏色', 'item_weight', 40, 60, $this->getVar('item_weight')));
        $form->addElement(new XoopsFormText('外觀', 'shop_price', 40, 60, $this->getVar('shop_price')));
        $form->addElement(new XoopsFormText('尺寸', 'item_weights', 40, 255, $this->getVar('item_weights')));
        $form->addElement(new XoopsFormText('材質', 'item_size', 40, 60, $this->getVar('item_size')));
        $form->addElement(new XoopsFormText('重量', 'item_weight2', 40, 255, $this->getVar('item_weight2')));
        $form->addElement(new XoopsFormText('包裝', 'item_weightss', 40, 255, $this->getVar('item_weightss'))); 
        $form->addElement(new XoopsFormText('附註', 'item_weightsss', 40, 255, $this->getVar('item_weightsss')));
   
        /*
        $criteria2 = new CriteriaCompo();
	    $criteria2->setSort('greenep_weight');
	    $criteria2->setOrder('ASC');
        $greeneps =& $greenep_handler->getList($criteria2);
        $greenep_select = new XoopsFormRadio('供應綠環保程度', "greenep_id", $this->getVar("greenep_id"));
        $greenep_select->addOptionArray($greeneps);
        $form->addElement($greenep_select);
        */

        $format = empty($format) ? "e" : $format;
        $form->addElement(new XoopsFormEditor(_AM_CATALOG_FUNCTIONDESC, "item_summary", array('editor'=>'ckeditor','width'=>'100%','height'=>'150px','name'=>'item_summary', 'value'=>$this->getVar('item_summary',$format)), false)); 
        $form->addElement(new XoopsFormEditor(_AM_CATALOG_DETAILSPEC_DESC,  "item_description", array('editor'=>'ckeditor','width'=>'100%','height'=>'200px','name'=>'item_description', 'value'=>$this->getVar('item_description',$format)), false));
        $form->addElement(new XoopsFormEditor(_AM_CATALOG_AFTERSERVICE_DESC,  "item_service", array('editor'=>'ckeditor','width'=>'100%','height'=>'200px','name'=>'item_service', 'value'=>$this->getVar('item_service',$format)), false));    
        
        $links =& $link_handler->getList();
        $link_select = new XoopsFormSelect(' ', "link_id", $this->getVar("link_id"));
        $link_select->addOption('',_NONE);
        $link_select->addOptionArray($links);

        /*
        $link_tray = new XoopsFormElementTray("環保標章選擇", "&nbsp;<br />");
        $link_tray->addElement($link_select);
        if ($this->getVar("link_id")) {
            $link_obj =& $link_handler->get($this->getVar("link_id"));
            $link_img = XOOPS_URL . "/uploads/symbol/" . $link_obj->getVar("link_image");
            $link_tray->addElement(new XoopsFormLabel('','<span id="symbol_img"><img src="'.$link_img.'" /></span>'));
        } 
        else {
            $link_tray->addElement(new XoopsFormLabel('','<span id="symbol_img"></span>'));
        }
        $form->addElement($link_tray);
        */
       
        /*
        $links =& $link_handler->getList();
        $link_select = new XoopsFormCheckBox('環保標章選擇', "link_id", explode(",",$this->getVar("link_id")));
        $link_select->addOptionArray($links);
        $form->addElement($link_select);
        
        $resellers =& $reseller_handler->getList();
        $reseller_select = new XoopsFormCheckBox('優質店家選擇', "reseller_ids", explode(",",$this->getVar("reseller_ids")));
        $reseller_select->addOptionArray($resellers);
        $form->addElement($reseller_select);
        */
        

        $item_image = new XoopsFormElementTray(_AM_CATALOG_ITEMIMAGE);
        if( $this->getVar('item_picture') ){
            $item_image->addElement(new XoopsFormLabel('', '<img src="'.XOOPS_URL.'/uploads/gallery/thumb_'.$this->getVar('item_picture').'"><br><br>'));
          /*  $display = _AM_CATALOG_REUPLOAD; */
        }else{
            $display = '';
        }  
        $item_image->addElement(new XoopsFormFile('','item_image',10240*10240*2));
        $item_image->addElement(new XoopsFormLabel('',_AM_CATALOG_UPLOADTYPE));
        $item_image->addElement(new XoopsFormLabel('', $display)); 	
        $form->addElement($item_image);
                

        $gallery = new XoopsFormElementTray(_AM_CATALOG_PICUPLOAD);
        $gallery_file = new XoopsFormFile('','pic',10240*10240*2);
        $gallery_multiLabel = new XoopsFormLabel('','<div><a id="addMore" href="javascript:void(0);">'._AM_CATALOG_ADDMORE.'</a></div>');
        $gallery->addElement($gallery_file);
        $gallery->addElement(new XoopsFormLabel('',_AM_CATALOG_UPLOADTYPE));
        $gallery->addElement($gallery_multiLabel);
        if (!$this->isNew()) {
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria('item_id', $item_id));
            $fields = array('pic_id','item_id','pic_description','pic_path','pic_thumb_path');
            $pictures = $pictures_handler->getAll($criteria, $fields, false, false);
            if(!empty($pictures)){
                $form_checkbox = new XoopsFormCheckBox('<br>'._AM_CATALOG_UPLOAD.'<input id="check" name="check" type="checkbox" onclick="xoopsCheckAll(\'form\',\'check\');" />'._ALL.'<br>', 'del_pictures_id', '','');
                foreach($pictures as $k=>$v){
                    $form_checkbox->addOption($v['pic_id'], '<img width=50 src="'.XOOPS_URL.'/uploads/gallery/'.$v['pic_path'].'"> ');
                }
                $gallery->addElement($form_checkbox);
                $gallery->addElement(new XoopsFormLabel('',_AM_CATALOG_AFTERCHOICED_DEL));
            }
        }           
        $form->addElement($gallery);

        // file 
        $annex = new XoopsFormElementTray(_AM_CATALOG_ANNEXUPLOAD,'','annex');
        $annex_file = new XoopsFormFile('','annex','');
        $annex_multiLabel = new XoopsFormLabel('','<div><a id="addMoreAnnex" href="javascript:void(0);">'._AM_CATALOG_ADDMORE.'</a></div>');
        $annex->addElement($annex_file);
        $annex->addElement($annex_multiLabel); 
        
        $criteria = new Criteria('item_id', $this->getVar('item_id') ? $this->getVar('item_id') : 0);
        $files = $att_handler->getAll($criteria, null, false);
        if(!empty($files)){
            foreach ($files as $id => $file) {
                $list[$id] = "<a href='".XOOPS_URL . "/modules/catalog/downloads.php?id=" . $file['att_id']."'>".$file["att_filename"]."</a>";
            }
        
            $ann_select = new XoopsFormCheckBox(_AM_CATALOG_UPLOAD, "att_ids", '');
            $ann_select->addOptionArray($list);
            $annex->addElement($ann_select);
            $annex->addElement(new XoopsFormLabel('',_AM_CATALOG_AFTERCHOICED_DEL));
        }       
        $form->addElement($annex);  
        
      
        /*
        $cstatus_select = new XoopsFormSelect('選擇比較商品形態', "compare_status", $this->getVar("compare_status"));
        $cstatus_select->addOption(1, '售價');
        $cstatus_select->addOption(2, '尺寸');
        $cstatus_select->addOption(3, '重量');
        $cstatus_select->addOption(4, '保修年份');
        $cstatus_select->addOption(5, '綠環保程度');
        $cstatus_select->addOption(6, '評價');
        $form->addElement($cstatus_select);
        */
   
        $form->addElement(new XoopsFormRadioYN(_AM_CATALOG_DOBEST, 'item_best',$this->getVar('item_best')));
//        $form->addElement(new XoopsFormRadioYN(_AM_CATALOG_DONEW, 'item_newarrival',$this->getVar('item_newarrival')));
//        $form->addElement(new XoopsFormRadioYN(_AM_CATALOG_DOHOT, 'item_hot',$this->getVar('item_hot')));
//        $form->addElement(new XoopsFormText(_AM_CATALOG_SORT, 'weight', 40, 60, $this->getVar('weight')));
        if ($this->isNew())   $form->addElement(new XoopsFormHidden('item_buildtime', time()));
        $form->addElement(new XoopsFormHidden('modify_time', time()));
        $form->addElement(new XoopsFormHidden('item_id', $this->getVar('item_id')));
        $form->addElement(new XoopsFormHidden('ac', 'insert'));
        $btn_save = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
        
//        $btn_preview = new XoopsFormButton("", "btn_preview", _PREVIEW, "button");
//        $btn_preview->setExtra('onclick="window.document.' . $form->getName() . '.preview.value=1; window.document.' . $form->getName() . '.submit()"');
//        $form->addElement(new XoopsFormHidden('preview', 0));
                    
        $button_tray = new XoopsFormElementTray("");
//        $button_tray->addElement($btn_preview);
        $button_tray->addElement($btn_save);
        $form->addElement($button_tray);

        return $form;
    }
}

class CatalogItemHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "catalog_item", "CatalogItem", "item_id", 'item_name');
    }
}
?>
