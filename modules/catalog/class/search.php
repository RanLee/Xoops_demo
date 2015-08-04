<?php

/**
 * Search 
 * 
 * @author Magic.Shao
 * @copyright copyright &copy; 2010
 * @package module::catalog
 *
 * {@link XoopsObject} 
 * 
 * Example1
 * $search_handler = xoops_getmodulehandler(search, 'catelog');   
 * $search_handler -> CatelogPageNav(0, 10, 'weight', 'ASC');
 * $res = $search_handler -> CategoryByItems($cat_id, true);
 * 
 * Example2
 * $res = $search_handler -> getItems('property_value', '銀色', true);  
 *  
 * Example3
 * $search_handler -> CatelogPageNav(0, 10, 'weight', 'ASC');  
 * $search_handler -> ProperyValueByItemIds('寬屏'); 
 * $criteria1 = new Criteria("item_id","(".implode(", ",$search_handler->item_ids). ")","in"); 
 * $criteria2 = new Criteria('cat_id', $cat_id); 
 * $search_handler -> setRender($criteria1, 'AND'); 
 * $search_handler -> setRender($criteria2, 'AND'); 
 * $res = $search_handler->JoinSelectItems(1, true, false); 
 **/

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

include_once dirname(dirname(__FILE__))."/class/catalog.php";

class CataLogSearchHandler extends CatalogCatalogHandler
{
    /**
    * $ObjectHandlers is catelog for handlers
    *     
    * @var array
    * @access public    
    */
    public $ObjectHandlers = array();
    
    /**
    * $pagenav for param
    *     
    * @var array
    * @access public    
    */
    public $CateLogPageNavParam = array(
        'start' => 0,
        'limit' => 10,
        'sort'  => null,
        'order' => 'ASC',
        'ext'   => ''
    );
    
    /**
    * $item_id for items ID
    *     
    * @var int
    * @access public    
    */
    //public $item_id;
    
    /**
    * $item_ids for items ID
    *     
    * @var array
    * @access public    
    */
    public $item_ids = array();
    
    /**
    * Constructor
    * Initialize Object Handelrs
    *  
    * @return void
    */
    public function CataLogSearchHandler () 
    {
        $this->SearchInitialize();
    }
    
    // Search Object for Initialize
    public function SearchInitialize($Initialize = true, $ObjectNames = array(), $AppXoopsDb = false)
    {
        $this->Initialize($Initialize, $ObjectNames, false);
    }
    
    //set items ids
    public function setItemIds ($item_ids = array())
    {
        if(!empty($item_ids) && is_array($item_ids)) $this->item_ids = $item_ids;
    }
    
    // get item ids 
    public function getItemIds ()
    {
        if(!empty($this->item_ids) && is_array($this->item_ids)) array_unique($this->item_ids);
        return $this->item_ids;
    }
    
    /**
    * Create pagenav param
    *     
    * @access private    
    */
    public function CatelogPageNav ($Start = 0, $Limit = 10, $Sort = null, $Order = 'ASC', $Ext = '')
    {
        $this->CateLogPageNavParam = array(
            'start' => $Start,
            'limit' => $Limit,
            'sort'  => $Sort,
            'order' => $Order,
            'ext'   => $Ext
        );
    }
    
    /**
    * Display PageNav
    *  
    * @return pagenav
    */
    function CatelogDisplayPageNav ($_Handler, $Criteria, $Limit, $Start, $Ext)
    {
        include_once XOOPS_ROOT_PATH.'/class/pagenav.php';  
        $pageNav = new XoopsPageNav($_Handler->getCount($Criteria), $Limit, $Start, 'start', @$Ext);
        
        return $pageNav->renderNav(4);
    }
    
    /**
    * get category id by item
    *    
    * @access public
    *
    * @param int       $cat_id    Category Id
    * @param mixed     $pagenav   The need for paging
    *
    * @return pagenav
    * @return items    
    */
    public function CategoryByItems ($cat_id, $status = 1, $pagenav = null)
    {
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('cat_id', $cat_id), 'AND');
        $criteria->add(new Criteria('status', $status));
        if($pagenav = true) {
            $criteria->setSort($this->CateLogPageNavParam['sort']);         
            $criteria->setOrder($this->CateLogPageNavParam['order']);
            $criteria->setLimit($this->CateLogPageNavParam['limit']);
            $criteria->setStart($this->CateLogPageNavParam['start']);
            if ($this->CatelogHandlers['item']->getCount($criteria) > $this->CateLogPageNavParam['limit'] ){
                include_once XOOPS_ROOT_PATH.'/class/pagenav.php';  
                $result['pagenav'] = $this->CatelogDisplayPageNav($this->CatelogHandlers['item'], $criteria, $this->CateLogPageNavParam['limit'], $this->CateLogPageNavParam['start'], $this->CateLogPageNavParam['ext']);
            } 
        }
        $result['items'] = $this->CatelogHandlers['item']->getAll($criteria, null, false);
        
