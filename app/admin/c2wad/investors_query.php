<?php

  //fetch total investors that requested withdrawal//

$sql3= "SELECT * FROM market WHERE buystatus = 'BOUGHT' AND status = 'approved' AND type = '' ";
			  $result3 = mysqli_query($link,$sql3);
			  if(mysqli_num_rows($result3) > 0){
			  $total3= mysqli_num_rows($result3);
				
 			  }else{
				$total3 = 0  ;
			  }


			    //fetch total investors that requested withdrawal//

$sql3land= "SELECT * FROM market WHERE buystatus = 'BOUGHT' AND status = 'approved' AND type = 'Land' ";
$result3land = mysqli_query($link,$sql3land);
if(mysqli_num_rows($result3land) > 0){
$total3land= mysqli_num_rows($result3land);
  
 }else{
  $total3land = 0  ;
}

//fetch total investors online

$sql2= "SELECT * FROM users WHERE session = 1 ";
			  $result2 = mysqli_query($link,$sql2);
			  
			  if(mysqli_num_rows($result2) > 0){
				 
              $total2= mysqli_num_rows($result2);
				
 
			  }else{

				$total2 = 0  ;

			  }


		
			  
//fetch total investors that registered

$sql= "SELECT * FROM users ";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				
              $total= mysqli_num_rows($result);
				
			  }else{
				$total = 0  ;
			  }
			  
			  
//fetch total investors that has invested
 
$sql1= "SELECT * FROM market WHERE status = 'approved' AND type = ''";
			  $result1 = mysqli_query($link,$sql1);
			  if(mysqli_num_rows($result1) > 0){
		 
              $total1= mysqli_num_rows($result1);
				
			  }	else{
				$total1 = 0  ;
			  }	
			  
			  
			  //fetch total investors that has invested
 
$sql1land= "SELECT * FROM market WHERE status = 'approved' AND type = 'Land'";
$result1land = mysqli_query($link,$sql1land);
if(mysqli_num_rows($result1land) > 0){

$total1land= mysqli_num_rows($result1land);
  
}	else{
  $total1land = 0  ;
}	



////////

	$sql_qry1="SELECT SUM(usd) AS count FROM btc WHERE type = 'Withdrawal' AND status = 'approved' ";

$duration1 = $link->query($sql_qry1);
while($record1 = $duration1->fetch_array()){
    $withdraw = $record1['count'];
	}
	
	
	
////////

	$sql_qry="SELECT SUM(usd) AS counter FROM btc WHERE type = 'Deposit' AND status = 'approved' ";

if($duration = $link->query($sql_qry)){
while($record = $duration->fetch_array()){
    $deposit = $record['counter'];
	}
}else{
				$deposit = 0  ;
			  }




			  $sql_qryba="SELECT SUM(balance) AS counter FROM users  ";

if($durationba = $link->query($sql_qryba)){
while($recordba = $durationba->fetch_array()){
    $userba = $recordba['counter'];
	}
}else{
				$userba = 0  ;
			  }
	
	
?>


