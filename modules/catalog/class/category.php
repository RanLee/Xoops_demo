<?php
/**
 * Empty module foo
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code 
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         foo
 * @since           2.3.0
 * @author          Susheng Yang <ezskyyoung@gmail.com>
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: index.php  $
 */
if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}
//require_once XOOPS_ROOT_PATH . "/class/tree.php";
/**
 * @package kernel
 * @copyright copyright &copy; 2000 XOOPS.org
 */
class CatalogCategory extends XoopsObject
{
    function __construct() 
    {
        $this->initVar('cat_id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('cat_name', XOBJ_DTYPE_TXTBOX, null, true);
        $this->initVar('cat_image', XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_unit', XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_pid', XOBJ_DTYPE_INT);
        $this->initVar('type_id', XOBJ_DTYPE_INT);
        $this->initVar('cat_keywords', XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_description', XOBJ_DTYPE_TXTAREA);
        $this->initVar('isnav', XOBJ_DTYPE_INT, 1);
        $this->initVar('cat_status', XOBJ_DTYPE_INT, 1);
        $this->initVar('cat_weight',  XOBJ_DTYPE_INT, 0);
        $this->initVar('cat_level',  XOBJ_DTYPE_INT, 1);        
        $this->initVar('cat_properties', XOBJ_DTYPE_TXTAREA);
        $this->initVar('cat_tpl', XOBJ_DTYPE_TXTAREA);
        $this->initVar('cat_tpl_css', XOBJ_DTYPE_TXTAREA);
        $this->initVar('cat_published', XOBJ_DTYPE_INT);
        $this->initVar('cattext', XOBJ_DTYPE_TXTBOX);
    }
    
    function CatalogCategory()
    {
        $this->__construct();
    }
    
    function getForm($action = false)
    {    
        global $xoopsModuleConfig,$category_handler,$category_obj;  
        include_once XOOPS_ROOT_PATH . "/modules/catalog/include/functions.render.php";

        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }  
        include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

        $title = $this->isNew() ? _AM_CATALOG_ADDCAT : _AM_CATALOG_UPDATECAT;
        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new XoopsFormText(_AM_CATALOG_CATNAME, 'cat_name', 27, 255, $this->getVar('cat_name')), true);
        $categories =& $category_handler->getTrees(0, "--");
        

        $cat_options = array();
        $cat_options[0] = _AM_CATALOG_TOPCAT;
        foreach ($categories as $id => $cat) {
            $cat_options[$id] = $cat["prefix"] . $cat["cat_name"];
        }      
        
        $cat_select = new XoopsFormSelect(_AM_CATALOG_CHOICEPID, "cat_pid", $category_obj->getVar("cat_pid"));    
        $cat_select->addOptionArray($cat_options);
        $form->addElement($cat_select);
        $templates = catalog_getTemplateList("category");
                
        
        /*
        if (count($templates)>0) {
            $template_select = new XoopsFormSelect(_AM_CATALOG_CHOICETPL, "cat_tpl", $this->getVar("cat_tpl"));
            $template_select->addOptionArray($templates);
            $form->addElement($template_select);
        }
        */
        
        
//        $form->addElement(new XoopsFormTextArea(_AM_CATALOG_CATNAMEA,'cattext',$this->getVar('cattext'), 10));
        $form->addElement(new XoopsFormEditor(_AM_CATALOG_CATNAMEA, "cattext", array('editor'=>'ckeditor','width'=>'100%','height'=>'150px','name'=>'cattext', 'value'=>$this->getVar('cattext')), false)); 

        
        $form->addElement(new XoopsFormText(_AM_CATALOG_SORT, 'cat_weight', 15, 40, $this->getVar('cat_weight')));
        
        //brand
        $brand_handler = xoops_getmodulehandler('brand','catalog');
        $brand_list = new XoopsFormElementTray(_AM_CATALOG_LINKEDBRAND);
        $criteria = new CriteriaCompo();
        $criteria->setSort('brand_weight');
        $criteria->setOrder('ASC');
        $brands = $brand_handler->getList($criteria);
        if(!empty($brands)){
            $ids = array();
            if(!$this->isNew()){
                  $catbrand_handler = xoops_getmodulehandler('catbrand','catalog');
                  $criteria = new Criteria('cat_id', $this->getVar('cat_id'));
                  $catbrands = $catbrand_handler->getAll($criteria, null, false, false);
                  if($catbrands){
                      foreach($catbrands as $key=>$value){
                        $ids[] = $value['brand_id'];
                      } 
                  }
            }
            $form_checkbox = new XoopsFormCheckBox('', 'brand_ids', $ids, '&nbsp;&nbsp;');
            foreach($brands as $k=>$v){
                $form_checkbox->addOption($k, $v);
            }
           $brand_list->addElement($form_checkbox);
        }else{
           $brand_list->addElement(new XoopsFormLabel('',_AM_CATALOG_UNLINKEDBRAND));
        }  

        $form->addElement($brand_list);

        $form->addElement(new XoopsFormHidden('cat_id', $this->getVar('cat_id')));
        if ($this->isNew())   $form->addElement(new XoopsFormHidden('cat_published', time()));
        $form->addElement(new XoopsFormHidden('ac', 'save'));
        $buttons = new XoopsFormElementTray(' ');
        $buttons->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));  
        $buttons->addElement(new XoopsFormButton('', 'reset', _AM_CATALOG_RESET, 'reset'));
        $form->addElement($buttons);     
        return $form;
               
    }
}
/**
 * @package kernel
 * @copyright copyright &copy; 2000 XOOPS.org
 */
class CatalogCategoryHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "catalog_category", "CatalogCategory", "cat_id", 'cat_name');
    }
    
    function &getTrees($pid = 0, $prefix = "--", $tags = array())
    {
        $pid = intval($pid);
        if (!is_array($tags) || count($tags) == 0) $tags = array("cat_id", "cat_name", "cat_image","cat_unit", "cat_pid", "cat_keywords", "cat_description", "isnav", "cat_status", "cat_weight","cat_level","cat_tpl","cat_tpl_css", "cat_properties", "cat_published");
        $criteria = new CriteriaCompo();
        $criteria->setSort('cat_weight');
        $criteria->setOrder('ASC');        
        $categories = $this->getAll($criteria,$tags);
        require_once dirname(__FILE__) . "/tree.php";
        $tree = new catalogTree($categories);
        $category_array =& $tree->makeTree($prefix, $pid, $tags);
        return $category_array;
    }

    function getTree($pid = 0, $prefix = "--", $tags = array()){
        $categories = $this->getTrees($pid, $prefix, $tags);
  	    if(!empty($categories)){
            $TreeCategories = $this->Tree($categories, $pid);
            return $TreeCategories;
        }
    }

    function &Tree($categories = array(), $key = 0, $cat_name = ''){
        if(!is_array($categories)) return false;
        foreach($categories as $k=>$v){
            if($v['cat_pid'] == $key){
                    $new_categories[$k] = $v;
                    if($v['cat_pid'] > 0 && empty($cat_name)){
                        $cat_obj = $this->get($v['cat_pid']);
                        $cat_name = $cat_obj->getVar('cat_name');
                    }
                    $new_categories[$k]['pname'] = $cat_name;
                    $child = $this->Tree($categories, $v['cat_id'], $v['cat_name']);
                    if(!empty($child)) $new_categories[$k]['child'] = $child;
            }
        }
        return $new_categories;
    }
    
    function &makeDisplay($categories){
        //$display = '<ul>';
        $display = '';
        foreach($categories as $k=>$v) {
            $css_id = $v['cat_level'];
            $display .= '<li><div class="m'.$css_id.'Link"><a href="'.XOOPS_URL.'/modules/catalog/itemlist.php?cat_id='.$v['cat_id'].'#A">'.$v['cat_name'].'</a></div></li>';
            $child = isset($v['child']) ? $v['child'] : '';
            if(!empty($child)) {
                $display .= '<ul class="subMenu'.$css_id.'">';
                $display .= $this->makeDisplay($v['child']);
                $display .= '</ul><br />';
            }
        }
        //$display .= '</ul>';

        return $display;
    }
   
    function getBread($pages = array(), $key = 0)
    {
        if(!is_array($pages) || empty($pages)) return false;
        $bread = array();
                     
        if(isset($pages[$key])) {
            $current = $pages[$key];
            $bread = array($current['cat_id']=>$current['cat_name']);      
            if($current['cat_pid'] > 0) {
                $p_brend = $this->getBread($pages, $current['cat_pid']);
                if(!empty($p_brend)) {
                    foreach ($p_brend as $k=>$v) {
                        $bread[$k] = $v;
                    }
                }
            }
        }
        
        return $bread;
    }
    
    //magic.shao hack
    function CategoryTree($categories = array(), $key = 0, $level = 1){
        
        if(!is_array($categories) || empty($categories)) return false;        
        $result = array();
        
        foreach($categories as $k=>$v){
            if($v['cat_pid'] == $key){
                $result[$k] = $v;
                $result[$k]['level'] = $level;
                $child = $this->CategoryTree($categories, $k, $level+1);
                if(!empty($child)) $result[$k]['child'] = $child;
            }
        }
        
        return $result;
    }
    function getCatCount($catid){
        $item_handler =& xoops_getmodulehandler('item', 'catalog');
        $criteria = new CriteriaCompo();
        if (!empty($catid)){        
                $category_ids = $this->getTrees($catid);
                foreach($category_ids as $k=>$v) {
                    $cat_ids[] = $k;
                }        
                if(count($cat_ids) != 1) {
                    $criteria->add(new Criteria("cat_id","(".implode(", ",$cat_ids). ")","in"), 'AND');
                } else {
                    $criteria->add(new Criteria("cat_id", current($cat_ids)), 'AND');
                }
                $resultnum =  $item_handler->getCount($criteria);   
        }
        return  $resultnum;
    }      

}
?>
