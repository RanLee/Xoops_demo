<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:29
         compiled from db:catalog_admin_category.html */ ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/templates/style.css" />

<a href="admin.category.php?op=new"><?php echo @_AM_CATALOG_BUILDITEMCAT; ?>
</a>
<form id="form" name="form" method="post" action="admin.category.php">
    <table   class="outer" id="list-table">
        <th align="center"><?php echo @_AM_CATALOG_CATNAME; ?>
</th>
        <th align="center"><?php echo @_AM_CATALOG_CREATEDATE; ?>
</th>        
        <th align="center"><?php echo @_AM_CATALOG_ACTION; ?>
</th>
        <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['categories']):
?>
        <tr class="<?php echo $this->_tpl_vars['categories']['cat_pid']; ?>
" align="center">
            <td  width="40%"  align="left" class="first-cell" >
                <span><?php echo $this->_tpl_vars['categories']['prefix']; ?>
</span>
                <img src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/images/menu_down.png" width="9" height="9" border="0"   onclick="rowClicked(this)" />
                <input name="cat_weight[<?php echo $this->_tpl_vars['categories']['cat_id']; ?>
]" type="text" id="<?php echo $this->_tpl_vars['categories']['cat_id']; ?>
" value="<?php echo $this->_tpl_vars['categories']['cat_weight']; ?>
" size="1" maxlength="4" />                
                <span><?php echo $this->_tpl_vars['categories']['cat_name']; ?>
</span>
                <td><?php echo $this->_tpl_vars['categories']['cat_published']; ?>
</td>
            </td>        
            <td>
                <a href="admin.category.php?op=edit&amp;cat_id=<?php echo $this->_tpl_vars['categories']['cat_id']; ?>
"><?php echo @_AM_CATALOG_EDIT; ?>
</a> |
              	<a  href="action.category.php?ac=delete&amp;cat_id=<?php echo $this->_tpl_vars['categories']['cat_id']; ?>
"><?php echo @_AM_CATALOG_DELETE; ?>
</a>
            </td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <tr>
            <td colspan="8" align="center"><input type="submit" name="button" id="button" value="<?php echo @_SUBMIT; ?>
"></td>
        </tr>        
    </table>
</form>
<script language="JavaScript">
<!--

onload = function()
{
  startCheckOrder();
}

var imgPlus = new Image();
imgPlus.src = "<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/images/menu_right.png";

function rowClicked(obj)
{
  obj = obj.parentNode.parentNode;

  var tbl = document.getElementById("list-table");
  var lvl = parseInt(obj.className);
  var fnd = false;

  for (i = 0; i < tbl.rows.length; i++)
  {
      var row = tbl.rows[i];

      if (tbl.rows[i] == obj)
      {
          fnd = true;
      }
      else
      {
          if (fnd == true)
          {
              var cur = parseInt(row.className);
              if (cur > lvl)
              {
                  row.style.display = (row.style.display != 'none') ? 'none' :   'table-row';
              }
              else
              {
                  fnd = false;
                  break;
              }
          }
      }
  }

  for (i = 0; i < obj.cells[0].childNodes.length; i++)
  {
      var imgObj = obj.cells[0].childNodes[i];
      if (imgObj.tagName == "IMG" && imgObj.src != '<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/images/menu_arrow.gif')
      {
          imgObj.src = (imgObj.src == imgPlus.src) ? '<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/images/menu_down.png' : imgPlus.src;
      }
  }
}
//-->
</script>