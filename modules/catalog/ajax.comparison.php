 <?php
//include_once '../../../mainfile.php';
include_once 'header.php';
include_once "include/functions.php";
header('Content-Type:text/html; charset='._CHARSET);

global $xoopsLogger;
$xoopsLogger->activated = false;

$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : 'exit';
$cat_id = isset($_REQUEST['cat_id']) ? intval($_REQUEST['cat_id']) : '';
$brand_id = isset($_REQUEST['brand_id']) ? intval($_REQUEST['brand_id']) : '';
$item_id = isset($_REQUEST['item_id']) ? intval($_REQUEST['item_id']) : '';
$item_ids = isset($_REQUEST['item_ids']) ? $_REQUEST['item_ids'] : '';

$search_handler =& xoops_getmodulehandler('search', 'catalog');
$item_handler =& xoops_getmodulehandler('item', 'catalog');
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

switch ($op) {
    case 'display':        
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('cat_id', $cat_id));
        $criteria->add(new Criteria('brand_id', $brand_id));
        $criteria->add(new Criteria('status', 1));
        $items = $search_handler->CatelogHandlers['item']->getList($criteria);

        echo '<option value="0">'._MD_CATALOG_ITEMTYPECHOICE.'</option>';
        foreach($items as $key=>$value){         
            echo '<option'.$select.' value="'.$key.'">'.$value.'</option>';
        }
    break;
    
    case 'setcookie':
        item_setcookie("favorites[" . $item_id . "]", time());
        /*
        $cookie_item_ids = item_getcookie('favorites');
        $item_ids = '';
        if($cookie_item_ids) {
            foreach($cookie_item_ids as $k=>$v){
                $item_ids[$k] = $k;
            }
            $item_ids = array_unique($item_ids);
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria("item_id","(".implode(", ",$item_ids). ")","in"), 'AND');
            $cookie_items = $item_handler->getAll($criteria, array('item_name', 'item_picture'), false);
            echo '<ul>';
            if($cookie_items) {
                foreach ($cookie_items as $k=>$v) {
                    echo '<li><a href="item.php?item_id='.$k.'"><img src="'.XOOPS_URL.'/uploads/gallery/'.$v['item_picture'].'" width="65" alt="'.$v['item_name'].'" /></a></li>';
                }
            }
            echo '</ul>';
        }
        
        if(count(item_getcookie('favorites'))+1 < 10) {
            item_setcookie("favorites[" . $item_id . "]", time());
            $item_obj = $search_handler->CatelogHandlers['item']->get($item_id);
            $item_name = $item_obj->getVar('item_name');
            $item_picture = $item_obj->getVar('item_picture');
            $item_picture = !empty($item_picture) ? XOOPS_URL . '/uploads/gallery/thumb_' . $item_picture : XOOPS_URL . '/modules/catalog/images/nopic.gif';
            echo '<div id="favorites_item_id'.$item_id.'">';
            echo '<img src="'.$item_picture.'" width="100" height="80" />';
            echo $item_name.'&nbsp;&nbsp;[ <a href="##" onclick="deletefavorites('.$item_id.');">X</a> ]&nbsp;&nbsp;';
            echo '</div>';
        }
        */
    break;
    
    case 'delcookie':
        item_setcookie("favorites[" . $item_id . "]", '',time()-1);
        /*
        $cookie_item_ids = item_getcookie('favorites');
        if($cookie_item_ids) {
            foreach($cookie_item_ids as $k=>$v){
                $item_ids[$k] = $k;
            }
            $item_ids = array_unique($item_ids);
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria("item_id","(".implode(", ",$item_ids). ")","in"), 'AND');
            $cookie_items = $item_handler->getAll($criteria, array('item_name', 'item_picture'), false);
            echo '<ul>';
            foreach ($cookie_items as $k=>$v) {
                echo '<li><a href="item.php?item_id='.$k.'"><img src="'.XOOPS_URL.'/uploads/gallery/'.$v['item_picture'].'" width="65" alt="'.$v['item_name'].'" /></a></li>';
            }
            echo '</ul>';
        }
        */
    break;
    
    case 'count':
        $ac = isset($_REQUEST['ac']) ? $_REQUEST['ac'] : '';
        if($ac == 'insert') {
            $count = count(item_getcookie('favorites'))+1;
        } elseif($ac == 'delete') {
            $count = count(item_getcookie('favorites'))-1;
        } else{
            $count = count(item_getcookie('favorites'));
        }
        echo $count.'/4';

    break;
    
    default:
    case 'exit':
    break;
}

?>
