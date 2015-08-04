<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_category_tree.html */ ?>


<ul>

 <a class="catalomenuMaina" title="<?php echo $this->_tpl_vars['category']['cat_name']; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/itemlist.php?cat_id=<?php echo $this->_tpl_vars['category']['cat_id']; ?>
"><?php echo $this->_tpl_vars['category']['cat_name']; ?>
</a>

 
 
<?php $_from = $this->_tpl_vars['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['child']):
?>
<?php if ($this->_tpl_vars['child']['child']): ?>
    <li id="lib">
          <div id="categorycatname"><a title="<?php echo $this->_tpl_vars['child']['cat_name']; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/itemlist.php?cat_id=<?php echo $this->_tpl_vars['child']['cat_id']; ?>
"><?php echo $this->_tpl_vars['child']['cat_name']; ?>
</a></div>
        <?php $this->assign('children', $this->_tpl_vars['child']['child']); ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "db:catalog_category_tree.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </li>
<?php else: ?>
    <li id="lib"><div id="childcatname"><a title="<?php echo $this->_tpl_vars['child']['cat_name']; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/itemlist.php?cat_id=<?php echo $this->_tpl_vars['child']['cat_id']; ?>
"><?php echo $this->_tpl_vars['child']['cat_name']; ?>
</a></div></li>
<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>
</ul>