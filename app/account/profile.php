<?php 

session_start(); 
include "../conn.php";
include "../config.php";

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
        $phone = $row1['phone'];
        $country = $row1['country'];
      
    }else{
  
  
        header("location: ../login.php");
        }
    }else{
    header('location: ../login.php');
    die();
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
<h3 class="card-title"> User Info</h3>
<div class="list-group list-group-flush">
    
 
									
									
									
									
<p class="list-group-item"> Fullname: &nbsp;&nbsp; <strong><?php echo $fname;?></strong> </p>
<p class="list-group-item">  Email: &nbsp;&nbsp; <strong><?php echo $email;?></strong> </p>
<p class="list-group-item"> Phone: &nbsp;&nbsp; <strong><?php echo $phone;?></strong> </p>
<p class="list-group-item"> Country of Residence: &nbsp;&nbsp; <strong> <?php echo $country;?>


                                        </strong> </p>
</div>
<a class="btn btn-outline-danger" style="margin-top: 15px; color: #f15c30;"  href="password.php" >  Change Password</a>

<a class="btn btn-outline-danger" style="margin-top: 15px; color: #f15c30;"  href="edit.php"> Edit Profile</a>


<a class="btn btn-outline-success" style="margin-top: 15px; color: #f15c30;"  href="feedback.php"> Contact Support</a>

</div>

 </div>

</div>

<div class="col-lg-12">
<div class="card">
<div class="card-body">
<h3 class="card-title"><i class="fa fa-money"></i> Account Info</h3>
<div class="list-group list-group-flush">
<p class="list-group-item"><i class="fa fa-money"></i> Available Balance: &nbsp;&nbsp; <strong> <?php echo $ubalance;?> ETH</strong></p>
<p class="list-group-item"><i class="fa fa-cogs"></i> Account Status: &nbsp;&nbsp; <strong>
    
	<button class="btn btn-success" type="button"><i class="fe fe-check-verified"></i> Verified</button>
													    
    
    
    
</strong> </p>
</div>
</div>

</div>

</div>

</div>

</div>
</div>












 














<?php include 'footer.php'; ?>