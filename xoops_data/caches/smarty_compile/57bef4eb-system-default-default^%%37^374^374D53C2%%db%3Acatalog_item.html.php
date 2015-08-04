<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_item.html */ ?>

<!-- saved from url=(0022)http://internet.e-mail -->
<!--
 <img style="float:left; margin-right:20px" src="<?php echo $this->_tpl_vars['item']['item_picture']; ?>
" width="100" />
-->
<div id="catalogitem">
<div id="selectedIndex">
<select name="cat_id" onchange="location='itemlist.php?cat_id='+this.options[this.selectedIndex].value">
 <option><?php echo @_MD_CATALOG_CATEGORIES; ?>
</option>
    <?php $_from = $this->_tpl_vars['cat_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['category']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['cat_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['category']; ?>
</option>
        </optgroup>
    <?php endforeach; endif; unset($_from); ?> 
</select>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "db:catalog_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<!-- start image -->
<!-- start  jquery-lightbox-0.5 js and css  --> 
<link rel="stylesheet" type="text/css" href="./include/jquery-lightbox/css/lightbox.css" />
<script type="text/javascript" src="./include/jquery-lightbox/jquery.lightbox.js"></script>
<script>
	$(document).ready(function(){
		$(".lightbox").lightbox();
	});

</script>
<!-- end  jquery-lightbox-0.5 js and css   -->
 
<!--
  jCarousel library
-->
<script type="text/javascript" src="./include/jcarousel/jquery.jcarousel.pack.js"></script>
<!--
  jCarousel core stylesheet
-->
<link rel="stylesheet" type="text/css" href="./include/jcarousel/jquery.jcarousel.css" />
<!--
  jCarousel skin stylesheet
-->
<link rel="stylesheet" type="text/css" href="./include/jcarousel/skins/tango/skin.css" />

<script type="text/javascript">  
jQuery(document).ready(function() {
    jQuery("#bigImage img").attr("src",jQuery("#mycarousel li:first").find("img").attr("src"));
    jQuery("#bigImage a").attr("href",jQuery("#mycarousel li:first").find("img").attr("src"));
    jQuery("#mycarousel li:first").find("img").toggleClass ('jcarousel-itemNormal').addClass("jcarousel-itemCurrent");
    jQuery('#mycarousel').jcarousel();
    
    $("#mycarousel li").mouseover(function(){
        jQuery("#bigImage img").attr("src",jQuery(this).find("img").attr("src"));
        jQuery("#bigImage a").attr("href",jQuery(this).find("img").attr("src"));
        $(this).siblings().each(function(){
            jQuery(this).find("img").toggleClass().addClass('jcarousel-itemNormal');
        })
        jQuery(this).find("img").toggleClass('jcarousel-itemNormal').addClass("jcarousel-itemCurrent");
    })     
});

</script>


<div class="items_msg">
<?php if ($this->_tpl_vars['itemdescription'] == '1'): ?>
<ul >
<li><strong><?php echo @_MD_CATALOG_BELONGCAT; ?>
：</strong><?php echo $this->_tpl_vars['item']['cat_name']; ?>
</li>
<li><strong><?php echo @_MD_CATALOG_BELONGCATA; ?>
</strong><a title="<?php echo $this->_tpl_vars['item']['item_name']; ?>
"  href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/item.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
#A"><?php echo $this->_tpl_vars['item']['item_name']; ?>
</a></li>

<?php if ($this->_tpl_vars['item']['item_repairtime']): ?><li><strong><?php echo @_MD_CATALOG_ITEMPACK; ?>
：</strong><?php echo $this->_tpl_vars['item']['item_repairtime']; ?>
</li><?php endif; ?>
<?php if ($this->_tpl_vars['item']['item_weight']): ?>
<li><strong><?php echo @_MD_CATALOG_WEIGHT; ?>
：</strong><?php echo $this->_tpl_vars['item']['item_weight']; ?>
</li><?php endif; ?>





<?php if ($this->_tpl_vars['item']['shop_price']): ?><li><strong><?php echo @_MD_CATALOG_MADEIN; ?>
：</strong><?php echo $this->_tpl_vars['item']['shop_price']; ?>
</li><?php endif; ?>



<?php if ($this->_tpl_vars['item']['item_weights']): ?>
<li><strong><?php echo @_MD_CATALOG_WEIGHTA; ?>
：</strong><?php echo $this->_tpl_vars['item']['item_weights']; ?>
</li><?php endif; ?>

<?php if ($this->_tpl_vars['item']['item_size']): ?><li><strong><?php echo @_MD_CATALOG_MAINFUNCTION; ?>
：</strong><?php echo $this->_tpl_vars['item']['item_size']; ?>
</li><?php endif; ?>

<?php if ($this->_tpl_vars['item']['item_weight2']): ?><li><strong><?php echo @_MD_CATALOG_WEIGHT2; ?>
：</strong><?php echo $this->_tpl_vars['item']['item_weight2']; ?>
</li><?php endif; ?>

<?php if ($this->_tpl_vars['item']['item_weightss']): ?>
<li><strong><?php echo @_MD_CATALOG_WEIGHTAA; ?>
：</strong><?php echo $this->_tpl_vars['item']['item_weightss']; ?>
</li><?php endif; ?>

<?php if ($this->_tpl_vars['item']['item_weightsss']): ?>
<li><strong><?php echo @_MD_CATALOG_WEIGHTAAA; ?>
：</strong><?php echo $this->_tpl_vars['item']['item_weightsss']; ?>
</li><?php endif; ?>
</ul>





<?php endif; ?>


<?php if ($this->_tpl_vars['xoops_isadmin']): ?>
 <div >  <a href="admin/admin.item.php?op=edit&amp;item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
" target="_blank"><?php echo @_MD_CATALOG_EDIT; ?>
</a> |
             <a href="admin/admin.byitems.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
" target="_blank"><?php echo @_MD_CATALOG_EDITRELATIONITEM; ?>
</a> |
              	<a href="admin/action.item.php?ac=delete&amp;item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
" target="_blank"><?php echo @_MD_CATALOG_DELETE; ?>
</a></div>
                
                
 <?php endif; ?> 
 
</div>






<div id="catalogplay">
<div id="divimg">

<div id="bigImage"><a class="lightbox"><img /></a></div></div>
    <ul id="mycarousel" class="jcarousel-skin-tango">

    <?php $_from = $this->_tpl_vars['item']['relevance']['picture']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gallery']):
?>
        <li><a class="lightbox" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/uploads/gallery/<?php echo $this->_tpl_vars['gallery']['pic_path']; ?>
"><img class="jcarousel-itemNormal"  src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/uploads/gallery/<?php echo $this->_tpl_vars['gallery']['pic_path']; ?>
" width="40" height="40" /></a></li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
</div>    
 

 
 
        
    
    
<!-- end image -->


<!-- start RATE -->
<script type="text/javascript">
$(document).ready(function() {
var raterOptions	= {    
    value : <?php echo $this->_tpl_vars['item']['type1']; ?>
,
    enabled : false,
	max	: 5,
	image :  '<?php echo 'http://localhost/xoops/'; ?>/modules/catalog/include/rater-stars/star.gif'
}    
    $("#rateformtype1").empty().rater(raterOptions);

});
</script>

<script type="text/javascript">
$(document).ready(function() {
var raterOptions	= {    
    value : <?php echo $this->_tpl_vars['item']['type2']; ?>
,
    enabled : false,
	max	: 5,
	image :  '<?php echo 'http://localhost/xoops/'; ?>/modules/catalog/include/rater-stars/star.gif'
}    
    $("#rateformtype2").empty().rater(raterOptions);

});
</script>
<script type="text/javascript">
$(document).ready(function() {
var raterOptions	= {    
    value : <?php echo $this->_tpl_vars['item']['type3']; ?>
,
    enabled : false,
	max	: 5,
	image :  '<?php echo 'http://localhost/xoops/'; ?>/modules/catalog/include/rater-stars/star.gif'
}    
    $("#rateformtype3").empty().rater(raterOptions);

});
</script>
<script type="text/javascript">
$(document).ready(function() {
var raterOptions	= {    
    value : <?php echo $this->_tpl_vars['item']['type4']; ?>
,
    enabled : false,
	max	: 5,
	image :  '<?php echo 'http://localhost/xoops/'; ?>/modules/catalog/include/rater-stars/star.gif'
}    
    $("#rateformtype4").empty().rater(raterOptions);

});
</script>
<script type="text/javascript">
$(document).ready(function() {
var raterOptions	= {    
    value : <?php echo $this->_tpl_vars['item']['type5']; ?>
,
    enabled : false,
	max	: 5,
	image :  '<?php echo 'http://localhost/xoops/'; ?>/modules/catalog/include/rater-stars/star.gif'
}    
    $("#rateformtype5").empty().rater(raterOptions);

});
</script>
<script type="text/javascript">
$(document).ready(function() {
var raterOptions	= {    
    value : <?php echo $this->_tpl_vars['item']['rating']; ?>
,
    enabled : false,
	max	: 5,
	image :  '<?php echo 'http://localhost/xoops/'; ?>/modules/catalog/include/rater-stars/star.gif'
}    
    $("#rateformtype6").empty().rater(raterOptions);

});
</script>
              

<!-- end rate -->


<br />

<div id="explanation">

<?php if ($this->_tpl_vars['symbols']): ?>
<div id="item04item">
<div id="item06item"><h3><a name="#B1"><?php echo @_MD_CATALOG_SYMBOL; ?>
</a></h3></div>
<?php $_from = $this->_tpl_vars['symbols']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['symbols']):
?>
<img src="<?php echo $this->_tpl_vars['symbols']['link_image']; ?>
"  /></a> 
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>


