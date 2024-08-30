<?php
session_start(); 
include "../conn.php";
include "../config.php";

$tnxid = $link->real_escape_string($_POST["tnxid"]);
$cdate = date('Y-m-d H:i:s');

    
function coinpayments_api_call($cmd, $txid, $publicwt, $privatewt, $req = array()) {
    // Fill these in from your API Keys page
   
     $public_key = $publicwt;
     $private_key = $privatewt;

    //Set the API command and required fields
    $req['version'] = 1;
    $req['cmd'] = $cmd;
    $req['txid'] = $txid;
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
$result = coinpayments_api_call('get_tx_info',$tnxid,$publicw,$privatew);
// print_r($result);
if($result['error'] == "ok"){
  $status = $result['result']['status'];
  $amount1 = $result['result']['receivedf'];
   
   
   
    $sql12 = "SELECT * FROM btc WHERE tnxid = '$tnxid' LIMIT 1";
    $result2 = mysqli_query($link, $sql12);
    
    if(mysqli_num_rows($result2) > 0){
        
      $row12 = mysqli_fetch_assoc($result2);
        $ustatus = $row12['status'];
        $uemail = $row12['email'];
        $uamount = $row12['usd'];
        $uallamount = $row12['allamount'];
        

    
         $sql1= "SELECT * FROM users WHERE email = '$uemail' LIMIT 1";
			  $result1 = mysqli_query($link,$sql1);
			  if(mysqli_num_rows($result1) > 0){
			      
			      $rowus = mysqli_fetch_assoc($result1);
			      
			      $referred = $rowus['referred'];
			  }
        
        if($ustatus != "approved"){
            
            
           if ($status >= 100 || $status == 2) {
               
                // Check amount against order total
    if ($amount1 < $uallamount) {
        errorAndDie('Amount is less than order total!');
    }else{
               
        // payment is complete or queued for nightly payout, success
        
        $sql = "UPDATE btc SET status = 'approved' WHERE tnxid = '$tnxid'";
            
            mysqli_query($link, $sql);
 
		      
		            if(mysqli_query($link, $sql)){

     
          $sql6 = "UPDATE users SET balance = balance + $uamount  WHERE email = '$uemail' LIMIT 1'";
		      mysqli_query($link, $sql6);


            echo "correct";
          }
		      
		      
		      
    }
        
    }elseif($status == 0){
    
    echo "pend";
    }else{
        echo "fail";
    }  
        
    }
    }
   
   
}else{
//echo "me";
    
    
}

    
    ?>