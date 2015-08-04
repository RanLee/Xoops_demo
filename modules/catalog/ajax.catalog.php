 <?php
//include_once '../../../mainfile.php';
include_once 'header.php';
header('Content-Type:text/html; charset='._CHARSET);

global $xoopsLogger;
$xoopsLogger->activated = false;

$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : 'exit';
$cat_id = isset($_REQUEST['cat_id']) ? intval($_REQUEST['cat_id']) : '';
$type_id = isset($_REQUEST['type_id']) ? intval($_REQUEST['type_id']) : '';
$tc_id = isset($_REQUEST['tc_id']) ? intval($_REQUEST['tc_id']) : '';

$search_handler =& xoops_getmodulehandler('search', 'catalog');
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

switch ($op) {
    case 'category':
        $cat_obj = $search_handler->CatelogHandlers['category']->get($cat_id);
        $types = $search_handler->CatelogHandlers['type']->getList();
        $type_id = $cat_obj->getVar('type_id');
        echo '<select id="type_id" name="type_id" size="1">';
        echo '<option value="0">'._MD_CATALOG_CATCHOICE.'</option>';
        foreach($types as $key=>$value){         
            $select = '';
            if($type_id == $key) $select = ' selected="selected"';
            echo '<option'.$select.' value="'.$key.'">'.$value.'</option>';
        }
        echo '</select>';
        
        echo '<span id="type">';
        $criteria = new Criteria('type_id', $type_id);
        $tcs = $search_handler->CatelogHandlers['typecategory']->getList($criteria);
        echo '<select id="tc_id" name="tc_id" size="1">';
        echo '<option value="0">'._MD_CATALOG_CONTENTCATCHOICE.'</option>';
        foreach($tcs as $key=>$value){         
            echo '<option'.$select.' value="'.$key.'">'.$value.'</option>';
        }
        echo '</select>';
        
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('type_id', $type_id));
        $criteria->add(new Criteria('property_hassearch', 2));
        $criteria->add(new Criteria('input_mode', 2));
        $properties = $search_handler->CatelogHandlers['property']->getList($criteria);
        echo '<span id="property">';
        echo '<select id="property_id" name="property_id" size="1">';
        echo '<option value="0">'._MD_CATALOG_CONTENT.'</option>';
        foreach($properties as $key=>$value){         
            echo '<option'.$select.' value="'.$key.'">'.$value.'</option>';
        }
        echo '</select>';
        echo '<span>';
        echo '<span>';
    break;
    
    case 'type':
        $criteria = new Criteria('type_id', $type_id);
        $tcs = $search_handler->CatelogHandlers['typecategory']->getList($criteria);
        echo '<select id="tc_id" name="tc_id" size="1">';
        echo '<option value="0">'._MD_CATALOG_CONTENTCATCHOICE.'</option>';
        foreach($tcs as $key=>$value){
            echo '<option'.$select.' value="'.$key.'">'.$value.'</option>';
        }
        echo '</select>';
        
        echo '<span id="property">';
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('type_id', $type_id));
        $criteria->add(new Criteria('property_hassearch', 2));
        $criteria->add(new Criteria('input_mode', 2));
        $properties = $search_handler->CatelogHandlers['property']->getList($criteria);
        echo '<select id="property_id" name="property_id" size="1">';
        echo '<option value="0">'._MD_CATALOG_CONTENT.'</option>';
        foreach($properties as $key=>$value){         
            echo '<option'.$select.' value="'.$key.'">'.$value.'</option>';
        }
        echo '</select>';
        echo '</span>';
    break;
    
    case 'tc':        
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('tc_id', $tc_id));
        $criteria->add(new Criteria('property_hassearch', 2));
        $criteria->add(new Criteria('input_mode', 2));
        $properties = $search_handler->CatelogHandlers['property']->getList($criteria);
        echo '<select id="property_id" name="property_id" size="1">';
        echo '<option value="0">'._MD_CATALOG_CONTENT.'</option>';
        foreach($properties as $key=>$value){         
            echo '<option'.$select.' value="'.$key.'">'.$value.'</option>';
        }
        echo '</select>';
    break;
    
    default:
    case 'exit':
    break;
}

?>