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
 * @version         $Id: subpage.php  $
 */

include 'header.php';

if($xoopsModuleConfig['display'] == 1) {

    $brand_handler = xoops_getmodulehandler('brand','catalog');
    $country_handler = xoops_getmodulehandler('country','catalog');
    $brands_id = isset($_GET['brand_id']) ? intval($_GET['brand_id']) : '';
    $country_limit = $xoopsModuleConfig['countries'];
    $brand_limit = $xoopsModuleConfig['brands'];

    $countries = $country_handler->getAll(null, null, false);
    $brands = $brand_handler->getAll(null, null, false);

    foreach($countries as $country_id=>$country){
        foreach($brands as $brand_id=>$brand){
            if($country_id == $brand['country_id']) $countries[$country_id]['brands'][$brand_id] = $brand;
        }
    }

    $xoopsOption['template_main'] = 'catalog_brandinfo.html';
    include XOOPS_ROOT_PATH.'/header.php';


    if ($brands_id){
        $brand_obj = $brand_handler->get($brands_id);
        $xoopsTpl->assign('brand',$brand_obj->getValues(null,'n'));
    }
    $xoopsTpl->assign('countries', $countries);

} else {

    $start = isset( $_GET['start'] ) ? trim($_GET['start']) : 0;
   	$limit = $xoopsModuleConfig['index_item_limit']; //首頁顯示商品的數�?
   	$cid = '';
    if($cid) $ext = '&cid='.$cid;

    $cat_handler = xoops_getmodulehandler('category','catalog');
    $item_handler = xoops_getmodulehandler('item','catalog');

    $xoopsOption['template_main'] = 'catalog_coubrand.html';
    include XOOPS_ROOT_PATH . '/header.php';

    xoops_load("cache");
    if (!$categories = XoopsCache::read('config_categories')) {
        $categories =& $cat_handler->getTrees($pid = 0, $prefix = "--");
        $categories = XoopsCache::write('config_categories', $categories);
    }

    foreach ($categories as $id => $cat) {
        $cat_options[$id] = $cat["prefix"] . $cat["cat_name"];
    }
    $xoopsTpl->assign('cat_options', $cat_options);
    $xoopsTpl->assign('categories', $categories);

    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('status', 1));
    if($cid) {
        $criteria->add(new Criteria('cat_id', $cid));
        $criteria->setSort('weight');
        $criteria->setOrder('ASC');
    } else {
        $criteria->setSort('weight');
        $criteria->setOrder('ASC');
    }
    $criteria->setLimit($limit);
    $criteria->setStart($start);

    if ($item_handler->getCount($criteria) > $limit ){
        include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
        $pageNav = new XoopsPageNav($item_handler->getCount($criteria), $limit, $start, 'start', @$ext);
        $xoopsTpl->assign('pagenav', $pageNav->renderNav(4));
    }

    $items = $item_handler->getAll($criteria, null ,false);
    foreach ($items as $k=>$v) {
        $items[$k]['item_buildtime'] = formatTimestamp($v['item_buildtime'],'Y/m/d');
    }

    $xoopsTpl->assign('items', $items);
}
include 'footer.php';
?>
