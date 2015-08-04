<?php

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class CatalogVote extends XoopsObject
{
    function __construct() 
    {
        $this->initVar('vote_id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('uid', XOBJ_DTYPE_INT, 0);
        $this->initVar('ip', XOBJ_DTYPE_INT, 0);
        $this->initVar('item_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('type_id',  XOBJ_DTYPE_TXTBOX);
        $this->initVar('vote_value', XOBJ_DTYPE_TXTBOX);
        $this->initVar('datetime', XOBJ_DTYPE_INT, 0); 
    }

    function CatalogVote()
    {
        $this->__construct();
    }
}

class CatalogVoteHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "catalog_vote", "CatalogVote", "vote_id");
    }
}
?>
