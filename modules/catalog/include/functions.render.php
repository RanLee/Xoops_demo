<?php

if (!defined('XOOPS_ROOT_PATH')) { exit(); }

define("catalog" . "_FUNCTIONS_RENDER_LOADED", TRUE);

function catalog_getTemplate($page = "index", $style = null)
{
    global $xoops;
    
    $template_dir = $xoops->path("modules/catalog/templates/");
    $style = empty($style) ? "" : "_" . $style;
    $file_name = "catalog_{$page}{$style}.html";
    if (file_exists($template_dir . $file_name)) return $file_name;
    if (!empty($style)) {
        $style = "";
        $file_name = "catalog_{$page}{$style}.html";
        if(file_exists($template_dir . $file_name)) return $file_name;
    }
    return null;
}

function &catalog_getTemplateList($page = "index", $refresh = false)
{
    $TplFiles = catalog_getTplPageList($page, $refresh);
    $template = array();
    foreach (array_keys($TplFiles) as $temp) {
        $template[$temp] = $temp;
    }
    return $template;
}

function catalog_getCss($style = "default")
{
    global $xoops;
    
    if (is_readable($xoops->path("modules/catalog/templates/style_" . strtolower($style) . ".css"))) {
        return $xoops->path("modules/catalog/templates/style_".strtolower($style).".css", true);
    }
    return $xoops->path("modules/catalog/templates/style.css", true);
}

function catalog_getModuleHeader($style = "default")
{
    $xoops_module_header = "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . catalog_getCss($style) . "\" />";
    return $xoops_module_header;
}

function &catalog_getTplPageList($page = "", $refresh = true)
{
    $list = null;
    
    $cache_file = empty($page) ? "template-list" : "template-article";
    
    xoops_load("cache");
    $key = "catalog_{$cache_file}";
    $list = XoopsCache::read($key);
    
    if ( !is_array($list) || $refresh ) {
        $list = catalog_template_lookup(!empty($page));
    }
    
    $ret = empty($page) ? $list : @$list[$page];
    
    return $ret;    
}

function &catalog_template_lookup($index_by_page = false) 
{
    include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
    
    $files = XoopsLists::getHtmlListAsArray(XOOPS_ROOT_PATH . "/modules/catalog/templates/");
    $list = array();
    foreach ($files as $file => $name) {
        if (preg_match("/^" . "catalog" . "_([^_]*)(_(.*))?\.(html|xotpl)$/i", $name, $matches)) {
            if(empty($matches[1])) continue;
            if(empty($matches[3])) $matches[3] = "default";
            if (empty($index_by_page)) {
                $list[] = array("file" => $name, "description" => $matches[3]);
            } else {
                $list[$matches[1]][$matches[3]] = $name;
            }
        }
    }
    
    $cache_file = empty($index_by_page) ? "template-list" : "template-page";
    xoops_load("cache");
    $key = "catalog" . "_{$cache_file}";
    XoopsCache::write($key, $list);
    
    return $list;
}

function &catalog_template_lookup_blocks($index_by_page = false) 
{
    include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
    
    $files = XoopsLists::getHtmlListAsArray(XOOPS_ROOT_PATH . "/modules/" . "catalog" . "/templates/blocks/");
    $list = array();
    foreach ($files as $file => $name) {
        if (preg_match("/^" . 'blocks_' . "catalog" . "_([^_]*)(_(.*))?\.(html|xotpl)$/i", $name, $matches)) {
            if(empty($matches[1])) continue;
            if(empty($matches[3])) $matches[3] = "default";
            if (empty($index_by_page)) {
                $list[] = array("file" => $name, "description" => $matches[3]);
            } else {
                $list[$matches[1]][$matches[3]] = $name;
            }
        }
    }
    
    $cache_file = empty($index_by_page) ? "template-list" : "template-page";
    xoops_load("cache");
    $key = "catalog" . "_{$cache_file}";
    XoopsCache::write($key, $list);
    
    return $list;
}
?>
