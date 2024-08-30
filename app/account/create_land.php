<?php 

session_start(); 
include "../conn.php";
include "../config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$msg = "";
$msgme = "";
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




if(isset($_POST['upload'])){
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

      if($gasfeew > $ubalance){
        $msg= "Sorry! You Have Insufficient Fund to pay for the Gas Fee To Create This Land";
      }
    

    $nft_logo = $_FILES['nft_logo']['name'];
    $target = "land/".basename($nft_logo);

    $ref ='1234567890';
    $ref = str_shuffle($ref);
     $ref = "Land".substr($ref,0, 10);

    if(empty($msg)){

      $sqlu11fee = "UPDATE users SET balance = balance - '$gasfeew' WHERE email = '$email'";
      mysqli_query($link, $sqlu11fee);
               
              
                $sqlu11 = "INSERT INTO market (name, email, ref, logo, amount, status, mstatus, type) VALUES ('$nft_name', '$email', '$ref', '$nft_logo', '$nft_price', 'pending', 'PENDING', 'Land') ";
                if(mysqli_query($link, $sqlu11)){
                    move_uploaded_file($_FILES['nft_logo']['tmp_name'], $target);
                   
                    
                   include_once "../PHPMailer/PHPMailer.php";
                   require_once '../PHPMailer/Exception.php';
       
         $mail= new PHPMailer();
          $mail->setFrom($emaila);
        $mail->FromName = $name;
         $mail->addAddress($email);
         $mail->Subject = "New Land Created";
         $mail->isHTML(true);
         $mail->Body = '
         <table style="color:rgb(0,0,0);font-family:&quot;Times New Roman&quot;;font-size:medium;font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(0,23,54);text-decoration-style:initial;text-decoration-color:initial" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#001736">
         <tbody>
            <tr>
               <td valign="top" align="center">
                  <table width="650" cellspacing="0" cellpadding="0" border="0">
                     <tbody>
                        <tr>
                           <td style="width:650px;min-width:650px;font-size:0pt;line-height:0pt;margin:0px;font-weight:normal;padding:55px 0px">
                              <div style="text-align:center">
                                 <img src="https://'.$bankurl.'/admin/c2wad/logo/'.$logo.'" style="height:240!important;width:338px;margin-bottom:20px" tabindex="0">
                                 
                              </div>
                              <table style="width:650px;margin:0px auto" cellspacing="0" cellpadding="0" border="0">
                                 <tbody>
                                    <tr>
                                       <td style="padding-bottom:10px">
                                          <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                             <tbody>
                                                <tr>
                                                   <td style="padding:60px 30px;border-radius:26px 26px 0px 0px" bgcolor="#000036">
                                                      <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                         <tbody>
                                                            <tr>
                                                               <td style="color:rgb(255,255,255);font-family:Muli,Arial,sans-serif;font-size:20px;line-height:46px;padding-bottom:25px;font-weight:bold">Hi '.$fname.' ,</td>
                                                            </tr>
                                                            <tr>
                                                               <td style="color:rgb(193,205,220);font-family:Muli,Arial,sans-serif;font-size:20px;line-height:30px;padding-bottom:25px">
                                                                  <div>You have successfully created a new Land<b> .<br></b></div>
                                                                  <div><b><br></b></div>
                                                                  <div><b>Details :<br></b></div>
                                                                  <div><br></div>
                                                                  <div>Amount : '.$nft_price.' ETH</div>
                                                                  <div>Gas Fee : '.$gasfeew.' ETH</div>
                                                                  <div>Land Name: '.$nft_name.'</div>
                                                                  <div>REF No : '.$ref.' <br></div>
                                                                  <div>Status : Pending <br></div>
                                                                  <div><br></div>
                                                                  <div><br></div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table style="width:650px;margin:0px auto" cellspacing="0" cellpadding="0" border="0">
                                 <tbody>
                                    <tr>
                                       <td style="padding:50px 30px;border-radius:0px 0px 26px 26px" bgcolor="#000036">
                                          <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                             <tbody>
                                                <tr>
                                                   <td style="color:rgb(0,153,255);font-family:Muli,Arial,sans-serif;font-size:18px;line-height:30px;text-align:center;padding-bottom:10px">© '.$cy.' '.$name.'. All Rights Reserved.</td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
         </table>
         
        
         ';
         
         
         if($mail->send()){
       
           
         }
                      echo "<script>
                    alert('Your Land ".$nft_name." has been created successfully, the Ref No. is ".$ref.". It will be availabe on the marketplace once it is approved.');
                    
                    </script> ";
                    $msgme = "Your Land ".$nft_name." has been created successfully, the Ref No. is ".$ref.". It will be availabe on the marketplace once it is approved.";
              
                }
               
        
     
        }

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
<h4 class="header-title"><i class="fa fa-money"></i>Create New Land</h4>
<form method="POST" enctype="multipart/form-data" action="create_land.php">
<?php if($msg != "") echo "<div class='alert alert-danger'>
				<button class='close' data-dismiss='alert'>×</button>
					".$msg."
			  </div>";  
              if($msgme != "") echo "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>×</button>
                ".$msgme."
			  </div>";
              
              ?>
<div class="form-group">
<label for="acct_name">Land Name</label>
<input class="form-control" type="text" name="nft_name" placeholder="Enter Land Name" required>
</div>
<div class="form-group">
<label for="acct_swift">Land Price (ETH)</label>
<input class="form-control" type="double" name="nft_price" placeholder="Enter Land Price" required>
</div>

<div class="form-group">
<label for="acct_swift">Select Land</label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
</div>
<div class="custom-file">
<input class="form-control" type="file" name="nft_logo" placeholder="Select Land" required>
</div>
</div>
</div>

<div class="form-group">
<button name="upload" type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Create</button>
</div>
</form>
</div>
</div>
<br><br>
<div class="row">
<div class="col-12 mb-3">
<div class="card">
<div class="card-body">
    
    
    
    
<h3 class="card-title" style="color:black">My Land Collections</h3>
<div class="table-responsive">
<table class="table table-hover">
<thead class="bg-light">
<tr style="background-color:black;">
<th>#</th>
<th>Name</th>
<th>Image</th>
<th>Price</th>
<th>Ref Number</th>
<th>Status</th>
<th>Buyer</th>
<th>Date</th>
</tr>
</thead>



        
			   

<tbody>
    
         
    <?php 
									$i = 1;
					$sql= "SELECT * FROM market WHERE email='$email' AND type = 'Land' ORDER BY id DESC ";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){   
                    $buyeremail = $row['buyer'];
                    $sqlmarkbuy = "SELECT * FROM users WHERE email = '$buyeremail' LIMIT 1";
        $resultmarkbuy = mysqli_query($link,$sqlmarkbuy);
        $rowauthor = mysqli_fetch_assoc($resultmarkbuy);

            ?>
     
             
  
                        <tr>
                        <td><?php echo $i;?> </td>
                          <td><?php echo $row['name'];?> </td>
                          <td ><img src="land/<?php echo $row['logo'];?>"  height="100px"  width="100px" > </td>
                          <td><?php echo $row['amount'];?>  ETH</td>
                          <td><?php echo $row['ref'];?></td>
                          <td><?php echo $row['mstatus'];?></td>
                          <td><?php echo $rowauthor['fname'];?></td>
                          <td><?php echo $row['created_on'];?></td>
                          
                     
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

<?php include 'footer.php'; ?>