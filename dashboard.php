
<?php
session_start();
include("connection.php");
extract($_REQUEST);
if(!isset($_SESSION['admin']))
{
	header("location:admin.php");
	
}
else
{
	$admin_username=$_SESSION['admin'];
}
if(isset($logout))
{
	unset ($_SESSION['admin']);
	setcookie('logout','loggedout successfully',time() +5);
	header("location:admin.php");
}
if(isset($delete))
{
	header("location:deletefood.php?id=$delete");
}
if(isset($deletecook))
{
	header("location:deletecook.php?cookid=$deletecook");
}
$admin_info=mysqli_query($con,"SELECT * from admin where admin_username='$admin_username'");
$row_admin=mysqli_fetch_array($admin_info);
$user= $row_admin['admin_username'];
$pass= $row_admin['fld_password'];

//update
if(isset($update))
{
if(mysqli_query($con,"UPDATE admin set fld_password='$password'"))
{
	//$_SESSION['pas_update_success']="Password Updated Successfully Login with New Password";
    unset ($_SESSION['admin']);
	header("location:admin_info_update.php");
}
else
{
	echo "failed";
}

}

if(isset($_GET['type']) && ($_GET['type']!=='')&& isset($_GET['id']) && ($_GET['id']>0)){
	$type=($_GET['type']);
	$id=($_GET['id']);
	if($type=='delete'){
		mysqli_query($con, "DELETE from delivery_person where id=$id");
		header('dashboard.php');
	}

}
?>
<html>
  <head>
     <title>Admin control panel</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">   
		 <style>
		ul li{list-style:none;}
		ul li a {color:black;}
		ul li a:hover {color:black; font-weight:bold;}
		ul li {list-style:none;}

ul li a:hover{text-decoration:none;}
#social-fb,#social-tw,#social-gp,#social-em{color:blue;}
#social-fb:hover{color:#4267B2;}
#social-tw:hover{color:#1DA1F2;}
#social-gp:hover{color:#D0463B;}
#social-em:hover{color:#D0463B;}
	 </style>
	 <script>			
			function delRecord(id)
			{
				//alert(id);
				
				var x=confirm("You want to delete this record? All Food Items Of that cook Will Also Be Deleted");
				if(x== true)
				{
					
					//document.getElementById("#result").innerHTML="success";
				  window.location.href='delete_cook.php?cookid=' +id;		
				}
				else
				{
					window.location.href='#';
				}
				
			}
		</script>
  
  </head>
  
    
	<body>

	
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;"><b>Hearty Cook</b></span></a>
    <?php
	if(!empty($admin_username))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoration:none;"><i class="far fa-user">Admin</i></a>
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
		<?php
		if(isset($_SESSION['admin']))
		{
			?>
			<li class="nav-item">
            <a class="nav-link" href="">
		      <form method="post">
			    <button type="submit" name="logout" class="btn btn-outline-success">Log Out</button>
			  </form>
		    </a>
            </li>
			<?php
		}
		
		?>
		
      </ul>
	  
    </div>
	
</nav>
<!--navbar ends-->
<br><br><br><br>
<!--details section-->
 
<div class="container">
       <!--tab heading-->
	   <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" style="color:#BDDEFD;" id="viewitem-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="viewitem" aria-selected="true">View Food Items</a>
          </li>
          <li class="nav-item">
              <a class="nav-link"  style="color:#BDDEFD;" id="manageaccount-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="manageaccount" aria-selected="false">Account Settings</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" style="color:#BDDEFD;"  id="Managecooks-tab" data-toggle="tab" href="#Managecooks" role="tab" aria-controls="Managecooks" aria-selected="false">Manage cooks</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" style="color:#BDDEFD;"  id="Managedriver-tab" data-toggle="tab" href="#Managedriver" role="tab" aria-controls="Managedriver" aria-selected="false">Manage Driver</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" style="color:#BDDEFD;" id="orderstatus-tab" data-toggle="tab" href="#orderstatus" role="tab" aria-controls="orderstatus" aria-selected="false">Order status</a>
          </li>
		  
		  
		  
		  
       </ul>
	   <br><br>
	<!--tab 1 starts-->   
	   <div class="tab-content" id="myTabContent">
	   
            <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="viewitem-tab">
                <div class="container">
	               <table class="table">
					<thead>
						<tr>
							<th scope="col">Cook Id</th>
								<th scope="col">Food View</th>
								<th scope="col">Food Cuisines</th>
								<th scope="col">Cook Name</th>
								<th scope="col">Food Id</th>
								
								<th scope="col">Remove cook</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query=mysqli_query($con,"SELECT cook.cook_id,cook.cust_name,cook.cust_email,food.food_id,food.foodname,food.cuisines,food.fldimage from  cook right join food on cook.cook_id=food.cook_id");
							while($row=mysqli_fetch_array($query))
							{
						
						?>			 
					
						<tr>
							<th scope="row"><?php echo $row['cook_id'];?></th>
							<td><img src="image/cook/<?php echo $row['cust_email']."/foodimages/" .$row['fldimage'];?>" height="50px" width="100px">
							<br><?php echo $row['foodname'];?>
							</td>
							<td><?php echo $row['cuisines'];?></td>
							<td><?php echo $row['cust_name'];?></td>
							<td><?php echo $row['food_id'];?></td>
						
							
							
							
							<form method="post">
							<td><a href=""><button type="submit" value="<?php echo $row['food_id']; ?>" name="delete"  class="btn btn-danger">Remove </button></td>
							</form>
					</tr>
						<?php
						}
						?>		   
					</tbody>
           		  </table>
	 
	 			</div>   	
		  
				<span style="color:green; text-align:centre;"><?php if(isset($success)) { echo $success; }?></span>				
      	    </div>	 
	  
