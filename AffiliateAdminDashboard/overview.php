<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include 'head.php';?>
    <title>Overview - Affiliate Panel</title>
  </head>
  <body>
    <!-- Include the Nav into the page -->
    <?php include 'nav.php';?>
    <div class="main">
      <!-- Button to show/hide menu -->
      <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

      <?php
        include 'config.php';
        
        $sql = "SELECT SUM(clicks) AS 'totalClicks' FROM `{$affiliateTableName}`";
        $resultClicks = $conn->query($sql)->fetch_assoc();
        $numberOfClicks = $resultClicks['totalClicks'];

        $sql2 = "SELECT COUNT(*) AS 'num' FROM `{$conversionsTableName}`";
        $resultConversions = $conn->query($sql2)->fetch_assoc();
        $numberOfConversions = $resultConversions['num'];
        
        $sql3 = "SELECT SUM(`commissionBalance`) AS 'totalCommissions' FROM `{$affiliateTableName}`";
        $resultTotalCommission = $conn->query($sql3)->fetch_assoc();
        $totalCommissionValue = $resultTotalCommission['totalCommissions'];
        $totalCommissionValue = number_format((float)$totalCommissionValue, 2, '.', '');

        $sql4 = "SELECT SUM(`commissionBalance`) AS 'totalCommissions' FROM `{$affiliateTableName}` WHERE `commissionBalance` > {$minPayoutAmount}";
        $resultPayableCommission = $conn->query($sql4)->fetch_assoc();
        $payableCommissionValue = $resultPayableCommission['totalCommissions'];
        $payableCommissionValue = number_format((float)$payableCommissionValue, 2, '.', '');

        if (is_null($resultClicks)) {
          $numberOfClicks = 0;
        }

        if (is_null($resultConversions)) {
          $numberOfConversions = 0;
        }

        if (is_null($resultTotalCommission)) {
          $totalCommissionValue = 0;
        }

        if (is_null($resultPayableCommission)) {
          $payableCommissionValue = 0;
        }
        
      ?>

      <div class="row rowtoppadded2">
        <div class="col m6 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Clicks</span>
              <h5><?php echo $numberOfClicks; ?></h5><p> Clicks</p>
            </div>
          </div>
        </div>
        <div class="col m6 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Conversions</span>
              <h5><?php echo $numberOfConversions;?></h5><p> Conversions</p>
            </div>
          </div>
        </div>
        <div class="col m6 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Earned By Affiliates</span>
              <h5><?php echo $totalCommissionValue;?></h5><p> <?php echo $currency?></p>
            </div>
          </div>
        </div>
        <div class="col m6 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Earned By Affiliates (With Balance Above <?php echo $minPayoutAmount . " " . $currency; ?>)</span>
              <h5><?php echo $payableCommissionValue;?></h5><p> <?php echo $currency?></p>
            </div>
          </div>
        </div>
      </div>

    </div>
    <?php include 'foot.php';?>
  </body>
</html>
