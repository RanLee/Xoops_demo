<?php

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class CatalogPicture extends XoopsObject
{
    function __construct() 
    {
        $this->initVar('pic_id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('item_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('pic_name', XOBJ_DTYPE_TXTBOX);                
        $this->initVar('pic_description', XOBJ_DTYPE_TXTAREA);
        $this->initVar('pic_path', XOBJ_DTYPE_TXTBOX);
        $this->initVar('pic_thumb_path', XOBJ_DTYPE_TXTBOX);
        $this->initVar('pic_isdefualt ', XOBJ_DTYPE_INT, 0);
    }

    function CatalogPicture()
    {
        $this->__construct();
    }
}

class CatalogPictureHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "catalog_picture", "CatalogPicture", "pic_id");
    }
}
?>
