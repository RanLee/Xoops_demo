<?php
include 'header.php';
xoops_cp_header();
loadModuleAdminMenu(6);

$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : 'list';
$item_id = isset($_REQUEST['item_id']) ? trim($_REQUEST['item_id']) : '';
$cat_id = isset($_REQUEST['cat_id']) ? trim($_REQUEST['cat_id']) : '';

$category_handler = xoops_getmodulehandler('category','catalog');
$item_handler = xoops_getmodulehandler('item','catalog');
$byitem_handler = xoops_getmodulehandler('itembyitems','catalog');
$brand_handler = xoops_getmodulehandler('brand','catalog');

$link_cat = !empty($cat_id) ? '&amp;cat_id='.$cat_id : '';
$item_obj = $item_handler->get($item_id);
if(!is_object($item_obj)) redirect_header('admin.item.php', 3, _AM_CATALOG_NOMSG);   

switch ($op) {
    default:
    case 'list':
    //item
    $item = $item_obj->getValues(null, 'n');
    $xoopsTpl->assign('item', $item);
    
    //by_itmes
    $criteria = new Criteria('item_id', $item_id);
    $byitemsids = $byitem_handler->getAll($criteria, null, false);

    if(!empty($byitemsids)) {
        foreach($byitemsids as $v) {
            $byitem_ids[$v['by_item_id']] = $v['by_item_id'];
        }
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria("item_id","(".implode(", ",$byitem_ids). ")","in"), 'AND');
        $by_items = $item_handler->getList($criteria);
        
        $xoopsTpl->assign('by_items', $by_items);
    }

    //category
    $catTree =& $category_handler->getTrees(0, "--");
    $categories = array();
    if($catTree){
        foreach ($catTree as $id => $cat) {
            $categories[$id] = $cat["prefix"] . $cat["cat_name"];
        }
    }

    if(!empty($cat_id)) {
        $criteria = new Criteria('cat_id', $cat_id);
        $items = $item_handler->getAll($criteria, array('cat_id', 'brand_id', 'item_name'), false);
        if(!empty($items)) {
            $byitem_ids[$item_id] = $item_id;
            foreach ($items as $k=>$v) {
                $ids[$v['brand_id']] = $v['brand_id'];
            }
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria("brand_id","(".implode(", ",$ids). ")","in"), 'AND');
            $brands = $brand_handler->getList($criteria);
            foreach ($items as $k=>$v) {
                $items[$k]['brand'] = $brands[$v['brand_id']];
                $items[$k]['checkbox'] = isset($byitem_ids[$k]) ? 0 : 1;
            }
        }
        $xoopsTpl->assign('items', $items);
    }
    $xoopsTpl->assign('cat_id', $cat_id);
    $xoopsTpl->assign('categories', $categories);
    $xoopsTpl->assign('item_id', $item_id);


    $xoopsTpl->display("db:catalog_admin_byitem.html");
    break;

    case 'insertAll': 
    $item_ids = isset($_REQUEST['item_ids']) ? $_REQUEST['item_ids'] : '';
    foreach ($item_ids as $id) {
        $byitem_obj =& $byitem_handler->create();
        $byitem_obj->setVar('item_id', $item_id);
        $byitem_obj->setVar('by_item_id', $id);
        $byitem_obj->setVar('datetime', time());
        $byitem_handler->insert($byitem_obj);
        unset($byitem_obj);
    }
    redirect_header('admin.byitems.php?item_id='.$item_id.$link_cat, 3, _AM_CATALOG_ADDSUCCESS);
    break;

    case 'delete': 
    $by_item_id = isset($_REQUEST['by_item_id']) ? $_REQUEST['by_item_id'] : '';
    $criteria = new CriteriaCompo();
    $criteria ->add( new Criteria('item_id', $item_id));
    $criteria ->add( new Criteria('by_item_id', $by_item_id));
    if($byitem_handler->getCount($criteria)) $byitem_handler->deleteAll($criteria, true);
    
    redirect_header('admin.byitems.php?item_id='.$item_id.$link_cat, 3, _AM_CATALOG_DELETESUCCESS);
    break;

    case 'deleteAll': 
    $item_ids = isset($_REQUEST['item']) ? $_REQUEST['item'] : '';
    $criteria = new CriteriaCompo();
    $criteria ->add( new Criteria('item_id', $item_id));
    if(!is_array($item_ids) || empty($item_ids)) redirect_header('admin.byitems.php?item_id='.$item_id.$link_cat, 3, _AM_CATALOG_AFTERCHOICESUBMIT);
    $criteria->add(new Criteria("by_item_id","(".implode(", ",$item_ids). ")","in"), 'AND');
    if($byitem_handler->getCount($criteria)) $byitem_handler->deleteAll($criteria, true);

    redirect_header('admin.byitems.php?item_id='.$item_id.$link_cat, 3, _AM_CATALOG_DELETESUCCESS);
    break;
}

include 'footer.php';

?>
