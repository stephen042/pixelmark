
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
   $pdname = "";
   $pdincrease = "";
   $pdbonus = "";
   $pdduration ="";
   $pdfroms = "";
   $pdtos = "";
   $pdtype = "";
   $vid = "";
   $id = "";

   

if(isset($_POST['package11'])){


$pname =$link->real_escape_string( $_POST['pname']);
$increase =$link->real_escape_string( $_POST['increase']);
$duration =$link->real_escape_string($_POST['duration']);
$froms =$link->real_escape_string($_POST['froms']);
$tos =$link->real_escape_string($_POST['tos']);
$pmaxreturn =$link->real_escape_string($_POST['maxreturn']);
$pminreturn =$link->real_escape_string($_POST['minreturn']);


if(isset($_POST['mid']) && $_POST['mid'] !=''){
  $mid = $link->real_escape_string( $_POST['mid']);
  
  $sql1 = "UPDATE package1 SET maxreturn='$pmaxreturn',minreturn='$pminreturn',pname='$pname',increase='$increase',duration='$duration',froms='$froms',tos='$tos'  WHERE id='$mid'";






  if (mysqli_query($link, $sql1)) {

$msg= " Package updated successfully!";

           } else {
        $msg= " Package not updated ";
         }
}else{


    $sql = "INSERT INTO package1 (pname,maxreturn,minreturn,increase,duration,froms,tos) VALUES ('$pname','$pmaxreturn','$pminreturn','$increase','$duration','$froms','$tos')";






                  if (mysqli_query($link, $sql)) {

  
               $msg= " Package has been successfully added";

                           } else {
                        $msg= " Package was not added ";
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

          <h4 align="center"><i class="fa fa-gears"></i> PACKAGE MANAGEMENT</h4>
</br>

<?php
  
  if(isset($_GET['id']) && $_GET['id'] !=''){
    $vid= "yes";
    $id = $link->real_escape_string( $_GET['id']);
$sql1= "SELECT * FROM package1 WHERE id = '$id'";
  $result1 = mysqli_query($link,$sql1);
  if(mysqli_num_rows($result1) > 0){
   $row = mysqli_fetch_assoc($result1);
   $pdname = $row['pname'];
   $pdmaxreturn = $row['maxreturn'];
   $pdminreturn = $row['minreturn'];
   $pdincrease = $row['increase'];
   $pdbonus = $row['bonus'];
   $pdduration = $row['duration'];
   $pdfroms = $row['froms'];
   $pdtos = $row['tos'];
 
  }
  }

?>
        
         

 
          <hr></hr>
          
        
          
            <div class="box-header with-border">
            
            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>

     <form class="form-horizontal" action="addpackages.php" method="POST" >

           <legend>Package</legend>
		   
		   
		   <input type="hidden" name="email"  value="<?php echo $_SESSION['email'];?>" class="form-control">

     <div class="form-group">
       <label> Package Name </label>
        <input type="text" name="pname" placeholder="Package Name" value="<?php echo $pdname;?>" class="form-control">
        </div>
       

       <div class="form-group">
       <label> Daily Percentage Increase </label>
        <input type="text"  name="increase" placeholder="Daily Percentage Increase" value="<?php echo $pdincrease;?>"  class="form-control">
      </div>

      <div class="form-group">
      <label> Package Duration (Days) </label>
        <input type="text"  name="duration" placeholder="Package Duration" value="<?php echo $pdduration;?>"  class="form-control">
      </div>
        
       
        <div class="form-group">
        <label> Package Price 'FROM' </label>
        <input type="text"  name="froms" placeholder="Package Price 'FROM'"  value="<?php echo $pdfroms;?>"  class="form-control">
        </div>
        
		
        <div class="form-group">
        <label>Package Price 'TO' </label>
        <input type="text"  name="tos" placeholder="Package Price 'TO'" value="<?php echo $pdtos;?>"  class="form-control">
        </div>
         <div class="form-group">
       <label> Package Min Returns </label>
        <input type="text" name="minreturn" placeholder="Package Type" value="<?php echo $pdminreturn;?>" class="form-control">
        </div>
         <div class="form-group">
       <label> Package Max Returns </label>
        <input type="text" name="maxreturn" placeholder="Package Type" value="<?php echo $pdmaxreturn;?>" class="form-control">
        </div>
        <?php if($vid == ""){
          ?>
      <button style="" type="submit" class="btn btn-info" name="package11" >Add Package</button>
	  <?php }else{?>
	  <input type="hidden" name="mid"  value="<?php echo $id;?>" class="form-control">
	  <button style="" type="submit" class="btn btn-info" name="package11" >Update Package </button>
	  <?php }?>


    </form>




    </div>
   </div>

   </div>
  </div>
  </section>
</div>

