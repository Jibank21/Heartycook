<?php
$connect = mysqli_connect("localhost", "root", "", "heartycook");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "SELECT * FROM cook 
	WHERE cust_name LIKE '%".$search."%'
	OR fld_address LIKE '%".$search."%' 
	OR cook_id LIKE '%".$search."%'	
	";
}
else
{
	$query = "SELECT * FROM cook ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '';
	while($row = mysqli_fetch_array($result))
	{
		$cook_id= $row['cook_id'];
		$output .= '
			<tr style="width:300px;background:white; border:1px solid black;">
				<td style="border-bottom:solid 1px black;padding:20px;"><a href="search.php?cook_id='.$cook_id.'" style="text-decoration:none;font-weight:bold; color:black;padding:100px;">'.$row["cust_name"].'</a></td>
				
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>