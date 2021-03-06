<?php

function catalog_category_items_edit ($options) {

  	include_once XOOPS_ROOT_PATH."/modules/catalog/class/blockform.php";
  	$form = new XoopsBlockForm("","","");

  	$category_handler = xoops_getmodulehandler('category','catalog');
    $categories =& $category_handler->getTrees(0, "--");
    $cat_options = array();
    if($categories){
        foreach ($categories as $id => $cat) {
            $cat_options[$id] = $cat["prefix"] . $cat["cat_name"];
        }
    }
    $cat_select = new XoopsFormSelect('顯示分類', 'options[0]',$options[0]);
    $cat_select->addOption(0, '全部');
    $cat_select->addOptionArray($cat_options);
    $form->addElement($cat_select, true);

    $form->addElement(new XoopsFormText("顯示條目數","options[1]",5,2,$options[1]), true);
    $form->addElement(new XoopsFormText("標題最大字元","options[2]",5,2,$options[2]), true);
    return $form->render();
}

function catalog_category_items_show ($options) {

    $category_handler = xoops_getmodulehandler('category','catalog');
    $item_handler = xoops_getmodulehandler('item','catalog');

    $criteria = new CriteriaCompo();
    if(!empty($options[0])) {
        $categories = $category_handler->getTrees($options[0]);
        foreach($categories as $k=>$v) {
            $cat_ids[] = $k;
        }
        $criteria->add(new Criteria("cat_id","(".implode(", ",$cat_ids). ")","in"), 'AND');
    }
    $criteria->add(new Criteria('status', 1));
    $criteria->setSort('weight');
    $criteria->setOrder('ASC');
    $criteria->setLimit($options[1]);
    $criteria->setStart(0);
    $items = $item_handler->getAll($criteria, null,  false, false);
    foreach ($items as $k=>$v) {
        $items[$k]['item_picture'] = !empty($v['item_picture']) ? XOOPS_URL . '/uploads/gallery/thumb_' . $v['item_picture'] : XOOPS_URL . '/modules/catalog/images/nopic.gif';

        if($v['rates']){
        	$items[$k]['rating'] = number_format($v['rating']/$v['rates'], 2);
        }
    }

    $block['items'] = $items;
    return $block;
}

function catalog_items_special_edit ($options) {

  	include_once XOOPS_ROOT_PATH."/modules/catalog/class/blockform.php";
  	$form = new XoopsBlockForm("","","");

  	$category_handler = xoops_getmodulehandler('category','catalog');
    $categories =& $category_handler->getTrees(0, "--");
    $cat_options = array();
    if($categories){
        foreach ($categories as $id => $cat) {
            $cat_options[$id] = $cat["prefix"] . $cat["cat_name"];
        }
    }
    $cat_select = new XoopsFormSelect('顯示分類', 'options[0]',$options[0]);
    $cat_select->addOption(0, '全部');
    $cat_select->addOptionArray($cat_options);
    $form->addElement($cat_select, true);

    $special_select = new XoopsFormSelect('顯示種類', 'options[1]',$options[1]);
    $special_select->addOption(1, '精品排行');
    $special_select->addOption(2, '新品排行');
    $special_select->addOption(3, '熱銷排行');
    $special_select->addOption(4, '點擊率排行');
    $form->addElement($special_select, true);

    $form->addElement(new XoopsFormText("顯示條目數","options[2]",5,2,$options[2]), true);
    $form->addElement(new XoopsFormText("標題最大字元","options[3]",5,2,$options[3]), true);
    return $form->render();
}

