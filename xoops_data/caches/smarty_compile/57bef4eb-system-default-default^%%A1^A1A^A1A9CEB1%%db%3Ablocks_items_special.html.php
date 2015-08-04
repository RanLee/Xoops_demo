<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:blocks_items_special.html */ ?>

<div id="Product">
<div id="center">

<ul>  
    <?php if (count($this->_tpl_vars['block']['items'])):
    foreach ($this->_tpl_vars['block']['items'] as $this->_tpl_vars['item']):
 ?>
    <!-- <?php echo $this->_tpl_vars['n']++; ?>
-->   
    <li>

    
      <div id="caption"><div id="odd"><a title="<?php echo $this->_tpl_vars['item']['item_name']; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
#A"><?php if ($this->_tpl_vars['item']['page_title']): ?><?php echo $this->_tpl_vars['item']['page_title']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['item_name']; ?>
<?php endif; ?></a></div></div>
      
       
    
     <div id="itemitem_picture">    
     <div id="coloritem"></div>    
     <div id="itemitem_picture02"> <a title="<?php if ($this->_tpl_vars['item']['page_title']): ?><?php echo $this->_tpl_vars['item']['page_title']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['item_name']; ?>
<?php endif; ?>" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
#A"><?php if ($this->_tpl_vars['item']['page_title']): ?><?php echo $this->_tpl_vars['item']['page_title']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['item_name']; ?>
<?php endif; ?></a></div> 
       
       
        <div id="itemitem_picturea" >
 <img src="<?php echo $this->_tpl_vars['item']['item_picture']; ?>
" /></div></div>
       

    
    <!-- end rate -->  
    </li>
    <?php endforeach; endif; unset($_from); ?>
</ul>
</div></div>