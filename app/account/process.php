<?php 
session_start(); 
include "../conn.php";
include "../config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$msg = "";

$sql1= "SELECT * FROM admin";
$result1 = mysqli_query($link,$sql1);
if(mysqli_num_rows($result1) > 0){
$row = mysqli_fetch_assoc($result1);


   if(isset($row['ewallet'])){
      $ethw = $row['ewallet'];
   }else{
      $ethw="Contact Our Support for address";
   }

}

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

$wdate = date('Y-m-d H:i:s');
if(isset($_POST['deposit'])){

    if (empty($_POST["amount"])) {
        echo "<script>
        alert('Please input amount.');
        window.location.href='deposit.php';
        </script>";
      } else {
        $amount = $link->real_escape_string($_POST["amount"]);
       
      }
      
    

     

      if (empty($_POST["method"])) {
        echo "<script>
        alert('Please select deposit method.');
        window.location.href='deposit.php';
        </script>";
      } else {
        $method = $link->real_escape_string($_POST["method"]);
       
      }



    

        if($method == "Instant"){
              if ($amount < 0.009) {
        echo "<script>
        alert('Minimum amount to deposit is 0.009 ETH.');
        window.location.href='deposit.php';
        </script>";
      } else{

            function coinpayments_api_call($cmd, $usdt, $coint, $uemail, $publicwt, $privatewt, $req = array()) {
                // Fill these in from your API Keys page
              
                $public_key = $publicwt;
                $private_key = $privatewt;
            
                //Set the API command and required fields
                $req['version'] = 1;
                $req['cmd'] = $cmd;
                $req['amount'] = $usdt;
                $req['currency1'] = 'ETH';
                $req['currency2'] = $coint;
                $req['buyer_email'] = $uemail;
                $req['key'] = $public_key;
                $req['format'] = 'json'; //supported values are json and xml
                
                // Generate the query string
                $post_data = http_build_query($req, '', '&');
            
                // Calculate the HMAC signature on the POST data
                $hmac = hash_hmac('sha512', $post_data, $private_key);
            
                // Create cURL handle and initialize (if needed)
                static $ch = NULL;
                if ($ch === NULL) {
                    $ch = curl_init('https://www.coinpayments.net/api.php');
                    curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                }
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            
                // Execute the call and close cURL handle
                $data = curl_exec($ch);
                // Parse and return data if successful.
                if ($data !== FALSE) {
                    if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
                        // We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
                        $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
                    } else {
                        $dec = json_decode($data, TRUE);
                    }
                    if ($dec !== NULL && count($dec)) {
                        return $dec;
                    } else {
                        // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
                        return array('error' => 'Unable to parse JSON result ('.json_last_error().')');
                    }
                } else {
                    return array('error' => 'cURL error: '.curl_error($ch));
                }
            }
            
            //Get current coin exchange rates
            $result = coinpayments_api_call('create_transaction',$amount,'ETH',$email,$publicw,$privatew);
            //print_r($result);
            //$result = json_decode($request, true);
            if($result['error'] == "ok"){
               
               $tnx_id = $result['result']['txn_id'];
               //$tnx_id = 'CPFI7WMTISBCLBIAX3CMHVPXXI';
               $timeout = $result['result']['timeout'];
               $address = $result['result']['address'];
               $amount = $result['result']['amount'];
               
               
               
               $sql12 = "SELECT * FROM btc WHERE tnxid = '$tnx_id' LIMIT 1";
                $result2 = mysqli_query($link, $sql12);
                if(mysqli_num_rows($result2) > 0){
                    
                }else{
               
                $sql = "INSERT INTO btc (usd, cointype, mode,allamount,email,status,tnxid,type,timeout,date)
                        VALUES ('$amount','Ethereum','Instant','$amount','$email','pending','$tnx_id','Deposit','$timeout','$wdate')";
                        
                        if (mysqli_query($link, $sql)) {
                            include_once "../PHPMailer/PHPMailer.php";
                            require_once '../PHPMailer/Exception.php';
                          
                            $mail= new PHPMailer();
                            $mail->setFrom($emaila);
                             $mail->FromName = $name;
                            $mail->addAddress($email);
                            $mail->Subject = "Deposit Alert!";
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
                                                                                     <div>Your deposit is currently under reviews, your balance will be credited once your deposit is confirmed.<b> .<br></b></div>
                                                                                     <div><b><br></b></div>
                                                                                     <div><b>Details of your Deposit:<br></b></div>
                                                                                     <div><br></div>
                                                                                     <div>Amount : '.$amount.' ETH</div>
                                                                                     <div>Deposit Method : Instant</div>
                                                                                     <div>Transaction ID : '.$tnx_id.'</div>
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
                            ' ;
                          
                          
                          
                           if($mail->send()){
                          
                                  
                            }

                        }
                        
                }
                
            }

       } }else{

            $address = $ew;


        }
    
    

}elseif(isset($_POST['submit'])){


    

    if (empty($_POST["amount"])) {
        $msg= "Amount is required";
      } else {
        $amount = $link->real_escape_string($_POST["amount"]);
       
      }
      
    
    if(empty($msg)){
        $tnx = uniqid('tnx');
        $sql = "INSERT INTO btc (usd,cointype,mode,email,status,tnxid,type)
        VALUES ('$amount','Ethereum','Manual','$email','pending','$tnx','Deposit')";
        
        if (mysqli_query($link, $sql)) {
        
        
          include_once "../PHPMailer/PHPMailer.php";
          require_once '../PHPMailer/Exception.php';
        
          $mail= new PHPMailer();
          $mail->setFrom($emaila);
           $mail->FromName = $name;
          $mail->addAddress($email);
          $mail->Subject = "Deposit Alert!";
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
                                                                   <div>Your deposit is currently under reviews, your balance will be credited once your deposit is confirmed.<b> .<br></b></div>
                                                                   <div><b><br></b></div>
                                                                   <div><b>Details of your Deposit:<br></b></div>
                                                                   <div><br></div>
                                                                   <div>Amount : '.$amount.' ETH</div>
                                                                   <div>Deposit Method : Manual</div>
                                                                   <div>Transaction ID : '.$tnx.' </div>
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
          ' ;
        
        
        
         if($mail->send()){
        
                
          }
    
             echo "<script>
            
            alert('Your deposit of ".$amount." ETH is currently under reviews, your transaction ID is ".$tnx." , your balance will be credited once your deposit is confirmed. ');
            window.location.href='deposit.php';
            </script>";     
        
        
        
        
        
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }

    }
   





}else{
    header("location: deposit.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title>Payment To Ethereum Wallet Address </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured cryptocurrency investment platform " name="description" />
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
<script src="../ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    </head>


    <body class="authentication-bg">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                     <div class="col-md-8 col-lg-8 col-xl-8">
                        <div class="text-center">
                        <?php  if($method == "Instant"){ ?>

                            <script>
    (function() {
  var start = new Date () / 1000;
 // start.setHours(23, 0, 0); // 11pm

  function pad(num) {
    return ("0" + parseInt(num)).substr(-2);
  }

  function tick() {
    var now = new Date() / 1000;
 
    var add = start + <?php echo $timeout; ?>;
    var remain = (add - now);
     if (remain < 0) { // too late, go to tomorrow
      alert('Countdown timeout for this transaction.');
      window.location.href='deposit.php';
    }else{
    var hh = pad((remain / 60 / 60) % 60);
    var mm = pad((remain / 60) % 60);
    var ss = pad(remain % 60);
    document.getElementById('time').innerHTML =
      hh + ":" + mm + ":" + ss;
    setTimeout(tick, 1000);
    }
  }

  document.addEventListener('DOMContentLoaded', tick);
})();
</script>
                            <?php } ?>
                        </div>
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                      <div id="google_translate_element" style="margin-bottom: 20px;"></div>
                                    <h4 class="text-uppercase mt-0">Ethereum Deposit Wallet Address</h4>
                                     <center><img src="eth.png" style="height: 100px;width:100px;"></center>
                                </div>

                                 <div style="text-align: center;">
                                      <div class="modal-body">
                                                    <p>The payment of <?php echo $amount;?> ETH should be sent to the ethereum address below: 
                                                    <?php  if($method == "Instant"){ ?>
                                                        <div class="c-100"><span><span>You have <strong><span id='time'></span></strong> minutes to initiate the transaction</span></span> </div>
                                                    <?php } ?>
                                                    </p>
                                                    <br>
                                                 
                                                    <div class="alert alert-info" role="alert">
                                                        <input type="text" value="<?php echo $ethw; ?>" id="myInput" style="width: 100%;text-align: center;">
                                                        <button onclick="myFunction()" class="btn btn-info btn-xs" style="margin-top: 20px;padding: 10px; font-size: 15px;font-weight: bold;">Copy Wallet Address</button>
                                                        
                                                    </div>
                                                    <br>
                                                    
                                                     <h4 class="text-uppercase mt-0"> Or Use Our Ethereum Deposit QR Code</h4>
                                                    <p>Scan Our Qr Code Below:</p>
                                                    <div>
                                                        <center>
                        <img src="./eth.jpg" style="width:200px;height:200px;">
                                                        </center>
                                                    </div> 
                                                    

                                                    <br>
                                                <?php  if($method == "Instant"){ ?>
                                                          <p><strong>Note: Payments should be made directly to the wallet address above and  your  account will be updated with the equivalent amount after confirmation in 30 minutes.</strong></p>
                                                          <?php }else{ ?>
                                                            <p><strong>Note: Click on the deposited button below after you have successfully made payment to the wallet address above.</strong></p>
                                                            
                                                            <form method="post">
                                                                <input type="hidden" name="amount" value="<?php echo $amount;?>"/>
                                                            <button type="submit" name="submit" class="btn btn-info btn-xs" style="padding: 10px; font-size: 15px;font-weight: bold;">Deposited</button>
                                                         
                                                        
                                                        </form>
                                                            <?php } ?>
                                                    <br>
                                                    <div class="alert alert-danger" role="alert">
                                                       <p>Once we confirm your payment, your account will be funded.</p>
                                                      
                                                    </div>
                                                     <a href="deposit.php"> <button type="button" class="btn btn-info btn-xs" style="margin-top: 20px;padding: 10px; font-size: 15px;font-weight: bold;">Go Back</button></a>

                                                     
                                      </div>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                      
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
 
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        <!-- jQuery -->
        <script src="../assets/js/jquery-3.2.1.min.js"></script>
       <script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>

 <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php  if($method == "Instant"){ ?>
<script>
function user_login(txid){
  
    
  jQuery.ajax({
      url:'success.php',
      type:'post',
      data:'tnxid='+txid,
      success:function(result){
          if(result == 'correct'){
              alert('Deposit has been found successfully, your investment has been activated!');
              window.location.href = 'deposit.php';
              //jQuery('#myTest').val('Correct!');
          }
          if(result == 'fail'){
              jQuery('#myTest').val('Failure o');
              setTimeout(user_login('<?php echo $tnx_id;?>'), 180000);
          }
          if(result == 'pend'){
              jQuery('#myTest').val('Pending');
              setTimeout(user_login('<?php echo $tnx_id;?>'), 180000);
          }
          if(result == 'failure'){
              jQuery('#myTest').val('Cant connect');
              setTimeout(user_login('<?php echo $tnx_id;?>'), 180000);
          }
      }
  });
  
   //setTimeout(user_login, 300000);

}



user_login('<?php echo $tnx_id;?>');

</script>

<?php } ?>
    </body>


</html>