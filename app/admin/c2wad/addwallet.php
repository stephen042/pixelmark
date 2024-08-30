<?php

session_start();


include "../../conn.php";

$msg = "";
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
  die();
}


if(isset($_POST['bank'])){



$email =$link->real_escape_string( $_POST['email']);
$ewallet =$link->real_escape_string( $_POST['ewallet']);
$bwallet =$link->real_escape_string( $_POST['bwallet']);
$pm =$link->real_escape_string($_POST['pm']);




    $sql = "UPDATE admin SET ewallet='$ewallet', bwallet='$bwallet',pm='$pm' WHERE email='$email'";



	if (mysqli_query($link, $sql)) {

  
               $msg= " Details has been successfully added";

                           } else {
                        $msg= " Details was not added ";
                         }
                         
}


if(isset($_POST['ubank'])){



$gasfee =$link->real_escape_string( $_POST['wallet']);





    $sql = "UPDATE admin SET ewallet='$gasfee'";



	if (mysqli_query($link, $sql)) {

  
               $msg= " Wallet has been successfully Updated";

                           } else {
                        $msg= " Wallet was not Updated ";
                         }
                         
}




include "header.php";


    ?>





 <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">



   




<div class="col-md-12 col-sm-12 col-sx-12">
          <div class="box box-default">
            <div class="box-header with-border">

          <h4 align="center"><i class="fa fa-plus"></i> GAS FEE MANAGEMENT</h4>
</br>


        
         

 
          <hr></hr>
          
        
          
            <div class="box-header with-border">
            
            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>
          
          
            <?php   
         $sql1= "SELECT * FROM admin";
         $result1 = mysqli_query($link,$sql1);
         if(mysqli_num_rows($result1) > 0){
         $row = mysqli_fetch_assoc($result1);
       
       
if(isset($row['ewallet'])){
  $ew = $row['ewallet'];
}else{
  $ew="";
}
       
      
      
      }
          ?>

     <form class="form-horizontal" action="" method="POST" >

           <legend>Add Wallet</legend>
		   
		   
		  

     <div class="form-group">
         <label>Ethereum Wallet</label>
        <input type="text" name="wallet" value="<?php echo $ew ;?>" placeholder="Ethereum Wallet"  class="form-control">
        </div>


      

     
   
	  
	  <button style="" type="submit" class="btn btn-primary" name="ubank" >Update Details </button>
	  


    </form>
    </div>
   </div>

   </div>
  </div>
  </section>
</div>

