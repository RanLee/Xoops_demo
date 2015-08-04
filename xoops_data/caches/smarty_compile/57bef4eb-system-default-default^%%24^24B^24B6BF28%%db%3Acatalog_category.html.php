<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_category.html */ ?>

<div style="padding-top:10px;">

<select name="cat_id" onchange="location='itemlist.php?cat_id='+this.options[this.selectedIndex].value">
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


 




<div id="catalog_header"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "db:catalog_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>




<?php if ($this->_tpl_vars['cattext']): ?>
<div id="cattextcc">
<?php echo $this->_tpl_vars['cattext']; ?>
 
</div>
<?php endif; ?>

  <?php if ($this->_tpl_vars['xoops_isadmin']): ?>
    <div id="cattextadmin"><a target='_blank' href="<?php echo 'http://localhost/xoops/'; ?>modules/catalog/admin/admin.category.php?op=edit&cat_id=<?php echo $this->_tpl_vars['cat_id']; ?>
 ">[<?php echo @_THEME_cattextadmin; ?>
]</a></div>
    <?php endif; ?>



<div id="catalog_coubrand">
<div id="catalog_coubranddiv">
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['items']):
?>
<ul>

    <li>
      <div id="itemtop">
    <div id="itemtopa">
 
    
        
   
    <div id="itemsborder"><div title="<?php echo $this->_tpl_vars['items']['item_name']; ?>
" id="itemsimg"><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['items']['item_id']; ?>
#A"> <img      src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/uploads/gallery/<?php echo $this->_tpl_vars['items']['item_picture']; ?>
" width="<?php echo $this->_tpl_vars['items_width']; ?>
" /></a></div></div>
 
   
 
 
 
         
     
    
<div id="item_name"><a title="<?php echo $this->_tpl_vars['items']['item_name']; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['items']['item_id']; ?>
#A"><?php echo $this->_tpl_vars['items']['item_name']; ?>
</a>

</div>   <div id="itemrepairtimea"><?php echo @_THEME_number; ?>
<?php echo $this->_tpl_vars['items']['item_repairtime']; ?>
</div>  
 </div>  </div>  
 
    </li>
  
</ul>
<?php endforeach; endif; unset($_from); ?>
</div>
<div style="clear:both;"></div>

<div id="pagenav"><?php echo $this->_tpl_vars['pagenav']; ?>
</div>

<?php if ($this->_tpl_vars['xoops_isadmin']): ?><div id="opnew">
<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/admin/admin.item.php?op=new&&cat_id=<?php echo $_GET['cat_id']; ?>
">【<?php echo @_MD_CATALOG_ADDITEM; ?>
】</a></div><?php endif; ?>

</div>