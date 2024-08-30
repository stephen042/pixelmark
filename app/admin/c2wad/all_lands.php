<?php
session_start();

include "../../conn.php";
include "../../config.php";

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



if(isset($_POST['delete'])){
	
	$tnx = $_POST['tnx'];
	
$sql = "DELETE FROM market WHERE id='$tnx'";

if (mysqli_query($link, $sql)) {
    $msg = "Land deleted successfully!";
} else {
    $msg = "Land not deleted! ";
}
}



include 'header.php';





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
  

     
 <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">



   <style>
 
	
   </style>


<div style="width:100%">
          <div class="box box-default">
            <div class="box-header with-border">

	<div class="row">


		 <h2 class="text-center">All Lands</h2>
		  </br>

</br>
 <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>
		    </br>

<div class="col-md-12 col-sm-12 col-sx-12">
               <div class="table-responsive">
                     <table class="display"  id="example">

					<thead>

						<tr class="info">
						<th>S/N</th>
			
            <th style="display:none;"></th>


							<th>Creator Name</th>
                            <th>Creator Email</th>
              <th>Land Name</th>
              <th>Land Logo</th>
              <th>Amount</th>
                               <th>Status</th>
                               <th>Buyer Name</th>
                            <th>Buyer Email</th>
							 
							 <th>Transaction ID</th>
					
							<th>Date</th>
             
              <th>Action</th>
                        
						</tr>
					</thead>

					<tbody>
					<?php
                    $i = 1;
                    $sql= "SELECT * FROM market WHERE type = 'Land' ORDER BY id DESC";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){   

                    $usemail = $row['email'];
                    $usbuyer = $row['buyer']; 


$row['status'];
$rowauthorfname = "";
if($usemail != "Admin"){
$sqlmarkbuy = "SELECT * FROM users WHERE email = '$usemail' LIMIT 1";
$resultmarkbuy = mysqli_query($link,$sqlmarkbuy);
$rowauthor = mysqli_fetch_assoc($resultmarkbuy);
$rowauthorfname = $rowauthor['fname'];
}
$sqlmarkbuyyer = "SELECT * FROM users WHERE email = '$usbuyer' LIMIT 1";
$resultmarkbuyyer = mysqli_query($link,$sqlmarkbuyyer);
$rowauthorbuyyer = mysqli_fetch_assoc($resultmarkbuyyer);
   


				  ?>

						<tr class="primary">
						<form  method="post">
                            <td><?php echo $i;?></td>
							
							<td style="display:none;"><input type="hidden" name="tnx" value="<?php echo $row['id'];?>"> </td>
              
							<td><?php echo $rowauthorfname;?></td>
              <td><?php echo $usemail;?></td>
							<td><?php echo $row['name'];?></td>
                            <td><a href="../../account/land/<?php echo $row['logo'];?>"><img src="../../account/land/<?php echo $row['logo'];?>" style="
    width: 139px;
    height: 88px;
" /></a</td>

<td><?php echo $row['amount'];?> ETH</td>

<td><?php echo $row['mstatus'];?> </td>

<td><?php echo $rowauthorbuyyer['fname'];?></td>
<td><?php echo $rowauthorbuyyer['email'];?></td>		

<td><?php echo $row['ref'];?></td>
              
        
			   <td><?php echo $row['created_on'];?></td>
			  
                         
						
							
							<td><button class="btn btn-danger" type="submit" name="delete"><span class="glyphicon glyphicon-check"> Delete</span></button></td>

   
</form>

						</tr>
					  <?php
  $i++;}
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






<script>
$(document).ready(function () {
        $('#table')
                .dataTable({
                    "responsive": true,
                    
                });

				
    });



				</script>


