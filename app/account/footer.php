
<style>
.divv {
  background-color: #343A40;
}
</style>
  
     
		
		
		
		
		
<footer>
<div class="footer-area divv">
<p>Copyright &copy; 2020 - 2024. All right reserved. Pixelmarkeverse</a>.</p>
</div>
</footer>
<?php
$sqld = "SELECT * FROM btc WHERE email='$email' AND status='pending' AND mode = 'Instant' AND type='Deposit'";
			  $resultut = mysqli_query($link,$sqld);
			  if(mysqli_num_rows($resultut) > 0){
				  while($row = mysqli_fetch_assoc($resultut)){   
            $tx_date = strtotime($row['date']) + $row['timeout'];
            
           $cdate = date('Y-m-d H:i:s');
           $ucdate = strtotime(date('Y-m-d H:i:s'));
           
           $tnx_id = $row['tnxid'];
           $ustatus = $row['status'];
        $uemail = $row['email'];
        $uamount = $row['usd'];
        $uallamount = $row['allamount'];
        
           if($ucdate > $tx_date){
               
               $sqld1 = "DELETE FROM btc WHERE tnxid='$tnx_id'";
			 mysqli_query($link,$sqld1);
			  
           }else{
               
               
    // Fill these in from your API Keys page
    $public_key = $publicw;
    $private_key = $privatew;
    

    //Set the API command and required fields
    $req['version'] = 1;
    $req['cmd'] = 'get_tx_info';
    $req['txid'] = $tnx_id;
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
            $result = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
        } else {
            $result = json_decode($data, TRUE);
        }
        if ($result !== NULL && count($result)) {
          
            
            if($result['error'] == "ok"){
  $status = $result['result']['status'];
  $amount1 = $result['result']['receivedf'];
   
        
            
           if ($status >= 100 || $status == 2) {
               
                // Check amount against order total
    if ($amount1 < $uallamount) {
        errorAndDie('Amount is less than order total!');
    }else{
               
        // payment is complete or queued for nightly payout, success
        
        $sql = "UPDATE btc SET status = 'approved' WHERE tnxid = '$tnx_id'";
            
            mysqli_query($link, $sql);
    
   
		      
		    
          if(mysqli_query($link, $sql)){

     
            $sql6 = "UPDATE users SET balance = balance + $uamount  WHERE email = '$uemail' LIMIT 1'";
            mysqli_query($link, $sql6);
  
  
           
            }
		      
    }
        
    }elseif($status == 0){
    
   
    }else{
        
    }  
        
    
    
   
   
}else{
  
    
    
}
        } else {
            // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message

        }
    } else {
       
    }





               
           }
           
				  }

        }

          ?>


