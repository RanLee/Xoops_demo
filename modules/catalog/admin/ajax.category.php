<?php
include_once '../../../mainfile.php';
header('Content-Type:text/html; charset='._CHARSET);

global $xoopsLogger;

$cat_id = isset($_REQUEST['cat_id']) ? intval($_REQUEST['cat_id']) : '';
$category_handler = xoops_getmodulehandler('category','catalog');


$criteria = new CriteriaCompo();
$criteria->add(new Criteria('cat_pid', $cat_id));
$criteria->setSort('cat_weight');
$criteria->setOrder('ASC');
$categories = $category_handler->getList($criteria);

if(empty($cat_id)) $categories = '';

$cats_selectbox = "<option value=''>"._NONE."</option>";

if ( !empty($categories) ) {
    foreach ( $categories as $k=>$v ) {         
        $cats_selectbox .= "<option value='".$k."'>".$v."</option>";        
    }
}

echo $cats_selectbox;


?>
