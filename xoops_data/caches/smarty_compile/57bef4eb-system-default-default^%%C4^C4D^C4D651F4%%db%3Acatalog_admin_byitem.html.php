<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:29
         compiled from db:catalog_admin_byitem.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'db:catalog_admin_byitem.html', 23, false),)), $this); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/templates/style.css" />
<script src="../include/jquery-1.3.2.min.js" type="text/javascript"></script>

<h1><?php echo $this->_tpl_vars['item']['item_name']; ?>
</h1>

<select name="cat_id" id="cat_id">
    <option value="0"><?php echo @_AM_CATALOG_CATCHOICE; ?>
</option>
    <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['category']):
?>
        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['cat_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['category']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
</select>

<form id="form" name="form" method="post" action="admin.byitems.php">

<div id="category">
    <?php if ($this->_tpl_vars['items']): ?>
        <h2><?php echo @_AM_CATALOG_CHOICEITEMOK; ?>
</h2>
            <table class="outer" align="left"> 
                <th><?php echo @_AM_CATALOG_CHECK; ?>
</th>
                <th><?php echo @_AM_CATALOG_ITEMNAME; ?>
</th>
                <th><?php echo @_AM_CATALOG_BRAND; ?>
</th>
                <?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <tr class="<?php echo smarty_function_cycle(array('values' => 'odd, even'), $this);?>
" >
                    <td><?php if ($this->_tpl_vars['item']['checkbox']): ?><input name="item_ids[]" value="<?php echo $this->_tpl_vars['item']['item_id']; ?>
"  type="checkbox" /><?php else: ?><?php echo @_AM_CATALOG_LINKED; ?>
<?php endif; ?></td>
                    <td><?php echo $this->_tpl_vars['item']['item_name']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['item']['brand']; ?>
</td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <tr><td colspan="3">
                    <input type='hidden' name='cat_id' value='<?php echo $this->_tpl_vars['cat_id']; ?>
' />
                    <input type='hidden' name='item_id' value='<?php echo $this->_tpl_vars['item_id']; ?>
' />
                    <input type="button" value="<?php echo @_AM_CATALOG_LINKEDITEM_AFTERJOIN; ?>
" onClick="insertAll()">
                    </td>
                </tr>       
            </table>
    <?php endif; ?>

    <h2><?php echo @_AM_CATALOG_LINKEDITEM; ?>
</h2>
    <table class="outer" align="left"> 
        <th><?php echo @_AM_CATALOG_CHECK; ?>
</th>
        <th><?php echo @_AM_CATALOG_ITEMNAME; ?>
</th>
        <th><?php echo @_AM_CATALOG_ACTION; ?>
</th>
        <?php $_from = $this->_tpl_vars['by_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['by_item']):
?>
        <tr class="<?php echo smarty_function_cycle(array('values' => 'odd, even'), $this);?>
" >
            <td><input name="item[]" value="<?php echo $this->_tpl_vars['key']; ?>
"  type="checkbox" /></td>
            <td><?php echo $this->_tpl_vars['by_item']; ?>
</td>
            <td><a href="admin.byitems.php?op=delete&amp;by_item_id=<?php echo $this->_tpl_vars['key']; ?>
&amp;item_id=<?php echo $this->_tpl_vars['item_id']; ?>
&amp;cat_id=<?php echo $this->_tpl_vars['cat_id']; ?>
"><?php echo @_AM_CATALOG_DELETE; ?>
</a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <tr>
            <td colspan="3">
                <input type='hidden' name='cat_id' value='<?php echo $this->_tpl_vars['cat_id']; ?>
' />
                <input type='hidden' name='item_id' value='<?php echo $this->_tpl_vars['item_id']; ?>
' />
                <input type="button" value="<?php echo @_AM_CATALOG_REMOVECHOICED; ?>
" onClick="deleteAll()">
            </td>
        </tr>       
    </table>
    

<SCRIPT language=JavaScript>
$(document).ready(function() {    
    $("select[id=cat_id]").change( function() {
        var cat_id = $(this).val();
        var item_id = "<?php echo $this->_tpl_vars['item_id']; ?>
";
        $.ajax({
        type: "get",
        url: "ajax.byitems.php",
        data:   "cat_id=" + cat_id + '&item_id=' + item_id,
        success: function(msg){
          	$("#category").html(msg);
        } 
        });
    }); 
});                                              
</SCRIPT>
</div>
</form>


<script language=javascript>
    function insertAll()
    {
    document.form.action="admin.byitems.php?op=insertAll"
    document.form.submit()
    }
    function deleteAll()
    {
    document.form.action="admin.byitems.php?op=deleteAll"
    document.form.submit()
    }
</script>