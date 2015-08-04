<?php

include 'header.php';
include dirname(__FILE__) . '/include/function.json.php';
header('Content-Type:text/html; charset=utf-8');
global $xoopsLogger;
$xoopsLogger->activated = false;
$rate = intval( @$_GET["rate"] );
$link_id = intval( @$_GET["link_id"] );
$item_id = intval( @$_GET["item_id"] );

if(empty($link_id)){
    return false;
    exit();
}
    
$link_handler =& xoops_getmodulehandler('reseller', 'reseller');
$rate_handler =& xoops_getmodulehandler('rate',"reseller");
$link_obj =& $link_handler->get($link_id);

$uid = (is_object($xoopsUser)) ? $xoopsUser->getVar("uid") : 0;
$criteria = new CriteriaCompo();
$criteria->add(new Criteria("link_id", $link_id));
$criteria->add(new Criteria("uid", $uid));
$criteria->add(new Criteria("item_id", $item_id));

if(!empty($uid)){
  	if($count = $rate_handler->getCount($criteria)){
  		$message = _MD_CATALOG_ALREADYRATED;
  	}else{
  		$rate_obj =& $rate_handler->create();
  		$rate_obj->setVar("link_id", $link_id);
  		$rate_obj->setVar("item_id", $item_id);
  		$rate_obj->setVar("uid", $uid);
  		$rate_obj->setVar("rate_rating", $rate);
  		$rate_obj->setVar("rate_time", time());
  		if(!$rate_id = $rate_handler->insert($rate_obj)){
  		    $message = _MD_CATALOG_NOTSAVED;
  		    exit();
  		}
  		$link_obj =& $link_handler->get($link_id);
  		$link_obj->setVar( "reseller_rating", $link_obj->getVar("reseller_rating") + $rate, true );
  		$link_obj->setVar( "reseller_rates", $link_obj->getVar("reseller_rates") + 1, true );
  		$link_handler->insert($link_obj, true);
  		$message = _MD_CATALOG_RATEIT_PREFIXU;
  	}
}else{
    $message = _MD_CATALOG_RATELT_NOUSER;
}

$message = $message;
echo json_encode(array('rating'=>$link_obj->getRatingAverage(), 'rates'=>$link_obj->getVar("reseller_rates"), 'msg'=>$message));
?>
