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
/**
 * @package kernel
 * @copyright copyright &copy; 2000 XOOPS.org
 */
class CatalogBrand extends XoopsObject
{
    function __construct() 
    {
        $this->initVar('brand_id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('country_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('brand_name', XOBJ_DTYPE_TXTBOX, null, true);
        $this->initVar('brand_url', XOBJ_DTYPE_URL);
        $this->initVar('brand_logo', XOBJ_DTYPE_TXTBOX);
        $this->initVar('brand_description', XOBJ_DTYPE_TXTAREA);
        $this->initVar('brand_weight', XOBJ_DTYPE_INT, 0);
        $this->initVar('brand_status', XOBJ_DTYPE_INT, 1);
        $this->initVar('brand_published', XOBJ_DTYPE_INT);

    }
    
    function ProductBrand()
    {
        $this->__construct();
    }
    
    function brandForm($action = false)
    {    
        global $xoopsModuleConfig;  
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }  
        include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
        $country_handler = xoops_getmodulehandler('country','catalog');
        $title = $this->isNew() ? _AM_CATALOG_ADDBRAND : _AM_CATALOG_UPDATEBRAND;
        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new XoopsFormText(_AM_CATALOG_BRANDNAME, 'brand_name', 60, 255, $this->getVar('brand_name')), true);
        
        $countys =& $country_handler->getList();
        $county_select = new XoopsFormSelect(_AM_CATALOG_CHOICECOUNTRY, "country_id", $this->getVar("country_id"));
        $county_select->addOption('', _AM_CATALOG_CHOICE);
        $county_select->addOptionArray($countys);
        $form->addElement($county_select);
  
        $configs = array('editor'=>'fckeditor','width'=>'100%','height'=>'150px','value'=>$this->getVar('brand_description')); 
        $form->addElement(new XoopsFormEditor(_AM_CATALOG_BRANDDESC, 'brand_description',$configs,$nohtml = false, $OnFailure = ""));
             
        if ($this->isNew())   $form->addElement(new XoopsFormHidden('brand_published', time()));
        $form->addElement(new XoopsFormHidden('brand_id', $this->getVar('brand_id')));
        $form->addElement(new XoopsFormHidden('ac', 'save'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));         
        return $form;
               
    }
}


/**
 * @package kernel
 * @copyright copyright &copy; 2000 XOOPS.org
 */
class CatalogBrandHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "catalog_brand", "CatalogBrand", "brand_id", 'brand_name');
    }
}
?>