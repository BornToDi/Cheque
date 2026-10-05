<?
//include_once ("../../config.php");

$limit =30;
/*
$query_hvbbn ="select HVBBN from HVPF where HVBRNM='".$_SESSION['branch_name']."'";			
$sql_result = mssql_query($query_hvbbn) or
die('Server Connection Error!');
$get_hvbbn = mssql_fetch_array($sql_result);
*/
function select_others_entries_excel($offset=0)
{
	global $limit;

	$offset=$_REQUEST['offset'];	
		//echo "test--".$order;
	
	
	
	if (empty($offset)) { $offset = 0; }
	//$group_name=$_REQUEST['group_name'];
if(($_SESSION['user_type']=='gsd')||($_SESSION['net_user_type']=='vendor')){
	$limit =30;
		$query = "select * from aibl_others_rqst  order by  others_approval_date_time desc limit $offset, $limit";
}
	
/*
if($_SESSION['user_type']=='user'){
	$limit =30;
	$order=$_REQUEST['order'];
	
  function str($order){	
		$fieldlist = array();
		$fieldlist[0] = "collecting_branch";
		$fieldlist[1] = "severity"; 
		$fieldlist[2] = "ac_type"; 
		$fieldlist[3] = "rqst_status"; 
		$fieldlist[4] = "order_date_time";
			
		for($i=0;$i<count($fieldlist);$i++)
		{
			if($order == $fieldlist[$i])
			{
			$order = $fieldlist[$i]." desc";						
			}	
			if($order == $fieldlist[$i]."_up")
			{
			$order = $fieldlist[$i]."";						
			}
			else if($order == $fieldlist[$i]."_down")
			{
			$order = $fieldlist[$i]." desc";						
			}					
		}
			return $order;	
	}
		 $order=str($order);
						
		$fieldlist = array();
		$fieldlist[0] = "collecting_branch";
		$fieldlist[1] = "severity"; 
		$fieldlist[2] = "ac_type"; 
		$fieldlist[3] = "rqst_status"; 
		$fieldlist[4] = "order_date_time";
		
		for($i=0;$i<count($fieldlist);$i++)
		{
			if($order == $fieldlist[$i]." desc")
			{
				$$fieldlist[$i] = $fieldlist[$i]."_up";	
						
			}
			else
			{
				$$fieldlist[$i] = $fieldlist[$i]."_down";
				
			}
		}
		
		?>
					  
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=hf align=left>
								<B>Account Number</B>
							</TD>
							 <TD class=hf align=left>
								<A href="index.php?option=manage_others_request&order=<? echo $collecting_branch; ?>"><B>Branch </B>
								
								</A>							
								
								</TD>
							 	
							 <TD class=hf align=left>
								<A href="index.php?option=manage_others_request&order=<? echo $ac_type; ?>"><B>Account Type </B></A>
							</TD>
							<TD class=hf align=left>
								<B>Books </B>
							</TD>
							<TD class=hf align=left>
								<A href="index.php?option=manage_others_request&order=<? echo $severity; ?>"><B>Delivery Type </B></A>
							</TD>
							<TD class=hf align=left>
								<A href="index.php?option=manage_others_request&order=<? echo $rqst_status; ?>"><B>Status of request </B></A>
							</TD>
							<TD class=hf align=left>
								<A href="index.php?option=manage_others_request&order=<? echo $order_date_time; ?>"><B>Order Date and Time</B></A>
							</TD>
							<TD class=hf align=center>
								<B>Action</B>
							</TD>
						  </TR>
						  <?
						//$order=$_REQUEST['order'];
													
				str($order);
				
				//echo "testkkkk".$order;
				$order1=" order by $order";
	
		//$query = "select * from aibl_chq_rqst where rqst_by='".$_SESSION['user_id']."' ".$order1." limit $offset, $limit";
		
		$query = "select * from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' ".$order1." limit $offset, $limit";
		
	
	}
	*/
	if(($_SESSION['user_type']=='manager')||($_SESSION['user_type']=='user')){
	$limit =30;
											  	
			$query = "select * from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' order by  others_approval_date_time desc limit $offset, $limit";
		
	}
	
	$result = mysql_query($query);

	return $result;

}

