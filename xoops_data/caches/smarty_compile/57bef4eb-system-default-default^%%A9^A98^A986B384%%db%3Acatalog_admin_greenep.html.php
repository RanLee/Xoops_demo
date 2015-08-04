<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:29
         compiled from db:catalog_admin_greenep.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'db:catalog_admin_greenep.html', 9, false),)), $this); ?>
<a href="admin.greenep.php?op=new"><?php echo @_AM_CATALOG_JOINGREENEP; ?>
</a>
<table class="outer">

    <th><?php echo @_AM_CATALOG_RANK; ?>
</th>
    <th><?php echo @_AM_CATALOG_SYMBOLPIC; ?>
</th>
    <th><?php echo @_AM_CATALOG_ACTION; ?>
</th>
     
    <?php $_from = $this->_tpl_vars['greeneps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['greeneps']):
?>
    <tr  class="<?php echo smarty_function_cycle(array('values' => 'odd, even'), $this);?>
">
        <td><?php echo $this->_tpl_vars['greeneps']['greenep_rank']; ?>
</td>
        <td><img src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/uploads/<?php echo $this->_tpl_vars['greeneps']['greenep_logo']; ?>
" width="80"></td>  
        <td>
        <a href="admin.greenep.php?op=edit&amp;greenep_id=<?php echo $this->_tpl_vars['greeneps']['greenep_id']; ?>
"><?php echo @_AM_CATALOG_EDIT; ?>
</a> | 
        <a href="admin.greenep.php?op=delete&amp;greenep_id=<?php echo $this->_tpl_vars['greeneps']['greenep_id']; ?>
"><?php echo @_AM_CATALOG_DELETE; ?>
</a></td> 
    </tr>
    <?php endforeach; endif; unset($_from); ?>
   
</table>