<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_header.html */ ?>



<div class="breadcrumbs">
    <?php $_from = $this->_tpl_vars['xoBreadcrumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bcloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bcloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['itm']):
        $this->_foreach['bcloop']['iteration']++;
?>
   
    <?php if ($this->_foreach['bcloop']['iteration'] == '1'): ?>  
   
      <?php if ($this->_tpl_vars['itm']['link']): ?>
            <a href="<?php echo 'http://localhost/xoops/'; ?>modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
" title="<?php echo $this->_tpl_vars['itm']['title']; ?>
"><?php echo @_MD_CATALOG_Return; ?>
<?php echo $this->_tpl_vars['itm']['title']; ?>
<?php echo @_MD_CATALOG_index; ?>
</a>
        <?php else: ?>
            <span class="breadcrumbs_title"><?php echo $this->_tpl_vars['itm']['repairtime']; ?>
&nbsp;<?php echo $this->_tpl_vars['itm']['title']; ?>
</span>
        <?php endif; ?>        
   
   <?php else: ?>
   
   
      <?php if ($this->_tpl_vars['itm']['link']): ?>
        <a href="<?php echo $this->_tpl_vars['itm']['link']; ?>
" title="<?php echo $this->_tpl_vars['itm']['title']; ?>
"><?php echo $this->_tpl_vars['itm']['title']; ?>
</a> 
        <?php else: ?>
            <span class="breadcrumbs_title"><?php echo $this->_tpl_vars['itm']['repairtime']; ?>
&nbsp;<?php echo $this->_tpl_vars['itm']['title']; ?>
</span>
        <?php endif; ?>
           <?php endif; ?>
        
        <?php if (! ($this->_foreach['bcloop']['iteration'] == $this->_foreach['bcloop']['total'])): ?>
            &raquo;
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
</div>