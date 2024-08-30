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

 















<div class="row">
<div class="col-sm-12">
<br>
</div>
</div>
<div class="container">
<h2>Available NFT Collection </h2>
<p>Prices are subject to change every minute, Take action now</p>
<a class="badge badge-info"  href="deposit.php" >Make Deposit</a>


 
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
</style>
 
 

<div style="overflow-x:auto;">
  <table>
    <tr>
      <th>NFT NAME</th>
      <th>NFT LOGO</th>
      <th>AMOUNT</th>
      <th>STATUS</th>
      <th>ACTION</th>
 
    </tr>
    
    
    
    
    <?php 
									$i = 1;
					$sql= "SELECT * FROM market WHERE status='approved' AND mstatus = 'ACTIVE'  ORDER BY id DESC ";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){   

            ?>
     
             
  
                        <tr>
                          <td><?php echo $row['name'];?> </td>
                          <td ><img src="nft/<?php echo $row['logo'];?>"  height="100px"  width="100px" > </td>
                          <td><?php echo $row['amount'];?>  ETH</td>
                          <td><?php echo $row['mstatus'];?></td>
                          <td>
                          
                          
                             <form method="POST" action="buy_now.php">
                          
                            <input type="hidden" name="nft_id"  value="<?php echo $row['id'];?>"/>
                            
                            <input type="submit" class="default-btn move-top" name="buy_now" role="button"  value="Buy Now" />
                             </form>
                          
                          </td>
                     
                        </tr>
 <?php } } ?>
             
				   
    
  
 
  </table>
</div>
 

</div>


<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">

<div class="modal-content">
<div class="modal-body mx-auto">
<h5 class="text-center mt-20"><font color="black">Alert!!!</font></h5>
<center><h4><font color="black">John Field, Send payment to Company's ethereum wallet below to have sole right to this piece of art.</font></h4></center>
<center>
<p class="mb-20">
<img src="content/chart.png">
</p>
 </center>
<div class="input-group mb-20">
<input id="myInput" type="text" class="form-control text-center" readonly="readonly" value="0x600907BF773aD0E762518902eFa9Fa344601f02D">
<span style="display: inline;" class="input-group-btn">
<button onclick="this.innerHTML='Copied'; this.classList.remove('btn-success');this.classList.add('btn-warning');" class="btn btn-success" type="button" id="copy-button" data-toggle="tooltip" data-placement="button" data-clipboard-target="#myInput" title="Copy to Clipboard">Copy</button>
</span>
</div>
<br>
<center>
<a href="#" class="btn btn-success btn-lg mb-20" style="font-size: 20px; font-weight: bold;">Pay Using Wallet App</a>
</center>
<br>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="myModal1" role="dialog">
<div class="modal-dialog">

<div class="modal-content">
<div class="modal-header">
<h4>Confirm Payment</h4>
</div>
<div class="modal-body">
<center><font color="black">
I confirmed that i (<strong>John Field</strong>), just sent the amount am entering below to the company's wallet.</font>
<br><br>
<form class="form-horizontal" method="POST" action="ipaid.php">
<div class="form-group">
<div class="col-sm-10">
<input type="text" class="form-control" id="amount" placeholder="Amount Sent" name="amount">
</div>
</div>
<div class="form-group">
<div class="col-sm-10">
<input type="text" class="form-control" id="name" placeholder="Nft Collected" name="name">
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="ipaid" class="btn btn-success btn-lg mb-20" style="font-size: 20px; font-weight: bold;">Submit</button>
</div>
</div>
</form></center>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<?php include 'footer.php'; ?>