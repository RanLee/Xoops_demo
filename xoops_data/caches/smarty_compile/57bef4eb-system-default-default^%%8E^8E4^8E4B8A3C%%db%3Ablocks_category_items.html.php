<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:blocks_category_items.html */ ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/templates/style.css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/include/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/include/rater-stars/jquery.rater.js"></script>
<link href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/include/rater-stars/jquery.rater.css" rel="stylesheet"/>
<?php $this->assign('n', 0); ?>

<table> 
<tr>  
    <?php if (count($this->_tpl_vars['block']['items'])):
    foreach ($this->_tpl_vars['block']['items'] as $this->_tpl_vars['item']):
 ?>
    <!-- <?php echo $this->_tpl_vars['n']++; ?>
-->   
    <td>
    <?php if ($this->_tpl_vars['n'] == 1): ?><img src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/uploads/smil3dbd4bf386b36.gif" width="10" style="vertical-align:top;"/><?php endif; ?>
    <?php if ($this->_tpl_vars['n'] == 2): ?><img src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/uploads/smil3dbd4d4e4c4f2.gif" width="10" style="vertical-align:top;"/><?php endif; ?>
    <?php if ($this->_tpl_vars['n'] == 3): ?><img src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/uploads/smil3dbd4d75edb5e.gif" width="10" style="vertical-align:top;"/><?php endif; ?>
        <a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><img src="<?php echo $this->_tpl_vars['item']['item_picture']; ?>
" width="100" height="80"/></a><br />
        <a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
"><?php if ($this->_tpl_vars['item']['page_title']): ?><?php echo $this->_tpl_vars['item']['page_title']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['item_name']; ?>
<?php endif; ?></a><br />

    <!-- start rate -->
    <div id="rateform<?php echo $this->_tpl_vars['item']['item_id']; ?>
"> 
        <?php 
        for($i=5;$i>0;$i--) echo'<span><input type="radio" name="rate" id="rate'.$i.'" value="'.$i.'" />'.$i.'</span>';
         ?>
    </div>
    
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
    <?php endforeach; endif; unset($_from); ?>
</tr>
</table>