<script>  

function  itemstylea(aaa){
	
	
	switch(aaa){
		
		case  01:		
		<?php if ($this->_tpl_vars['item']['item_summary']): ?>
		document.getElementById("item01a").style.color = '#E60012';
		document.getElementById("item01a").style.border = '1px solid #E60012';
	    document.getElementById("item01a").style.backgroundColor= '#FFF2F2';	
		
		
		<?php endif; ?>
		 <?php if ($this->_tpl_vars['item']['item_description']): ?>
		document.getElementById("item02a").style.color = '#545454';
		document.getElementById("item02a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item02a").style.backgroundColor= '#EFEFEF';
		<?php endif; ?>
		
		
		<?php if ($this->_tpl_vars['item']['item_service']): ?>		
		document.getElementById("item03a").style.color = '#545454';
		document.getElementById("item03a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item03a").style.backgroundColor= '#EFEFEF';
		<?php endif; ?>
		 <?php if ($this->_tpl_vars['files']): ?>	
		document.getElementById("item04a").style.color = '#545454';
		document.getElementById("item04a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item04a").style.backgroundColor= '#EFEFEF';
		<?php endif; ?>
		
		
	break
	
		
		case  02:
		
		<?php if ($this->_tpl_vars['item']['item_summary']): ?>
		document.getElementById("item01a").style.color = '#545454';
		document.getElementById("item01a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item01a").style.backgroundColor= '#EFEFEF';
			<?php endif; ?>
		 <?php if ($this->_tpl_vars['item']['item_description']): ?>
		document.getElementById("item02a").style.color = '#E60012';
		document.getElementById("item02a").style.border = '1px solid #E60012';
	    document.getElementById("item02a").style.backgroundColor= '#FFF2F2';	
			<?php endif; ?>
			<?php if ($this->_tpl_vars['item']['item_service']): ?>	
		document.getElementById("item03a").style.color = '#545454';
		document.getElementById("item03a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item03a").style.backgroundColor= '#EFEFEF';
			<?php endif; ?>
		 <?php if ($this->_tpl_vars['files']): ?>	
		document.getElementById("item04a").style.color = '#545454';
		document.getElementById("item04a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item04a").style.backgroundColor= '#EFEFEF';	
			<?php endif; ?>
		break
		
		case  03:
		<?php if ($this->_tpl_vars['item']['item_summary']): ?>
		document.getElementById("item01a").style.color = '#545454';
		document.getElementById("item01a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item01a").style.backgroundColor= '#EFEFEF';
			<?php endif; ?>		
		 <?php if ($this->_tpl_vars['item']['item_description']): ?>
		document.getElementById("item02a").style.color = '#545454';
		document.getElementById("item02a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item02a").style.backgroundColor= '#EFEFEF';
			<?php endif; ?>
			<?php if ($this->_tpl_vars['item']['item_service']): ?>	
		document.getElementById("item03a").style.color = '#E60012';
		document.getElementById("item03a").style.border = '1px solid #E60012';
	    document.getElementById("item03a").style.backgroundColor= '#FFF2F2';		
			<?php endif; ?>
		 <?php if ($this->_tpl_vars['files']): ?>	
		document.getElementById("item04a").style.color = '#545454';
		document.getElementById("item04a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item04a").style.backgroundColor= '#EFEFEF';
			<?php endif; ?>
		break	
		
		case  04:
		<?php if ($this->_tpl_vars['item']['item_summary']): ?>
		document.getElementById("item01a").style.color = '#545454';
		document.getElementById("item01a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item01a").style.backgroundColor= '#EFEFEF';
		<?php endif; ?>		
		 <?php if ($this->_tpl_vars['item']['item_description']): ?>
		document.getElementById("item02a").style.color = '#545454';
		document.getElementById("item02a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item02a").style.backgroundColor= '#EFEFEF';
		<?php endif; ?>
		<?php if ($this->_tpl_vars['item']['item_service']): ?>	
		document.getElementById("item03a").style.color = '#545454';
		document.getElementById("item03a").style.border = '1px solid #9E9E9E';
	    document.getElementById("item03a").style.backgroundColor= '#EFEFEF';
		<?php endif; ?>
		<?php if ($this->_tpl_vars['files']): ?>	
		document.getElementById("item04a").style.color = '#E60012';
		document.getElementById("item04a").style.border = '1px solid #E60012';
	    document.getElementById("item04a").style.backgroundColor= '#FFF2F2';	
		<?php endif; ?>
		break		
	
		}

	
	
	}




