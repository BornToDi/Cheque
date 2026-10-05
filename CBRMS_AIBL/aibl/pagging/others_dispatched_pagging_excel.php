<?
//include_once ("../../config.php");

$limit =30;
function select_entries_dispatched_excel($offset=0)
{
	global $limit;

	$offset=$_REQUEST['offset'];	
		//echo "test--".$order;
	
	
	
	if (empty($offset)) { $offset = 0; }
	//$group_name=$_REQUEST['group_name'];
	$query = "select * from aibl_others_rqst where others_rqst_status='dispatched'  order by  others_order_date_time desc limit $offset, $limit";
	
	//$result = mysql_query("select * from jos_project  order by date desc LIMIT $a,$c");

	//$query = "select *from tex_product  limit $offset, $limit";
	$result = mysql_query($query);

	return $result;

}

function nav_dispatched_excel($offset=0,$this_script="")
{
	$limit =30;
	global $PHP_SELF;
	$offset=$_REQUEST['offset'];

	if (empty($this_script)) { $this_script = $PHP_SELF; }
	if (empty($offset)) 
	{ $offset = 0; 
	}


	//$order=$_REQUEST['order'];
	$result = mysql_query("select count(*) from aibl_others_rqst where others_rqst_status='dispatched'" );
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
                $paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_dispatched&offset=0&total=$total_rows'  style='text-decoration:underline'> << Start </a> ";
				$paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_dispatched&offset=$page&total=$total_rows'  style='text-decoration:underline' class='pagenav'> < Previous </a> ";
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
                        $m="<a href='$this_script?option=others_total_request&task=others_total_request_dispatched&offset=$page'  style='text-decoration:underline'>$i</a>";


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
           $paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_dispatched&offset=$page&total=$total_rows'  style='text-decoration:underline'> Next> </a> ";
           $paging.=" <a href='$this_script?option=others_total_request&task=others_total_request_dispatched&offset=$end_page&total=$total_rows'  style='text-decoration:underline'> Last>> </a> ";	
		}
       else
	   {
       $paging.="  Next>  ";
	   $paging.="  Last>>  ";
        }
	
	echo "<span class='pagenav'><font size=2> $paging </font></span>";
}
?>
