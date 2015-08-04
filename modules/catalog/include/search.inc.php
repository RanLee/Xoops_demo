<?php
 
if (!defined("XOOPS_ROOT_PATH")) { exit(); }

function catalog_search($queryarray, $andor, $limit, $offset, $userid)

{
    global $xoopsDB, $xoopsConfig, $myts, $xoopsUser;
    
    $sql = "SELECT item_id,item_name,item_summary,item_keywords,modify_time,item_repairtime,item_summary,item_description,item_service FROM ".$xoopsDB->prefix("catalog_item")."";
        
    if ( is_array($queryarray) && $count = count($queryarray) ) {
        $sql .= " WHERE ((item_name LIKE '%$queryarray[0]%' OR item_summary LIKE '%$queryarray[0]%' OR item_keywords LIKE '%$queryarray[0]%' OR item_repairtime LIKE '%$queryarray[0]%' OR item_summary LIKE '%$queryarray[0]%' OR item_description LIKE '%$queryarray[0]%' OR item_service LIKE '%$queryarray[0]%')";
        for($i=1;$i<$count;$i++){
            $sql .= " $andor ";
            $sql .= "(item_name '%$queryarray[$i]%' OR item_summary LIKE '%$queryarray[$i]%' OR item_keywords LIKE '%$queryarray[$i]%' OR item_repairtime LIKE '%$queryarray[$i]%' OR item_summary LIKE '%$queryarray[$i]%' OR item_description LIKE '%$queryarray[$i]%' OR item_service  LIKE '%$queryarray[$i]%')";
        }
        $sql .= ") ";
    }

    $sql .= "ORDER BY item_id DESC";
    
    $query = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("catalog_item")." WHERE item_id>0");
    list($numrows) = $xoopsDB->fetchrow($query);
    
    $result = $xoopsDB->query($sql,$limit,$offset);
    $ret = array();
    $i = 0;
    
    while($myrow = $xoopsDB->fetchArray($result)){
        $ret[$i]['image'] = "images/search.png";  
        $ret[$i]['link'] = "item.php?item_id=".$myrow['item_id'];
        $ret[$i]['title'] = $myrow['item_name'].$myrow['item_repairtime'];
        $ret[$i]['time'] = $myrow['modify_time'];
        $ret[$i]['uid'] = "";
        $i++;
    }
        
    return $ret;

}

?>
