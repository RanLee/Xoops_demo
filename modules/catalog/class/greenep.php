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
class CatalogGreenep extends XoopsObject
{
    function __construct() 
    {
        $this->initVar('greenep_id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('greenep_rank',  XOBJ_DTYPE_TXTBOX, null, true);
        $this->initVar('greenep_logo', XOBJ_DTYPE_TXTBOX, null, true);
        $this->initVar('greenep_weight', XOBJ_DTYPE_INT, 0);        

    }
    
    function CatalogGreenep()
    {
        $this->__construct();
    }
    
    function greenepForm($action = false)
    {    
        global $xoopsModuleConfig;  
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }  
        include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
        $title = $this->isNew() ? _AM_CATALOG_ADD_GREENEP : _AM_CATALOG_EDIT_GREENEP;
        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');       
        $form->addElement(new XoopsFormText(_AM_CATALOG_GREENEP_RANK, 'greenep_rank', 60, 255, $this->getVar('greenep_rank')), true);
        

        
        
        $logo_image = new XoopsFormElementTray(_AM_CATALOG_GREENLOGO);

          if( $this->getVar('greenep_id') ){
          $logo_image->addElement(new XoopsFormLabel('', '<img src="'.XOOPS_URL."/uploads/".$this->getVar('greenep_logo').'" width="100"><br><br>')); 	
          $display = _AM_CATALOG_REUPLOAD;
          }else{
              $display = '';
          }  
        $logo_image->addElement(new XoopsFormFile('', 'greenep_logo',1024*1024*2));

        $logo_image->addElement(new XoopsFormLabel('', $display));
        $form->addElement($logo_image);
        
        $form->addElement(new XoopsFormText(_AM_CATALOG_SORT, 'greenep_weight', 40, 60, $this->getVar('greenep_weight')));         
        $form->addElement(new XoopsFormHidden('greenep_id', $this->getVar('greenep_id')));
        $form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit')); 
                
        return $form;
               
    }
}


/**
 * @package kernel
 * @copyright copyright &copy; 2000 XOOPS.org
 */
class CatalogGreenepHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "catalog_greenep", "CatalogGreenep", "greenep_id", 'greenep_rank');
    }
}
?>