function item01item(){  
itemstylea(01);
  <?php if ($this->_tpl_vars['item']['item_summary']): ?> document.getElementById("item01item").style.display = ""; <?php endif; ?>
   <?php if ($this->_tpl_vars['item']['item_description']): ?>	document.getElementById("item02item").style.display = "none";	<?php endif; ?>
   <?php if ($this->_tpl_vars['item']['item_service']): ?>	document.getElementById("item03item").style.display = "none";<?php endif; ?>
    <?php if ($this->_tpl_vars['files']): ?>	document.getElementById("item04item").style.display = "none";<?php endif; ?>
}  
function item02item(){
itemstylea(02);		
<?php if ($this->_tpl_vars['item']['item_summary']): ?>document.getElementById("item01item").style.display = "none"; <?php endif; ?>
  	 <?php if ($this->_tpl_vars['item']['item_description']): ?>document.getElementById("item02item").style.display = "";	<?php endif; ?>
   <?php if ($this->_tpl_vars['item']['item_service']): ?>	document.getElementById("item03item").style.display = "none";<?php endif; ?>
    <?php if ($this->_tpl_vars['files']): ?>	document.getElementById("item04item").style.display = "none";<?php endif; ?>
}
function item03item(){    
itemstylea(03);		
 <?php if ($this->_tpl_vars['item']['item_summary']): ?>document.getElementById("item01item").style.display = "none";  <?php endif; ?>
   <?php if ($this->_tpl_vars['item']['item_description']): ?>	document.getElementById("item02item").style.display = "none";	<?php endif; ?>
   <?php if ($this->_tpl_vars['item']['item_service']): ?>	document.getElementById("item03item").style.display = "";<?php endif; ?>
    <?php if ($this->_tpl_vars['files']): ?>	document.getElementById("item04item").style.display = "none";<?php endif; ?>
}

