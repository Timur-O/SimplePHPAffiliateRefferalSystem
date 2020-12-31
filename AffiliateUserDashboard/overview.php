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
        
        $sql = "SELECT `clicks`, `conversions`, `commissionBalance` FROM `{$affiliateTableName}` WHERE `affiliateID` = '{$_SESSION['userRefCode']}'";
        $result = $conn->query($sql)->fetch_assoc();
        $numberOfClicks = $result['clicks'];
        $numberOfConversions = $result['conversions'];
        $currentCommissionValue = $result['commissionBalance'];
        
        if (is_null($result)) {
          $sql = "INSERT INTO  `{$affiliateTableName}` (`affiliateID`, `clicks`, `conversions`, `commissionBalance`) VALUES ({$_SESSION['userRefCode']}, 0, 0, 0)";
          $conn->query($sql);

          $sql = "SELECT `clicks`, `conversions`, `commissionBalance` FROM `{$affiliateTableName}` WHERE `affiliateID` = '{$_SESSION['userRefCode']}'";
          $result = $conn->query($sql)->fetch_assoc();
          $numberOfClicks = $result['clicks'];
          $numberOfConversions = $result['conversions'];
          $currentCommissionValue = $result['commissionBalance'];
        }
        
      ?>

      <div class="row rowtoppadded2">
        <div class="col m4 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Clicks</span>
              <h5><?php echo $numberOfClicks; ?></h5><p> Clicks</p>
            </div>
          </div>
        </div>
        <div class="col m4 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Conversions</span>
              <h5><?php echo $numberOfConversions;?></h5><p> Conversions</p>
            </div>
          </div>
        </div>
        <div class="col m4 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Commission Amount</span>
              <h5><?php echo $currentCommissionValue;?></h5><p> <?php echo $currency?></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Your Refferal Link</span>
                <input type="text" disabled value="<?php echo $websiteURL . '?ref=' . $_SESSION['userRefCode']; ?>">
            </div>
          </div>
        </div>
      </div>

    </div>
    <?php include 'foot.php';?>
  </body>
</html>
