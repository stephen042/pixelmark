<?php 

session_start(); 
include "../conn.php";
include "../config.php";
$msg = $msgme = "";
if(isset($_SESSION['email'])){

    $email = $link->real_escape_string($_SESSION['email']);

    $sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($link, $sql1);
    if(mysqli_num_rows($result) > 0){

        $row1 = mysqli_fetch_assoc($result);
        $ubalance = $row1['balance'];
        $fname = $row1['fname'];
        $gasfee = $row1['gasfee'];
        $picture = $row1['picture'];
        $ucountry = $row1['country'];
        $udob = $row1['dob'];
        $uphone = $row1['phone'];
        $uaddress = $row1['address'];
		$ucity = $row1['city'];
        $ustate = $row1['state'];
        $uzip = $row1['zip'];
		$ugender = $row1['gender'];
      
    }else{
  
  
        header("location: ../login.php");
        }
    }else{
    header('location: ../login.php');
    die();
}


if(isset($_POST['update'])){

	if(empty(trim($_POST["fname"]))){
	 $msg = "Please enter full first name.";     
 } else{
	 $ufname = $link->real_escape_string($_POST["fname"]);
 }
 
 $ppix = $_FILES['ppix']['name'];
    $target = "image/".basename($ppix);

 
 $phone = $link->real_escape_string($_POST["phone"]);
 $address = $link->real_escape_string($_POST["address"]);
 $dob = $link->real_escape_string($_POST["dob"]);
 $gender = $link->real_escape_string($_POST["gender"]);
 $city = $link->real_escape_string($_POST["city"]);
 $state = $link->real_escape_string($_POST["state"]);
 $zip = $link->real_escape_string($_POST["zip"]);
 $country = $link->real_escape_string($_POST["country"]);
 
   
   if(empty($msg)){
	   if($ppix != ""){
   $sqlup = "UPDATE users SET picture = '$ppix', fname = '$ufname',phone = '$phone', address = '$address', dob = '$dob', gender = '$gender',city = '$city', state = '$state', zip = '$zip', country = '$country' WHERE email = '$email'";
	   }else{
		$sqlup = "UPDATE users SET fname = '$ufname',phone = '$phone', address = '$address', dob = '$dob', gender = '$gender',city = '$city', state = '$state', zip = '$zip', country = '$country' WHERE email = '$email'";

	   }	

	 if (mysqli_query($link, $sqlup)) {
		if($ppix != ""){
			move_uploaded_file($_FILES['ppix']['tmp_name'], $target);
		}
		 
		 $msgme = "Profile updated successfully!";
		 
	 }
}

}

$sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
$result = mysqli_query($link, $sql1);
if(mysqli_num_rows($result) > 0){

	$row1 = mysqli_fetch_assoc($result);
	$fname = $row1['fname'];
	$picture = $row1['picture'];
	$ucountry = $row1['country'];
	$udob = $row1['dob'];
	$uphone = $row1['phone'];
	$uaddress = $row1['address'];
	$ucity = $row1['city'];
	$ustate = $row1['state'];
	$uzip = $row1['zip'];
	$ugender = $row1['gender'];
  
}

include 'header.php'; ?>

 

















     
        
        
        

<div class="main-content-inner">
<div class="row">
<div class="col-md-12 mt-4">

<div class="box box-widget widget-user">

<div class="widget-user-header bg-black" style="background: url('https://media.istockphoto.com/photos/contemporary-workspace-with-books-colour-pencils-gadgets-and-supplies-picture-id929368282?k=20&m=929368282&s=612x612&w=0&h=3920H8nh8xYiXCBvfg8PQ3fZG2DWF0R9VJ4_K1MnOEc=') center center;">
<h3 class="widget-user-username"><?php echo $fname;?></h3>
 
						 
</div>
<div class="widget-user-image">
<img class="rounded-circle" src="image/<?php echo $picture;?>" alt="User Avatar">
</div>
</div>

</div>

</div>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

 
 









<!-- Edit Details Modal --> 
												<div class="modal-dialog modal-dialog-centered" role="document" >
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" style="color: darkgreen;">Edit Profile</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form action="#" method="post" enctype="multipart/form-data" >
															<?php if($msg != "") echo "<div class='alert alert-danger'>
				<button class='close' data-dismiss='alert'>×</button>
					".$msg."
			  </div>";  
              if($msgme != "") echo "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>×</button>
                ".$msgme."
			  </div>";
              
              ?>
																<div class="row form-row">
																	<div class="col-12">
																		<div class="form-group">
																			<label for="profilePhoto">Upload Profile Image</label>
																			<input type="file" class="form-control" name="ppix" id="profilePhoto">
																		</div>
																	</div>
																	<div class="col-12 col-sm-6">
																		<div class="form-group">
																			<label for="name">Full Name</label>
																			<input type="text" class="form-control" name="fname" id="name" value="<?php echo $fname;?>" required>
																		</div>
																	</div>
																	<div class="col-12 col-sm-6">
																		<div class="form-group">
																			<label for="gender">Gender</label>
																			<select class="form-control" name="gender" id="gender">
																				<option value="" disabled selected >Select Gender</option>
																				<option value="Male"  >Male</option>
																				<option value="Female"  >Female</option>
																			</select>
																		</div>
																	</div>
																	<div class="col-12 col-sm-6">
																		<div class="form-group">
																			<label for="dob">Date of Birth</label>
																			<input type="date" name="dob" id="dob" value="<?php echo $udob;?>" class="form-control">
																		</div>
																	</div>
																	<div class="col-12 col-sm-6">
																		<div class="form-group">
																			<label for="phone">Mobile</label>
																			<input type="number" name="phone" id="phone" value="<?php echo $uphone;?>" class="form-control" placeholder="Mobile">
																		</div>
																	</div>
																	<div class="col-12">
																		<h5 class="form-title"><span>Address</span></h5>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																		<label for="address">Address</label>
																			<input type="text" name="address" id="address" class="form-control" value="<?php echo $uaddress;?>" placeholder="Address">
																		</div>
																	</div>
																	<div class="col-12 col-sm-6">
																		<div class="form-group">
																			<label for="city">City</label>
																			<input type="text" name="city" id="city" class="form-control" value="<?php echo $ucity;?>" placeholder="City">
																		</div>
																	</div>
																	<div class="col-12 col-sm-6">
																		<div class="form-group">
																			<label for="state">State</label>
																			<input type="text" name="state" id="state" class="form-control" value="<?php echo $ustate;?>" placeholder="State">
																		</div>
																	</div>
																	<div class="col-12 col-sm-6">
																		<div class="form-group">
																			<label for="zipcode">Zip Code</label>
																			<input type="number" name="zipcode" id="zipcode" class="form-control" value="<?php echo $uzip;?>"  placeholder="Zip Code">
																		</div>
																	</div>
																	<div class="col-12 col-sm-6">
																		<div class="form-group">
																			<label for="country">Country</label>
																			<input type="text" name="country" id="country" class="form-control" value="<?php echo $ucountry;?>" placeholder="Country">
																		</div>
																	</div>
																</div>
																<button type="submit" name="update" class="btn btn-primary btn-block">Save Changes&nbsp;<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="edit-profile-spinner"></span></button>
															</form>
														</div>
													</div>
												</div>
									 
											<!-- /Edit Details Modal -->




























</div>

 </div>

</div>

 

</div>

</div>
</div>





<?php include 'footer.php'; ?>