CREATE TABLE `catalog_category` (
`cat_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
`cat_name` VARCHAR( 100 ) NOT NULL ,
`cat_unit` VARCHAR( 100 ) NOT NULL ,
`cat_image` VARCHAR( 100 ) NOT NULL ,
`cat_pid` INT( 11 ) NOT NULL ,
`type_id` INT( 11 ) NOT NULL ,
`cat_keywords` VARCHAR( 255 ) NOT NULL ,
`cat_description` VARCHAR( 255 ) NOT NULL ,
`isnav` TINYINT( 1 ) NOT NULL DEFAULT '1',
`cat_status` TINYINT( 1 ) NOT NULL DEFAULT '1',
`cat_weight` TINYINT( 4 ) NOT NULL DEFAULT '0',
`cat_level` TINYINT( 4 ) NOT NULL DEFAULT '0',
`cat_properties`  VARCHAR( 255 ) NOT NULL ,
`cat_tpl` VARCHAR ( 255 ) NOT NULL ,
`cat_tpl_css` VARCHAR ( 255 ) NOT NULL ,
`cat_published` int(10)   unsigned NOT NULL default '0',
`cattext` text NOT NULL,
PRIMARY KEY ( `cat_id` )
) ENGINE=MyISAM;

CREATE TABLE `catalog_item` (
`item_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
`item_name` VARCHAR( 255 ) NOT NULL ,
`item_sn` VARCHAR( 255 ) NOT NULL ,
`cat_id` INT( 11 ) NOT NULL ,
`link_id` VARCHAR( 255 ) NOT NULL ,
`greenep_id` INT( 11 ) NOT NULL ,
`reseller_ids` VARCHAR( 255 ) NOT NULL ,
`country_id` INT( 11 ) NOT NULL ,
`brand_id` INT( 11 ) NOT NULL ,
`specs_id` INT( 11 ) NOT NULL ,
`item_keywords` TEXT NOT NULL ,
`item_unit` VARCHAR( 255 ) NOT NULL ,
`item_summary` TEXT NOT NULL ,
`market_price` decimal(10,2) NOT NULL ,
`shop_price`  VARCHAR( 255 ) NOT NULL ,
`promote_price` decimal(10,2) NOT NULL ,
`item_number` VARCHAR( 255 ) NOT NULL ,
`item_weight`  VARCHAR( 255 ) NOT NULL ,
`item_weights`  VARCHAR( 255 ) NOT NULL ,
`item_weightss`  VARCHAR( 255 ) NOT NULL ,
`item_weightsss`  VARCHAR( 255 ) NOT NULL ,
`item_weight2`  VARCHAR( 255 ) NOT NULL ,
`item_inventory` INT( 11 ) NOT NULL ,
`item_description` TEXT NOT NULL ,
`item_service` TEXT NOT NULL ,
`page_title` VARCHAR( 255 ) NOT NULL ,
`meta_keywords` TEXT NOT NULL ,
`meta_description` TEXT NOT NULL ,
`item_newarrival` TINYINT( 1 ) NOT NULL DEFAULT '0',
`item_best` TINYINT( 1 ) NOT NULL DEFAULT '0',
`item_hot` TINYINT( 1 ) NOT NULL DEFAULT '0',
`status` TINYINT( 1 ) NOT NULL DEFAULT '1',
`item_comments` TINYINT( 11 )  NOT NULL ,
`item_counter` INT( 11 ) NOT NULL ,
`item_type` TINYINT( 6 ) NOT NULL DEFAULT '0',
`weight` int(11) NOT NULL DEFAULT '0',
`item_picture` varchar(255) NOT NULL ,
`item_thumbnail` varchar(255) NOT NULL ,
`isgallery` TINYINT( 1 ) NOT NULL DEFAULT '0',
`rating` decimal(10,2) NOT NULL ,
`rates` int(10) NOT NULL ,
`type1` decimal(10,2) NOT NULL ,
`type2` decimal(10,2) NOT NULL ,
`type3` decimal(10,2) NOT NULL ,
`type4` decimal(10,2) NOT NULL ,
`type5` decimal(10,2) NOT NULL ,
`create_time` int(10) NOT NULL ,
`modify_time` int(10) NOT NULL ,
`item_tpl` VARCHAR ( 255 ) NOT NULL ,
`item_tpl_css` VARCHAR ( 255 ) NOT NULL ,
`dohtml` TINYINT( 1 ) NOT NULL DEFAULT '1',
`doxcode` TINYINT( 1 ) NOT NULL DEFAULT '0',
`dosmiley` TINYINT( 1 ) NOT NULL DEFAULT '0',
`doimage` TINYINT( 1 ) NOT NULL DEFAULT '0',
`dobr` TINYINT( 1 ) NOT NULL DEFAULT '0',
`item_buildtime` int(10) NOT NULL ,
`item_repairtime` varchar(255) NOT NULL ,
`item_size` varchar(255) NOT NULL ,
`compare_status` int(10) NOT NULL ,
PRIMARY KEY ( `item_id` )
) ENGINE=MyISAM;

