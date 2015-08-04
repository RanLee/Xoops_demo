<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_coubrand.html */ ?>



<div style="padding-top:10px;">

<select name="cat_id" onchange="location='itemlist.php?cat_id='+this.options[this.selectedIndex].value">
 <option><?php echo @_MD_CATALOG_CATEGORIES; ?>
</option>
    <?php $_from = $this->_tpl_vars['cat_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['category']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['cat_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['category']; ?>
</option>
        </optgroup>
    <?php endforeach; endif; unset($_from); ?> 
</select>
</div>


<div id="catalog_coubrand">
<div id="catalog_coubranddiv">
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<ul>
    <li>
    <div id="itemtop">
    <div id="itemtopa">
   
 
   <div id="itemsborder"><div id="itemsimg"><a title=" <?php echo $this->_tpl_vars['item']['item_name']; ?>
<?php echo @_MD_CATALOG_VIEWED; ?>
<?php echo $this->_tpl_vars['item']['item_counter']; ?>
" href="item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><img   src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/uploads/gallery/thumb_<?php echo $this->_tpl_vars['item']['item_picture']; ?>
" alt="<?php echo $this->_tpl_vars['item']['item_name']; ?>
" /></a></div></div> 
   </div></div>
  


 

    
      

   <div id="item_name"><a  title=" <?php echo $this->_tpl_vars['item']['item_name']; ?>
<?php echo $this->_tpl_vars['item']['item_counter']; ?>
" href="item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><?php echo $this->_tpl_vars['item']['item_name']; ?>
</a> </div> <div id="itemrepairtimea"><?php echo @_THEME_number; ?>
<?php echo $this->_tpl_vars['item']['item_repairtime']; ?>
</div> 
   
     
    </li>
 
</ul>

<?php endforeach; endif; unset($_from); ?>
</div>
 <div style="clear:both;"></div>



<div id="pagenav"><?php echo $this->_tpl_vars['pagenav']; ?>
</div>
<?php if ($this->_tpl_vars['xoops_isadmin']): ?><div id="opnew"><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/admin/admin.item.php?op=new">【新增商品】</a></div><?php endif; ?>

</div>
