<?php
if (isset($_POST['newEmail'])) {
    include 'config.php';
    $sql = "UPDATE `{$affiliateTableName}` SET `payoutEmail` =  '{$_POST['newEmail']}' WHERE `affiliateID` = {$_SESSION['userRefCode']}";
    $conn->query($sql);
}
?>