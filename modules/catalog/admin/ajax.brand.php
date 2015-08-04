<?php
include_once '../../../mainfile.php';
header('Content-Type:text/html; charset='._CHARSET);

global $xoopsLogger;
//$xoopsLogger->activated = false;

$country_id = isset($_REQUEST['country_id']) ? intval($_REQUEST['country_id']) : '';
$country_handler = xoops_getmodulehandler('country','catalog');
$brand_handler = xoops_getmodulehandler('brand','catalog');

$criteria = new CriteriaCompo();
$criteria->add(new Criteria('country_id', $country_id));
$criteria->setSort('brand_weight');
$criteria->setOrder('ASC');
$brands = $brand_handler->getList($criteria);

if(empty($country_id)) $brands = '';

$brands_selectbox = "<option value=''>"._NONE."</option>";

if ( !empty($brands) ) {
    foreach ( $brands as $k=>$v ) {         
        $brands_selectbox .= "<option value='".$k."'>".$v."</option>";        
    }
}

echo $brands_selectbox;


?>
