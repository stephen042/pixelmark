<?php
session_start();


include "../../conn.php";
include "header.php";
$msg = "";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET['email'])) {
  $email = $_GET['email'];
} else {
  $email = '';
}


if (isset($_SESSION['uid'])) {
} else {


  header("location:../c2wadmin/signin.php");
}



$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
}
if (isset($row['email']) && isset($row['balance'])) {

  $email;
} else {


  $email =  '';
}



if (isset($_POST['edit'])) {


  $user_id = $_POST['user_id'];

  $emails = $link->real_escape_string($_POST['email']);
  $fname = $link->real_escape_string($_POST['fname']);
  $password = $link->real_escape_string($_POST['password']);
  $balance = $link->real_escape_string($_POST['balance']);
  $eth_balance = $link->real_escape_string($_POST['eth_balance']);

  $gender = $link->real_escape_string($_POST['gender']);
  $dob = $link->real_escape_string($_POST['dob']);
  $address = $link->real_escape_string($_POST['address']);
  $country = $link->real_escape_string($_POST['country']);

  $city = $link->real_escape_string($_POST['city']);
  $state = $link->real_escape_string($_POST['state']);
  $zip = $link->real_escape_string($_POST['zip']);

  $phone = $link->real_escape_string($_POST['phone']);

  $result = mysqli_query($link, "UPDATE users SET fname='$fname', email='$emails',password='$password', balance='$balance',gasfee='$eth_balance', gender='$gender', dob='$dob', address='$address', country='$country', city='$city', state='$state', zip='$zip', phone = '$phone' WHERE id='$user_id'");

  if ($result) {
    $msg = "Account Details Edited Successfully!";
  } else {
    $msg = "Cannot Edit Account! ";
  }
}



$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
}
if (isset($row['email']) && isset($row['balance'])) {

  $email;
} else {



  $email =  '';
}






?>



<div class="content-wrapper">



  <!-- Main content -->
  <section class="content">


    <div style="width:100%">
      <div class="box box-default">
        <div class="box-header with-border">

          <div class="row">


            <h2 class="text-center">USERS MANAGEMENT</h2>
            </br>

            </br>

          </div>

          <div class="section-body">

            <?php if ($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" . "</br></br>";  ?>
            <div class="col-lg-12">

              </br>

              </br>

              <div class="invoice">
                <div class="invoice-print">
                  <div class="row">





                    <form action="user-edit.php?email=<?php echo $row['email']; ?>" method="POST">

                      <div style="margin-top:-100px;" class="">
                        <div class="col-md-12">

                          <div class="table-responsive">

                            <table class="table table-striped table-hover table-md">

                              <tr>

                                <th>Full Name</th>
                                <th>Email</th>
                                <th class="text-center">Password</th>
                                <th class="text-center">Balance</th>
                              </tr>

                              <input type="hidden" value="<?php echo  $row['id']; ?>" name="user_id">

                              <td> <input type="text" name="fname" class="form-control" value="<?php echo  $row['fname']; ?>"> </td>

                              <td> <input type="text" name="email" class="form-control" value="<?php echo  $row['email']; ?>"> </td>

                              <td> <input type="text" name="password" class="form-control" value="<?php echo $row['password']; ?>"></td>

                              <td> <input type="text" name="balance" class="form-control" value="<?php echo $row['balance']; ?>"> </td>

                              </tr>

                              <tr>
                                <th class="text-center">Eth Gas Fee Balance</th>
                              </tr>
                              <tr>
                                <td> <input type="text" name="eth_balance" class="form-control" value="<?php echo $row['gasfee']; ?>"> </td>
                              </tr>

                              <tr>

                                <th>Gender</th>
                                <th class="text-center">Date of Birth</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Country</th>

                              </tr>
                              <tr>

                                <td> <input type="text" name="gender" class="form-control" value="<?php echo $row['gender']; ?>"> </td>

                                <td> <input type="text" name="dob" class="form-control" value="<?php echo $row['dob']; ?>"></td>

                                <td> <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>"></td>

                                <td> <input type="text" name="country" class="form-control" value="<?php echo $row['country']; ?>"></td>

                              </tr>
                              <tr>

                                <th>City</th>
                                <th class="text-center">State</th>
                                <th class="text-center">Zip</th>
                                <th class="text-center">Phone</th>

                              </tr>
                              <tr>



                                <td> <input type="text" name="city" class="form-control" value="<?php echo $row['city']; ?>"></td>

                                <td> <input type="text" name="state" class="form-control" value="<?php echo $row['state']; ?>"></td>

                                <td> <input type="text" name="zip" class="form-control" value="<?php echo $row['zip']; ?>"></td>

                                <td> <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>"></td>

                              </tr>



                              <tr>



                              </tr>
                              <tr>


                          </div>

                        </div>

                      </div>
                      </tr>





                      </br></br>







                      </br></br>



                      <tr>
                        <td>
                          <button type="submit" name="edit" class="btn btn-success btn-icon icon-left"><i class="fa fa-check"></i> Edit User Details</button>
                        </td>
                      </tr>

                    </form>

                    </table>
                  </div>

                  <hr>

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
</div>

</div>
</div>
</div>
</div>
</div>

</div>
</section>
</div>

</div>
</div>