<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_admin_property.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'db:catalog_admin_property.html', 10, false),)), $this); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/templates/style.css" />
<h1><?php echo $this->_tpl_vars['type']['type_name']; ?>
</h1>
<div><a href="admin.property.php?op=new&amp;type_id=<?php echo $this->_tpl_vars['type']['type_id']; ?>
"><?php echo @_AM_CATALOG_JOINCONTENT; ?>
</a></div>
<form id="form" name="form" method="post" action="admin.property.php?type_id=<?php echo $this->_tpl_vars['type']['type_id']; ?>
">
<table class="outer"> 
    <th width="5%"><?php echo @_AM_CATALOG_SORT; ?>
</th>
    <th align="center" width="70%"><?php echo @_AM_CATALOG_CONTENTNAME; ?>
</th>
    <th align="center" width="15%"><?php echo @_AM_CATALOG_ACTION; ?>
</th>
    <?php $_from = $this->_tpl_vars['properties']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['property']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd, even'), $this);?>
" align="center">
        <td><input name="property_weight[<?php echo $this->_tpl_vars['property']['property_id']; ?>
]" type="text" id="<?php echo $this->_tpl_vars['property']['property_id']; ?>
" value="<?php echo $this->_tpl_vars['property']['property_weight']; ?>
" size="1" maxlength="4" /></td>
        <td><?php echo $this->_tpl_vars['property']['property_name']; ?>
</td>
        <td align="center">
            <a href="admin.property.php?op=edit&amp;property_id=<?php echo $this->_tpl_vars['property']['property_id']; ?>
&amp;type_id=<?php echo $this->_tpl_vars['type']['type_id']; ?>
"><?php echo @_AM_CATALOG_EDIT; ?>
</a> |
          	<a href="action.property.php?ac=delete&amp;property_id=<?php echo $this->_tpl_vars['property']['property_id']; ?>
&amp;type_id=<?php echo $this->_tpl_vars['type']['type_id']; ?>
"><?php echo @_AM_CATALOG_DELETE; ?>
</a>
        </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    <tr>
        <td colspan="3"><input type="submit" name="button" id="button" value="<?php echo @_SUBMIT; ?>
"></td>
    </tr>       
</table>
</form>
<?php echo $this->_tpl_vars['pagenav']; ?>