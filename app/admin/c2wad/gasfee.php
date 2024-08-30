<?php

session_start();


include "../../conn.php";

$msg = "";
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
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



$gasfee =$link->real_escape_string( $_POST['gasfee']);





$sql = "UPDATE users SET gasfee = '$gasfee'";

$sqlAdmin = "UPDATE admin SET gasfee = '$gasfee'";



	if (mysqli_query($link, $sql) && mysqli_query($link, $sqlAdmin)) {

  
               $msg= " Gas Fee has been successfully Updated For all users";

                           } else {
                        $msg= " Gas Fee was not Updated ";
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
       
           if(isset($row['gasfee'])){
         $gasfeew = $row['gasfee'];
       }else{
         $gasfeew="";
       }
       
      
      
      }
          ?>

     <form class="form-horizontal" action="gasfee.php" method="POST" >

           <legend>Gas Fee (ETH)</legend>
		   
		   
		  

     <div class="form-group">
         <label>Gas Fee(ETH)</label>
        <input type="text" name="gasfee" value="<?php echo $gasfee ;?>" placeholder="Gas Fee (ETH)"  class="form-control">
        </div>


      

     
   
	  
	  <button style="" type="submit" class="btn btn-primary" name="ubank" >Update Details </button>
	  


    </form>
    </div>
   </div>

   </div>
  </div>
  </section>
</div>

