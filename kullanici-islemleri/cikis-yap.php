<?php
  session_start();

  $_SESSION["Kullanici"] = null;
  header("location: ../index.php"); 
  exit;