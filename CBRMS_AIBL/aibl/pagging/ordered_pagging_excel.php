<?
//include_once ("../../config.php");

$limit =30;
function select_entries_ordered_excel($offset=0)
{
	$limit =30;

	$offset=$_REQUEST['offset'];	
		//echo "test--".$order;
	
	
	
	if (empty($offset)) { $offset = 0; }
	//$group_name=$_REQUEST['group_name'];
	$query = "select * from aibl_chq_rqst where rqst_status='ordered' order by approval_date_time desc limit $offset, $limit";
	
	//$result = mysql_query("select * from jos_project  order by date desc LIMIT $a,$c");

	//$query = "select *from tex_product  limit $offset, $limit";
	$result = mysql_query($query);

	return $result;

}

function nav_ordered_excel($offset=0,$this_script="")
{
	$limit =30;
	global $PHP_SELF;
	$offset=$_REQUEST['offset'];

	if (empty($this_script)) { $this_script = $PHP_SELF; }
	if (empty($offset)) 
	{ $offset = 0; 
	}


	//$order=$_REQUEST['order'];
	$result = mysql_query("select count(*) from aibl_chq_rqst where rqst_status='ordered'" );
	//$result = mysql_query("select count(*) from tex_product" );
	list($total_rows) = mysql_fetch_array($result);
	print "<p align=center>\n";
	echo "<font size=2> Total Requests: $total_rows &nbsp;</fort>"; 
	
	
	$j=1;
    if($offset-$limit>=0)
        {
                $pre=$offset-$limit;
                $paging.=" <a href='$this_script?option=total_request&task=total_request_ordered&offset=$pre&total=$total_rows'  style='text-decoration:underline'> << Previous </a> ";
        }
        else
         $paging.="  << Previous ";
        $paging.="Pages: ";
	for($i=0; $i<$total_rows; $i=$i+$limit)
        {
		
                if($i==$offset)
                        $m="<font color='#FF0000'><b>$j</b></font>";
                else
                        $m="<a href='$this_script?option=total_request&task=total_request_ordered&offset=$i'  style='text-decoration:underline'>$j</a>";


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
           $paging.=" <a href='$this_script?option=total_request&task=total_request_ordered&offset=$post&total=$total_rows'  style='text-decoration:underline'> Next>> </a> ";
        }
       else
	   {
       $paging.="  Next>>  ";
        }
	
	echo "<font size=2> $paging </font>";

}

?>
