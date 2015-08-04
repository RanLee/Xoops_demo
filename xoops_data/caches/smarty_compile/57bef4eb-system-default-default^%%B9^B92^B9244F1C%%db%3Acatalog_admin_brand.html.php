<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:29
         compiled from db:catalog_admin_brand.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'db:catalog_admin_brand.html', 14, false),)), $this); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/templates/style.css" />

<a href="admin.brand.php?op=new"><?php echo @_AM_CATALOG_BUILDITEMBRAND; ?>
</a>
<form id="form" name="form" method="post" action="action.brand.php">
    <table class="outer">
        <th width=50><input id="brand_check" name="brand_check" type="checkbox" onclick="xoopsCheckAll('form','brand_check');" /><?php echo @_AM_CATALOG_CHECK; ?>
</th>
        <th><?php echo @_AM_CATALOG_NUMBER; ?>
</th>
        <th><?php echo @_AM_CATALOG_BRAND; ?>
</th>
        <th><?php echo @_AM_CATALOG_BELONGCOUNTRY; ?>
</th>
        <th><?php echo @_AM_CATALOG_CREATEDATE; ?>
</th>
        <th><?php echo @_AM_CATALOG_ACTION; ?>
</th>

        <?php $_from = $this->_tpl_vars['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['brands']):
?>
        <tr  class="<?php echo smarty_function_cycle(array('values' => 'odd, even'), $this);?>
">
            <td><input name="brand[<?php echo $this->_tpl_vars['brands']['brand_id']; ?>
]" id="brand[<?php echo $this->_tpl_vars['brands']['brand_id']; ?>
]" value="<?php echo $this->_tpl_vars['brands']['brand_id']; ?>
"  type="checkbox" /></td>
            <td><input name="brand_weight[<?php echo $this->_tpl_vars['brands']['brand_id']; ?>
]" type="text" id="<?php echo $this->_tpl_vars['brands']['brand_id']; ?>
" value="<?php echo $this->_tpl_vars['brands']['brand_weight']; ?>
" size="1" maxlength="4" /></td>
            <td><?php echo $this->_tpl_vars['brands']['brand_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['brands']['country_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['brands']['brand_published']; ?>
</td>
            <td><a href="admin.brand.php?op=edit&amp;brand_id=<?php echo $this->_tpl_vars['brands']['brand_id']; ?>
"><?php echo @_AM_CATALOG_EDIT; ?>
</a> | <a href="admin.brand.php?op=delete&amp;brand_id=<?php echo $this->_tpl_vars['brands']['brand_id']; ?>
"><?php echo @_AM_CATALOG_DELETE; ?>
</a></td> 
  
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <tr>
            <td  align="center" colspan="4"><input type="submit" name="button" id="button" value="<?php echo @_SUBMIT; ?>
"></td>
        </tr>
        
    </table>
</form>
<?php echo $this->_tpl_vars['pagenav']; ?>