        return $result;
    }
    
    /**
    * get brand id by item
    *    
    * @access public
    *
    * @param int       $brand_id    Brand Id
    * @param mixed     $pagenav   The need for paging
    *
    * @return pagenav
    * @return items    
    */
    public function BrandByItems ($brand_id, $status = 1, $pagenav = null)
    {
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('brand_id', $brand_id), 'AND');
        $criteria->add(new Criteria('status', $status));
        if($pagenav = true) {
            $criteria->setSort($this->CateLogPageNavParam['sort']);         
            $criteria->setOrder($this->CateLogPageNavParam['order']);
            $criteria->setLimit($this->CateLogPageNavParam['limit']);
            $criteria->setStart($this->CateLogPageNavParam['start']);
            if ($this->CatelogHandlers['item']->getCount($criteria) > $this->CateLogPageNavParam['limit'] ){
                include_once XOOPS_ROOT_PATH.'/class/pagenav.php';  
                $result['pagenav'] = $this->CatelogDisplayPageNav($this->CatelogHandlers['item'], $criteria, $this->CateLogPageNavParam['limit'], $this->CateLogPageNavParam['start'], $this->CateLogPageNavParam['ext']);
            } 
        }
        $result['items'] = $this->CatelogHandlers['item']->getAll($criteria, null, false);
        
        return $result;
    }
    
    /**
    * get type id by item
    *    
    * @access public
    *
    * @param int       $type_id    Type Id
    * @param mixed     $pagenav   The need for paging
    *
    * @return pagenav
    * @return items    
    */
    public function TypeByItems ($type_id, $status = 1, $pagenav = null)
    {
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('item_type', $type_id), 'AND');
        $criteria->add(new Criteria('status', $status));
        if($pagenav = true) {
            $criteria->setSort($this->CateLogPageNavParam['sort']);         
            $criteria->setOrder($this->CateLogPageNavParam['order']);
            $criteria->setLimit($this->CateLogPageNavParam['limit']);
            $criteria->setStart($this->CateLogPageNavParam['start']);
            if ($this->CatelogHandlers['item']->getCount($criteria) > $this->CateLogPageNavParam['limit'] ){
                include_once XOOPS_ROOT_PATH.'/class/pagenav.php';  
                $result['pagenav'] = $this->CatelogDisplayPageNav($this->CatelogHandlers['item'], $criteria, $this->CateLogPageNavParam['limit'], $this->CateLogPageNavParam['start'], $this->CateLogPageNavParam['ext']);
            } 
        }
        $result['items'] = $this->CatelogHandlers['item']->getAll($criteria, null, false);
        
        return $result;
    }
    
    
    /**
    * get propery type_id by item_ids
    *     
    * @access private    
    */
    public function TypeByItemIds ($value)
    {
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('type_id', $value));
        $ips = $this->CatelogHandlers['itemsproperties']->getAll($criteria, null, false);
        if(!empty($ips)) {
            foreach ($ips as $k=>$ip){
                $this->item_ids[] = $ip['item_id'];
            }
            $this->item_ids = array_unique($this->item_ids);
        }
    }
    
    /**
    * get propery value by item_ids
    *     
    * @access private    
    */
    public function ProperyValueByItemIds ($value)
    {
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('property_value', $value));
        $ips = $this->CatelogHandlers['itemsproperties']->getAll($criteria, null, false);
        if(!empty($ips)) {
            foreach ($ips as $k=>$ip){
                $this->item_ids[] = $ip['item_id'];
            }
            $this->item_ids = array_unique($this->item_ids);
        }
    }
    
    public function ProperyValuesByItemIds ($values)
    {

        foreach ($values as $key=>$value){
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria('property_value', $value));
            $ips = $this->CatelogHandlers['itemsproperties']->getAll($criteria, null, false);
            $item_ids = array();
            if(!empty($ips)) {
                foreach ($ips as $k=>$ip){
                    $item_ids[] = $ip['item_id'];
                }
                if($this->item_ids){
                    $this->item_ids = array_intersect($this->item_ids, $item_ids);
                } else {
                    $this->item_ids = $item_ids;
                }
                
            }
            unset($item_ids);
        }
    }
    
    /**
    * get propery id by item_ids
    *     
    * @access private    
    */
    public function ProperyIdByItemIds ($propery_id)
    {
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('propery_id', $propery_id));
        $ips = $this->CatelogHandlers['itemsproperties']->getAll($criteria, null, false);
        if(!empty($ips)) {
            foreach ($ips as $k=>$ip){
                $this->item_ids[] = $ip['item_id'];
            }
            $this->item_ids = array_unique($this->item_ids);
        }
    }
    
    /**
    * According to the property sheet parameters get items
    * 
    * @param   string     $field             According to property sheet information returns item_ids
    * @param   string     $value             Field value
    * @param   string     $status            View Status
    * @param   null       $pagenav           Whether the application pagenav
    *           
    * @access public
    */
    public function getItems ($field = '', $value, $status = 1, $pagenav = null)
    {
        
        if($field == 'type_id') {
            $this->TypeByItemIds($value);
        } elseif ($field == 'propery_id') {
            $this->ProperyIdByItemIds($value);
        }
         elseif ($field == 'property_value') {
            $this->ProperyValueByItemIds($value);
        } else {
            $this->item_ids = null;
        }
        
        $criteria = new CriteriaCompo();
        if (!empty($this->item_ids) || is_array($this->item_ids)) $criteria->add(new Criteria("item_id","(".implode(", ",$this->item_ids). ")","in"), 'AND');
        $criteria->add(new Criteria('status', $status));
        if($pagenav = true) {
            $criteria->setSort($this->CateLogPageNavParam['sort']);         
            $criteria->setOrder($this->CateLogPageNavParam['order']);
            $criteria->setLimit($this->CateLogPageNavParam['limit']);
            $criteria->setStart($this->CateLogPageNavParam['start']);
            if ($this->CatelogHandlers['item']->getCount($criteria) > $this->CateLogPageNavParam['limit'] ){
                include_once XOOPS_ROOT_PATH.'/class/pagenav.php';  
                $result['pagenav'] = $this->CatelogDisplayPageNav($this->CatelogHandlers['item'], $criteria, $this->CateLogPageNavParam['limit'], $this->CateLogPageNavParam['start'], $this->CateLogPageNavParam['ext']);
            } 
        }
        $result['items'] = $this->CatelogHandlers['item']->getAll($criteria, null, false);

        return $result;
    }
    
    /**
    * setRender for JoinSelectItem 
    * 
    * @param   string       $criteria           example:  $criteria = new criteria('cat_id', 1);
    * @param   string       $operator           example:  $operator = 'AND';
    *           
    * @access public
    */
    public function setRender ($criteria, $operator = 'AND')
    {
        $this->setCatalogRender ($criteria, $operator);
    }
    
    /**
    * According to the property sheet parameters get items
    * 
    * @param   int        $status            View Status
    * @param   null       $pagenav           Whether the application pagenav
    * @param   boolean    $Relevance         Whether the application relevance  
    *           
    * @access public
    */
    public function JoinSelectItems ($status = 1, $pagenav = null, $Relevance = false)
    {     
        $criteria = new CriteriaCompo();
        if(is_array($this->CatalogRender) && count($this->CatalogRender) > 0) {
            foreach ($this->CatalogRender as $render) {
                $criteria->add($render[0], $render[1]);
            }

        }
        $criteria->add(new Criteria('status', $status));
                
        if($pagenav = true) {
            $criteria->setSort($this->CateLogPageNavParam['sort']);         
            $criteria->setOrder($this->CateLogPageNavParam['order']);
            $criteria->setLimit($this->CateLogPageNavParam['limit']);
            $criteria->setStart($this->CateLogPageNavParam['start']);
            if ($this->CatelogHandlers['item']->getCount($criteria) > $this->CateLogPageNavParam['limit'] ){
                include_once XOOPS_ROOT_PATH.'/class/pagenav.php';  
                $result['pagenav'] = $this->CatelogDisplayPageNav($this->CatelogHandlers['item'], $criteria, $this->CateLogPageNavParam['limit'], $this->CateLogPageNavParam['start'], $this->CateLogPageNavParam['ext']);
            }
        }
        if($Relevance) $this->item_ids = $this->CatelogHandlers['item']->getIds($criteria);
        $result['items'] = $this->CatelogHandlers['item']->getAll($criteria, null, false);

        return $result;
    }
    
    /**
    * get item relevance
    * 
    * @param   string     $HandlerName       Handler name
    * @param   array      $ext               Handler names  exp:array('article', 'category')  
    *           
    * @access public
    */
    public function getRelevance ($HandlerName = 'picture', $ext = array())
    {
        if (empty($this->item_ids) || !is_array($this->item_ids)) return false;

        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria("item_id","(".implode(", ",$this->item_ids). ")","in"), 'AND');
        $res[$HandlerName] = $this->CatelogHandlers[$HandlerName] ->getAll($criteria, null, false);

        if (!empty($ext) && is_array($ext)) {
            foreach ($ext as $ext_handlerName) {
                $res[$ext_handlerName] = $this->CatelogHandlers[$ext_handlerName]->getAll($criteria, null, false);
            }
        }
        
        return $res;
    }
  
    public function getRelProperty ()
    {
        if (empty($this->item_ids) || !is_array($this->item_ids)) return false;

        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria("item_id","(".implode(", ",$this->item_ids). ")","in"), 'AND');
        $res[$HandlerName] = $this->CatelogHandlers[$HandlerName] ->getAll($criteria, null, false);

        if (!empty($ext) && is_array($ext)) {
            foreach ($ext as $ext_handlerName) {
                $res[$ext_handlerName] = $this->CatelogHandlers[$ext_handlerName]->getAll($criteria, null, false);
            }
        }
        
        return $res;
    }
}
?>
