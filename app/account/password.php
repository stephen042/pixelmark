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
		$upassword = $row1['password'];
      
    }else{
  
  
        header("location: ../login.php");
        }
    }else{
    header('location: ../login.php');
    die();
}

if(isset($_POST['save'])){
 
   

    // Validate name
  
    if(trim($_POST["password"]) != ""){
        $password = trim($_POST["password"]);

        if(empty(trim($_POST["password2"]))){
            $msg = "Please confirm password.";     
        } else{
            $cpassword = trim($_POST["password2"]);
            if(empty($msg) && ($password != $cpassword)){
                $msg = "Password did not match.";
            }
        }

    }
     if(empty(trim($_POST["opassword"]))){
            $msg = "Please input old password.";     
        } else{
            $opassword = trim($_POST["opassword"]);
        }
    if($opassword != $upassword){
                $msg = "Wrong Old Password.";
            }
    
     // Prepare an insert statement
        if(empty($msg)){
        $sql1 = "UPDATE users SET password = '$password'  WHERE email = '$email' ";
         
        if(mysqli_query($link, $sql1)){
          
$msgme = "Password changed successfully."; 

            } else{
                $msg = "Something went wrong. Please try again later.";
            }
            
        }
    
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

 
 



				<!-- Change Password Tab -->
						 
								
									<div class="card">
										<div class="card-body">
											<h5 class="card-title" style="color: darkgreen;">Change Password</h5>
											<div class="row">
												<div class="col-md-10 col-lg-6">
													<form action="#" method="post" >
													<?php if($msg != "") echo "<div class='alert alert-danger'>
				<button class='close' data-dismiss='alert'>×</button>
					".$msg."
			  </div>";  
              if($msgme != "") echo "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>×</button>
                ".$msgme."
			  </div>";
              
              ?>
														<div class="form-group">
															<label for="curpass">Current Password</label>
															<input type="password" class="form-control" name="opassword" id="curpass" required minlength="6">
														</div>
														<div class="form-group">
															<label for="newpass">New Password</label>
															<input type="password" class="form-control" name="password" id="newpass" required minlength="6">
														</div>
														<div class="form-group">
															<label for="cneewpass">Confirm Password</label>
															<input type="password" class="form-control" name="password2" id="cnewpass" required minlength="6">
														</div>
														<button class="btn btn-primary" type="submit" name="save" >Save Changes&nbsp;<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="change-pass-spinner"></span></button>
													</form>
												</div>
												<div class="col-md-10 col-lg-6" style="margin-top: 125px;">
													<div id="changePassError"></div>
												</div>
											</div>
										</div>
									</div>
					 
								<!-- /Change Password Tab -->


 




























</div>

 </div>

</div>

 

</div>

</div>
</div>










<?php include 'footer.php'; ?>