# Snippets

The following are snippets of code which need to be included on other pages of your websites to enable the affiliate system to work. Currently there are no fraud checks included in these snippets of code, I would recommend either including a fraud check in these snippets or during the approval process for conversions (either manually or add additional fraud checking code - if you do code a fraud check, feel free to create pull request or an issue).

## Click Counter + Cookie Setting Snippet

The following snippet should be inserted into any page which you want an affiliate link to work on. This snippet will update the affiliates link clicks by one and will set a cookie called "ref" which will store their affiliate code for 30 days. If the user visits another affiliate's link then that cookie will be overwritten.

Important: You should have a $conn variable which connects to the database containing the affiliate information.

``` php
<?php 
    $affiliatesTableName = 'affiliates';

    if (isset($_GET['ref'])) {
        $refferalCode = $_GET['ref'];

        $sql = "UPDATE `{$affiliateTableName}` SET `clicks` =  `clicks` + 1 WHERE `affiliateID` = {$refferalCode}";
        $conn->query($sql);

        setcookie('ref', $refferalCode, time() + (86400 * 30), "/"); // 86400 = 1 day * 30 = 30 Days
    }
?>
```

## Conversion Collecting Snippet

The following snippet should be inserted into the page after a sign up / purchase (eg. successful payment / thank you for signing up page). It will add a new conversion to the referring affiliate's account. 

Important: You should have a $conn variable which connects to the database containing the affiliate information. Also you should fill in the $conversionType and $conversionValue variables with the necessary information. Eg: "Premium Purchase", 1.0 - The $conversionType variable must be a string and will be shown to the affiliate and the $conversionValue is the commission that the affiliate will recieve and must be a float. 

``` php
    $conversionsTableName = 'conversions';
    $affiliatesTableName = 'affiliates';
    
    $conversionType = '';
    $conversionValue = 0;

    if (isset($_COOKIE['ref'])) {
        $refferalCode = $_COOKIE['ref'];

        $sql = "UPDATE `{$affiliateTableName}` SET `conversions` =  `conversions` + 1 WHERE `affiliateID` = {$refferalCode}";
        $conn->query($sql);

    $sql2 = "INSERT INTO  `{$conversionsTableName}` (`affiliate`, `date`, `type`, `commissionAmount`, `approved`) VALUES ({$refferalCode}, now(), '{$conversionType}', {$conversionValue}, 0)";
    $conn->query($sql2);
    }
```