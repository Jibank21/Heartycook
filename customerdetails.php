<?php
$connect = mysqli_connect("localhost", "root", "", "heartycook");
$output = '';
if(isset($_GET["cust_email_id"]))
{
	$search = mysqli_real_escape_string($connect, $_GET["cust_email_id"]);
	$query = "SELECT * FROM customer 
	WHERE cust_email LIKE '%".$search."%'
	OR cust_phone LIKE '%".$search."%' 
	
	";
}
else
{
	$query = "SELECT * FROM customer ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '';
	while($row = mysqli_fetch_array($result))
	{
		$cust_email= $row['cust_email'];

		$output .= '
			<tr style="width:100%;background:white; border:1px solid black;">
				<td style="border-bottom:solid 1px black;padding:10px;"><a href="searchfood.php?food_id='.$cust_email.'" style="text-decoration:none;font-weight:bold; color:black;padding:100px;">'.$row["cust_email"].'</a></td>
				
			</tr>
		';
	}
	//echo $output;
}
else
{
	echo 'Data Not Found';
}


?>
!<html>
  <head>
     <title>Home</title>
	 <!--bootstrap files-->
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	  <!--bootstrap files-->
	 
	 <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	 
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
	 
	 
	 
	 
<style>
#aboutus{
     background-image:url("img/main_spice2.jpg");
	 background-repeat: no-repeat;
	 background-attachment: fixed;
	  background-position: center;
  
}

ul li {list-style:none;}
ul li a{color:black; font-weight:bold;}
ul li a:hover{text-decoration:none;}


</style>
  </head>
  
    
	<body>
	

<div id="result" style="position:fixed;top:100; right:50;z-index: 3000;width:350px;background:white;"></div>

<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;"><b>Hearty Cook</b></span></a>
    <?php
	if(!empty($cust_id))
	{
	?>
	<a class="navbar-brand" style="color:white; text-decoratio:none;"><i class="far fa-user"><?php if(isset($cust_id)) { echo $qqr['cust_name']; }?></i></a>
	<?php
	}
	?>
	
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
	      
          
		  <li class="nav-item">
		     <a href="index.php" style="color:white;" class="nav-link">Home</a>
		  </li>
		  <li class="nav-item">
		     <a href="aboutus.php" style="color:white;" class="nav-link">About Us</a>
		  </li>
		  <li class="nav-item">
		     <a href="services.php" style="color:white;" class="nav-link">Services</a>
		  </li>
		  <li class="nav-item">
		     <a href="contact.php" style="color:white;" class="nav-link">Contact Us</a>
		  </li>
		  <?php
			if(empty($cust_id))
			{
			?>
			<li class="nav-item">
			  <a href="form/index.php?msg=you must be login first" class="nav-link"><span style="color:red;  font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:red;" id="cart"  class="badge badge-light">0</span></i></span></a>
		    </li>
			
			<li class="nav-item">
			<a  class="nav-link"><form method="post"><button class="btn btn-outline-danger my-2 my-sm-0" name="login" type="submit">Log In</button></form></a>
            </li>
			<?php
			}
			else
			{
			?>
			<li class="nav-item">
			<a href="customer/cart.php" class="nav-link"><form method="post"><span style=" color:green; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:green;" id="cart"  class="badge badge-light"><?php if(isset($re)) { echo $re; }?></span></i></span></form></a>
			</li>
			<li class="nav-item">
			<a class="nav-link"><form method="POST"><button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log Out</button></form></a>
			</li>
			<?php
			}
			?>
	  
		
        
      </ul>
	  
    </div>
	
</nav>
<br><br><br><br>

<!--menu ends-->
<div class="container" >
<img src="img/five-points-proposed-hotel-2012.jpg" alt="no Pic Available" height="400px" width="100%">
</div>
<div class="container-fluid" >
<br><br>

<div class="row">
   <div class="col-sm-1"></div>
   <div class="col-sm-10" >
   <?php
   if(isset($_GET["cust_email_id"])){
     $cust_email=$_GET["cust_email_id"];
		
		$sql= "SELECT * from customer where cust_email=$cust_email";
		$str= $connect->query($sql);
		if($str->num_rows>0){
			while($row2=$str->fetch_assoc()){
		?>
	<h3 style="color:#01C699;text-transform:uppercase;"><?php echo $row2['cust_name']; ?></h3><br><br>

   <span style="color:#A5A5A5;font-size:25px;text-transform:uppercase;"><i class="fas fa-home"></i></span>&nbsp;&nbsp;<span style="font-family: 'Tangerine', serif; font-weight:bold;font-size:25px; color:#ED2553;"><?php echo $row2['cust_email'];?></span><br><br>

   <span style="color:#A5A5A5;font-size:25px;"><i class="fas fa-phone"></i></span>&nbsp;&nbsp;<span style=" font-size:25px; color:#ED2553;"><?php echo $row2['cust_phone']?></span><br><br>

   <span style="color:#A5A5A5;font-size:25px;"><i class="fa fa-address" aria-hidden="true"></i></span>&nbsp;&nbsp;<span style=" font-size:25px; color:#ED2553;"><?php echo $row2['address']?></span><br><br> 
   <?php
	}
		
}
}
?>
  
   </div>
   
   <div class="col-sm-1"></div>
</div>
</div>

<!--footer primary-->
	     <?php
		 include("footer.php");
		 ?>
</body>

</html>