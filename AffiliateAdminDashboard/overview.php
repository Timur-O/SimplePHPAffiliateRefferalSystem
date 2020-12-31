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
        
        $sql = "SELECT SUM(`clicks`) AS 'totalClicks' FROM `{$affiliateTableName}`";
        $result = $conn->query($sql)->fetch_assoc();
        $numberOfClicks = $result['totalClicks'];

        $sql = "SELECT COUNT(*) as 'num' FROM `{$conversionsTableName}`";
        $result = $conn->query($sql)->fetch_assoc();
        $numberOfConversions = $result['num'];
        
        $sql = "SELECT SUM(`commissionBalance`) AS 'totalCommissions' FROM `{$affiliateTableName}`";
        $result = $conn->query($sql)->fetch_assoc();
        $totalCommissionValue = $result['totalCommissions'];

        $sql = "SELECT SUM(`commissionBalance`) AS 'totalCommissions' FROM `{$affiliateTableName}` WHERE `commissionBalance` > {$minPayoutAmount}";
        $result = $conn->query($sql)->fetch_assoc();
        $totalCommissionValue = $result['totalCommissions'];

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
        <div class="col m3 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Clicks</span>
              <h5><?php echo $numberOfClicks; ?></h5><p> Clicks</p>
            </div>
          </div>
        </div>
        <div class="col m3 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Conversions</span>
              <h5><?php echo $numberOfConversions;?></h5><p> Conversions</p>
            </div>
          </div>
        </div>
        <div class="col m3 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Commission Amount</span>
              <h5><?php echo $totalCommissionValue;?></h5><p> <?php echo $currency?></p>
            </div>
          </div>
        </div>
        <div class="col m3 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Commission Amount</span>
              <h5><?php echo $payableCommissionValue;?></h5><p> <?php echo $currency?></p>
            </div>
          </div>
        </div>
      </div>

    </div>
    <?php include 'foot.php';?>
  </body>
</html>
