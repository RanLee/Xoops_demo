<?php

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class CatalogItembyitems extends XoopsObject
{
    function __construct() 
    {
        $this->initVar('by_id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('item_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('by_item_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('datetime', XOBJ_DTYPE_INT, 0);
    }

    function CatalogItembyitems()
    {
        $this->__construct();
    }
}

class CatalogItembyitemsHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "catalog_itembyitems", "CatalogItembyitems", "by_id");
    }
}
?>
