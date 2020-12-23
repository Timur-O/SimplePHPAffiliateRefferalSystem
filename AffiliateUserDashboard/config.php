<?php
  // Your Company Name - Appears in footer next to copyright
  $companyName = "YOUR COMPANY";
  // Root of the affiliate panel files
  // if in a folder called refferal or affiliates simply put "/refferal" or "/affiliates". if not in a folder then simply put "".
  $rootOfFiles = "";
  
  // Add your database information for the login system
  $servername = "sql.yourdomain.tld";
  $username = "username";
  $password = "password";
  $dbname = "yourdatabase"; // Database which contains admin login info
  $userTableName = "yourtable"; // Name of table containing affiliate program users login info
  $emailColumn = "email"; // Name of column containing emails
  $hashPasswordColumn = "password"; // Name of column containing passwords
  $primaryKeyColumn = "id"; // Name of column containing the primary key/unique identifier for each row (will be used for affiliateID)
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // CHANGE ICON BY UPLOADING favicon.png INTO THE IMAGES FOLDER
  // CHANGE LOGO BY UPLOADING logo.png INTO THE IMAGES FOLDER
?>
