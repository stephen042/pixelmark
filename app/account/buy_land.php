<?php 

session_start(); 
include "../conn.php";
include "../config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$msg = $msgme = "";
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


if(isset($_POST['buy_now'])){
    if (empty($_POST["nft_id"])) {
        echo "<script>
        alert('Please select Land.');
        window.location.href='marketplace.php';
        </script>";
      } else {
        $nft_id = $link->real_escape_string($_POST["nft_id"]);
       
      }

      $sql1nft = "SELECT * FROM market WHERE id = '$nft_id' AND type = 'Land' LIMIT 1";
    $resultnft = mysqli_query($link, $sql1nft);
    if(mysqli_num_rows($resultnft) > 0){

        $row1nft = mysqli_fetch_assoc($resultnft);
        $nftname = $row1nft['name'];
        $nftusd = $row1nft['amount'];

    }
    

}

if(isset($_POST['buy'])){
    if (empty($_POST["unft_id"])) {
        $msg = "Land is required";
      } else {
        $unft_id = $link->real_escape_string($_POST["unft_id"]);
       
      }

    
      $sql1buy = "SELECT * FROM market WHERE id = '$unft_id' AND type = 'Land' LIMIT 1";
      $resultbuy = mysqli_query($link, $sql1buy);
      if(mysqli_num_rows($resultbuy) > 0){
  
          $row1buy = mysqli_fetch_assoc($resultbuy);
          $nftbuyname = $row1buy['name'];
          $nftbuyusd = $row1buy['amount'];
          $nftbuyemail = $row1buy['email'];
          $nftbuybuyer = $row1buy['buyer'];
          $nftbuylogo = $row1buy['logo'];
  
      }

      if ($nftbuyusd <= $ubalance) {
        
    }else{
        $msg= "Sorry! You Have Insufficient Fund! Please Deposit More Funds To Buy This Land";
    }

    $ref ='1234567890';
    $ref = str_shuffle($ref);
     $ref = "NFT".substr($ref,0, 10);

    if(empty($msg)){

        $sqlu1buy = "UPDATE users SET balance = balance - '$nftbuyusd' WHERE email = '$email'";
        mysqli_query($link, $sqlu1buy);

        $sqlu112 = "UPDATE market SET mstatus = 'SOLD', buyer = '$email' WHERE id = '$unft_id' AND type = 'Land'";

                if(mysqli_query($link, $sqlu112)){

                    if($nftbuyemail != "Admin"){
                        $sqlu1buysel = "UPDATE users SET balance = balance + '$nftbuyusd' WHERE email = '$nftbuyemail'";
                        mysqli_query($link, $sqlu1buysel);
                    }
                   

                $sqlu11 = "INSERT INTO market (name, email, ref, logo, amount, status, mstatus, buystatus, type) VALUES ('$nftbuyname', '$email', '$ref', '$nftbuylogo', '$nftbuyusd', 'approved', 'BOUGHT', 'BOUGHT', 'Land') ";
                if(mysqli_query($link, $sqlu11)){
                 
                   include_once "../PHPMailer/PHPMailer.php";
                   require_once '../PHPMailer/Exception.php';
       
         $mail= new PHPMailer();
          $mail->setFrom($emaila);
        $mail->FromName = $name;
         $mail->addAddress($email);
         $mail->Subject = "New Land Purchased";
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
                                                                  <div>You have successfully purchased a new Land<b> .<br></b></div>
                                                                  <div><b><br></b></div>
                                                                  <div><b>Details of your Purchase :<br></b></div>
                                                                  <div><br></div>
                                                                  <div>Amount : '.$nftbuyusd.' ETH</div>
                                                                  <div>Land Name: '.$nftbuyname.'</div>
                                                                  <div>REF No : '.$ref.' <br></div>
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
                    alert('You have successfully purchased Land ".$nftbuyname." for ".$nftbuyusd." ETH, the Ref No. is ".$ref.".');
                    
                    </script> ";
                    $msgme = "You have successfully purchased Land ".$nftbuyname." for ".$nftbuyusd." ETH, the Ref No. is ".$ref.".";
              
                }else{


                }
               
            }else{


            }
     
        }

}


include 'header.php'; ?>

 


 














 


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
<h4 class="header-title"><i class="fa fa-money"></i>BUY Land NOW</h4>



                        <form method="post" action="">
                            
                        <?php if($msg != "") echo "<div class='alert alert-danger'>
				<button class='close' data-dismiss='alert'>×</button>
					".$msg."
			  </div>";  
              if($msgme != "") echo "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>×</button>
                ".$msgme."
			  </div>";
              
              ?>
                        
                        <div  class="form-group" >
                        <label for="btc_address">Land SELECTED</label>
                        <input class="form-control" type="text" name="nft_name" value="<?php echo $nftname;?>" readonly >
                        </div>
                         
                        <div  class="form-group">
                        <label for="ethereum_address">PAYING AMOUNT (ETH)</label>
                        <input class="form-control" type="text" name="nft_amt" value="<?php echo $nftusd;?>" readonly>
                        </div>
                         
                 
                         
                         
                        
                    
                             <input type="hidden"  name="unft_id" value="<?php echo $nft_id;?>" />
                        <br>
                        
                        <div class="form-group">
                        <button name="buy" type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i>PAY NOW</button>
                        </div>
                        </form>
</div>
</div>
<div class="row">
<div class="col-12 mb-3">
</div>
</div>
</div>


</div>

</div>
</div>


<?php include 'footer.php'; ?>