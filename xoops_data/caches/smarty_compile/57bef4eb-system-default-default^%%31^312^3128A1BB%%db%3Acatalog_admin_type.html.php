<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_admin_type.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'db:catalog_admin_type.html', 8, false),)), $this); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/templates/style.css" />
<div><a href="admin.type.php?op=new"><?php echo @_AM_CATALOG_JOINTYPE; ?>
</a></div>
<table class="outer"> 
    <th align="center"><?php echo @_AM_CATALOG_TYPENAME; ?>
</th>
    <th align="center"><?php echo @_AM_CATALOG_CONTENTNUM; ?>
</th>
    <th align="center"><?php echo @_AM_CATALOG_ACTION; ?>
</th>
    <?php $_from = $this->_tpl_vars['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd, even'), $this);?>
" align="center">
        <td><?php echo $this->_tpl_vars['type']['type_name']; ?>
</td>
        <td><?php echo $this->_tpl_vars['type']['count_property']; ?>
</td>
        <td align="center">
            <a href="admin.type_category.php?type_id=<?php echo $this->_tpl_vars['type']['type_id']; ?>
"><?php echo @_AM_CATALOG_CONTENTCAT_MANAGER; ?>
</a> |
            <a href="admin.property.php?type_id=<?php echo $this->_tpl_vars['type']['type_id']; ?>
"><?php echo @_AM_CATALOG_CONTENT_MANAGER; ?>
</a> |
            <a href="admin.type.php?op=edit&amp;type_id=<?php echo $this->_tpl_vars['type']['type_id']; ?>
"><?php echo @_AM_CATALOG_EDIT; ?>
</a> |
          	<a href="action.type.php?ac=delete&amp;type_id=<?php echo $this->_tpl_vars['type']['type_id']; ?>
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
<?php echo $this->_tpl_vars['pagenav']; ?>