function nav_others_excel($offset=0,$this_script="")
{
	$limit =30;
	global $PHP_SELF;
	$offset=$_REQUEST['offset'];

	if (empty($this_script)) { $this_script = $PHP_SELF; }
	if (empty($offset)) 
	{ $offset = 0; 
	}


	//$order=$_REQUEST['order'];
	if(($_SESSION['user_type']=='gsd')||($_SESSION['net_user_type']=='vendor'))
	{
		
	$result = mysql_query("select count(*) from aibl_others_rqst" );			
	//$result = mysql_query("select count(*) from tex_product" );
	list($total_rows) = mysql_fetch_array($result);
	print "<p align=center>\n";
	echo "<font size=2> Total Requests: $total_rows &nbsp;</fort>"; 
	
	$displayed_pages = 10;
	$total_pages = $limit ? ceil( $total_rows / $limit ) : 0;
	$this_page = $limit ? ceil( ($offset+1) / $limit ) : 1;
		
	$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
	if ($start_loop + $displayed_pages - 1 < $total_pages) {
		$stop_loop = $start_loop + $displayed_pages - 1;
	} else {
		$stop_loop = $total_pages;
	}
	

    //if($offset-$limit>=0)
	if ($this_page > 1)
        {
                $pre=$offset-$limit;
				$page = ($this_page - 2) * $limit;
                $paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_admin&offset=0&total=$total_rows'  style='text-decoration:underline'> << Start </a> ";
				$paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_admin&offset=$page&total=$total_rows'  style='text-decoration:underline' class='pagenav'> < Previous </a> ";
        }
        else
         $paging.='<span class="pagenav">  << Start </span>';
		 $paging.='<span class="pagenav">  < Previous </span>';
        $paging.="Pages: ";
		
		
		
	for ($i=$start_loop; $i <= $stop_loop; $i++) 
		
	//for($i=0; $i<$total_rows; $i=$i+$limit)
        {
				$page = ($i - 1) * $limit;
                if($i==$this_page)
                        $m="<font color='#FF0000'><b>$i</b></font>";
                else
                        $m="<a href='$this_script?option=others_total_request&task=others_total_request_admin&offset=$page'  style='text-decoration:underline'>$i</a>";


                if($i==0)
				{
                        $paging.="$m";
						
						}
                else
				{
                        $paging.=" | $m";
						
						}
                //$j++;
			}	
			
		if ($this_page < $total_pages) 
        {
          $page = $this_page * $limit;
		  $end_page = ($total_pages-1) * $limit;
		  //$page = $this_page * $this->limit;
           $paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_admin&offset=$page&total=$total_rows'  style='text-decoration:underline'> Next> </a> ";
           $paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_admin&offset=$end_page&total=$total_rows'  style='text-decoration:underline'> Last>> </a> ";	
		}
       else
	   {
       $paging.="  Next>  ";
	   $paging.="  Last>>  ";
        }
	
	echo "<span class='pagenav'><font size=2> $paging </font></span>";


 }


// End Admin nav
//Start User nav
/*if($_SESSION['user_type']=='user'){
	//$result = mysql_query("select count(*) from aibl_chq_rqst where rqst_by='".$_SESSION['user_id']."'");
	$result = mysql_query("select count(*) from aibl_chq_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."'");
		
	list($total_rows) = mysql_fetch_array($result);
	print "<p align=center>\n";
	echo "<font size=2> Total Requests: $total_rows &nbsp;</fort>"; 
	
	
$displayed_pages = 10;
	$total_pages = $limit ? ceil( $total_rows / $limit ) : 0;
	$this_page = $limit ? ceil( ($offset+1) / $limit ) : 1;
		
	$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
	if ($start_loop + $displayed_pages - 1 < $total_pages) {
		$stop_loop = $start_loop + $displayed_pages - 1;
	} else {
		$stop_loop = $total_pages;
	}
	

    //if($offset-$limit>=0)
	if ($this_page > 1)
        {
                $pre=$offset-$limit;
				$page = ($this_page - 2) * $limit;
                $paging.=" <a href='$this_script?option=manage_others_request&offset=0&total=$total_rows'  style='text-decoration:underline'> << Start </a> ";
				$paging.=" <a href='$this_script?option=manage_others_request&offset=$page&total=$total_rows'  style='text-decoration:underline' class='pagenav'> < Previous </a> ";
        }
        else
         $paging.='<span class="pagenav">  << Start </span>';
		 $paging.='<span class="pagenav">  < Previous </span>';
        $paging.="Pages: ";
		
		
		
	for ($i=$start_loop; $i <= $stop_loop; $i++) 
		
	//for($i=0; $i<$total_rows; $i=$i+$limit)
        {
				$page = ($i - 1) * $limit;
                if($i==$this_page)
                        $m="<font color='#FF0000'><b>$i</b></font>";
                else
                        $m="<a href='$this_script?option=option=manage_others_request&offset=$page'  style='text-decoration:underline'>$i</a>";


                if($i==0)
				{
                        $paging.="$m";
						
						}
                else
				{
                        $paging.=" | $m";
						
						}
                //$j++;
			}	
			
		if ($this_page < $total_pages) 
        {
          $page = $this_page * $limit;
		  $end_page = ($total_pages-1) * $limit;
		  //$page = $this_page * $this->limit;
           $paging.=" <a href='$this_script?option=manage_others_request&offset=$page&total=$total_rows'  style='text-decoration:underline'> Next> </a> ";
           $paging.=" <a href='$this_script?option=manage_others_request&offset=$end_page&total=$total_rows'  style='text-decoration:underline'> Last>> </a> ";	
		}
       else
	   {
       $paging.="  Next>  ";
	   $paging.="  Last>>  ";
        }
	
	echo "<span class='pagenav'><font size=2> $paging </font></span>";
	
	}*/
//End User nav




// Start Manager nav	
	if(($_SESSION['user_type']=='manager')||($_SESSION['user_type']=='user'))
	{
		
		$result = mysql_query("select count(*) from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."'");
		
	
	list($total_rows) = mysql_fetch_array($result);
	print "<p align=center>\n";
	echo "<font size=2> Total Requests: $total_rows &nbsp;</fort>"; 
	
	
$displayed_pages = 10;
	$total_pages = $limit ? ceil( $total_rows / $limit ) : 0;
	$this_page = $limit ? ceil( ($offset+1) / $limit ) : 1;
		
	$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
	if ($start_loop + $displayed_pages - 1 < $total_pages) {
		$stop_loop = $start_loop + $displayed_pages - 1;
	} else {
		$stop_loop = $total_pages;
	}
	

    //if($offset-$limit>=0)
	if ($this_page > 1)
        {
                $pre=$offset-$limit;
				$page = ($this_page - 2) * $limit;
                $paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_manager&offset=0&total=$total_rows'  style='text-decoration:underline'> << Start </a> ";
				$paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_manager&offset=$page&total=$total_rows'  style='text-decoration:underline' class='pagenav'> < Previous </a> ";
        }
        else
         $paging.='<span class="pagenav">  << Start </span>';
		 $paging.='<span class="pagenav">  < Previous </span>';
        $paging.="Pages: ";
		
		
		
	for ($i=$start_loop; $i <= $stop_loop; $i++) 
		
	//for($i=0; $i<$total_rows; $i=$i+$limit)
        {
				$page = ($i - 1) * $limit;
                if($i==$this_page)
                        $m="<font color='#FF0000'><b>$i</b></font>";
                else
                        $m="<a href='$this_script?option=others_total_request&task=others_total_request_manager&offset=$page'  style='text-decoration:underline'>$i</a>";


                if($i==0)
				{
                        $paging.="$m";
						
						}
                else
				{
                        $paging.=" | $m";
						
						}
                //$j++;
			}	
			
		if ($this_page < $total_pages) 
        {
          $page = $this_page * $limit;
		  $end_page = ($total_pages-1) * $limit;
		  //$page = $this_page * $this->limit;
           $paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_manager&offset=$page&total=$total_rows'  style='text-decoration:underline'> Next> </a> ";
           $paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_manager&offset=$end_page&total=$total_rows'  style='text-decoration:underline'> Last>> </a> ";	
		}
       else
	   {
       $paging.="  Next>  ";
	   $paging.="  Last>>  ";
        }
	
	echo "<span class='pagenav'><font size=2> $paging </font></span>";


 }
}
//End Manager nav 

?>