function catalog_items_special_show ($options) {

    $category_handler = xoops_getmodulehandler('category','catalog');
    $item_handler = xoops_getmodulehandler('item','catalog');

    $criteria = new CriteriaCompo();
    if(!empty($options[0])) {
        $categories = $category_handler->getTrees($options[0]);
        foreach($categories as $k=>$v) {
            $cat_ids[] = $k;
        }
        $criteria->add(new Criteria("cat_id","(".implode(", ",$cat_ids). ")","in"), 'AND');
    }

    if($options[1] == 1) {
        $criteria->add(new Criteria('item_best', 1));
    } elseif ($options[1] == 2) {
        $criteria->add(new Criteria('item_newarrival', 1));
    } elseif ($options[1] == 3) {
        $criteria->add(new Criteria('item_hot', 1));
    } else {}

    $criteria->add(new Criteria('status', 1));
    if($options[1] == 4) {
    $criteria->setSort('item_counter');
    $criteria->setOrder('DESC');
    } else{
        $criteria->setSort('weight');
        $criteria->setOrder('ASC');
    }
    $criteria->setLimit($options[2]);
    $criteria->setStart(0);
    $items = $item_handler->getAll($criteria, null, false);
    foreach ($items as $k=>$v) {
        $items[$k]['item_picture'] = !empty($v['item_picture']) ? XOOPS_URL . '/uploads/gallery/thumb_' . $v['item_picture'] : XOOPS_URL . '/modules/catalog/images/nopic.gif';
           if($v['rates']){
        	$items[$k]['rating'] = number_format($v['rating']/$v['rates'], 2);
        }
    }
    $block['items'] = $items;

    return $block;
}

function catalog_categories_edit ($options) {

  	include_once XOOPS_ROOT_PATH."/modules/catalog/class/blockform.php";
  	$form = new XoopsBlockForm("","","");

  	$category_handler = xoops_getmodulehandler('category','catalog');
    $categories =& $category_handler->getTrees(0, "--");
    $cat_options = array();
    if($categories){
        foreach ($categories as $id => $cat) {
            $cat_options[$id] = $cat["prefix"] . $cat["cat_name"];
        }
    }
    $cat_select = new XoopsFormSelect('演算上色功能表', 'options[0]',$options[0]);
    $cat_select->addOption(0, '全部');
    $cat_select->addOptionArray($cat_options);
    $form->addElement($cat_select, true);

    return $form->render();
}

function catalog_categories_show ($options) {
    include_once XOOPS_ROOT_PATH.'/modules/catalog/include/functions.php';
    $category_handler = xoops_getmodulehandler('category','catalog');
    $categories = $category_handler->getTree($options[0]);
    $menu = $category_handler->makeDisplay($categories);

    $block['categories'] = $menu;
    return $block;
}

function catalog_category_brands_edit ($options) {

  	include_once XOOPS_ROOT_PATH."/modules/catalog/class/blockform.php";
  	$form = new XoopsBlockForm("","","");

  	$category_handler = xoops_getmodulehandler('category','catalog');
    $categories =& $category_handler->getTrees(0, "--");
    $cat_options = array();
    if($categories){
        foreach ($categories as $id => $cat) {
            $cat_options[$id] = $cat["prefix"] . $cat["cat_name"];
        }
    }
    $cat_select = new XoopsFormSelect('顯示分類', 'options[0]',$options[0]);
    $cat_select->addOption(0, '全部');
    $cat_select->addOptionArray($cat_options);
    $form->addElement($cat_select, true);

    return $form->render();
}

function catalog_category_brands_show ($options) {

    $category_handler = xoops_getmodulehandler('category','catalog');
    $item_handler = xoops_getmodulehandler('item','catalog');
    $catbrand_handler = xoops_getmodulehandler('catbrand','catalog');
    $criteria = new CriteriaCompo();
    if(!empty($options[0])) {
        $categories = $category_handler->getTrees($options[0]);
        foreach($categories as $k=>$v) {
            $cat_ids[] = $k;
        }
        $criteria->add(new Criteria("cat_id","(".implode(", ",$cat_ids). ")","in"));
    }
    $criteria->setSort('brand_id');
    $criteria->setOrder('ASC');
    $catbrands = $catbrand_handler->getAll($criteria, null, false);
    $new_brands = '';
    foreach($catbrands as $k=>$v) {
        $new_brands[$v['brand_id']] = $v;
    }
    $block['catbrands'] = $new_brands;
    return $block;

}
?>