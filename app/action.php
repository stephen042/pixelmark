<?php
session_start();
// Include config file
include "conn.php";
include "config.php";

$msg = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$is_error = "";

//register

if (isset($_POST["action"]) && $_POST["action"] == "register") {



   // Validate email
   if (empty(trim($_POST["email"]))) {
      echo "Please enter an email.";
      $is_error = 1;
   } else {
      // Prepare a select statement
      $sql = "SELECT id FROM users WHERE email = ?";

      if ($stmt = mysqli_prepare($link, $sql)) {
         // Bind variables to the prepared statement as parameters
         mysqli_stmt_bind_param($stmt, "s", $param_email);

         // Set parameters
         $param_email = trim($_POST["email"]);

         // Attempt to execute the prepared statement
         if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
               echo "This email is already taken.";
               $is_error = 1;
            } else {
               $email = trim($_POST["email"]);
            }
         } else {
            echo "Oops! Something went wrong. Please try again later.";
            $is_error = 1;
         }
      }

      // Close statement
      mysqli_stmt_close($stmt);
   }



   // Validate password
   if (empty(trim($_POST["password"]))) {
      echo  "Please enter a password.";
      $is_error = 1;
   } elseif (strlen(trim($_POST["password"])) < 6) {
      echo  "Password must have atleast 6 characters.";
      $is_error = 1;
   } else {
      $password = trim($_POST["password"]);
   }

   if (empty($_POST["captcha"])) {
      echo "Captcha is required";
      $is_error = 1;
   } else {
      $captcha = trim($_POST["captcha"]);
      $ocaptcha = trim($_POST["ocaptcha"]);
      if ($captcha != $ocaptcha) {
         echo "Captcha does not match!";
         $is_error = 1;
      }
      // check if name only contains letters and whitespace

   }



   // Check input errors before inserting in database
   if (empty($is_error)) {



      $token = 'kllcabcdg19etsfjhdshdsh35678gwyjerehuhbdTSGSAWQUJHDCSMNBVCBNRTPZXMCBVN';
      $token = str_shuffle($token);
      $token = substr($token, 0, 30);

      $uname = trim($_POST["name"]);


      // Prepare an insert statement
      $sql = "INSERT INTO users (fname, email, password, picture, token) VALUES (?, ?, ?, ?, ?)";

      if ($stmt = mysqli_prepare($link, $sql)) {
         // Bind variables to the prepared statement as parameters
         mysqli_stmt_bind_param($stmt, "sssss", $param_fullname, $param_email, $param_password, $param_picx, $param_token);

         // Set parameters
         $param_fullname = $uname;
         $param_email = $email;
         $param_password = $password;
         $param_picx = "user.png";
         $param_token = $token;


         // Attempt to execute the prepared statement
         if (mysqli_stmt_execute($stmt)) {

            require_once "PHPMailer/PHPMailer.php";
            require_once 'PHPMailer/Exception.php';


            //PHPMailer Object
            $mail = new PHPMailer;
            
            //From email address and name
            $mail->setFrom($emaila);
            $mail->FromName = $name;


            $mail->addAddress("$email"); //Recipient name is optional

            //Address to which recipient will reply

            //Send HTML or Plain Text email
            $mail->isHTML(true);

            $mail->Subject = "Welcome Message";
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
                                                                              <td style="color:rgb(255,255,255);font-family:Muli,Arial,sans-serif;font-size:20px;line-height:46px;padding-bottom:25px;font-weight:bold">Hi ' . $uname . ' ,</td>
                                                                           </tr>
                                                                           <tr>
                                                                              <td style="color:rgb(193,205,220);font-family:Muli,Arial,sans-serif;font-size:20px;line-height:30px;padding-bottom:25px">
                                                                                 <div>Welcome to <b>' . $name . '</b>, Thank you for choosing MintSeaSpace-NFT as your trading platform. Your creator account has been successfully created. Make sure to keep your login details safe for future references. For safety and security, never share your login details or password with anyone.<b> .<br></b>

                                                                                 <br>
                                                                                 <br>
                                                                                 As a registered trader of MintSeaSpace-NFT , you can now access:
                  A large list of tradeable assets (NFT) using the Quirky trading platform And Ethereum network. Important notice: Trading account reflects the trading conditions of a platinum account type. Should you have any questions or concerns, please contact us at MintSeaSpace-NFT .org with your email or your updated contact number or visit our contact us page. If you prefer to contact us directly, or use the live chat in our site. You’re just a few steps away from trading with us.
                                                                                    <br>
                                                                                    <br>
                                                                                    Disclaimer:
                  MintSeaSpace-NFT is offering to rent hardware to clients for mining purposes. Clients that only rent hardware under investment considerations are reminded to carefully access the underlying risks of such an investment in hardware themselves. Join over 500,000 people with the world leading hashpower provider!
                                                                                    <br>
                                                                                    <br>
                                                                                    Your Happy Trading Support Team,
                  MintSeaSpace-NFT Inc.
                                                                                    <br>
                                                                                    <br>
                                                                                    <center> <a href="https://' . $bankurl . '/login.php" style="
                                                                                 color: #fff;
                                                                                 text-decoration: none;
                                                                                 background: blue;
                                                                                 padding: 16px;
                                                                                 border-radius: 10px;
                                                                              ">Login Your Account </a> </center>

                                                                              <br>
                                                                              <br>
                                                                                 </div>
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
                        </table>

                  ';
            if (!$mail->send()) {
            } else {
            }
            echo "register";
            mysqli_query($link, "UPDATE users SET gasfee='$gasfeew' WHERE email='$param_email'");
         } else {
            echo "Something went wrong. Please try again later.";
         }
      }

      // Close statement
      mysqli_stmt_close($stmt);
   }

   // Close connection
   mysqli_close($link);
}



