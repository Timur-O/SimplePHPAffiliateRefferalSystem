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
        
        $sql = "SELECT COUNT(*) as 'num' FROM `{$clientTableName}`";
        $result = $conn->query($sql)->fetch_assoc();
        $numberOfClients = $result['num'];
        
      ?>

      <div class="row rowtoppadded2">
        <div class="col m4 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Total Users</span>
              <h5><?php echo $numberOfClients; ?></h5><p>Registered Users</p> <!-- Should be done with database -->
            </div>
          </div>
        </div>
        <div class="col m4 s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">7 Day User Total</span>
              <h5><?php echo $analyticsValueusers;?></h5><p>Users</p>
            </div>
          </div>
        </div>
        <div class="col m4 s12">
          <a class="card-link" href="uptime.php">
            <div id="uptimecard" class="card green">
              <div class="card-content">
                <span class="card-title">Service Status</span>
                <h5>0</h5><p>Services Down</p>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col m4 s12 twitterFeed">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Twitter Feed</span>
              <a class="twitter-timeline" data-height="473" href="https://twitter.com/<?php echo $twitterHandle; ?>?ref_src=twsrc%5Etfw">Tweets by <?php echo $twitterHandle; ?></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
          </div>
        </div>
        <div class="col m4 s12 rssFeed">
          <div class="card">
            <div class="card-content">
              <span class="card-title">RSS Feed</span>
              <div class="rssHeight">
                <script src="<?php echo $rssFeed;?>"></script>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <?php include 'foot.php';?>
  </body>
</html>
