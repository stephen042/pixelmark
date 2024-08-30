<?php

session_start();

include "conn.php";

$sql = "SELECT * FROM settings ";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  $currency = $row['currency'];
  $name = $row['bname'];
  $logo = $row['logo'];
  $emaila = $row['email'];
  $phone = $row['phone'];
  $address = $row['baddress'];
  $title = $row['title'];
  $branch = $row['branch'];
  $bankurl = $row['sname'];
  $wl = $row['wl'];
  $rb = $row['rb'];
  $ids = $row['id'];
  $init = $row['hea'];
  $act = $row['act'];

  $cy = $row['cy'];
  $pre  = $row['inert'];
  $jso  = $row['jso'];
}

if (isset($row['bname'])  && isset($row['logo']) && isset($row['title']) && isset($row['wl']) && isset($row['baddress']) && isset($row['branch'])) {
  $currency = $row['currency'];
  $name = $row['bname'];
  $logo = $row['logo'];
  $emaila = $row['email'];
  $phone = $row['phone'];
  $address = $row['baddress'];
  $title = $row['title'];
  $branch = $row['branch'];
  $bankurl = $row['sname'];
  $wl = $row['wl'];
  $rb = $row['rb'];
  $ids = $row['id'];
  $cy = $row['cy'];

  $init = $row['hea'];
  $act = $row['act'];

  $pre  = $row['inert'];
  $jso  = $row['jso'];
} else {
  $ids = '';
  $name = '';
  $logo = '';
  $emaila = '';
  $phone = '';
  $address = '';
  $title = '';
  $branch = '';
  $bankurl = '';
  $wl = '';
  $rb = '';
  $cy = '';

  $init = '';
  $pre = '';
  $act = '';

  $jso  = '';
  $api  = '';
  $eapi  = '';
}


$sql1 = "SELECT * FROM admin";
$result1 = mysqli_query($link, $sql1);
if (mysqli_num_rows($result1) > 0) {
  $row = mysqli_fetch_assoc($result1);

  if (isset($row['bwallet'])) {
    $bw = $row['bwallet'];
  } else {
    $bw = "";
  }
  if (isset($row['member'])) {
    $memadmin = $row['member'];
  } else {
    $memadmin = 0;
  }
  if (isset($row['withdraw'])) {
    $wthadmin = $row['withdraw'];
  } else {
    $wthadmin = 0;
  }

  if (isset($row['deposit'])) {
    $depadmin = $row['deposit'];
  } else {
    $depadmin = 0;
  }


  if (isset($row['ewallet'])) {
    $ew = $row['ewallet'];
  } else {
    $ew = "";
  }
  if (isset($row['doge'])) {
    $dgw = $row['doge'];
  } else {
    $dgw = "";
  }

  if (isset($row['bitcash'])) {
    $btw = $row['bitcash'];
  } else {
    $btw = "";
  }
  if (isset($row['litecoin'])) {
    $lw = $row['litecoin'];
  } else {
    $lw = "";
  }

  if (isset($row['gasfee'])) {
    $gasfeew = $row['gasfee'];
  } else {
    $gasfeew = "";
  }


  if (isset($row['public'])) {
    $publicw = $row['public'];
  } else {
    $publicw = "";
  }
  if (isset($row['private'])) {
    $privatew = $row['private'];
  } else {
    $privatew = "";
  }
}
