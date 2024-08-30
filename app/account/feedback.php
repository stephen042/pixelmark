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
      
    }else{
  
  
        header("location: ../login.php");
        }
    }else{
    header('location: ../login.php');
    die();
}

if(isset($_POST['save'])){
    if (empty($_POST["subject"])) {
        $msg = "Subject is required";
      } else {
        $subject = $link->real_escape_string($_POST["subject"]);
       
      }

      if (empty($_POST["body"])) {
        $msg = "Feedback is required";
      } else {
        $body = $link->real_escape_string($_POST["body"]);
       
      }
    

    if(empty($msg)){


               
              
                $sqlu11 = "INSERT INTO support (email, subject, body) VALUES ('$email', '$subject', '$body') ";
                if(mysqli_query($link, $sqlu11)){
   
                   
                    $msgme = "Your Feedback has been successfully submitted. Our customer agent will get in touch with you shortly.";
              
                }
               
        
     
        }

}

include 'header.php'; ?>

 
















 



<div class="main-content-inner mt-4">
<div class="row">
<div class="col-md-12">
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="alert alert-success bg-success" role="alert">
<div class="row">
<div class="col-5">
<p class="text-white"><b>Balance:</b></p>
</div>
<div class="col-7 text-right">
<p class="text-white"><?php echo $ubalance;?> ETH</p>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<h4 class="header-title"><i class="fa fa-money"></i>Contact Support</h4>
 
 
 
 
 
 
 	 
							 
				 
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
						<div class="card-body">
							<div class="form-group">
								<input type="text" name="subject" class="form-control" placeholder="Write Your Subject Here..." required>
							</div>
							<div class="form-group">
								<textarea name="body" class="form-control" placeholder="Write Your Feedback Here..." rows="8" required></textarea>
							</div>
							<div class="form-group">
								<button type="submit" name="save"  class="btn btn-block btn-primary">Send Message&nbsp;<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="send-feedback-spinner"></span></button>
							</div>
						</div>
					</form>
		 
					
	 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
</div>
</div>
<br><br>
 
</div>


</div>

</div>
</div>


<?php include 'footer.php'; ?>