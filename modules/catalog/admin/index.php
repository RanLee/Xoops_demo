<?php
include 'header.php';
xoops_cp_header();
 
loadModuleAdminMenu(1, "");

    $xoopsTpl->assign('backend', _CATALOG_AM_BACKEND);
    $template_main = "catalog_admin_index.html";
    
include 'footer.php';
?>