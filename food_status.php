<?php
session_start();
$_SESSION ['id']=$_POST['username'];
$_SESSION['pwd']= $_POST['pswd'];
include("connection.php");
extract($_REQUEST);
if(isset($_SESSION['id']))
{
 $id=$_SESSION['id'];
 $vq=mysqli_query($con,"SELECT * from delivery_person where email='$id'");
 $vr=mysqli_fetch_array($vq);
 $vrid=$vr['id'];
}

if(!isset($_SESSION['id']))
{
	header("location:delivery_login.php?msg=Please Login To continue");
}
else
{
$query=mysqli_query($con,"SELECT * from delivery_person   where email='$id'");
if(mysqli_num_rows($query))
{   if(!file_exists("../image/deliver/".$id."/foodimages"))
	{
		$dir=mkdir("../image/delivery/".$id."/foodimages");
	}
	$row=mysqli_fetch_array($query);
    $v_id=$row['id'];
}
else
{
	
	header("location:delivery_login.php");
	
	
}
}

if(isset($logout))
{
	session_destroy();
	header("location:index.php");
}
if(isset($upd_account))
				{
					
					//echo $fn;
					//echo $emm;
					//echo $add;
					if(mysqlI_query($con,"UPDATE delivery_person set name='$fn',email='$emm',address='$add',mob='$mob',password='$pwsd' where email='$id'"))
				   {
						 header("location:infoUpdate.php");
					}
			  }
			  if(isset($upd_logo))
			  {
				  if(isset($_SESSION['id']))
				  {
				  $log_img=mysqli_query($con,"SELECT * from delivery_person where email='$id'");
                  $log_img_row=mysqli_fetch_array($log_img);
				  $old_logo=$log_img_row['pro_image'];
				  $new_img_name=$_FILES['logo_pic']['name'];
				  
				  if(mysqli_query($con,"UPDATE delivery_person set image='$new_img_name' where email='$id'"))
				  {
					  unlink("image/delivery/$id/$old_logo");
					  move_uploaded_file($_FILES['logo_pic']['tmp_name'],"image/deliver/$id/".$_FILES['logo_pic']['name']);
				      
					  header("location:update_food.php");
					  
				  }
			  }
			  else
			  {
				  header("location:delivery_login.php?msg=Please Login To continue");
			  }
			  }
			  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hearty cook</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="css/font.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	 <style>
		ul li {list-style: none;}
		ul li a {color:white;padding:40px; }
		ul li a:hover {color:white;}
	 </style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;"><b>Hearty Cook</b></span></a>
    <?php
	if(!empty($id))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoration:none;"><i class="far fa-user"><?php if(isset($id)) { echo $vr['name']; }?></i></a>
	<?php
	}
	?>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
		<li class="nav-item">
		  <form method="post">
          <?php
			if(empty($_SESSION['id']))
			{
			?>
		   <button class="btn btn-outline-danger my-2 my-sm-0" name="login">Log In</button>&nbsp;&nbsp;&nbsp;
            <?php
			}
			else
			{
			?>
			
			<button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log Out</button>&nbsp;&nbsp;&nbsp;
			<?php
			}
			?>
			</form>
        </li>
		
		
      </ul>
	  
    </div>
	
</nav>

<!--navbar ends-->


<br><br>
<div class="middle" style=" padding:40px; border:1px solid #ED2553;  width:100%;">
       <!--tab heading-->
	   <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
                    
		  <li class="nav-item active">
              <a class="nav-link " id="accountsettings-tab" data-toggle="tab" href="#accountsettings" role="tab" aria-controls="accountsettings" aria-selected="false">Account Settings</a>
          </li>
		  
		  <li class="nav-item">
              <a class="nav-link" id="logo-tab" data-toggle="tab" href="#logo" role="tab" aria-controls="logo" aria-selected="false">Update Image</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Order Details</a>
          </li>
		  
       </ul>
	   <br><br>
	   <span style="color:green;"><?php if(isset($msgs)) { echo $msgs; }?></span>
		   
			
			
			<!--tab 2 starts-->		
			
			 <!--tab 3-- starts-->
			 <div class="tab-pane fade" id="accountsettings" role="tabpanel" aria-labelledby="accountsettings-tab">
			    <form method="POST" enctype="multipart/form-data">
				<?php
			    $upd_info=mysqli_query($con,"SELECT * from delivery_person where email='$id'");
				$upd_info_row=mysqlI_fetch_array($upd_info);
				 $nm=$upd_info_row['name'];
				 $emm=$upd_info_row['email'];
				 $psd=$upd_info_row['password'];				 
				$ad=$upd_info_row['address'];
				$mb=$upd_info_row['phone'];
				$log=$upd_info_row['image'];
				
				?>
				
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="username" value="<?php if(isset($nm)){ echo $nm;}?>" class="form-control" name="fn" />
                    </div>
					<div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" id="email" value="<?php if(isset($emm)){ echo $emm;}?>" class="form-control" name="emm" readonly="readonly"/>
                    </div>
					<div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" id="address" value="<?php if(isset($ad)){ echo $ad;}?>" class="form-control" name="add" required/>
                    </div>
					<div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="text" id="mobile" value="<?php if(isset($mb)){ echo $mb;}?>" class="form-control" name="mob" required/>
                    </div>
					
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="pwsd" class="form-control" value="<?php if(isset($psd)){ echo $psd;}?>" id="pwd" required/>
                   </div>
				   
				   
 
                  <button type="submit" name="upd_account" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Update</button>
                  
			 </form>
			</div>
			<div class="tab-pane fade" id="logo" role="tabpanel" aria-labelledby="logo-tab">
                <div class="container">
				    <form class="form" method="POST" enctype="multipart/form-data">
				       <input type="file" name="logo_pic" accept="image/*" required/>
					   <button type="submit" name="upd_logo" class="btn btn-outline-primary">Update profile picture</button>
			        </form>
				</div>
			</div>
			 <div class="tab-pane fade " id="status" role="tabpanel" aria-labelledby="status-tab">
	            <table class="table">
				<tbody>
				<th>Order Id</th>
				<th>Customer Email</th>
				<th>Food Id</th>
				<th>Order Status</th>
				<th>Update Status</th>
				<?php
				
				$orderquery=mysqli_query($con,"SELECT * from orders order by cook_id='$vrid'");
				if(mysqli_num_rows($orderquery))
				{
					while($orderrow=mysqli_fetch_array($orderquery))
					{
						$stat=$orderrow['fldstatus'];
						?>
						<tr>
						<td><?php echo $orderrow['order_id']; ?></td>
						<td><?php echo $orderrow['cust_email_id']; ?></td>
						<td><?php echo $orderrow['food_id']; ?></td>
						<?php
			   if($stat=="cancelled" || $stat=="Out Of Stock")
			   {
			   ?>
			   <td><i style="color:orange;" class="fas fa-exclamation-triangle"></i>&nbsp;<span style="color:red;"><?php echo $orderrow['fldstatus']; ?></span></td>
			   <?php
			   }
			   else
				   
			   {
			   ?>
			   <td><span style="color:green;"><?php echo $orderrow['fldstatus']; ?></span></td>
			   <?php
			   }
			   ?>
						<form method="POST">
						<td><a href="changestatus.php?order_id=<?php echo $orderrow['order_id']; ?>"><button type="button" name="changestatus">Update Status</button></a></td>
						</form>
						<tr>
						<?php
					}
				}
				?>
				</tbody>
				</table>
			 </div>
	  </div>
	</div>  
	
</body>
</html>