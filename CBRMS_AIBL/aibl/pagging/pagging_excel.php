<?php
$limit = 30;
function requisition_list_scope() {
    $role = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : '';
    $vendorRole = isset($_SESSION['net_user_type']) ? $_SESSION['net_user_type'] : '';
    if (in_array($role, array('admin','gsd')) || in_array($vendorRole, array('admin','vendor'))) return '';
    if (in_array($role, array('user','manager'))) return " WHERE collecting_branch_code='".mysql_real_escape_string($_SESSION['branch_code'])."'";
    return ' WHERE 1=0';
}
function select_entries_excel($offset=0) {
    global $limit;
    $offset = isset($_REQUEST['offset']) ? max(0,(int)$_REQUEST['offset']) : max(0,(int)$offset);
    return mysql_query('SELECT * FROM aibl_chq_rqst'.requisition_list_scope().' ORDER BY approval_date_time DESC, rqst_id DESC LIMIT '.$offset.', '.(int)$limit);
}
function nav_excel($offset=0,$this_script='') {
    global $limit;
    $offset = isset($_REQUEST['offset']) ? max(0,(int)$_REQUEST['offset']) : max(0,(int)$offset);
    $result = mysql_query('SELECT COUNT(*) FROM aibl_chq_rqst'.requisition_list_scope());
    if (!$result) return;
    $row = mysql_fetch_row($result); $total=(int)$row[0];
    $pages=max(1,(int)ceil($total/$limit)); $current=min($pages,(int)floor($offset/$limit)+1);
    echo '<nav class="pagination" aria-label="Requisition pages"><span>'.number_format($total).' requisitions &middot; Page '.$current.' of '.number_format($pages).'</span><div>';
    $visible=array_unique(array_merge(array(1),range(max(1,$current-2),min($pages,$current+2)),array($pages)));
    $last=0;
    if($current>1) echo '<a href="index.php?option=total_request&amp;task=total_request_admin&amp;offset='.(($current-2)*$limit).'">&larr; Previous</a>';
    foreach($visible as $page) {
        if($last && $page>$last+1) echo '<span class="pagination-gap">&hellip;</span>';
        if($page===$current) echo '<span class="pagination-current" aria-current="page">'.$page.'</span>';
        else echo '<a href="index.php?option=total_request&amp;task=total_request_admin&amp;offset='.(($page-1)*$limit).'">'.$page.'</a>';
        $last=$page;
    }
    if($current<$pages) echo '<a href="index.php?option=total_request&amp;task=total_request_admin&amp;offset='.($current*$limit).'">Next &rarr;</a>';
    echo '</div></nav>';
}
