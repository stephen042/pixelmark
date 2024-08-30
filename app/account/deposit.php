<?php 

session_start(); 
include "../conn.php";
include "../config.php";

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



include 'header.php'; ?>

 













<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: black}
tr:nth-child(odd){background-color: grey}
.table-hover tbody tr:hover {
    background-color: #9c9c9c;
}
</style>




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
  <!--  <h6 style="color:red;">NOTE: Minimum deposit is 0.009 ETH for Instant Deposit Method </h6>
<h4 class="header-title"><i class="fa fa-money"></i> Deposit</h4>-->
<form method="post" action="process.php">



<div class="form-group">
<label for="amount">Enter Deposit Amount(ETH) </label>
<input class="form-control" type="text" name="amount" placeholder="" id="amount" required>
</div>


<div class="form-group">
<label for="mode">Select Deposit Method</label>
<select class="form-control" type="text" name="method"  required>
<option value="">Select Payment Method </option>
<option value="Manual">Manual Deposit</option>
<!--<option value="Instant">Instant Deposit</option>-->

</select>
</div>



<div class="form-group">
<button name="deposit" type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Proceed</button>
</div>
</form>
</div>
</div>

<br><br>
<div class="row">
<div class="col-12 mb-3">
<div class="card">
<div class="card-body">
    
    
    
    
<h3 class="card-title" style="color:black">Deposit History</h3>
<div class="table-responsive">
<table class="table table-hover">
<thead class="bg-light">
<tr style="background-color:black;">
<th>#</th>
<th>Amount</th>
<th>Ref Number</th>
<th>Method</th>

<th>Status</th>
<th>Date</th>
</tr>
</thead>

 <tbody>  
<?php 
									$i = 1;
					$sql= "SELECT * FROM btc WHERE email='$email' ORDER BY id DESC ";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){   

            ?>
     
             
  
                        <tr>
                        <td><?php echo $i;?> </td>
                          <td><?php echo $row['usd'];?> ETH</td>
                          <td><?php echo $row['tnxid'];?> </td>
                          <td><?php echo $row['mode'];?></td>
                          <td> 
                              <?php if($row['status'] == "pending"){ ?>
                              <span style="background: #e00505;padding: 5px 10px;border-radius: 10px;"> <?php echo $row['status'];?> </span>
                        <?php }else{?>
                          <span style="background: #0c9902;padding: 5px 10px;border-radius: 10px;"> <?php echo $row['status'];?> </span>
                          <?php }?>
                        </td>
                          <td><?php echo $row['date'];?></td>
                         
                     
                        </tr>
 <?php $i++;} } ?>

        
			   


    
      
 

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



<script type="text/javascript">
        $(function () {
        $("#withdrawalMethod").change(function () {
            if ($(this).val() == "Bitcoin") {
                $("#beneficiaryField1").fadeIn();
                $("#beneficiaryField2").hide();
                $("#beneficiaryField3").hide();
                $("#beneficiaryField4").hide();
                $("#beneficiaryField5").hide();
                $("#beneficiaryField6").hide();
                $("#beneficiaryField7").hide();
            } else if ($(this).val() == "Litecoin") {
                $("#beneficiaryField2").fadeIn();
                $("#beneficiaryField1").hide();
                $("#beneficiaryField3").hide();
                $("#beneficiaryField4").hide();
                $("#beneficiaryField5").hide();
                $("#beneficiaryField6").hide();
                $("#beneficiaryField7").hide();
            } else if ($(this).val() == "Ethereum") {
                $("#beneficiaryField3").fadeIn();
                $("#beneficiaryField1").hide();
                $("#beneficiaryField2").hide();
                $("#beneficiaryField4").hide();
                $("#beneficiaryField5").hide();
                $("#beneficiaryField6").hide();
                $("#beneficiaryField7").hide();
            } else if ($(this).val() == "Bank Transfer") {
                $("#beneficiaryField4").fadeIn();
                $("#beneficiaryField5").fadeIn();
                $("#beneficiaryField6").fadeIn();
                $("#beneficiaryField7").fadeIn();
                $("#beneficiaryField1").hide();
                $("#beneficiaryField2").hide();
                $("#beneficiaryField3").hide();
            } else {
                $("#beneficiaryField1").hide();
                $("#beneficiaryField2").hide();
                $("#beneficiaryField3").hide();
                $("#beneficiaryField4").hide();
                $("#beneficiaryField5").hide();
                $("#beneficiaryField6").hide();
                $("#beneficiaryField7").hide();
            }
        });
        });
    </script>

<?php include 'footer.php'; ?>