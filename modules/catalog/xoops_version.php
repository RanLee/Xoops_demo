<?php
/**
 * product module 
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
 * @package         product
 * @since           2.3.0
 * @author          Susheng Yang <ezskyyoung@gmail.com> 
 * @version         $Id: xoops_version.php  $
 */
 
/**
 * 
 * 
 *
 */
$modversion = array();
$modversion['name'] = _CATALOG_MI_NAME;
$modversion['version'] = 'V4';
$modversion['description'] = _CATALOG_MI_DESC;
$modversion['author'] = "Susheng Yang<ezskyyoung@gmail.com>";
$modversion['credits'] = "xoops community.";
$modversion['license'] = "GPL see XOOPS LICENSE";
$modversion['image'] = "images/logo.png";
$modversion['dirname'] = "catalog";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/admin.category.php";
$modversion['adminmenu'] = "admin/menu.php";

// Scripts to run upon installation or update
//$modversion['onInstall'] = "include/install.php";
$modversion['onUpdate'] = "include/action.module.php";

// Menu
$modversion['hasMain'] = 1;


// Mysql file

$modversion["sqlfile"]["mysql"] = "sql/mysql.sql";
$modversion["tables"] = array(
"catalog_brand",
"catalog_category",
"catalog_item",
"catalog_picture",
"catalog_attachment",
"catalog_item_counter",
"catalog_greenep",
"catalog_cat_brand",
"catalog_country",
"catalog_vote",
"catalog_itembyitems"
);
//$isModuleAction = mod_isModuleAction('catalog');
$isModuleAction = ( !empty($_POST["fct"]) && "modulesadmin" == $_POST["fct"] ) ? true : false;
if ($isModuleAction) {
    include_once dirname(__FILE__) . '/include/functions.render.php';
    $modversion['templates'] = catalog_getTplPageList('', true);
}

$i = 0;
$modversion['config'][$i] = array(
    'name'			=> 'display',
    'title'			=> '_CATALOG_MI_LIST',
    'description'	=> '',
    'formtype'		=> 'select',
    'valuetype'		=> 'int',
    'options'		=> array("_CATALOG_MI_LIST_COUNTRY" => 1, "_CATALOG_MI_LIST_ITEM" => 2),
    'default'		=> 1
    );
$i++;
$modversion['config'][$i] = array(
    'name'			=> 'index_item_limit',
    'title'			=> '_CATALOG_MI_INDEX_ITEM_LIMIT',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '10'
    );
$i++;
$modversion['config'][$i] = array(
    'name'			=> 'perpage',
    'title'			=> '_CATALOG_MI_HOWITEMS',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '10'
    );
$i++;
$modversion['config'][$i] = array(
    'name'			=> 'items',
    'title'			=> '_CATALOG_MI_ITEMS',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '10'
    );
$i++;
$modversion['config'][$i] = array(
    'name'			=> 'countries',
    'title'			=> '_CATALOG_MI_COUNTRIES',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '10'
    );
$i++;
$modversion['config'][$i] = array(
    'name'			=> 'brands',
    'title'			=> '_CATALOG_MI_BRANDS',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '10'
    );
$i++;
$modversion['config'][$i] = array(
    'name'			=> 'catgories',
    'title'			=> '_CATALOG_MI_CATGORIES',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '10'
    );
$i++;
$modversion['config'][$i] = array(
    'name'			=> 'branditems',
    'title'			=> '_CATALOG_MI_BRANDITEMS',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '10'
    );
/*    
$i++;
$modversion['config'][$i] = array(
    'name'			=> 'compare',
    'title'			=> '_CATALOG_MI_COMPARE',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '10'
    );
$i++;
$modversion['config'][$i] = array(
    'name'			=> 'relation',
    'title'			=> '_CATALOG_MI_RELATION',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '10'
    );
*/    
$i++;
$modversion['config'][$i] = array(
    'name'			=> 'picturewidth',
    'title'			=> '_CATALOG_MI_PICTUREWIDTH',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '100'
    );

$i++;
$modversion['config'][$i] = array(
    'name'			=> 'itemdescription',
    'title'			=> '_CATALOG_MI_ITEM DESCRIPTION',
    'description'	=> '',
    'formtype'		=> 'yesno',
    'valuetype'		=> 'int',
    'default'		=> '1',
    );
/*
$modversion['config'][] = array(
    'name'			=> 'logo_dir',
    'title'			=> '_PROD_MI_LOGODIR',
    'description'	=> '',
    'formtype'		=> 'textbox',
    'valuetype'		=> 'text',
    'default'		=> '/uploads/product/brand/'
    );
*/
$modversion['blocks'] = array();
$modversion['blocks'][] = array(
  	'file'			=> 'blocks.php',
  	'name'			=> _CATALOG_MI_CATITEM,
  	'description'	=> '',
  	'show_func'		=> 'catalog_category_items_show',
  	'options'		=> '0|5|20',
  	'edit_func'		=> 'catalog_category_items_edit',
  	'template'		=> 'blocks_category_items.html'
);

$modversion['blocks'][] = array(
  	'file'			=> 'blocks.php',
  	'name'			=> _CATALOG_MI_SPECIAL,
  	'description'	=> '',
  	'show_func'		=> 'catalog_items_special_show',
  	'options'		=> '0|1|5|20',
  	'edit_func'		=> 'catalog_items_special_edit',
  	'template'		=> 'blocks_items_special.html'
);

$modversion['blocks'][] = array(
  	'file'			=> 'blocks.php',
  	'name'			=> _CATALOG_MI_Random,
  	'description'	=> '',
  	'show_func'		=> 'catalog_items_special_show',
  	'options'		=> '0|1|5|20',
  	'edit_func'		=> 'catalog_items_special_edit',
  	'template'		=> 'blocks_items_Random.html'
);


$modversion['blocks'][] = array(
  	'file'			=> 'blocks.php',
  	'name'			=> _CATALOG_MI_CATS,
  	'description'	=> '',
  	'show_func'		=> 'catalog_categories_show',
  	'options'		=> '0|5|20',
  	'edit_func'		=> 'catalog_categories_edit',
  	'template'		=> 'blocks_categories.html'
);

$modversion['blocks'][] = array(
  	'file'			=> 'blocks.php',
  	'name'			=> _CATALOG_MI_CATBRAND,
  	'description'	=> '',
  	'show_func'		=> 'catalog_category_brands_show',
  	'options'		=> '0',
  	'edit_func'		=> 'catalog_category_brands_edit',
  	'template'		=> 'blocks_category_brands.html'
);
$modversion['blocks'][] = array(
  	'file'			=> 'blocks.php',
  	'name'			=> _CATALOG_MI_CATSELECTITEM,
  	'description'	=> '',
  	'show_func'		=> 'catalog_cat_items_show',
  	'options'		=> '0|10',
  	'edit_func'		=> 'catalog_cat_items_edit',
  	'template'		=> 'blocks_cat_items.html'
);
// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'item.php';
$modversion['comments']['itemName'] = 'item_id';

// Search
$modversion["hasSearch"] = 1;
$modversion["search"]["file"] = "include/search.inc.php";
$modversion["search"]["func"] = "catalog_search";
?>
