<?php
session_start();
if (isset($_POST['markPaid']) && isset($_SESSION['userRefCode'])) {
    include 'config.php';

    $payoutAmount = $_POST['payoutAmount'];
    
    $sql = "SELECT `commissionBalance` FROM `{$affiliateTableName}` WHERE  `affiliateID` = {$_SESSION['userRefCode']}";
    $result = $conn->query($sql);
    $previousCommissionBalance = $result['commissionBalance'];

    $newCommissionBalance = $previousCommissionBalance - $payoutAmount;

    $sql = "UPDATE `{$affiliateTableName}` SET `commissionBalance` =  {$newCommissionBalance} WHERE `conversionID` = {$_POST['conversionID']}";
    $result = $conn->query($sql);

    $sql = "INSERT INTO  `{$payoutsTableName}` (`affiliate`, `date`, `amount`) VALUES ({$_SESSION['userRefCode']}, now(), {$payoutAmount})";
    $conn->query($sql);

    header("Location: payout.php");
    die();
}
?>