CREATE TABLE `catalog_picture` (
`pic_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
`item_id` INT( 11 ) NOT NULL DEFAULT '0',
`pic_name` VARCHAR( 100 ) NOT NULL ,
`pic_description` TEXT NOT NULL ,
`pic_path` VARCHAR( 255 ) NOT NULL ,
`pic_thumb_path` VARCHAR( 255 ) NOT NULL ,
`pic_isdefualt` TINYINT( 1 ) NOT NULL DEFAULT '1',
PRIMARY KEY ( `pic_id` )
) ENGINE=MyISAM;

CREATE TABLE `catalog_attachment` (
`att_id` int(11) NOT NULL auto_increment,
`item_id` INT( 11 ) NOT NULL DEFAULT '0',
`att_filename` varchar(255) NOT NULL,
`att_attachment` varchar(255) NOT NULL,
`att_type` varchar(128) NOT NULL default '',
`att_size` int(11) NOT NULL default '0',
PRIMARY KEY  (`att_id`)
) ENGINE=MyISAM;

CREATE TABLE `catalog_brand` (
`brand_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
`country_id` INT( 11 ) NOT NULL ,
`brand_name` VARCHAR( 100 ) NOT NULL ,
`brand_url` VARCHAR( 100 ) NOT NULL ,
`brand_logo` VARCHAR( 100 ) NOT NULL ,
`brand_description` TEXT NOT NULL ,
`brand_weight` INT( 4 ) NOT NULL DEFAULT '0',
`brand_status` TINYINT( 1 ) NOT NULL DEFAULT '1',
`brand_published` int(10)   unsigned NOT NULL default '0',
PRIMARY KEY ( `brand_id` )
) ENGINE = MYISAM ;

CREATE TABLE `catalog_item_counter` (
`counter_id` 		INT( 11 ) 		unsigned NOT NULL auto_increment,
`item_id` 		INT( 11 ) 		NOT NULL default '0',	
`uid` 			mediumint(8) 	unsigned NOT NULL default '0',
`ip` 	INT( 11 )		NOT NULL default '0',
`counter_time` 		int(10) 		unsigned NOT NULL default '0',
PRIMARY KEY  		(`counter_id`)
) ENGINE=MyISAM;

CREATE TABLE `catalog_country` (
`country_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
`country_weight` TINYINT( 4 ) NOT NULL DEFAULT '0',
`country_name` VARCHAR( 255 ) NOT NULL ,
`add_time` int(10)   unsigned NOT NULL default '0',
PRIMARY KEY ( `country_id` )
) ENGINE=MyISAM;

CREATE TABLE `catalog_greenep` (
`greenep_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
`greenep_rank` VARCHAR( 255 ) NOT NULL ,
`greenep_logo`  VARCHAR( 100 ) NOT NULL ,
`greenep_weight` TINYINT( 4 ) NOT NULL DEFAULT '0',
PRIMARY KEY ( `greenep_id` )
) ENGINE=MyISAM;

CREATE TABLE `catalog_cat_brand` (
`cb_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
`cat_id` INT( 11 ) NOT NULL ,
`brand_id` INT( 11 ) NOT NULL ,
`brand_name` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY ( `cb_id` )
) ENGINE=MyISAM;

CREATE TABLE `catalog_vote` (
`vote_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
`uid` 	INT( 11 )		NOT NULL default '0',
`ip` 	INT( 11 )		NOT NULL default '0',
`item_id` 	INT( 11 )		NOT NULL default '0',
`type_id` 	INT( 2 )		NOT NULL default '0',
`vote_value` 	VARCHAR( 100 ) NOT NULL ,
`datetime` 	INT( 10 )		NOT NULL default '0',
PRIMARY KEY ( `vote_id` )
) ENGINE=MyISAM;

CREATE TABLE `catalog_itembyitems` (
`by_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
`item_id` INT( 11 ) NOT NULL DEFAULT '0',
`by_item_id` INT( 11 ) NOT NULL DEFAULT '0',
`datetime` INT( 10 ) NOT NULL DEFAULT '0',
PRIMARY KEY ( `by_id` )
) ENGINE=MyISAM;