function item04item(){     
itemstylea(04);		
 <?php if ($this->_tpl_vars['item']['item_summary']): ?>document.getElementById("item01item").style.display = "none";  <?php endif; ?>
   <?php if ($this->_tpl_vars['item']['item_description']): ?>	document.getElementById("item02item").style.display = "none";	<?php endif; ?>
   <?php if ($this->_tpl_vars['item']['item_service']): ?>	document.getElementById("item03item").style.display = "none";<?php endif; ?>
    <?php if ($this->_tpl_vars['files']): ?>	document.getElementById("item04item").style.display = "";<?php endif; ?>
}

</script>
<div id="itemulleft">
<ul>
    <?php if ($this->_tpl_vars['item']['item_summary']): ?><li  onmouseover="item01item();"><span><a  id="item01a" name="01"><?php echo @_MD_CATALOG_FUNCTIONDESC; ?>
</a></span></li><?php endif; ?>
    <?php if ($this->_tpl_vars['item']['item_description']): ?><li onmouseover="item02item();"><a id="item02a" name="02"><?php echo @_MD_CATALOG_DETAILSPEC; ?>
</a></li><?php endif; ?>
    <?php if ($this->_tpl_vars['item']['item_service']): ?><li onmouseover="item03item();"><a id="item03a" name="03"><?php echo @_MD_CATALOG_AFTERSERVICE; ?>
