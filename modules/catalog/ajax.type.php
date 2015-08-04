 <?php
//include_once '../../../mainfile.php';
include_once 'header.php';
header('Content-Type:text/html; charset='._CHARSET);

global $xoopsLogger;
$xoopsLogger->activated = false;

$type_id = isset($_REQUEST['type_id']) ? intval($_REQUEST['type_id']) : '';
$item_id = isset($_REQUEST['item_id']) ? intval($_REQUEST['item_id']) : '';

$property_handler = xoops_getmodulehandler('property','catalog');
$itemsproperties_handler =& xoops_getmodulehandler('itemsproperties', 'catalog');
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

$criteria = new Criteria("type_id", $type_id);
$properties = $property_handler->getAll($criteria, null, false);

if(!empty($properties)){
    $itemsproperties = '';
    if(!empty($item_id)){
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria("item_id", $item_id));
        $criteria->add(new Criteria("type_id", $type_id));
        $itemsproperties = $itemsproperties_handler->getAll($criteria,array('property_id','property_value'),false);
    }
    echo _MD_CATALOG_CONTENTLIST;
    echo '<input id="type_id" type="hidden" value="'.$type_id.'" name="type_id"/>';
    foreach($properties as $k=>$v){
        $item_value = '';
        if(!empty($itemsproperties)){
            foreach($itemsproperties as $itemvalue){      
                if($itemvalue['property_id'] == $v['property_id']) $item_value = $itemvalue['property_value'];
            }
        }
        echo '<br>';
        echo $v['property_name'];
        if($v['input_mode'] == 1){
            echo '&nbsp;&nbsp;<input id="property['.$v['property_id'].']" type="text" value="'.$item_value.'" maxlength="255" size="60" name="property['.$v['property_id'].']"/>';
        }elseif($v['input_mode'] == 2){
            if(!empty($v['property_options']) && preg_match('/|/', $v['property_options'])){
                $property_options = explode('|', $v['property_options']);
                echo '<select id="property['.$v['property_id'].']" name="property['.$v['property_id'].']" size="1">';
                    echo '<option value="0">'._MD_CATALOG_CHOICE.'</option>';
                    foreach($property_options as $key=>$value){
                        $select = !empty($item_value) ? ' selected="selected"' : '';
                        echo '<option'.$select.' value="'.$value.'">'.$value.'</option>';
                    }
                echo '</select>';
            }else{
                echo _MD_CATALOG_NOLIST;
            }
        }else{
           echo '<textarea id="property['.$v['property_id'].']" cols="80" rows="5" name="property['.$v['property_id'].']">'.$item_value.'</textarea>';
        }
    }
}else{
    echo _MD_CATALOG_NOCONTENT;
}

?>