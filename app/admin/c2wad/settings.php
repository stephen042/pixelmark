<?php
session_start();


include "../../conn.php";
include "../../config.php";

$msg = "";
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}







if(isset($_POST['uset'])){


  $sname = $_POST['sname'];
   
   
    $bname = $_POST['bname'];
    $email = $_POST['email'];
    $logo = $_FILES['logo']['name'];
    $target = "logo/".basename($logo);
    $scy = $_POST['cy'];
     
 if($logo!=""){
    $sql = "UPDATE settings SET  sname='$sname', bname='$bname', email='$email', logo='$logo' WHERE id = '$ids' ";
    }else{
    $sql = "UPDATE settings SET  sname='$sname', bname='$bname', email='$email' WHERE id = '$ids' ";
    }
    
    if(mysqli_query($link, $sql)){
 if($logo!=""){
     move_uploaded_file($_FILES['logo']['tmp_name'], $target);
       }
       $msg = "Settings Updated!";
     }else{
       
       $msg = "Settings Not Updated!";
     }
 }
 
 

include "header.php";






    ?>

    
 <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">




<div style="width:100%">
          <div class="box box-default">
            <div class="box-header with-border">

	<div class="row">


		 <h2 class="text-center">CONFIGURATION</h2>
		  </br>

        
         

 
          <hr></hr>
          
        
          
            <div class="box-header with-border">
            
            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>

     <form class="form-horizontal" action="settings.php" method="POST" enctype="multipart/form-data" >

           <legend> <?php echo $name;?> Settings </legend>
		   
	
 <div class="form-group">
        <input type="text" name="sname" placeholder="site url"  value="<?php echo $bankurl;?>" class="form-control">
        </div>

    

    
        
    

       

        <div class="form-group">
        <input type="text" name="bname" placeholder="Name" value="<?php echo $name;?>"  class="form-control">
        </div>
        
        
        
        
       

        <div class="form-group">
        <input type="text" name="email" placeholder="email" value="<?php echo $emaila;?>"  class="form-control">
        </div>
        


      
        
    

       
     <div class="form-group">
        <input type="text" name="cy" placeholder="Copyright Year" value="<?php echo $cy;?>"  class="form-control">
        </div>

        <div class="form-group">
        <input type="file" name="logo" placeholder="logo" value="<?php echo $logo;?>"  class="form-control">
        </div>
        
     

      
      
	  
	 

    <button style="" type="submit" class="btn btn-success" name="uset" > <i class="fa fa-send"></i>&nbsp; Update Settings </button>

    </form>


    </div>
   </div>

   </div>
  </div>
  </section>
</div>

