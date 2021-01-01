<?php
session_start();
if (isset($_POST['approveConversion']) && isset($_SESSION['userRefCode'])) {
    include 'config.php';
    $sql = "UPDATE `{$conversionsTableName}` SET `approved` =  1 WHERE `conversionID` = {$_POST['conversionID']}";
    $result = $conn->query($sql);

    $sql2 = "SELECT `commissionAmount` FROM `{$conversionsTableName}` WHERE  `conversionID` = {$_POST['conversionID']}";
    $result = $conn->query($sql2)->fetch_assoc();
    $commissionAmount = $result['commissionAmount '];

    $sql3 = "UPDATE `{$affiliatesTableName}` SET `commissionBalance ` =  `commissionBalance ` + {$commissionAmount} WHERE `affiliateID` = {$_SESSION['userRefCode']}";
    $result = $conn->query($sql3);

    header("Location: conversions.php");
    die();
} else if (isset($_POST['rejectConversion']) && isset($_SESSION['userRefCode'])) {
    include 'config.php';
    $sql = "UPDATE `{$conversionsTableName}` SET `approved` =  2 WHERE `conversionID` = {$_POST['conversionID']}";
    $result = $conn->query($sql);
    header("Location: conversions.php");
    die();
}
?>