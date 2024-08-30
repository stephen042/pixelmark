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


if(isset($_POST['ubank'])){
    if (empty($_POST["nft_price"])) {
        $msg = "Land price is required";
      } else {
        $nft_price = $link->real_escape_string($_POST["nft_price"]);
       
      }

      if (empty($_POST["nft_name"])) {
        $msg = "Land name is required";
      } else {
        $nft_name = $link->real_escape_string($_POST["nft_name"]);
       
      }

     
    

    $nft_logo = $_FILES['nft_logo']['name'];
    $target = "../../account/land/".basename($nft_logo);

    $ref ='1234567890';
    $ref = str_shuffle($ref);
     $ref = "Land".substr($ref,0, 10);

    if(empty($msg)){
               
              
                $sqlu11 = "INSERT INTO market (name, email, ref, logo, amount, status, mstatus, type) VALUES ('$nft_name', 'Admin', '$ref', '$nft_logo', '$nft_price', 'approved', 'ACTIVE', 'Land') ";
                if(mysqli_query($link, $sqlu11)){
                    move_uploaded_file($_FILES['nft_logo']['tmp_name'], $target);
                   
                    
           
                    $msg = "Your Land ".$nft_name." has been created successfully, the Ref No. is ".$ref.". It has been made availabe on the marketplace.";
              
                }
               
        
     
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

          <h4 align="center"><i class="fa fa-plus"></i> CREATE Land </h4>
</br>


        
         

 
          <hr></hr>
          
        
          
            <div class="box-header with-border">
            
            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>
          
          

     <form class="form-horizontal" action="" enctype="multipart/form-data" method="POST" >

           <legend>Create New Land </legend>
		   
		   
		  

     <div class="form-group">
         <label>Land Name</label>
        <input type="text" name="nft_name" value="" placeholder="Enter Land Name"  class="form-control" required>
        </div>
        <div class="form-group">
         <label>Land Price</label>
        <input type="double" name="nft_price" value="" placeholder="Enter Land Price"  class="form-control" required>
        </div>
        <div class="form-group">
         <label>Select Land</label>
        <input type="file" name="nft_logo" value="" placeholder=""  class="form-control" required>
        </div>


      

     
   
	  
	  <button style="" type="submit" class="btn btn-primary" name="ubank" >Create </button>
	  


    </form>
    </div>
   </div>

   </div>
  </div>
  </section>
</div>

