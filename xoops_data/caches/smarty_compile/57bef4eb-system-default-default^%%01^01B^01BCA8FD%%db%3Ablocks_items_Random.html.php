<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:blocks_items_Random.html */ ?>
<div id="infopictop">
<div class="infopic">
<div class="picbox">
<UL class="gallery piclist">
<?php if (count($this->_tpl_vars['block']['items'])):
    foreach ($this->_tpl_vars['block']['items'] as $this->_tpl_vars['item']):
 ?>  
 
<li ><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
#A" title="<?php if ($this->_tpl_vars['item']['page_title']): ?><?php echo $this->_tpl_vars['item']['page_title']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['item_name']; ?>
<?php endif; ?>" > <img    src="<?php echo $this->_tpl_vars['item']['item_picture']; ?>
" /></a><br /><div id="spanitemname"><a title="<?php echo $this->_tpl_vars['item']['item_name']; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
#A"><?php echo $this->_tpl_vars['item']['item_name']; ?>
</a></div> 
<div id="itemrepairtime"><?php echo @_THEME_number; ?>
<?php echo $this->_tpl_vars['item']['item_repairtime']; ?>
</div>
     </li>    
<?php endforeach; endif; unset($_from); ?> 
  
  
  </UL></div>
  <div style="clear: both;"></div>
<div class="pic_prev"></div>
<div class="pic_next"></div></div>
<div id="infopicbuttom"><a title="<?php echo @_THEME_Showall; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/"><?php echo @_THEME_Showall; ?>
</a></div>
</div>