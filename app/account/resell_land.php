<?php
include "../conn.php";
include "../config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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


if(isset($_POST['resell'])){
    $msgre = "";

    if (empty($_POST["nft"])) {
        $msgre = "Land collection is required";
        echo "<script> alert('Land collection is required');
        window.location.href = 'index.php';
        </script>";
      } else {
        $nft_n = $link->real_escape_string($_POST["nft"]);
       
      }

      if (empty($_POST["amount"])) {
        $msgre = "Amount to sell for is required";
        echo "<script> alert('Amount to sell for is required');
        window.location.href = 'index.php';
        </script>";
      } else {

        $nft_p = $link->real_escape_string($_POST["amount"]);
       
      }

      $sql1re = "SELECT * FROM market WHERE id = '$nft_n' AND email = '$email' AND mstatus = 'BOUGHT' AND type = 'Land' LIMIT 1";
    $resultre = mysqli_query($link, $sql1re);
    if(mysqli_num_rows($resultre) > 0){
      $row1buy = mysqli_fetch_assoc($resultre);
      $nftbuyname = $row1buy['name'];
      $nftbuyref = $row1buy['ref'];

    }else{
        $msgre = "dgd";
        echo "<script> alert('Land not found in your collections');
        window.location.href = 'index.php';
        </script>";
    }

    if(empty($msgre)){


               
              
        $sqlu11 = "UPDATE market SET mstatus = 'ACTIVE', amount = '$nft_p'  WHERE email = '$email' AND id = '$nft_n' AND type = 'Land'";

                if(mysqli_query($link, $sqlu11)){
                   
                   
                    
                   include_once "../PHPMailer/PHPMailer.php";
                   require_once '../PHPMailer/Exception.php';
       
         $mail= new PHPMailer();
          $mail->setFrom($emaila);
        $mail->FromName = $name;
         $mail->addAddress($email);
         $mail->Subject = "Land Listed Successfully";
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
                                                                  <div>Your Land collection has been listed on the marketplace successfully!<b> .<br></b></div>
                                                                  <div><b><br></b></div>
                                                                  <div><b>Details :<br></b></div>
                                                                  <div><br></div>
                                                                  <div>Amount : '.$nft_p.' ETH</div>
                                                                  <div>Land Name: '.$nftbuyname.'</div>
                                                                  <div>REF No : '.$nftbuyref.' <br></div>
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
                     
                  
                }
               
        
     
        }

}else{
    echo "<script> 
        window.location.href = 'index.php';
        </script>";
        die();
}

?>
 




<!DOCTYPE html>

 
<html lang="en">

<head>
 
	  <meta name="viewport" content="width=device-width, initial-scale=1"><meta name="theme-color" content="#000000">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
 
<meta name="description" content="Manage your banking and business in one place. Open a business bank account in 5 minutes, built to help 
you succeed. Entrepreneurs ðŸ’œ Land Open Wave Digital Land Trading Company"> 
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>Success page</title> 
 
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <script>
$(document).ready(function(){
$("#myModal").modal({
show:true,
backdrop:'static'
});
});
</script>
 


 
  
  
<style>
    .bs-example{
    	margin: 20px;
    }
    
    
 
</style>
</head>
<body style="background-image:url(assets/img/bg3.jpg);">
<div class="bs-example">
  
    
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color:green; font-weight:700">SUBMITTED SUCCESSFULLY</h5> 
                </div>
                <div class="modal-body">
                    <center><img src='assets/logo-ok-png-2.png' width='70px'  /></center>
                    <form  action="marketplace_land.php"  method="POST" >
               
               
 



               
              <center> <p>Your Land collection has been listed on the marketplace successfully!</p></center>
   
               
                                        
                                        
                <div>
                     
                    <center><button type="submit"  class="btn btn-danger">OKAY</button></center>
                </div>
            </form>
               </div>
               
                <br><br>
            </div>
        </div>
    </div>
</div>
</body>
</html>