</a></li><?php endif; ?>
  <?php if ($this->_tpl_vars['files']): ?>  <li onmouseover="item04item();"><a id="item04a" name="04"><?php echo @_MD_CATALOG_ITEMFILEDOWNLOAD; ?>
</a></li> <?php endif; ?>
</ul>
</div>
<br />


<?php if ($this->_tpl_vars['item']['item_summary']): ?><div id="itemitemsummary">


<div id="item01item">
<div id="itemitema"></div>
<?php echo $this->_tpl_vars['item']['item_summary']; ?>

</div> 
<?php endif; ?>

<?php if ($this->_tpl_vars['item']['item_description']): ?>
<div id="item02item" style="display:none;">
<div id="itemitema"></div>
<?php echo $this->_tpl_vars['item']['item_description']; ?>
 
</div>
<?php endif; ?>
 
<?php if ($this->_tpl_vars['item']['item_service']): ?>
<div id="item03item" style="display:none;">
<div id="itemitema"></div>
<?php echo $this->_tpl_vars['item']['item_service']; ?>
 
</div> 
<?php endif; ?>



<?php if ($this->_tpl_vars['files']): ?>
<div id="item04item" style="display:none;">
<div id="itemitema"></div>
<?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['files']):
?>
<div id="files"><a title="<?php echo $this->_tpl_vars['files']['att_filename']; ?>
" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/catalog/downloads.php?id=<?php echo $this->_tpl_vars['files']['att_id']; ?>
" ><?php echo $this->_tpl_vars['files']['att_filename']; ?>
</a></div> 
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>
<div style="clear:both;"></div>
</div>




