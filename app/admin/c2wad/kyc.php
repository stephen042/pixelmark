<?php
session_start();


include "../../conn.php";
include "../../config.php";
include "header.php";
$msg = "";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET['referred'])){
	$referreds = $_GET['referred'];
}else{
	$referreds = '';
}


if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}


if(isset($_POST['approve'])){
	
	
	$email = $_POST['email'];

 		 $sql2= "SELECT * FROM users WHERE email= '$email'";
  $result2 = mysqli_query($link,$sql2);
  if(mysqli_num_rows($result2) > 0){
   $row = mysqli_fetch_assoc($result2);
   $row['balance'];
   $usernamewtc = $row['fname'];
  }
if(isset($row['kycverify']) &&  $row['kycverify']== 1){
	
	$msg = "KYC already approved!";

}else{
		
	
		    
		    
		include_once "PHPMailer/PHPMailer.php";
    require_once 'PHPMailer/Exception.php';


 $mail= new PHPMailer();
     $mail->setFrom($emaila);
   $mail->FromName = $name;
    $mail->addAddress($email);
    $mail->Subject = "KYC Approval";
    $mail->isHTML(true);
    $mail->Body = '
    
    
    <div style="background: #f5f7f8;width: 100%;height: 100%; font-family: sans-serif; font-weight: 100;" class="be_container"> 

<div style="background:#fff;max-width: 600px;margin: 0px auto;padding: 30px;"class="be_inner_containr"> <div class="be_header">

<div class="be_logo" style="float: left;"> <img src="https://'.$bankurl.'/admin/c2wad/logo/'.$logo.'"> </div>

<div class="be_user" style="float: right"> <p>Dear: '.$usernamewtc.'</p> </div> 

<div style="clear: both;"></div> 

<div class="be_bluebar" style="background: #1976d2; padding: 20px; color: #fff;margin-top: 10px;">

<h1>Thank you for investing on '.$name.'</h1>

</div> </div> 

<div class="be_body" style="padding: 20px;"> <p style="line-height: 25px; color:#000;"> 

Your document is now approved successfully and your account is now verified!
</p>

<div class="be_footer">
<div style="border-bottom: 1px solid #ccc;"></div>


<div class="be_bluebar" style="background: #1976d2; padding: 20px; color: #fff;margin-top: 10px;">

<p> Please do not reply to this email. Emails sent to this address will not be answered. 
Copyright ©'.$cy.' '.$name.'. </p> <div class="be_logo" style=" width:60px;height:40px;float: right;"> </div> </div> </div> </div></div>';
    

if($mail->send()) {
     
	
		$msg = "KYC approved successfully!";

    
    
		    
          
		$sql1 = "UPDATE users SET kycverify = 1  WHERE email = '$email'";
		mysqli_query($link, $sql1);
		

  
} else {
    $msg = "KYC was not approved! ";
}


		
				    
	

		
}

}

   
    if(isset($_POST['delete'])){
	
	
      $email =$link->real_escape_string( $_POST['email']);
          
        
      $sql1 = "UPDATE users SET kyc = 0 WHERE email ='$email'";
      
      if (mysqli_query($link, $sql1)) {
          $msg = "Record Deleted successfully  !";
            
          
      } else {
          $msg = "Cannot delete Account! ";
      }
      }

?>
  

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
  

  <link rel="stylesheet" href=" https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.5.6/css/buttons.jqueryui.min.css">



  

  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css">
  <link rel="stylesheet" href="">
 
  
    
    



  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
 

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.jqueryui.min.js"></script>
   
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
  
  
  <script type="text/javascript" charset="utf8" src=""></script>
  <script type="text/javascript" charset="utf8" src=""></script>

 
  



    
    
 
    
    
    
    
    
    

   
   



<style>
.table-responsive {
overflow-x: hidden;
}
@media (max-width: 8000px) {
.table-responsive {
overflow-x: auto;
}
</style>
  </head>
  <body>

  <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">


<div style="width:100%">
          <div class="box box-default">
            <div class="box-header with-border">

	<div class="row">


		 <h2 class="text-center">INVESTORS KYC MANAGEMENT</h2>
		  </br>
<?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
           
</br>
          <div class="col-md-12 col-sm-12 col-sx-12">
               <div class="table-responsive">
                     <table class="display"  id="example">
                                    <thead>
                                        <tr>
                                            	<th>First Name</th>
						<th>Last Name</th>
                                            <th>EMAIL</th>
                                            <th>ID Card</th>
                                            
                                            <th>Passport </th>
                                            <th>Status </th>
                                            <th style="display:none">EMAIL</th>
                                             <th>ACTION</th>   
                                                   <th>ACTION</th>   
                                        </tr>
                                    </thead>
                                    <tbody>


                                    <?php 
                                    $sql= "SELECT * FROM users WHERE kyc = 1 ORDER BY id DESC";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){  
			
        if(isset($row['kycverify']) &&  $row['kycverify']== 1){
	
	
	$sec = 'Approved &nbsp;&nbsp;<i style="background-color:green;color:#fff; font-size:20px;" class="fa  fa-check" ></i>';

}else{
$sec ='Pending &nbsp;&nbsp;<i class="fa  fa-refresh" style=" font-size:20px;color:red"></i>';

}
				  ?>
				

                            
                                        <tr class="odd gradeX">
                                                   
                                                     <form  action="kyc.php" method="POST">
                                            
                                                                               
                                            <td><?php echo $row['fname'];?></td>
                            <td><?php echo $row['lname'];?></td>
                                            <td><?php echo $row['email'];?></td>
                                            	<td><a href="../../account/proof/<?php echo $row['idcard'];?>"><img src="../../account/proof/<?php echo $row['idcard'];?>" style="
    width: 139px;
    height: 88px;
" /></a</td>
	<td><a href="../../account/proof/<?php echo $row['passport'];?>"><img src="../../account/proof/<?php echo $row['passport'];?>" style="
    width: 139px;
    height: 88px;
" /></a</td>
                                             <td><?php echo $sec;?></td>
                                           <td style="display:none"><input type="hidden" name="email" value="<?php echo $row['email'];?>"</td>

                                            <td> 
                                            <button type="submit" name="approve" style="width:100%" class="btn btn-primary"><span class="fa fa-check">-Approve </span></button></td>
                                            
                                           <td><button type="submit" name="delete" style="width:100%" class="btn btn-danger"><span class="fas fa-trash">-Delete </span></button></td>
                                           
                                           
                                           
</form>
                                        </tr>

<?php    
          }
          }
?>


                                     </tbody>
                                </table>
                            </div>
                        </div>
                      

      </div>
      </div>
      </div> 
      </div>
      </div>
      </div>
      </div>
      </section>
      </div>
      </div>       
     
<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
       
    } );
    

    table.buttons().container()
        .insertBefore( '#example_filter' );

        table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-12:eq(0)' );
} );
</script>

  </body>
</html>