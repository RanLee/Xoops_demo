<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:blocks_category_brands.html */ ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/templates/style.css" /> 

<?php if (count($this->_tpl_vars['block']['catbrands'])):
    foreach ($this->_tpl_vars['block']['catbrands'] as $this->_tpl_vars['brand']):
 ?>                             
<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/itemlist.php?brand_id=<?php echo $this->_tpl_vars['brand']['brand_id']; ?>
"><?php echo $this->_tpl_vars['brand']['brand_name']; ?>
</a>
<?php endforeach; endif; unset($_from); ?>