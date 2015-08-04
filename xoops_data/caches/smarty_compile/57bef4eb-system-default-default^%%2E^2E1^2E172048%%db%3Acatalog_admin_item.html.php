<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:29
         compiled from db:catalog_admin_item.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'db:catalog_admin_item.html', 25, false),)), $this); ?>

<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/templates/style.css" />

<div style="float:left"><a href="admin.item.php?op=new"><?php echo @_AM_CATALOG_ADDITEM; ?>
</a></div>

<div style="float:right"><?php echo @_AM_CATALOG_SORT; ?>
：
    <select name="weight" id="weight" onchange="location='<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/admin/admin.item.php?start=<?php echo $this->_tpl_vars['start']; ?>
&amp;weight='+this.options[this.selectedIndex].value">
        <?php $_from = $this->_tpl_vars['weight_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['weight_list']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['weight']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['weight_list']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select> 
</div>
<br style="clear:both" />
<?php if ($this->_tpl_vars['showtype'] == '1'): ?>
<form id="form" name="form" method="post" action="action.item.php">
    <table class="outer"> 
        <th><?php echo @_AM_CATALOG_NUMBER; ?>
</th>
        <th><?php echo @_AM_CATALOG_ITEMNAME; ?>
</th>
        <th><?php echo @_AM_CATALOG_COUNTRY; ?>
</th>
        <th><?php echo @_AM_CATALOG_BRAND; ?>
</th>       
        <th><?php echo @_AM_CATALOG_CAT; ?>
</th>
        <th><?php echo @_AM_CATALOG_CREATEDATE; ?>
</th>
        <th><?php echo @_AM_CATALOG_ACTION; ?>
</th>
        <?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
        <tr class="<?php echo smarty_function_cycle(array('values' => 'odd, even'), $this);?>
" >
            <td><input name="weight[<?php echo $this->_tpl_vars['item']['item_id']; ?>
]" type="text" id="<?php echo $this->_tpl_vars['item']['item_id']; ?>
" value="<?php echo $this->_tpl_vars['item']['weight']; ?>
" size="1" maxlength="4" /></td>
            <td><a href="../item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
#A"><?php echo $this->_tpl_vars['item']['item_name']; ?>
</a></td>
            <td><?php echo $this->_tpl_vars['item']['country_name']; ?>
 </td>
            <td><?php echo $this->_tpl_vars['item']['brand_name']; ?>
</td>                  
            <td><?php echo $this->_tpl_vars['item']['cat_secname']; ?>
</td>
            <td><?php echo $this->_tpl_vars['item']['item_buildtime']; ?>
</td>
            <td>
                <a href="admin.item.php?op=edit&amp;item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><?php echo @_AM_CATALOG_EDIT; ?>
</a> |
               <a href="admin.byitems.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><?php echo @_AM_CATALOG_EDITLINKEDITEM; ?>
</a> |
              	<a href="action.item.php?ac=delete&amp;item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><?php echo @_AM_CATALOG_DELETE; ?>
</a>           
            </td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <tr> <td colspan="8"  align="right">
           <input type="submit" name="button" id="button" value="<?php echo @_SUBMIT; ?>
"></td>
        </tr>       
    </table>
</form>
<?php else: ?>
<form id="form" name="form" method="post" action="action.item.php">
    <table class="outer"> 
        <th><?php echo @_AM_CATALOG_NUMBER; ?>
</th>
        <th><?php echo @_AM_CATALOG_WEIGHT; ?>
</th>
        <th><?php echo @_AM_CATALOG_ITEMNAME; ?>
</th>     
        <th><?php echo @_AM_CATALOG_CAT; ?>
</th>
        <th><?php echo @_AM_CATALOG_CREATEDATE; ?>
</th>
        <th><?php echo @_AM_CATALOG_ACTION; ?>
</th>
        <?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
        <tr class="<?php echo smarty_function_cycle(array('values' => 'odd, even'), $this);?>
" >
                      <td><?php echo $this->_tpl_vars['item']['item_id']; ?>
</td>
            <td>
                <input name="weight[<?php echo $this->_tpl_vars['item']['item_id']; ?>
]" type="text" id="<?php echo $this->_tpl_vars['item']['item_id']; ?>
" value="<?php echo $this->_tpl_vars['item']['weight']; ?>
" size="1" maxlength="4" />
            </td>
            <td><a href="../item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
#A"><?php echo $this->_tpl_vars['item']['item_name']; ?>
</a></td>                    
            <td><?php echo $this->_tpl_vars['item']['cat_secname']; ?>
</td>
            <td><?php echo $this->_tpl_vars['item']['create_time']; ?>
</td>
            <td>
                <a href="admin.item.php?op=edit&amp;item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><?php echo @_AM_CATALOG_EDIT; ?>
</a> |
              <a href="admin.byitems.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><?php echo @_AM_CATALOG_EDITLINKEDITEM; ?>
</a> |
              	<a href="action.item.php?ac=delete&amp;item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><?php echo @_AM_CATALOG_DELETE; ?>
</a>            
            </td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <tr> <td colspan="8"  align="right">
           <input type="submit" name="button" id="button" value="<?php echo @_SUBMIT; ?>
"></td>
        </tr>      
    </table>
</form>
<?php endif; ?>
<?php echo $this->_tpl_vars['pagenav']; ?>