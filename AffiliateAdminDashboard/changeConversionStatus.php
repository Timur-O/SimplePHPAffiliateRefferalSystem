<?php
session_start();
if (isset($_POST['approveConversion']) && isset($_SESSION['userRefCode'])) {
    include 'config.php';
    $sql = "UPDATE `{$conversionsTableName}` SET `approved` =  1 WHERE `conversionID` = {$_POST['conversionID']}";
    $result = $conn->query($sql);
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