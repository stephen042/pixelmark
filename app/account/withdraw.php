<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
session_start();
include "../conn.php";
include "../config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$msg = "";
if (isset($_SESSION['email'])) {

   $email = $link->real_escape_string($_SESSION['email']);

   $sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
   $result = mysqli_query($link, $sql1);
   if (mysqli_num_rows($result) > 0) {

      $row1 = mysqli_fetch_assoc($result);
      $ubalance = $row1['balance'];
      $fname = $row1['fname'];
      $gasfee = $row1['gasfee'];
      $picture = $row1['picture'];
   } else {


      header("location: ../login.php");
   }
} else {
   header('location: ../login.php');
   die();
}


if (isset($_POST['withdraw'])) {

   if (empty($_POST["amount"])) {
      $msg = "Amount is required";
   } else {
      $amount = $link->real_escape_string($_POST["amount"]);
   }

   if (empty($_POST["address"])) {
      $msg = "Wallet address is required";
   } else {
      $wallet = $link->real_escape_string($_POST["address"]);
   }
   if (empty($_POST["method"])) {
      $msg = "Mode is required";
   } else {
      $mode = $link->real_escape_string($_POST["method"]);
   }

   if ($amount > $ubalance) {
      $msg = "Insufficient Fund!";
      // die("$msg");
   }


   if (empty($msg)) {

      $tnx_id = "tnxW" . rand(100000000000, 999999999999) . "mint";
      $sqlu = "UPDATE users SET balance = balance - '$amount' WHERE email = '$email'";


      if (mysqli_query($link, $sqlu)) {

         $sqlu11 = "INSERT INTO btc (usd, cointype, email, wallet, mode, status, type, tnxid) VALUES ('$amount','Ethereum','$email', '$wallet', '$mode', 'Pending', 'Withdrawal', '$tnx_id') ";

         if (mysqli_query($link, $sqlu11)) {
            include_once "../PHPMailer/PHPMailer.php";
            require_once '../PHPMailer/Exception.php';

            $mail = new PHPMailer();
            $mail->setFrom($emaila);
            $mail->FromName = $name;
            $mail->addAddress($email, $username);
            $mail->Subject = "Withdrawal Request";
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
                           <img src="https://' . $bankurl . '/admin/c2wad/logo/' . $logo . '" style="height:240!important;width:338px;margin-bottom:20px" tabindex="0">
                           
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
                                                         <td style="color:rgb(255,255,255);font-family:Muli,Arial,sans-serif;font-size:20px;line-height:46px;padding-bottom:25px;font-weight:bold">Hi ' . $fname . ' ,</td>
                                                      </tr>
                                                      <tr>
                                                         <td style="color:rgb(193,205,220);font-family:Muli,Arial,sans-serif;font-size:20px;line-height:30px;padding-bottom:25px">
                                                            <div>Your withdrawal request has been done successfully! The fund will arrive to your wallet shortly<b> .<br></b></div>
                                                            <div><b><br></b></div>
                                                            <div><b>Details :<br></b></div>
                                                            <div><br></div>
                                                            <div>Amount : ' . $amount . ' ETH</div>
                                                            <div>Mode : ' . $mode . '</div>
                                                            <div>Ethereum Address: ' . $wallet . '</div>
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
                                             <td style="color:rgb(0,153,255);font-family:Muli,Arial,sans-serif;font-size:18px;line-height:30px;text-align:center;padding-bottom:10px">© ' . $cy . ' ' . $name . '. All Rights Reserved.</td>
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
   </table>';


            if ($mail->send()) {
            }
            echo "<script>
              alert('Your withdraw request of " . $amount . " USD through " . $mode . " has been done successfully! The fund will arrive to your wallet shortly. Note: The page will reload shortly.');
              </script> ";
            // PHP header to reload the page after a delay
            header("Refresh: 0"); // Refresh the page after 3 seconds
            exit(); // Ensure no further code is executed
         }
      }
   } else {
      $msg = " Something went wrong! Please check your details try again!";
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

   th,
   td {
      text-align: left;
      padding: 8px;
   }

   tr:nth-child(even) {
      background-color: black
   }

   tr:nth-child(odd) {
      background-color: grey
   }

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
                  <br>
                  <p class="text-white"><b><?= $msg ?></b></p>
               </div>
               <div class="col-7 text-right">
                  <p class="text-white"><?php echo $ubalance; ?> ETH</p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <h4 class="header-title"><i class="fa fa-money"></i> Withdrawal Request</h4>
               <form method="post" action="">
                  <div class="form-group">
                     <label for="withdrawal_method">Select Withdrawal Method</label>
                     <select name="method" class="form-control" id="withdrawalMethod" required>
                        <option value="">---Select Method---</option>
                        <option value="Ethereum">Ethereum</option>
                     </select>
                  </div>

                  <div id="beneficiaryField3" class="form-group">
                     <label for="ethereum_address">Ethereum Address</label>
                     <input class="form-control" type="text" name="address" placeholder="Enter Your Ethereum Address" id="ethereum_address" required>
                  </div>

                  <div class="form-group">
                     <label for="amount">Enter Withdrawal Amount</label>
                     <input class="form-control" type="text" name="amount" placeholder="0.00" id="amount" required>
                  </div>


                  <div class="form-group">
                     <button name="withdraw" type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Proceed</button>
                  </div>
               </form>
            </div>
         </div>

         <br><br>
         <div class="row">
            <div class="col-12 mb-3">
               <div class="card">
                  <div class="card-body">

                     <h3 class="card-title" style="color:black">Withdrawal History</h3>
                     <div class="table-responsive">
                        <table class="table table-hover">
                           <thead class="bg-light">
                              <tr style="background-color:black;">
                                 <th>#</th>
                                 <th>Method</th>
                                 <th>Ethereum Address</th>
                                 <th>Amount</th>
                                 <th>Status</th>
                                 <th>Date</th>

                              </tr>
                           </thead>

                           <tbody>

                              <?php
                              $i = 1;
                              $sql = "SELECT * FROM btc WHERE email='$email' AND type = 'Withdrawal' ORDER BY id DESC ";
                              $result = mysqli_query($link, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                 while ($row = mysqli_fetch_assoc($result)) {

                              ?>
                                    <tr>
                                       <td><?php echo $i; ?> </td>
                                       <td><?php echo $row['mode']; ?> </td>
                                       <td><?php echo $row['wallet']; ?> </td>
                                       <td><?php echo $row['usd']; ?> ETH</td>
                                       <td>
                                          <?php if ($row['status'] == "pending") { ?>
                                             <span style="background: #e00505;padding: 5px 10px;border-radius: 10px;"> <?php echo $row['status']; ?> </span>
                                          <?php } else { ?>
                                             <span style="background: #0c9902;padding: 5px 10px;border-radius: 10px;"> <?php echo $row['status']; ?> </span>
                                          <?php } ?>
                                       </td>
                                       <td><?php echo $row['date']; ?></td>


                                    </tr>
                              <?php $i++;
                                 }
                              } ?>


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
   $(function() {
      $("#withdrawalMethod").change(function() {
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