<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:29
         compiled from db:catalog_admin_country.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'db:catalog_admin_country.html', 11, false),)), $this); ?>
<a href="admin.country.php?op=new"><?php echo @_AM_CATALOG_ADDCOUNTRY; ?>
</a>
<form id="form" name="form" method="post" action="admin.country.php">
<table class="outer">
    <th><input id="country_check" name="country_check" type="checkbox" onclick="xoopsCheckAll('form','country_check');" /><?php echo @_AM_CATALOG_CHECK; ?>
</th>
    <th><?php echo @_AM_CATALOG_SORT; ?>
</th>
    <th><?php echo @_AM_CATALOG_COUNTRY; ?>
</th>
    <th><?php echo @_AM_CATALOG_CREATEDATE; ?>
</th>
    <th><?php echo @_AM_CATALOG_ACTION; ?>
</th>
     
    <?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['countries']):
?>
    <tr  class="<?php echo smarty_function_cycle(array('values' => 'odd, even'), $this);?>
">
        <td><input name="country[<?php echo $this->_tpl_vars['countries']['country_id']; ?>
]" id="country[<?php echo $this->_tpl_vars['countries']['country_id']; ?>
]" value="<?php echo $this->_tpl_vars['countries']['country_id']; ?>
"  type="checkbox" /></td>
        <td><input name="country_weight[<?php echo $this->_tpl_vars['countries']['country_id']; ?>
]" type="text" id="<?php echo $this->_tpl_vars['countries']['country_id']; ?>
" value="<?php echo $this->_tpl_vars['countries']['country_weight']; ?>
" size="1" maxlength="4" /></td>
        <td><?php echo $this->_tpl_vars['countries']['country_name']; ?>
</td>
        <td><?php echo $this->_tpl_vars['countries']['add_time']; ?>
</td>
        <td><a href="admin.country.php?op=edit&amp;country_id=<?php echo $this->_tpl_vars['countries']['country_id']; ?>
"><?php echo @_AM_CATALOG_EDIT; ?>
</a> | <a href="admin.country.php?op=delete&amp;country_id=<?php echo $this->_tpl_vars['countries']['country_id']; ?>
"><?php echo @_AM_CATALOG_DELETE; ?>
</a></td>   
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    <tr>
        <td colspan="5"><input type="submit" name="button" id="button" value="<?php echo @_SUBMIT; ?>
"></td>
    </tr>
   
</table>
</form>
<?php echo $this->_tpl_vars['pagenav']; ?>