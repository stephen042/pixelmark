<?php   
session_start(); //to ensure you are using same session
include "../conn.php";

if(session_destroy()){ //destroy the session

	  header("location: ../login.php");
}
exit();
?>