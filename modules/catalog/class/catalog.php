<?php

/**
 * Abstert Handler
 * 
 * @author Magic.Shao  (magic.shao@gmail.com)
 * @copyright copyright &copy; 2010
 * @package module::catalog
 *
 * {@link XoopsObject} 
 **/

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class CatalogCatalogHandler extends XoopsPersistableObjectHandler
{
    /**
      * is it a module name
      * 
      * @var string
      * @access public
      */
    public $ModuleName = 'catalog';
    
    /**
     * $AppXoopsDb is Application XoopsDB
     *     
     * @var array
     * @access bool    
     */
    public $AppXoopsDb = false;
    
    /**
     * $ObjectHandlers is catelog for handlers
     *     
     * @var array
     * @access protected
     */
    public $CatelogHandlers;
    
    /**
     * $Catalogrender is catelog for make a sql condition string
     *     
     * @var array
     * @access protected    
     */
    public $CatalogRender = array();
    /**
     * $Relevance is catelog for item relevance info
     *     
     * @var int
     * @access bool    
     */
    //public $Relevance = false;
    
    /**
     * $CatelogPermission is catelog for Access
     *     
     * @var array
     * @access protected    
     */
    //public $CatelogPermission;
    
    /**
     * Constructor
     */
    public function __construct ()
    {
    }
    
    /**
     * Initialize Object Handelrs
     * Create a class, there are parameters passed in the implementation of an abstract class to create the object model, 
     * there is no parameter is initialized when the object model
     *    
     * @access protected
     *     
     * @param array     $Initialize  Initia
     * @param array     $ObjectNames Object name
     *
     * @return void
     */    
    public function Initialize ($Initialize = true, $ObjectNames = array(), $AppXoopsDb = false) 
    {
        if (!is_array($ObjectNames) && $Initialize == false) {
            echo 'Your $ObjectNames is not an array!';
            exit();
        } else {
            $ObjectNames = !empty($Initialize) ? array('category', 'brand','item', 'catbrand','picture') : $ObjectNames;
        }
        
        $this->CreateObjectHandler ($ObjectNames);
        $this->AppXoopsDb = $AppXoopsDb;
    }
    
    /**
     * Create Object Handler
     *      
     * @param array     $ObjectNames   is class name  
     *      
     * @return void
     */
    public function CreateObjectHandler ($ObjectNames) 
    {   
        foreach ($ObjectNames as $k=>$v) {
            $this->CatelogHandlers[$v] =& xoops_getmodulehandler($v, $this->ModuleName);
        }
    }
    
    /**
     * Whether the application of XoopsDB
     *              
     * @return bool
     */ 
    public function getCriteriaQueries ()
    {
        return $this->AppXoopsDb;
    }
    
    /**
     * Make a sql condition string for Catelogrender
     * 
     * @return  string
     **/
    public function setCatalogRender ($render = '', $operator = 'AND')
    {
        $this->CatalogRender[] = array($render, $operator);
    }
    
    /**
     * get Catelogrender
     * 
     * @return  array
     **/
    public function getCatalogRender ()
    {
        return $this->CatalogRender;
    }
    
    //get Relevance
    public function getRelevance()
    {
    }
    
    //set PageNav
    public function CatelogPageNav ()
    {
    }
    
    // get Item
    public function CatalogGet()
    {
    }
    
    // get Items
    public function CatelogGetAll()
    {
    }
     // delete
    public function CatalogDelete()
    {
    }
    
    // deleteAll
    public function CatelogDeleteAll()
    {
    }
    
}

?>