<!--tab 1 ends-->	   
			
			
			<!--tab 2 starts-->
            <div class="tab-pane fade" id="manageaccount" role="tabpanel" aria-labelledby="manageaccount-tab">
			    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="username" value="<?php if(isset($user)){ echo $user;}?>" class="form-control" name="name" readonly="readonly"/>
                    </div>
					
					
					
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="password" class="form-control" value="<?php if(isset($pass)){ echo $pass;}?>" id="pwd" required/>
                   </div>
				   
				   
 
                  <button type="submit" name="update" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Update</button>
                  <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
			 	</form>
			</div>
			<!--tab 2 ends-->
			<!-- tab 3 start -->
			 
			<div class="tab-pane fade show" id="Managecooks" role="tabpanel" aria-labelledby="Managecooks-tab">
			    <div class="container">
	               <table class="table">
					<thead>
						<tr>
							<th scope="col"></th>
								<th scope="col">Cook Id</th>
								<th scope="col">Name</th>                         
								<th scope="col">Address</th>
								<th scope="col">Remove cook</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query=mysqli_query($con,"SELECT  * from cook");
							while($row=mysqli_fetch_array($query))
							{
						
						?>			 
					
						<tr>
							
							<td><img src="image/cook/<?php echo $row['cust_email']."/" .$row['pro_image'];?>" height="50px" width="100px"></td>
							<th scope="row"><?php echo $row['cook_id'];?></th>
							<td><?php echo $row['cust_name'];?></td>
							<td><?php echo $row['fld_address'];?></td>
							
							<form method="post">
							<td><a href="#"  style="text-decoration:none; color:white;" onclick="delRecord(<?php echo $row['cook_id']; ?>)"><button type="button" class="btn btn-danger">Remove cook</a></a></td>
							</form>
						</tr>
							<?php
							}
							?>		   
					</tbody>
           		  </table>
	 
	 			</div>   	
			</div>
			<!-- tab 3 ends -->
			<!-- tab 4 starts -->
			<div class="tab-pane fade show" id="Managedriver" role="tabpanel" aria-labelledby="Managedriver-tab">
			    <div class="container">
	               <table class="table">
					<thead>
						<tr>
							<th scope="col"></th>
								<th scope="col">Driver Id</th>
								<th scope="col">Name</th>                         
								<th scope="col">Address</th>
								<th scope="col">Remove driver</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query=mysqli_query($con,"SELECT  * from delivery_person");
							while($row=mysqli_fetch_array($query))
							{
						
						?>			 
					
						<tr>
							
							<td><img src="image/deliver/<?php echo $row['email']."/" .$row['image'];?>" height="50px" width="100px"></td>
							<th scope="row"><?php echo $row['id'];?></th>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['address'];?></td>
							
							<form method="POST">
							<td><a href="?id=<?php echo $id=$row['id']; ?>&type=delete"  style="text-decoration:none; color:white;" ><button type="button" class="btn btn-danger" id="remove">Remove Driver</a></a></td>
							</form>
						</tr>
							<?php
							}
							?>		   
					</tbody>
           		  </table>
	 
	 			</div>   	
			</div>
			 
			 <!--tab 4-->
			 <div class="tab-pane fade" id="orderstatus" role="tabpanel" aria-labelledby="orderstatus-tab">
               <table class="table">
			   <th>Order Id</th>
			   <th>Food Id</th>
			   <th>Customer Email Id</th>
			   <th>order Status</th>
			   <tbody>
			   <?php			   
			   $rr=mysqli_query($con,"SELECT * from orders");
			   while($rrr=mysqli_fetch_array($rr))
			   {
				   $stat=$rrr['fldstatus'];
				   $foodid=$rrr['food_id'];
				   $r_f=mysqli_query($con,"SELECT * from food where food_id='$foodid'");
				   $r_ff=mysqli_fetch_array($r_f);
			   
			   ?>
			   <tr>
			   <td><?php echo $rrr['order_id']; ?></td>
			   <td><a href="searchfood.php?food_id=<?php echo $rrr['food_id']; ?>"><?php echo $rrr['food_id']; ?></td>
			   <td><?php echo $rrr['cust_email_id']; ?></td>
			   <?php
			   if($stat=="cancelled" || $stat=="Out Of Stock")
			   {
			   ?>
			   <td><i style="color:orange;" class="fas fa-exclamation-triangle"></i>&nbsp;<span style="color:red;"><?php echo $rrr['fldstatus']; ?></span></td>
			   <?php
			   }
			   else
				   
			   {
			   ?>
			   <td><span style="color:green;"><?php echo $rrr['fldstatus']; ?></span></td>
			   <?php
			   }
			   ?>
			   
			   </tr>
			   <?php
			   }
			   ?>
			   </tbody>
			   </table>
			</div>
			 
      
	  </div>
	</div>	 
	<br><br><br>
 	<?php
	include("footer.php");
	?>
		  

</body>
	
</html>	