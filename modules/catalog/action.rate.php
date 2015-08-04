<?php

include 'header.php';

$rate = intval( @$_POST["rate"] );
$link_id = intval( @$_POST["link_id"] );

if(empty($link_id)){
    redirect_header("javascript:history.go(-1);", 1, _MD_CATALOG_INVALID_SUBMIT);
    exit();
}

$link_handler =& xoops_getmodulehandler('reseller', 'reseller');
$rate_handler =& xoops_getmodulehandler('rate',"reseller");
$link_obj =& $link_handler->get($link_id);

	$uid = (is_object($xoopsUser)) ? $xoopsUser->getVar("uid") : 0;
	$criteria = new CriteriaCompo(new Criteria("link_id", $link_id));
	$criteria->add(new Criteria("uid", $uid));
	if($count = $rate_handler->getCount($criteria)){
		$message = _MD_CATALOG_ALREADYRATED;
	}else{
		$rate_obj =& $rate_handler->create();
		$rate_obj->setVar("link_id", $link_id);
		$rate_obj->setVar("uid", $uid);
		$rate_obj->setVar("rate_rating", $rate);
		$rate_obj->setVar("rate_time", time());
		if(!$rate_id = $rate_handler->insert($rate_obj)){
		    redirect_header("javascript:history.go(-1);", 1, _MD_CATALOG_NOTSAVED);
		    exit();
		}
		$link_obj =& $link_handler->get($link_id);
		$link_obj->setVar( "reseller_rating", $link_obj->getVar("reseller_rating") + $rate, true );
		$link_obj->setVar( "reseller_rates", $link_obj->getVar("reseller_rates") + 1, true );
		$link_handler->insert($link_obj, true);
		$message = _MD_CATALOG_RATEIT_PREFIXU;
	}

redirect_header("index.php", 2, $message);

include 'footer.php';
?>