//login

if (isset($_POST["action"]) && $_POST["action"] == "login") {

   if (empty($_POST["email"])) {
      echo "E-mail is required";
      $is_error = 1;
   } else {
      $email = test_input($_POST["email"]);
   }


   if (empty($_POST["password"])) {
      echo "Password is required";
      $is_error = 1;
   } else {
      $password = test_input($_POST["password"]);
      // check if name only contains letters and whitespace

   }

   if (empty($_POST["captcha"])) {
      echo "Captcha is required";
      $is_error = 1;
   } else {
      $captcha = trim($_POST["captcha"]);
      $ocaptcha = trim($_POST["ocaptcha"]);
      if ($captcha != $ocaptcha) {
         echo "Captcha does not match!";
         $is_error = 1;
      }
      // check if name only contains letters and whitespace

   }

   $email = $link->real_escape_string($_POST['email']);
   $password = $link->real_escape_string($_POST['password']);
   //$ip = $_SERVER['REMOTE_ADDR'];


   if ($email == "" || $password == "") {
      echo "E-mail or Password fields cannot be empty!";
   } else {
      $sql = $link->query("SELECT id,email,password FROM users WHERE email='$email' AND password= '$password' LIMIT 1");
      if ($sql->num_rows > 0) {
         $data = $sql->fetch_array();


         if ($sql1 = "SELECT * FROM users WHERE email='$email'  AND password='$password' LIMIT 1") {

            $result1 = $link->query($sql1);
            if (mysqli_num_rows($result1) > 0) {
               $row = mysqli_fetch_array($result1);

               $uverify = $row['verify'];
               
               if ($uverify == 0 || $uverify == 1) {
                  $_SESSION['email'] = $row['email'];

                  echo "login";
               }
            } else {
               echo "Cannot Send!";
            }
         }
      } else {

         echo "E-mail or Password incorrect!";
      }
   }
}



//forgot password

if (isset($_POST["action"]) && $_POST["action"] == "forgot") {

   if (empty($_POST["email"])) {
      echo "Email is required";
   } else {
      $email = test_input($_POST["email"]);
   }

   $email = $link->real_escape_string($_POST['email']);


   if ($email == "") {
      echo "email fields cannot be empty!";
   } else {


      $sql = "SELECT * FROM users WHERE email = '$email' ";

      $result = mysqli_query($link, $sql);
      if (mysqli_num_rows($result) == 1) {
         $row = mysqli_fetch_assoc($result);
         $password = $row['password'];
         $ufname = $row['fname'];




         require_once "PHPMailer/PHPMailer.php";
         require_once 'PHPMailer/Exception.php';


         //PHPMailer Object
         $mail = new PHPMailer;

         //From email address and name
         $mail->setFrom($emaila);
         $mail->FromName = $name;

         //To address and name
         $mail->addAddress($email);


         //Address to which recipient will reply

         //Send HTML or Plain Text email
         $mail->isHTML(true);

         $mail->Subject = "Password Reset";
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
                                                          <td style="color:rgb(255,255,255);font-family:Muli,Arial,sans-serif;font-size:20px;line-height:46px;padding-bottom:25px;font-weight:bold">Hi ' . $ufname . ' ,</td>
                                                       </tr>
                                                       <tr>
                                                          <td style="color:rgb(193,205,220);font-family:Muli,Arial,sans-serif;font-size:20px;line-height:30px;padding-bottom:25px">
                                                             <div>You requested for a forgot password<b> .<br></b></div>
                                                             <div><b><br></b></div>
                                                             <div><br></div>
                                                             <div>Your Passowrd is : ' . $password . ' </div>
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
    </table>  
                ';

         if (!$mail->send()) {
            echo "Something went wrong. Please try again later.";
         } else {
            echo "Check Your Email to get your password";
         }
      } else {
         echo "Email address not found!";
      }
   }
}


function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
