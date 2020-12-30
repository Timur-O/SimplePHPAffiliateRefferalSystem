<?php
session_start();
if (isset($_POST['newEmail'])) {
    include 'config.php';
    $sql = "UPDATE `{$affiliateTableName}` SET `payoutEmail` =  '{$_POST['newEmail']}' WHERE `affiliateID` = {$_SESSION['userRefCode']}";
    $result = $conn->query($sql);
    header("Location: payout.php");
    die();
}
?>