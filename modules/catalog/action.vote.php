<?php

include 'header.php';

$item_id = isset($_REQUEST['item_id']) ? intval($_REQUEST['item_id']) : '';
$rates = isset($_REQUEST['rate']) ? $_REQUEST['rate'] : '';
$uid = (is_object($xoopsUser)) ? $xoopsUser->getVar("uid") : 0;

$item_handler =& xoops_getmodulehandler('item', 'catalog');
$vote_handler =& xoops_getmodulehandler('vote', 'catalog');

$item_obj = $item_handler->get($item_id);
if(!is_object($item_obj) || empty($rates) || !is_array($rates)) {
    redirect_header("javascript:history.go(-1);", 1, _MD_CATALOG_INVALID_SUBMIT);
    exit();
}

include_once "include/functions.php";

$criteria = new CriteriaCompo(new Criteria("item_id", $item_id));
$criteria->add(new Criteria("uid", $uid));

if (!empty($uid)){
    if ($count = $vote_handler->getCount($criteria)){
  		  $message = _MD_CATALOG_ALREADYRATED;
  	} else {
        $ip = item_getIP();
        $_rating = 0;
        foreach ($rates as $type_id=>$rate) {
            if(!empty($rate)) {
                $_rating = $_rating + $rate;
                $vote_obj =& $vote_handler->create();
                $vote_obj->setVar('uid', $uid);
                $vote_obj->setVar('ip', $ip);
                $vote_obj->setVar('item_id', $item_id);
                $vote_obj->setVar('type_id', $type_id);
                $vote_obj->setVar('vote_value', $rate);
                $vote_obj->setVar('datetime', time());
                $vote_handler->insert($vote_obj);
                $item_obj->setVar('type'.$type_id, $item_obj->getVar('type'.$type_id) + $rate);
            }
        }
        $ave = number_format($_rating/5, 2);
        $item_obj->setVar('rating', $item_obj->getVar('rating') + $ave);
        $item_obj->setVar('rates', $item_obj->getVar('rates') + 1);
        $item_handler->insert($item_obj);
        $message = _MD_CATALOG_RATEIT_PREFIXU;
    }
}else{
    $message = _MD_CATALOG_RATELT_NOUSER;
}

redirect_header("item.php?item_id=".$item_id, 2, $message);
include 'footer.php';
?>
