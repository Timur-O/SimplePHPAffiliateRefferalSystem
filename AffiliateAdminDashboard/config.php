<?php
  // Your Company Name - Appears in footer next to copyright
  $companyName = "YOUR COMPANY";
  // Root of the affiliate panel files
  // if in a folder called refferal or affiliates simply put "/refferal/admin" or "/affiliates/admin". if not in a folder then simply put "/".
  $rootOfFiles = "/";
  echo "<script>rootOfFiles = '" . $rootOfFiles . "/'</script>"; // Don't Change
  // The currency you are paying your affiliate in
  $currency = 'USD';
  // Minimum payout amount for affiliates. This will only change how the payouts are displayed.
  $minPayoutAmount = 0;

  // Add your database information for the login system
  $servername = "sql.yourdomain.tld";
  $username = "username";
  $password = "password";
  $dbname = "yourdatabase"; // Database which contains admin login info
  $adminTableName = "yourtable"; // Name of table containing affiliate program users login info
  $affiliateTableName = "affiliates"; // Name of the table containing information about each affiliate (ie clicks, conversions, balance)
  $conversionsTableName = "conversions"; // Name of the table containing information about each conversion (ie singup)
  $payoutsTableName = "payouts"; // Name of the table containing information about payouts to affiliates
  // Below columns refer to the table containing users login info
  $emailColumn = "email"; // Name of column containing emails
  $hashPasswordColumn = "password"; // Name of column containing passwords
  $primaryKeyColumn = "id"; // Name of column containing the primary key/unique identifier for each row (will be used for affiliateID)
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // CHANGE ICON BY UPLOADING favicon.png INTO THE IMAGES FOLDER
  // CHANGE LOGO BY UPLOADING logo.png INTO THE IMAGES FOLDER
?>
