<?php
$connect = mysqli_connect("localhost", "root", "", "heartycook");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM food 
	WHERE foodname LIKE '%".$search."%'
	OR Cuisines LIKE '%".$search."%' 
	
	";
}
else
{
	$query = "
	SELECT * FROM food ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '';
	while($row = mysqli_fetch_array($result))
	{
		$food_id= $row['food_id'];
		$output .= '
			<tr style="width:100%;background:white; border:1px solid black;">
				<td style="border-bottom:solid 1px black;padding:10px;"><a href="searchfood.php?food_id='.$food_id.'" style="text-decoration:none;font-weight:bold; color:black;padding:100px;">'.$row["foodname"].'</a></td>
				
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