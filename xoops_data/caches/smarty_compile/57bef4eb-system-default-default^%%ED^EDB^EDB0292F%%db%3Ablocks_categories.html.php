<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:blocks_categories.html */ ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/include/jquery-treeview/jquery.treeview.css" />
<?php if ($this->_tpl_vars['xoops_dirname'] != tadgallery && $this->_tpl_vars['xoops_dirname'] != tad_form && $this->_tpl_vars['xoops_dirname'] != tad_uploader): ?>
<?php echo $this->_tpl_vars['xoTheme']->addScript("modules/catalog/include/jquery-1.3.2.min.js"); ?>

<?php endif; ?>
<?php echo $this->_tpl_vars['xoTheme']->addScript("modules/catalog/include/jquery-treeview/jquery.cookie.js"); ?>

<script src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/include/jquery-treeview/jquery.treeview.js" type="text/javascript"></script>





<div id="catalomainmenu">
<div id="blockscategories">
<ul class="treeview" id="tree">
    <?php $_from = $this->_tpl_vars['block']['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
    
    <?php if ($this->_tpl_vars['category']['child']): ?>
        <li id="lia">
         <a class="catalomenuMainatop" ><?php echo $this->_tpl_vars['category']['cat_name']; ?>
</a>
     
        <?php $this->assign('children', $this->_tpl_vars['category']['child']); ?>  
        
              
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "db:catalog_category_tree.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </li>
    <?php else: ?>
       <li> <a class="catalomenuMainatop" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/itemlist.php?cat_id=<?php echo $this->_tpl_vars['category']['cat_id']; ?>
"><?php echo $this->_tpl_vars['category']['cat_name']; ?>
</a></li>
    <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
</ul>
</div>
</div>
<script type="text/javascript">
$(function() {
	$("#tree").treeview({
		animated: "medium",
		persist: "cookie",
		collapsed: true,
		unique: true
	});
})
</script>