<div id="item05item">
<!-- start rate -->
<script type="text/javascript" src="include/rater-star/jquery.rater.js"></script>
<link href="include/rater-star/jquery.rater.css" rel="stylesheet"/>
<?php $_from = $this->_tpl_vars['resellers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['resellers']):
?>

<div id="resellers">
   <div id="resellersdiv">  <a href='<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/reseller/redirect.php?id=<?php echo $this->_tpl_vars['resellers']['link_id']; ?>
&amp;url=<?php echo $this->_tpl_vars['resellers']['link_url']; ?>
' target="_blank"><img src="<?php echo $this->_tpl_vars['resellers']['link_image']; ?>
"  /></a>  </div>  
    <div id="reseller-rate<?php echo $this->_tpl_vars['resellers']['link_id']; ?>
">
    <h4><?php echo @_MD_CATALOG_RATE; ?>
 : <span id="rateValue<?php echo $this->_tpl_vars['resellers']['link_id']; ?>
"><?php echo $this->_tpl_vars['resellers']['reseller_rating']; ?>
/<?php echo $this->_tpl_vars['resellers']['reseller_rates']; ?>
</span> </h4>
   
    <div id="rateform<?php echo $this->_tpl_vars['resellers']['link_id']; ?>
">
    <form action="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/action.rate.php" method="post">
        <div class="rate-item">
        <?php 
        for($i=5;$i>0;$i--) echo'<span><input type="radio" name="rate" id="rate'.$i.'" value="'.$i.'" />'.$i.'</span>';
         ?>
            <span>
                <input type="hidden" name="link_id" value="<?php echo $this->_tpl_vars['resellers']['link_id']; ?>
" />
                <input type="submit" class="article-button" value="<?php echo @_MD_CATALOG_RATEIT; ?>
" />
            </span>
        </div>
    </form>
    </div>
    
    <script type="text/javascript">
    $(document).ready(function() {
    var raterOptions	= {
        value : <?php echo $this->_tpl_vars['resellers']['reseller_rating']; ?>
,
    	max	: 5,
    	url		: '<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/ajax.action.rate.php?item_id=<?php echo $this->_tpl_vars['item']['item_id']; ?>
',
    	method	: 'get',
    	data : <?php echo $this->_tpl_vars['resellers']['link_id']; ?>
,
    	after_ajax	: function(ret) {
    		this.value	= ret.rating;
    		this.enabled= false;
    		alert(ret.msg);
    		$("#rateValue<?php echo $this->_tpl_vars['resellers']['link_id']; ?>
").replaceWith(ret.rating+'/'+ret.rates);
    		$("#rateform<?php echo $this->_tpl_vars['resellers']['link_id']; ?>
").rater(this);
        }
    }
    
    $("#rateform<?php echo $this->_tpl_vars['resellers']['link_id']; ?>
").empty().rater(raterOptions);
    
    });
    </script>
    </div> </div>
    <!-- end rate -->            
<?php endforeach; endif; unset($_from); ?>

<!-- start link_item -->




</div>

<!-- start link_item -->
 

<!-- start link_item -->
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#linksliderL').jcarousel({
        scroll: 1,
        auto: 1,
        wrap: 'both'         
    });
    jQuery('#linksliderR').jcarousel({
        scroll: 1,
        auto: 1,
        wrap: 'both'         
    });    
 
});

</script> 

<link rel="stylesheet" type="text/css" href="./include/linkslider/style.css" />
<div id="bottomitem_picture">
<table >
 <?php if ($this->_tpl_vars['item']['by_items']): ?>
  <tr>
    <td>
    
    <h3><?php echo @_MD_CATALOG_RELATIONITEM; ?>
</h3>
<ul id="linksliderL" class="jcarousel jcarousel-skin-linksliderL">
 <?php $_from = $this->_tpl_vars['item']['by_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['by_item']):
?>
        <li>
        <div id="imgdiv"><a href="item.php?item_id=<?php echo $this->_tpl_vars['by_item']['item_id']; ?>
#A"> <img  src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/uploads/gallery/<?php echo $this->_tpl_vars['by_item']['item_picture']; ?>
"   alt="<?php echo $this->_tpl_vars['by_item']['item_name']; ?>
" /></a></div></li>
    <?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>
</td>
    </tr>
</table>
</div>
 

</div>  

<!-- end link_item -->

<div style="text-align: center; padding: 3px; margin: 3px;">
    <?php echo $this->_tpl_vars['commentsnav']; ?>

    <?php echo $this->_tpl_vars['lang_notice']; ?>

</div>
<div style="margin:3px; padding: 3px;">
<?php if ($this->_tpl_vars['comment_mode'] == 'flat'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "db:system_comments_flat.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['comment_mode'] == 'thread'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "db:system_comments_thread.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['comment_mode'] == 'nest'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "db:system_comments_nest.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
</div>
<div style="position: absolute; 	top: 10000px;">
<img  src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/counter.php?item=<?php echo $this->_tpl_vars['item']['item_id']; ?>
" width="1px" height="1px" />
</div>
</div>
