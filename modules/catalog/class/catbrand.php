<?php

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class CatalogCatbrand extends XoopsObject
{
    function __construct() 
    {
        $this->initVar('cb_id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('cat_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('brand_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('brand_name', XOBJ_DTYPE_TXTBOX);
    }

    function CatalogCatbrand()
    {
        $this->__construct();
    }
}

class CatalogCatbrandHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "catalog_cat_brand", "CatalogCatbrand", "cb_id","brand_name");
    }
}
?>
