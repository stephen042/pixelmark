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



if(isset($_POST['stop'])){
	
	
  $email = $_POST['email'];
  $uid = $_POST['uid'];
  $cdate = date('Y-m-d H:i:s');

    $sql1 = "UPDATE investment SET activate = '0' WHERE email='$email' AND id='$uid'";
    
 

  if(mysqli_query($link, $sql1)){
	
  $msg = "package is successfully stopped!";


}else{
		

    $msg = "Package cannot be stopped ! ";
}
    }

   
 


include 'header.php';





?>



<link rel="stylesheet" href="http://cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css"/>
    <link rel="stylesheet" href="http://cdn.datatables.net/responsive/1.0.2/css/dataTables.responsive.css"/>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/responsive/1.0.2/js/dataTables.responsive.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">

     
 <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">



   <style>
 
	
   </style>


<div style="width:100%">
          <div class="box box-default">
            <div class="box-header with-border">

	<div class="row">
	

		 <h2 class="text-center">INVESTORS PACKAGE MANAGEMENT</h2>
		  </br>

		</br>
	
	</body>
</html>


</br>
 <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
         
<div class="col-md-12 col-sm-12 col-sx-12">
<div class="box-body table-responsive no-padding">

<table id="table" class="table table-striped table-hover table-responsive" cellspacing="0" >



					<thead>

						<tr class="info">
						<th>Email</th>
						<th>Type</th>
						<th style="display:none;"></th>
						<th style="display:none;"></th>
							<th>Daily Profit</th>
              <th>Total Plan Profit</th>
            <th>Activation Date</th>
						<th> End Date</th>
						<th>Days to End</th>
            <th>Amount Invested</th>
						                           
                             <th>Status</th>
                             
							
                                <th>Action</th>
                                 
                                

						</tr>
					</thead>



					<tbody>
					<?php $sql= "SELECT * FROM investment";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){ 

$row['activate'];
$row['pdate'];
   
    $pdate = $row['pdate'];
 $duration = $row['duration'];
 $increase = $row['increase'];
 $usd = $row['usd'];



        if(isset($row['activate']) &&  $row['activate'] == '1'  ){
          
         
          $endpackage = new DateTime($pdate);
          $endpackage->modify( '+ '.$duration. 'day');
 $Date2 = $endpackage->format('Y/m/d');
 $current=date("Y/m/d");

 $diff = abs(strtotime($Date2) - strtotime($current));

 $days=floor($diff / (60*60*24));
$daily = $duration - $days;

if(isset($days) && $days == 0 || $Date2 == (date("Y/m/d")) || (date("Y/m/d")) >= $Date2 ){
    
    $percentage = ($increase/100) * $duration * $usd;
    $days=0;
}else{
    $percentage = ($increase/100) * $daily * $usd;
}



 }else {
			        $endpackage = new DateTime($pdate);
          $endpackage->modify( '+ '.$duration. 'day');
 $Date2 = $endpackage->format('Y/m/d');
 $days=0;

			  $percentage = $row['profit'];
			    
 }
if(isset($_SESSION['pprofit'])){

  $profit = $_SESSION['pprofit'];
}else{
 
  $profit = "";
}
 

if(isset($row['activate']) &&  $row['activate']== '1'){
	
	
	$sec = 'Active &nbsp;&nbsp;<i style="background-color:green;color:#fff; font-size:20px;" class="fa  fa-refresh" ></i>';
}else{
$sec ='Completed &nbsp;&nbsp;<i style="color:green; font-size:20px;" class="fa  fa-check" ></i>';
}




$date = $row['pdate'];







				  ?>

						<tr class="primary">
						<form action="ivtpackages.php?email=<?php  echo $_SESSION['email'];?>" method="post">
						
						<td><?php echo $row['email'];?></td>
                          <td><?php echo $row['pname'];?> </td>
						  
						  <td style="display:none;"><input type="hidden" name="email" value="<?php echo $row['email'];?>"> </td>
						  <td style="display:none;"><input type="hidden" name="uid" value="<?php echo $row['id'];?>"> </td>
						
						  <td><?php echo $row['increase'];?>%</td>
              <td>€<?php echo $percentage;?> </td>
						   <td><?php echo $date;?></td>
						    <td><?php echo $Date2;?></td>
							<td><?php echo $days;?></td>
              <td>€<?php echo $usd;?></td>
								<td><?php echo $sec ;?></td>
               
						
                             <td><button class="btn btn-danger" type="submit" name="stop" ><span class="fa fa-times"> Stop Package</span></button></td>
	
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
          <!-- /top tiles -->

          </div>

   

    </body>
              </div>
            </div>


              </div>


          <br />







    </body>
              </div>
            </div>





          </section>

   </div>
  </div>
</div>


  </body>
</html>
<script>
$(document).ready(function () {
        $('#table')
                .dataTable({
                    "responsive": true,
                   
                  
                    
                });

				$('#tables')
                .dataTable({
                    "responsive": true,
                   
                  
                    
                    
                });
    });



				</script>
