<?php
// session_start();
include "../../config.php";
$msg = "";
use PHPMailer\PHPMailer\PHPMailer;


if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}


include "header.php";

include "investors_query.php";

?>


		
  <div class="content-wrapper">
  


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
       
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-white" id="demo">
            <div class="inner">
            <h4 ><i class="fa  fa-users" id="icon"  ></i> Total Users</h4>
              <h3 id="value"><?php echo $total;?></h3>

              
            </div>
            
           
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12" >
          <!-- small box -->
          <div class="small-box bg-white" id="demo">
            <div class="inner">
            <h4 ><i class="fa  fa-money" id="icons"  ></i> Total NFTs</h4>
              <h3> <?php echo $total1 ;?></h3>

             
            </div>
            
          </div>
        </div>
        <!--
           ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-white" id="demo">
            <div class="inner">
            <h4 ><i class="fa  fa-database" id="icone"  ></i>Total Purchased NFTS</h4>

              <h3>	<?php echo $total3;?></h3>

              
            </div>
            
           
          </div>
        </div>


          <!-- ./col -->
          <div class="col-lg-4 col-xs-12" >
          <!-- small box -->
          <div class="small-box bg-white" id="demo">
            <div class="inner">
            <h4 ><i class="fa  fa-money" id="icons"  ></i> Total Lands</h4>
              <h3> <?php echo $total1land ;?></h3>

             
            </div>
            
          </div>
        </div>
        <!--
           ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-white" id="demo">
            <div class="inner">
            <h4 ><i class="fa  fa-database" id="icone"  ></i>Total Purchased Lands</h4>

              <h3>	<?php echo $total3land;?></h3>

              
            </div>
            
           
          </div>
        </div>

         <!-- ./col -->
         <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-white" id="demo">
            <div class="inner">
            <h4 ><i class="fa  fa-database" id="icone"  ></i>Total User's Balance</h4>

              <h3>	<?php echo $userba;?> ETH</h3>

              
            </div>
            
           
          </div>
        </div>



        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-white" id="demo">
            <div class="inner">
            <h4 ><i class="fa  fa-history" id="icons"  ></i>Total Amount Withdrawn</h4>

              <h3><?php echo round($withdraw,2);?> ETH<h3>

              
            </div>
            
           
          </div>
        </div>
		
		
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-white" id="demo">
            <div class="inner">
            <h4 ><i class="fa  fa-history" id="icons"  ></i>Total Amount deposited</h4>

              <h3><?php echo round($deposit,2);?> ETH<h3>

              
            </div>
            
           
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-white" id="demo">
            <div class="inner">
            <h4 ><i class="fa  fa-bullhorn" id="icon"  ></i>My Package</h4>

              <h3>	</h3>

              
            </div>
            
           
          </div>
        </div>
        
      
        

              </div>
            </div>
           
        
        <!-- ./col -->
      </div>
      </section>
</div>     
       	
 
