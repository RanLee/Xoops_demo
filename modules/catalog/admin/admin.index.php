<?php
include 'header.php';
xoops_cp_header();
loadModuleAdminMenu(1, "");

$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : 'catagory';
$cat_id = isset($_REQUEST['cat_id']) ? intval($_REQUEST['cat_id']) : '';
$cat_pid = isset($_REQUEST['cat_pid']) ? intval($_REQUEST['cat_pid']) : '';

$cat_handler =& xoops_getmodulehandler('category', 'catalog');
$country_handler = xoops_getmodulehandler('country','catalog');
$item_handler = xoops_getmodulehandler('item','catalog');
$brand_handler = xoops_getmodulehandler('brand','catalog');

include_once XOOPS_ROOT_PATH . "/class/pagenav.php";
$start = isset($_GET["start"]) ? intval($_GET["start"]) : 0;     
$items_perpage = $xoopsModuleConfig['perpage'];   
$total = intval($country_handler->getCount());
$ext = 'op='.$op;
$pagenav = new XoopsPageNav($total, $items_perpage, $start, "start", @$ext);
$criteria = new CriteriaCompo();
$criteria->setLimit($items_perpage);
$criteria->setStart($start);
    
switch ($op) {
default:
case 'country':
    $countries = $country_handler->getAll($criteria, array('country_id', 'country_name'), false);
    $brands = $brand_handler->getAll(null, null, false, false);
    $country_ids = array();
    foreach($countries as $country_id=>$country){
        $country_ids[] = $country_id;
        $countries[$country_id]['count'] = 0;
        $countries[$country_id]['name'] = '';
        $countries[$country_id]['item_time'] = '';
        foreach($brands as $brand_id=>$brand){
            if($country_id == $brand['country_id']) $countries[$country_id]['brands'][$brand_id] = $brand;               
        }
    }
    $criteria->add(new Criteria("country_id","(".implode(", ",$country_ids). ")","in"), 'AND');
    $criteria->setSort('item_buildtime');
    $criteria->setOrder('ASC');    
     
    $items = $item_handler->getAll($criteria, array('item_name', 'country_id', 'brand_id', 'item_buildtime'), false, false);
    foreach($countries as $country_id=>$country){        
        foreach($items as $k=>$v){
            if($country_id == $v['country_id']) {
                $countries[$country_id]['count'] = $countries[$country_id]['count'] + 1;
                $countries[$country_id]['item_name'] = $v['item_name'];
                $countries[$country_id]['item_time'] = formatTimestamp($v['item_buildtime'],'Y/m/d');;
            }         
        }
    }
 
    $xoopsTpl->assign('countries', $countries);
    
break;

case 'catagory':
    $criteria->setSort('cat_weight');
    $criteria->setOrder('ASC'); 
    //$criteria->add(new Criteria('cat_pid',0));
    $categories = $cat_handler->getAll($criteria, array('cat_id', 'cat_pid','cat_name'), false);
    $cat_ids = array();
    foreach($categories as $cat_id=>$category){
        $cat_ids[] = $cat_id;
        $categories[$cat_id]['count'] = 0;
        $categories[$cat_id]['name'] = '';
        $categories[$cat_id]['item_time'] = '';
    }  
    
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria("cat_id","(".implode(", ",$cat_ids). ")","in"), 'AND');
    $criteria->setSort('item_buildtime');
    $criteria->setOrder('ASC'); 
    $items = $item_handler->getAll($criteria, array('item_name', 'cat_id', 'brand_id', 'item_buildtime'), false, false);
    $catcriteria = new CriteriaCompo();
    foreach($categories as $cat_id=>$category){
    
            $categories[$cat_id]['countnum'] = $cat_handler->getCatCount($cat_id);
    
        foreach($items as $item_id=>$item){
            if($cat_id == $item['cat_id'] ) {
                   // $categories[$cat_id]['count'] = $categories[$cat_id]['count'] + 1;                
                        
                    $categories[$cat_id]['item_name'] = $item['item_name'];
                    $categories[$cat_id]['item_time'] = !empty($item['item_buildtime']) ? formatTimestamp($item['item_buildtime'],'Y/m/d') : '';
      
            }         
        }
    }
 //   xoops_result($categories);
/*
    foreach($categories as $cat_id=>$category){
        foreach($categories as $k=>$v){
            if($cat_id == $v['cat_pid']){
                $categories[$cat_id]['subcategories'][$k] = $v;
               $categories[$cat_id]['count'] = $categories[$cat_id]['count'] + $v['count'];
                $categories[$cat_id]['item_name'] = !empty($v['item_name']) ? $v['item_name'] : '';
                $categories[$cat_id]['item_time'] = !empty($v['item_time']) ? formatTimestamp($v['item_time'],'Y/m/d') : '';
                unset($categories[$k]);
            } 
        }
    }
*/    
    //xoops_result($categories);
    $xoopsTpl->assign('categories', $categories);
break;
}
$xoopsTpl->assign('pagenav', $pagenav->renderNav());  
$xoopsTpl->assign('op', $op);
$xoopsTpl->assign('showtype', $xoopsModuleConfig['display']); 
$template_main = "catalog_admin_preview.html";    
include 'footer.php';
?>
