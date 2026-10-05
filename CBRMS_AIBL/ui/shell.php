<?php
function ui_escape($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'Windows-1252'); }
function ui_icon($name = 'grid') {
    $paths = array('grid'=>'M3 3h7v7H3z M14 3h7v7h-7z M3 14h7v7H3z M14 14h7v7h-7z', 'arrow'=>'M7 17L17 7 M7 7h10v10', 'menu'=>'M4 6h16 M4 12h16 M4 18h16', 'search'=>'M21 21l-5-5 M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0', 'file'=>'M14 2H5v20h14V7z M14 2v5h5 M8 12h8 M8 16h6', 'check'=>'M5 12l4 4L19 6', 'logout'=>'M9 4H4v16h5 M9 12h12 M17 8l4 4-4 4');
    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="'.$paths[isset($paths[$name]) ? $name : 'file'].'"/></svg>';
}
function ui_title($option) {
    $titles = array('aibl_start'=>'Overview','upload_file'=>'Import cheque requisitions','upload_card_file'=>'Import card requisitions','other_upload_file'=>'Import other items','psi_print'=>'Print preparation','others_psi_print'=>'Other items print preparation','serial_no'=>'Serial numbers','manage_order'=>'Manage orders','challan_no'=>'Cheque challans','others_challan_no'=>'Other item challans','download_bill'=>'Bills & challans','net_user'=>'User management','aibl_user'=>'User management','manage_branch'=>'Branch management','search_criteria'=>'Search requisitions','others_search_criteria'=>'Search other items','user_search_criteria'=>'My requisitions','manager_search_criteria'=>'Branch requisitions','chk_request'=>'New cheque requisition','others_request'=>'New item requisition','chk_approval_manager'=>'Cheque approvals','others_approval_manager'=>'Other item approvals','chk_ack'=>'Delivery acknowledgement','others_ack'=>'Other item acknowledgement','change_password'=>'Change password','total_request'=>'Cheque requisitions','others_total_request'=>'Other item requisitions','manage_chk_request'=>'Manage requisitions','manage_chk_request_admin'=>'Manage requisitions','manage_chk_request_vendor'=>'Manage requisitions');
    return isset($titles[$option]) ? $titles[$option] : ucwords(str_replace('_',' ', $option));
}
function ui_navigation($portal) {
    ob_start();
    if ($portal === 'vendor') include __DIR__.'/../net/net_left_menu.php';
    else include __DIR__.'/../aibl/body_content/left_menu.php';
    $legacy = ob_get_clean();
    $document = new DOMDocument();
    $previous = libxml_use_internal_errors(true);
    $document->loadHTML('<html><body>'.$legacy.'</body></html>');
    libxml_clear_errors(); libxml_use_internal_errors($previous);
    $seen = array(); $groups = array('Workspace'=>array(), 'Cheque status'=>array(), 'Other item status'=>array(), 'Administration'=>array());
    if ($portal==='vendor') $groups['Workspace'][] = array('index.php?option=manage_order','Manage orders','manage_order');
    if ($portal==='bank' && $_SESSION['user_type']==='user') {
        $groups['Workspace'][] = array('index.php?option=chk_request','New cheque requisition','chk_request');
        $groups['Workspace'][] = array('index.php?option=others_request','New item requisition','others_request');
    }
    foreach ($document->getElementsByTagName('a') as $anchor) {
        $href = $anchor->getAttribute('href');
        if (strpos($href,'index.php?option=') !== 0 || isset($seen[$href])) continue;
        $seen[$href] = true;
        parse_str(parse_url($href,PHP_URL_QUERY),$query);
        $option = isset($query['option']) ? $query['option'] : '';
        $group = in_array($option,array('net_user','aibl_user','manage_branch','change_password')) ? 'Administration' : ($option==='total_request' ? 'Cheque status' : ($option==='others_total_request'?'Other item status':'Workspace'));
        $label = trim(preg_replace('/\s+/',' ',str_replace("\xc2\xa0",' ',$anchor->textContent)));
        if (!in_array($group,array('Cheque status','Other item status'))) $label = ui_title($option);
        if (in_array($option,array('aibl_user','manage_branch')) && isset($query['task'])) $label = ucwords(str_replace('_',' ',$query['task']));
        $groups[$group][] = array($href,$label,$option);
    }
    echo '<a class="nav-link '.(empty($_REQUEST['option']) || $_REQUEST['option']==='aibl_start' ? 'active' : '').'" href="index.php?option=aibl_start">'.ui_icon('grid').'<span>Overview</span></a>';
    foreach ($groups as $heading=>$links) {
        if (!$links) continue;
        echo '<p class="nav-heading">'.ui_escape($heading).'</p>';
        foreach ($links as $link) {
            $current = isset($_REQUEST['option']) && $_REQUEST['option']===$link[2];
            if ($current && strpos($link[0],'task=')!==false) $current = isset($_REQUEST['task']) && strpos($link[0],'task='.urlencode($_REQUEST['task']))!==false;
            echo '<a class="nav-link '.($current?'active':'').'" '.($current?'aria-current="page"':'').' href="'.ui_escape($link[0]).'">'.ui_icon(strpos($link[2],'search')!==false?'search':'file').'<span>'.ui_escape($link[1]).'</span></a>';
        }
    }
}
function ui_header($portal) {
    $option = isset($_REQUEST['option']) ? $_REQUEST['option'] : 'aibl_start';
    $title = ui_title($option);
    $name = $portal==='vendor' ? $_SESSION['user_name'] : $_SESSION['branch_user_name'];
    $role = $portal==='vendor' ? $_SESSION['net_user_type'] : $_SESSION['user_type'];
    $logout = $portal==='vendor' ? 'net_signout.php' : 'signout.php';
    $prefix = $portal==='vendor' ? '../aibl/' : '';
    ?><!doctype html><html lang="en"><head><meta charset="windows-1252"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?php echo ui_escape($title); ?> | Requisition</title>
    <link rel="stylesheet" href="<?php echo $prefix; ?>style/style.css"><link rel="stylesheet" href="<?php echo $prefix; ?>body_content/calender/themes/fancyblue.css"><link rel="stylesheet" href="../ui/modern.css">
    <script src="<?php echo $prefix; ?>js/common.js"></script><script src="<?php echo $prefix; ?>body_content/calender/utils/zapatec.js"></script><script src="<?php echo $prefix; ?>body_content/calender/src/calendar.js"></script><script src="<?php echo $prefix; ?>body_content/calender/lang/calendar-en.js"></script><script src="../ui/modern.js" defer></script></head>
    <body class="modern-app"><a class="skip-link" href="#main-content">Skip to content</a><div class="sidebar-scrim" data-close-menu></div><aside class="sidebar" id="app-sidebar"><a class="brand" href="index.php?option=aibl_start"><span class="brand-mark">R</span><span>requisition<span class="brand-subtitle">AIBL / <?php echo $portal==='vendor'?'Operations':'Bank portal'; ?></span></span></a><nav aria-label="Main navigation"><?php ui_navigation($portal); ?></nav><div class="sidebar-footer"><span class="live-dot"></span> Requisition workspace <span class="version">2.0</span></div></aside>
    <div class="app-main"><header class="topbar"><button class="icon-button mobile-menu" type="button" aria-label="Open navigation" aria-controls="app-sidebar" aria-expanded="false" data-open-menu><?php echo ui_icon('menu'); ?></button><div class="breadcrumbs">Workspace <span>/</span> <strong><?php echo ui_escape($title); ?></strong></div><div class="account"><span class="avatar"><?php echo ui_escape(strtoupper(substr($name,0,1))); ?></span><span class="account-name"><?php echo ui_escape($name); ?><small><?php echo ui_escape(ucfirst($role)); ?></small></span><a class="icon-button" href="<?php echo $logout; ?>" aria-label="Sign out" title="Sign out"><?php echo ui_icon('logout'); ?></a></div></header>
    <main id="main-content" class="page"><div class="page-heading"><div><p class="eyebrow"><?php echo $portal==='vendor'?'OPERATIONS WORKSPACE':'BANK WORKSPACE'; ?></p><h1><?php echo ui_escape($title); ?></h1><p class="page-description"><?php echo $option==='aibl_start'?'A clear view of your requisitions, from request to delivery.':'Manage your workflow and keep every detail in one place.'; ?></p></div><span class="date-label"><?php echo date('D, d M Y'); ?></span></div><div class="legacy-content">
    <?php
}
function ui_footer() { echo '</div><footer class="page-footer"><span>AIBL Cheque Book Requisition Management</span><span>Requisition 2.0 &middot; Networld Bangladesh</span></footer></main></div></body></html>'; }
