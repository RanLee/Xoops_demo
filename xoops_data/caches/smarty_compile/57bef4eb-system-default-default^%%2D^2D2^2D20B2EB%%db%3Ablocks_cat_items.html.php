<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:blocks_cat_items.html */ ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/templates/style.css" />
<div id="catalogitemdiv">
<ul>  
    <?php if (count($this->_tpl_vars['block']['items'])):
    foreach ($this->_tpl_vars['block']['items'] as $this->_tpl_vars['item']):
 ?>

    <li <?php if ($this->_tpl_vars['block']['current'] == $this->_tpl_vars['item']['item_id']): ?> class="currentItem" <?php endif; ?>>
        <a title="<?php echo $this->_tpl_vars['item']['item_name']; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><?php echo $this->_tpl_vars['item']['item_name']; ?>
</a>           
    </li>
    
    <?php endforeach; endif; unset($_from); ?>
</ul>
</div>




