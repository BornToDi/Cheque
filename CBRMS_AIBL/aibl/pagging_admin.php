<?
$limit =11;
function select_entries_admin ($offset=0)
{
	global $limit;

	$order=$_REQUEST['order'];
	$offset=$_REQUEST['offset'];	
		//echo "test--".$order;
	
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
				$s_asc="images/s_asc.png";			
			}
			else
			{
				$$fieldlist[$i] = $fieldlist[$i]."_down";
				$s_desc="images/s_desc.png";
			}
		}
?>

	<TR>
                            <TD class=hf align=left>
								<B>Account Number</B>
							</TD>
							<TD class=hf align=left>
								<B>User Id</B>
							</TD>
							 <TD class=hf align=left>
								<A href="index.php?option=manage_chk_request_admin&order=<? echo $collecting_branch; ?>"><B>Requester Branch </B>
								
								</A>							
								
								</TD>
							 	
							 <TD class=hf align=lef>
								<A href="index.php?option=manage_chk_request_admin&order=<? echo $ac_type; ?>"><B>Account Type </B></A>
							</TD>
							<TD class=hf align=lef>
								<A href="index.php?option=manage_chk_request_admin&order=<? echo $severity; ?>"><B>Delivery Type </B></A>
							</TD>
							<TD class=hf align=lef>
								<A href="index.php?option=manage_chk_request_admin&order=<? echo $rqst_status; ?>"><B>Status </B></A>
							</TD>
							<TD class=hf align=lef>
								<A href="index.php?option=manage_chk_request_admin&order=<? echo $order_date_time; ?>&offset=<? echo $offset ?>"><B>Order Date and Time</B>
								<? if ($order_date_time=="order_date_time_up") {?> <img src="<? echo $s_asc ?>" border="0" align="absmiddle" /><? 
								}
								if ($order_date_time=="order_date_time_down")
									{
								?>
									 <img src="<? echo $s_desc ?>" border="0" align="absmiddle" />
									 <?
									 }
								?>
								</A>
							</TD>							
						  </TR>
<?
	str($order);

	$order1=" order by $order";
	
	if (empty($offset)) { $offset = 0; }
	//$group_name=$_REQUEST['group_name'];
	$query = "select * from aibl_chq_rqst".$order1." limit $offset, $limit";
	
	//$result = mysql_query("select * from jos_project  order by date desc LIMIT $a,$c");

	//$query = "select *from tex_product  limit $offset, $limit";
	$result = mysql_query($query);

	return $result;

}

function nav_admin ($offset=0,$this_script="")
{
	global $limit;
	global $PHP_SELF;
	$offset=$_REQUEST['offset'];

	if (empty($this_script)) { $this_script = $PHP_SELF; }
	if (empty($offset)) 
	{ $offset = 0; 
	}


	//$order=$_REQUEST['order'];
	$result = mysql_query("select count(*) from aibl_chq_rqst" );
	//$result = mysql_query("select count(*) from tex_product" );
	list($total_rows) = mysql_fetch_array($result);
	print "<p align=center>\n";
	echo "<font size=2> Total Requests: $total_rows &nbsp;</fort>"; 
	
	
	$j=1;
    if($offset-$limit>=0)
        {
                $pre=$offset-$limit;
                $paging.=" <a href='$this_script?option=manage_chk_request_admin&offset=$pre&total=$total_rows&order=order_date_time'  style='text-decoration:underline'> << Previous </a> ";
        }
        else
         $paging.="  << Previous ";
        $paging.="Pages: ";
	for($i=0; $i<$total_rows; $i=$i+$limit)
        {
		
                if($i==$offset)
                        $m="<font color='#FF0000'><b>$j</b></font>";
                else
                        $m="<a href='$this_script?option=manage_chk_request_admin&offset=$i&order=order_date_time'  style='text-decoration:underline'>$j</a>";


                if($i==0)
				{
                        $paging.="$m";
						
						}
                else
				{
                        $paging.=" | $m";
						
						}
                $j++;
			}	
			
		if($offset+$limit<$total_rows)
        {
          $post=$offset+$limit;
           $paging.=" <a href='$this_script?option=manage_chk_request_admin&offset=$post&total=$total_rows&order=order_date_time'  style='text-decoration:underline'> Next>> </a> ";
        }
       else
	   {
       $paging.="  Next>>  ";
        }
	
	echo "<font size=2> $paging </font>";
}

?>
