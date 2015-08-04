<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_brandinfo.html */ ?>
<?php if ($this->_tpl_vars['brand']): ?>
<div id="catalog_brandinfo">
<h2><a title="<?php echo @_MD_CATALOG_BACKBRANLIST; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/index.php#A"><?php echo @_MD_CATALOG_BACKBRANLIST; ?>
</a></h2>
<h3><?php echo $this->_tpl_vars['brand']['brand_name']; ?>
</h3>
<?php if ($this->_tpl_vars['xoops_isadmin']): ?>
<div >【 <a href="admin/admin.brand.php?op=edit&amp;brand_id=<?php echo $this->_tpl_vars['brand']['brand_id']; ?>
"><?php echo @_MD_CATALOG_EDIT; ?>
</a> | <a href="admin.brand.php?op=delete&amp;brand_id=<?php echo $this->_tpl_vars['brand']['brand_id']; ?>
"><?php echo @_MD_CATALOG_DELETE; ?>
</a>】</div>
 <?php endif; ?>  
<p><?php echo $this->_tpl_vars['brand']['brand_description']; ?>
</p>
<div id="but"><a title="<?php echo @_MD_CATALOG_LOOKITEMLIST; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/itemlist.php?brand_id=<?php echo $this->_tpl_vars['brand']['brand_id']; ?>
#A"><?php echo @_MD_CATALOG_LOOKITEMLIST; ?>
</a></div>
</div>
<?php else: ?>
<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country']):
?>
<div>
    <h2><?php echo $this->_tpl_vars['country']['country_name']; ?>
</h2>
    <div>
        <?php $_from = $this->_tpl_vars['country']['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['brand']):
?>
            <a href='<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/index.php?brand_id=<?php echo $this->_tpl_vars['brand']['brand_id']; ?>
'><?php echo $this->_tpl_vars['brand']['brand_name']; ?>
</a>
        <?php endforeach; endif; unset($_from); ?>
    </div>
</div>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>