<script src="../content/jquery-3.6.0.min.js"></script>
<script src="../content/bootstrap.bundle.min.js"></script>
<script src="../content/waypoints.min.js"></script>
<script src="../content/lightcase.js"></script>
<script src="../content/swiper-bundle.min.js"></script>
<script src="../content/countdown.min.js"></script>
<script src="../content/jquery.counterup.min.js"></script>
<script src="../content/wow.min.js"></script>
<script src="../content/isotope.pkgd.min.js"></script>
<script src="../content/functions.js"></script>
<script>
    (function newFact() {
  var facts = ['@Michael', '@Christopher', '@Jessica',  '@Matthew', '@Ashley', '@Jennifer', '@Joshua', '@Amanda', '@Daniel', '@David', '@James', '@Robert', '@John', '@Joseph', '@Andrew', '@Ryan', '@Brandon', '@Jason', '@Justin', '@Sarah', '@William', '@Jonathan', '@Stephanie', '@Brian', '@Nicole', '@Nicholas', '@Anthony', '@Heather', '@Eric', '@Elizabeth', '@Adam', '@Megan', '@Melissa', '@Kevin', '@Steven', '@Thomas', '@Timothy', '@Christina', '@Kyle', '@Rachel', '@Laura', '@Lauren', '@Amber', '@Brittany', '@Danielle'];
  
  
  //top collectors
  var randomFact = Math.floor(Math.random() * facts.length);
  document.getElementById('p1').innerHTML = facts[randomFact];
  
  var randomFact1 = Math.floor(Math.random() * facts.length);
  document.getElementById('p2').innerHTML = facts[randomFact1];
  
  var randomFact2 = Math.floor(Math.random() * facts.length);
  document.getElementById('p3').innerHTML = facts[randomFact2];
  
  var randomFact3 = Math.floor(Math.random() * facts.length);
  document.getElementById('p4').innerHTML = facts[randomFact3];
  
  var randomFact4 = Math.floor(Math.random() * facts.length);
  document.getElementById('p5').innerHTML = facts[randomFact4];
  
  var randomFact5 = Math.floor(Math.random() * facts.length);
  document.getElementById('p6').innerHTML = facts[randomFact5];
  
  var randomFact6 = Math.floor(Math.random() * facts.length);
  document.getElementById('p7').innerHTML = facts[randomFact6];
  
  var randomFact7 = Math.floor(Math.random() * facts.length);
  document.getElementById('p8').innerHTML = facts[randomFact7];
  
  var randomFact8 = Math.floor(Math.random() * facts.length);
  document.getElementById('p9').innerHTML = facts[randomFact8];
  
  var randomFact9 = Math.floor(Math.random() * facts.length);
  document.getElementById('p10').innerHTML = facts[randomFact9];
  
  var randomFact10 = Math.floor(Math.random() * facts.length);
  document.getElementById('p11').innerHTML = facts[randomFact10];
  
  var randomFact11 = Math.floor(Math.random() * facts.length);
  document.getElementById('p12').innerHTML = facts[randomFact11];
  
  var randomFact12 = Math.floor(Math.random() * facts.length);
  document.getElementById('p13').innerHTML = facts[randomFact12];
  
  var randomFact13 = Math.floor(Math.random() * facts.length);
  document.getElementById('p14').innerHTML = facts[randomFact13];
  
  var randomFact14 = Math.floor(Math.random() * facts.length);
  document.getElementById('p15').innerHTML = facts[randomFact14];
  
  
  //hot collectors
  
  var randomFact15 = Math.floor(Math.random() * facts.length);
  document.getElementById('p16').innerHTML = facts[randomFact15];
  
  var randomFact16 = Math.floor(Math.random() * facts.length);
  document.getElementById('p17').innerHTML = facts[randomFact16];
  
  var randomFact17 = Math.floor(Math.random() * facts.length);
  document.getElementById('p18').innerHTML = facts[randomFact17];
  
  var randomFact18 = Math.floor(Math.random() * facts.length);
  document.getElementById('p19').innerHTML = facts[randomFact18];
  
  
  // featured assets
  
  var randomFact19 = Math.floor(Math.random() * facts.length);
  document.getElementById('p20').innerHTML = facts[randomFact19];
  
  var randomFact20 = Math.floor(Math.random() * facts.length);
  document.getElementById('p21').innerHTML = facts[randomFact20];
  
  var randomFact21 = Math.floor(Math.random() * facts.length);
  document.getElementById('p22').innerHTML = facts[randomFact21];
  
  var randomFact22 = Math.floor(Math.random() * facts.length);
  document.getElementById('p23').innerHTML = facts[randomFact22];
  
  var randomFact23 = Math.floor(Math.random() * facts.length);
  document.getElementById('p24').innerHTML = facts[randomFact23];
  
  var randomFact24 = Math.floor(Math.random() * facts.length);
  document.getElementById('p25').innerHTML = facts[randomFact24];
  
  var randomFact25 = Math.floor(Math.random() * facts.length);
  document.getElementById('p26').innerHTML = facts[randomFact25];
  
  var randomFact26 = Math.floor(Math.random() * facts.length);
  document.getElementById('p27').innerHTML = facts[randomFact26];
  
  
  //live nft coll
  
  var randomFact27 = Math.floor(Math.random() * facts.length);
  document.getElementById('p28').innerHTML = facts[randomFact27];
  
  var randomFact28 = Math.floor(Math.random() * facts.length);
  document.getElementById('p29').innerHTML = facts[randomFact28];
  
  var randomFact29 = Math.floor(Math.random() * facts.length);
  document.getElementById('p30').innerHTML = facts[randomFact29];
  
  var randomFact30 = Math.floor(Math.random() * facts.length);
  document.getElementById('p31').innerHTML = facts[randomFact30];
 
})();
</script>
<script src="../content/vendor/jquery-2.2.4.min.js"></script>

<script src="../content/popper.min.js"></script>
<script src="../content/bootstrap.min.js"></script>
<script src="../content/owl.carousel.min.js"></script>
<script src="../content/metisMenu.min.js"></script>
<script src="../content/jquery.slimscroll.min.js"></script>
<script src="../content/jquery.slicknav.min.js"></script>

<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>

<script src="../content/line-chart.js"></script>

<script src="../content/pie-chart.js"></script>

<script src="../content/plugins.js"></script>
<script src="../content/sweetalert2.min.js"></script>
<script src="../content/scripts.js"></script>


 <script src="../assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Datatables JS -->
		<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script src="../assets/js/script.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<script src="../assets/php/js/home.js"></script>
		
		<!--<script src="//code.tidio.co/5zysfbaok0bx7vec65tuljjjffo85htq.js" async></script>-->
</body>
</html>














 