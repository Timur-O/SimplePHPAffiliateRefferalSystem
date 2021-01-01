<?php
session_start();
if (isset($_POST['markPaid']) && isset($_SESSION['userRefCode'])) {
    include 'config.php';

    $payoutAmount = $_POST['payoutAmount'];
    
    $sql = "SELECT `commissionBalance`, `payoutEmail` FROM `{$affiliateTableName}` WHERE  `affiliateID` = {$_POST['affiliateID']}";
    $result = $conn->query($sql)->fetch_assoc();
    $previousCommissionBalance = $result['commissionBalance'];
    $payoutEmail = $result['payoutEmail'];

    $newCommissionBalance = $previousCommissionBalance - $payoutAmount;

    $sql = "UPDATE `{$affiliateTableName}` SET `commissionBalance` =  {$newCommissionBalance} WHERE `affiliateID` = {$_POST['affiliateID']}";
    $result = $conn->query($sql);

    $sql2 = "INSERT INTO  `{$payoutsTableName}` (`affiliate`, `date`, `amount`, `email`) VALUES ({$_POST['affiliateID']}, now(), {$payoutAmount}, '{$payoutEmail}')";
    $result = $conn->query($sql2);

    header("Location: payout.php");
    die();
}
?>