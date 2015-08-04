<?php
if (!defined('XOOPS_ROOT_PATH')){ exit(); }

function xoops_module_install_catalog(&$module)
{
    return true ;
}
function xoops_module_update_catalog(&$module, $prev_version = null)
{
	global $xoopsDB;
	  $query = 'ALTER TABLE `'.$xoopsDB->prefix("catalog_item").'` CHANGE `shop_price` `shop_price` VARCHAR( 255 ) NOT NULL';
	  $xoopsDB->queryF($query);
	  $query = 'ALTER TABLE `'.$xoopsDB->prefix("catalog_item").'` CHANGE `item_repairtime` `item_repairtime` VARCHAR( 255 ) NOT NULL';
	  $xoopsDB->queryF($query);
	  $query = 'ALTER TABLE `'.$xoopsDB->prefix("catalog_item").'` CHANGE `item_size` `item_size` VARCHAR( 255 ) NOT NULL';
	  $xoopsDB->queryF($query);
	  $query = 'ALTER TABLE `'.$xoopsDB->prefix("catalog_item").'` CHANGE `item_weight` `item_weight` VARCHAR( 255 ) NOT NULL';
	  $xoopsDB->queryF($query);
    /*
    $query = "ALTER TABLE `".$xoopsDB->prefix("catalog_item")."`  ADD `type1` decimal(10,2) NOT NULL ;";
    $xoopsDB->queryF($query);
    $query = "ALTER TABLE `".$xoopsDB->prefix("catalog_item")."`  ADD `type2` decimal(10,2) NOT NULL ;";
    $xoopsDB->queryF($query);
    $query = "ALTER TABLE `".$xoopsDB->prefix("catalog_item")."`  ADD `type3` decimal(10,2) NOT NULL ;";
    $xoopsDB->queryF($query);
    $query = "ALTER TABLE `".$xoopsDB->prefix("catalog_item")."`  ADD `type4` decimal(10,2) NOT NULL ;";
    $xoopsDB->queryF($query);
    $query = "ALTER TABLE `".$xoopsDB->prefix("catalog_item")."`  ADD `type5` decimal(10,2) NOT NULL ;";
    $xoopsDB->queryF($query);
    $query = "
        CREATE TABLE `".$xoopsDB->prefix("catalog_vote")."` (
        `vote_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
        `uid` 	INT( 11 )		NOT NULL default '0',
        `ip` 	INT( 11 )		NOT NULL default '0',
        `item_id` 	INT( 11 )		NOT NULL default '0',
        `type_id` 	INT( 2 )		NOT NULL default '0',
        `vote_value` 	VARCHAR( 100 ) NOT NULL ,
        `datetime` 	INT( 10 )		NOT NULL default '0',
        PRIMARY KEY ( `vote_id` )
        ) ENGINE = MYISAM ;
    ";
    $xoopsDB->queryF($query);
    $query ="
        CREATE TABLE `".$xoopsDB->prefix("catalog_itembyitems")."` (
        `by_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
        `item_id` INT( 11 ) NOT NULL DEFAULT '0',
        `by_item_id` INT( 11 ) NOT NULL DEFAULT '0',
        `datetime` INT( 10 ) NOT NULL DEFAULT '0',
        PRIMARY KEY ( `by_id` )
        ) ENGINE = MYISAM ;
    ";
    $xoopsDB->queryF($query);
    */
	return true;
}

?>
