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
class CatalogCountry extends XoopsObject
{
    function __construct() 
    {
        $this->initVar('country_id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('country_weight',  XOBJ_DTYPE_INT, 0);
        $this->initVar('country_name', XOBJ_DTYPE_TXTBOX, null, true);
        $this->initVar('add_time', XOBJ_DTYPE_INT);

    }
    
    function CatalogCountry()
    {
        $this->__construct();
    }
    
    function countryForm($action = false)
    {    
        global $xoopsModuleConfig;  
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }  
        include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
        $title = $this->isNew() ? _AM_CATALOG_ADDCOUNTRY : _AM_CATALOG_EDITCOUNTRY;
        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        
        $form->addElement(new XoopsFormText(_AM_CATALOG_COUNTRYNAME, 'country_name', 60, 255, $this->getVar('country_name')), true);
        $form->addElement(new XoopsFormText(_AM_CATALOG_SORT, 'country_weight', 15, 40, $this->getVar('country_weight')));
        $form->addElement(new XoopsFormHidden('country_id', $this->getVar('country_id')));
        if ($this->isNew())   $form->addElement(new XoopsFormHidden('add_time', time()));
        $form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit')); 
                
        return $form;
               
    }
}


/**
 * @package kernel
 * @copyright copyright &copy; 2000 XOOPS.org
 */
class CatalogCountryHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "catalog_country", "CatalogCountry", "country_id", 'country_name');
    }
}
?>