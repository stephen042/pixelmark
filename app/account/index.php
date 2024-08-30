<?php

session_start();
include "../conn.php";
include "../config.php";

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



include 'header.php'; ?>





<div class="row">
  <div class="col-sm-12">
    <br>
  </div>
</div>
<div class="col-md-12">
  <div class="alert alert-primary bg-dark">

    <h6>Mint Nft now to collect the realest collections of Nfts available on NFT Open Wave Digital NFT Trading Company </h6>
    <h6>NOTE: NFT purchase is based on the ethereum network only </h6>

  </div>
</div>


<style>
  /* Float four columns side by side */
  .column1 {
    /* float: left; */
    width: 33%;
    padding: 0 10px;
  }

  /* Remove extra left and right margins, due to padding */
  .row1 {
    margin: 0 20px;
  }

  /* Clear floats after the columns */
  .row1:after {
    content: "";
    display: table;
    clear: both;
  }

  /* Responsive columns */
  @media screen and (max-width: 600px) {
    .column1 {
      width: 100%;
      display: block;
      margin-bottom: 20px;
    }
  }

  /* Style the counter cards */
  .card1 {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 16px;
    text-align: center;
    background-color: #074409;
    border-style: solid;
    border-color: white;
    border-radius: 20px;
    color: white;
  }

  .card2 {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 16px;
    text-align: center;
    background-color: #721e0f;
    border-style: solid;
    border-color: white;
    border-radius: 20px;
    color: white;
  }

  .card3 {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 16px;
    text-align: center;
    background-color: #106d6d;
    border-style: solid;
    border-color: white;
    border-radius: 20px;
    color: white;
  }

  .card4 {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 16px;
    text-align: center;
    background-color: #263058;
    border-style: solid;
    border-color: white;
    border-radius: 20px;
    color: white;
  }
</style>

  <div class="row1 row m-0">
    <div class="column1 ">
      <div class="card1">
        <small>WALLET BALANCE</small>
        <h2 style="font-weight: 700;"> <?php echo $ubalance; ?> <small> ETH</small></h2>
      </div>
    </div>

    
    <div class="column1">
      <div class="card2">
        <small>GAS FEE</small>
        <h2 style="font-weight: 700;"><small><?php echo $gasfee; ?> ETH</small></h2>
      </div>
    </div>


    <div class="column1 ">
      <div class="card3">
        <small>PURCHASE NFT</small>
        <h2 style="font-weight: 700;"><small>NFT</small></h2>
      </div>
    </div>



  </div>

<br>

<div class="col-sm-12">
  <div class="row mt-2">
    <div class="col-md-5">
    </div>


    <div class="container">
      <div class="section-header light-version-3">
        <div class="header-title">
          <div class="live-icon" data-blast="bgColor">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 24">
              <title>live</title>
              <g id="Layer_2" data-name="Layer 2" data-blast="color">
                <g id="Layer_2-2" data-name="Layer 2">
                  <path d="M12,17.87l4.36,4.51,4.37-4.51A6,6,0,0,0,12,17.87Z"></path>
                  <path d="M6,12.35l2.91,3a10,10,0,0,1,14.54,0l2.91-3A14.09,14.09,0,0,0,6,12.35Z"></path>
                  <path d="M0,6.85l2.91,3a18.09,18.09,0,0,1,26.18,0l2.91-3A22.12,22.12,0,0,0,0,6.85Z"></path>
                </g>
              </g>
            </svg>
          </div>
          <h3>
            <font color="white">Nft Collections</font>
          </h3>


          <a class="btn btn-xs btn-info" href="deposit.php">Make Deposit <i class="fa fa-money mx-1" aria-hidden="true"></i></a>

        </div>
      </div>
    </div>

  </div>
</div>
<section class="assets-section pb-100">
  <div class="container">






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
    </style>



    <div style="overflow-x:auto;">
      <table>
        <tr>
          <th>NFT NAME</th>
          <th>NFT LOGO</th>
          <th>AMOUNT</th>
          <th>STATUS</th>
          <th>ACTION</th>

        </tr>



        <?php
        $i = 1;
        $sql = "SELECT * FROM market WHERE status='approved' AND mstatus = 'ACTIVE' ORDER BY id DESC ";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {

        ?>



            <tr>
              <td><?php echo $row['name']; ?> </td>
              <td><img src="nft/<?php echo $row['logo']; ?>" height="100px" width="100px"> </td>
              <td><?php echo $row['amount']; ?> ETH</td>
              <td><?php echo $row['mstatus']; ?></td>
              <td>


                <form method="POST" action="buy_now.php">

                  <input type="hidden" name="nft_id" value="<?php echo $row['id']; ?>" />

                  <input type="submit" class="default-btn move-top" name="buy_now" role="button" value="Buy Now" />
                </form>

              </td>

            </tr>
        <?php }
        } ?>

      </table>
    </div>










  </div>
</section>



















<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-body mx-auto">
        <h5 class="text-center mt-20">
          <font color="black">Alert!!!</font>
        </h5>
        <center>
          <h4>
            <font color="black">Send payment to Company's ethereum wallet below to have sole right to this piece of art.</font>
          </h4>
        </center>
        <center>
          <p class="mb-20">
            <img src="../content/chart.png" width="160" height="160">
          </p>
        </center>
        <div class="input-group mb-20">
          <input id="myInput" type="text" class="form-control text-center" readonly="readonly" value="0x600907BF773aD0E762518902eFa9Fa344601f02D">
          <span style="display: inline;" class="input-group-btn">
            <button onclick="this.innerHTML='Copied'; this.classList.remove('btn-success');this.classList.add('btn-warning');" class="btn btn-success" type="button" id="copy-button" data-toggle="tooltip" data-placement="button" data-clipboard-target="#myInput" title="Copy to Clipboard">Copy</button>
          </span>
        </div>
        <br>
        <center>
          <a href="ethereum:0x688B0a7104b8b0687FA530541365d5771aeF75eE" class="btn btn-success btn-lg mb-20" style="font-size: 20px; font-weight: bold;">Pay Using Wallet App</a>
        </center>
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal1" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <h4>Confirm Payment</h4>
      </div>
      <div class="modal-body">
        <center>
          <font color="black">
            I confirmed that i (<strong>John Field</strong>), just sent the amount am entering below to the company's wallet.</font>
          <br><br>
          <form class="form-horizontal" method="POST" action="ipaid.php">
            <div class="form-group">
              <div class="col-sm-10">
                <input type="text" class="form-control" id="amount" placeholder="Amount Sent" name="amount">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Nft Collected" name="name">

                <input type="hidden" name="u_name" value="lesrich105@gmail.com" />
                <input type="hidden" name="status" value="PENDING" />
                <input type="hidden" name="date" value="01:32 PM 13 May 2022" />
                <input type="hidden" name="ref" value="NFT1394239855" />
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-10">
                <select class="form-control" name="method" required>

                  <option>Select Method</option>
                  <option value="Bitcoin">Bitcoin</option>
                  <option value="Ethereum">Ethereum</option>
                </select>
              </div>

              <br>






              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" name="ipaid" class="btn btn-success btn-lg mb-20" style="font-size: 20px; font-weight: bold;">Submit</button>
                </div>
              </div>
          </form>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>


<?php include 'footer.php'; ?>