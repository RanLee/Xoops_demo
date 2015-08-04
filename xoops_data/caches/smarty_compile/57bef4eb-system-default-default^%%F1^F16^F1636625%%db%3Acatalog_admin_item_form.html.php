<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_admin_item_form.html */ ?>
<div>
    <form name="<?php echo $this->_tpl_vars['form']['name']; ?>
" id="<?php echo $this->_tpl_vars['form']['name']; ?>
" action="<?php echo $this->_tpl_vars['form']['action']; ?>
" method="<?php echo $this->_tpl_vars['form']['method']; ?>
" <?php echo $this->_tpl_vars['form']['extra']; ?>
>
        <table class="outer" width="100%">
                <tr class="head">
                    <th colspan="2"><?php echo $this->_tpl_vars['form']['title']; ?>
</th>
                </tr>
                <?php if (count($this->_tpl_vars['form']['elements'])):
    foreach ($this->_tpl_vars['form']['elements'] as $this->_tpl_vars['item']):
 ?>
                <?php if (! $this->_tpl_vars['item']['hidden']): ?>
                <tr>
                <td class="even" width="15%"><?php echo $this->_tpl_vars['item']['caption']; ?>
<?php if ($this->_tpl_vars['item']['required']): ?><em>*</em><?php endif; ?></td>
                <td class="odd"><?php echo $this->_tpl_vars['item']['body']; ?>
</td>
                </tr>
                <?php else: ?>
                    <?php echo $this->_tpl_vars['item']['body']; ?>

                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </table>
    </form>
</div>
<?php echo $this->_tpl_vars['form']['javascript']; ?>

<script src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/include/jquery-1.3.2.min.js" type="text/javascript"></script>
<SCRIPT language=JavaScript>
$(document).ready(function() {
    $("select[id=country_id]").change( function() {
        var country_id = $(this).val();      
        $.ajax({
            type: "get",
            url: "ajax.brand.php",
            data:   "country_id=" + country_id,
            success: function(msg){        
              	$("#brand_id").html(msg);
            } 
        });
    }); 

    $("select[id=cat_pid]").change( function() {
        var cat_id = $(this).val();      
        $.ajax({
            type: "get",
            url: "ajax.category.php",
            data:   "cat_id=" + cat_id,
            success: function(msg){        
              	$("#cat_id").html(msg);
            } 
        });
    });
    
    $("select[id=link_id]").change( function() {
        var link_id = $(this).val();      
        $.ajax({
            type: "get",
            url: "ajax.symbol.php",
            data:   "link_id=" + link_id,
            success: function(msg){        
              	//$("#symbol_img").attr({ 
                //  src: msg
                //});
                $("#symbol_img").html(msg);
            } 
        });
    });       
}); 
                                            
</SCRIPT>
<script>
$(document).ready(function(){
	var fileName = $("input[name='pic']").attr("name");
    var i = 0;
	  $("#addMore").click(function(){
        i = ++i;
    	$(this).parent().before('<div><input type="file" name="'+fileName+i+'" id="'+fileName+i+'" /><input type="hidden" name="xoops_upload_file[]" id="xoops_upload_file[]" value="'+fileName+i+'" /> <a id="del'+i+'" href="javascript:void(0);" onclick="deleteUploadfeild('+i+');">X</a></div>');
    });
});
function deleteUploadfeild(id){
    var id = '#del'+id;
    $(id).parent().remove();
};
</script>
<script>
$(document).ready(function(){
	var annexfileName = $("input[name='annex']").attr("name");
    var i = 0;
	  $("#addMoreAnnex").click(function(){
        i = ++i;
    	$(this).parent().before('<div><input type="file" name="'+annexfileName+i+'" id="'+annexfileName+i+'" /><input type="hidden" name="xoops_upload_file[]" id="xoops_upload_file[]" value="'+annexfileName+i+'" /> <a id="delannex'+i+'" href="javascript:void(0);" onclick="deleteUploadannexfeild('+i+');">X</a></div>');
    });
});
function deleteUploadannexfeild(id){
    var id = '#delannex'+id;
    $(id).parent().remove();
};
</script>