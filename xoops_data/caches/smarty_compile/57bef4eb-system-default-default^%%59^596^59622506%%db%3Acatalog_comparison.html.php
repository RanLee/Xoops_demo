<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_comparison.html */ ?>
<div id="catalog_comparison">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "db:catalog_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo @_MD_CATALOG_DEAR; ?>
 <?php echo $this->_tpl_vars['name']; ?>
<?php echo @_MD_CATALOG_HELLO; ?>
</h2>
<?php if ($this->_tpl_vars['items']): ?>
<script type="text/javascript" src="include/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="include/rater-stars/jquery.rater.js"></script>
<link href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/include/rater-stars/jquery.rater.css" rel="stylesheet"/>
<script language=javascript>
    function deleteAll()
    {
    document.form.action="comparison.php?op=deleteAll"
    document.form.submit()
    }
    function list()
    {
    document.form.action="comparison.php#A"
    document.form.submit()
    }
</script>




          
<form id="form" name="form" method="post" action="comparison.php">
    <div><input type="button" value='<?php echo @_MD_CATALOG_CLEARITEM; ?>
'  onClick="deleteAll()"></div>
    <table class="outer"> 
        <th><input id="item_check" name="item_check" type="checkbox" onclick="xoopsCheckAll('form','item_check');" /></th>
        <th><?php echo @_MD_CATALOG_ITEMNAME; ?>
</th>
        <th><?php echo @_MD_CATALOG_SHOPPRICE; ?>
</th>
        <th style="width: 50px;" ><?php echo @_MD_CATALOG_GREEN; ?>
</th>
        <th><?php echo @_MD_CATALOG_SIZENUMBER; ?>
</th>                
        <th style="width: 40px;" ><?php echo @_MD_CATALOG_WEIGHT; ?>
</th>
        <th style="width: 40px;"><?php echo @_MD_CATALOG_REPAIR; ?>
</th>
        <th><?php echo @_MD_CATALOG_EVALUATION; ?>
</th>
        <th style="width: 40px;" ><?php echo @_MD_CATALOG_ACTIVE; ?>
</th>
        <?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr >
            <td><input name="item[<?php echo $this->_tpl_vars['item']['item_id']; ?>
]" id="item[<?php echo $this->_tpl_vars['item']['item_id']; ?>
]" value="<?php echo $this->_tpl_vars['item']['item_id']; ?>
"  type="checkbox" /></td>
            <td><a href="../../modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
#A"><?php echo $this->_tpl_vars['item']['item_name']; ?>
</a></td>
            <td><?php echo $this->_tpl_vars['item']['shop_price']; ?>
<?php echo @_MD_CATALOG_DOLLOR; ?>
</td>
            <td><?php echo @_MD_CATALOG_RANK; ?>
<?php echo $this->_tpl_vars['item']['greenep_id']; ?>
</td> 
            <td><?php echo $this->_tpl_vars['item']['item_size']; ?>
<?php echo @_MD_CATALOG_SIZE; ?>
</td>
            <td><?php echo $this->_tpl_vars['item']['item_weight']; ?>
<?php echo @_MD_CATALOG_KG; ?>
></td>                                   
            <td><?php echo $this->_tpl_vars['item']['item_repairtime']; ?>
<?php echo @_MD_CATALOG_YEAR; ?>
</td>
            <td>
                <!-- start rate -->
                <span id="rateform<?php echo $this->_tpl_vars['item']['item_id']; ?>
"> 
                    <?php 
                    for($i=5;$i>0;$i--) echo'<span><input type="radio" name="rate" id="rate'.$i.'" value="'.$i.'" />'.$i.'</span>';
                     ?>
                </span>
                
                <script type="text/javascript">
                $(document).ready(function() {
                var raterOptions	= {    
                    value : <?php echo $this->_tpl_vars['item']['rating']; ?>
,
                    enabled : false,
                	max	: 5,
                	image :  '<?php echo 'http://localhost/xoops/'; ?>/modules/catalog/include/rater-stars/star.gif'
                }    
                    $("#rateform<?php echo $this->_tpl_vars['item']['item_id']; ?>
").empty().rater(raterOptions);
                });
                </script>
                
                <!-- end rate --> 
            </td>
            <td><a href="comparison.php?op=delete&amp;item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
#A"><?php echo @_MD_CATALOG_DELETE; ?>
</a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <tr>
            <td colspan="9" align="right">
                <select name="sort">
                    <option value="shop_price"><?php echo @_MD_CATALOG_BYPRICE; ?>
</option>
                    <option value="greenep_id"><?php echo @_MD_CATALOG_GREENEP; ?>
</option>
                    <option value="rating"><?php echo @_MD_CATALOG_EVALUATION; ?>
</option>
                    <option value="item_size"><?php echo @_MD_CATALOG_SIZENUMBER; ?>
</option>       
                    <option value="item_weight"><?php echo @_MD_CATALOG_WEIGHT; ?>
</option>
                    <option value="item_repairtime"><?php echo @_MD_CATALOG_REPAIRTIME; ?>
</option>      
                </select>
                <select name="order">
                    <option value="asc"><?php echo @_MD_CATALOG_BYASC; ?>
</option>
                    <option value="desc"><?php echo @_MD_CATALOG_BYDESC; ?>
</option>
                </select>
                <input type="button" value="<?php echo @_SUBMIT; ?>
"  onClick="list()"> 
            </td>
        </tr>       
    </table>
</form>
<?php else: ?>
    <h1 ><?php echo @_MD_CATALOG_NOITEMJOIN; ?>
</h1>
<?php endif; ?>
</div>