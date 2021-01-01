<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include 'head.php';?>
    <title>Payouts - Affiliate Panel</title>
  </head>
  <body>
    <!-- Include the Nav into the page -->
    <?php include 'nav.php';?>
    <div class="main">
      <!-- Button to show/hide menu -->
      <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

      <?php
        include 'config.php';
        
        $sql = "SELECT `payoutEmail` FROM `{$affiliateTableName}` WHERE `affiliateID` = '{$_SESSION['userRefCode']}'";
        $result = $conn->query($sql)->fetch_assoc();
        $paypalEmail = $result['payoutEmail'];
        
      ?>

    <div class="row rowtoppadded2">
        <div class="col s12">
            <div class="card">
            <div class="card-content">
                <span class="card-title">Your PayPal Email Address</span>
                <form action="change_aff_email.php" method="POST">
                  <input name="newEmail" type="text" value="<?php echo $paypalEmail; ?>">
                  <button class="btn waves-effect waves-light" type="submit" name="action">Change Payout Address</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <?php
        $sql = "SELECT COUNT(*) as 'num' FROM `{$payoutsTableName}` WHERE `affiliate` = '{$_SESSION["userRefCode"]}'";
        $result = $conn->query($sql)->fetch_assoc();
        $numberOfPayouts = $result['num'];
        
        if (isset($_GET['page'])) {
          $pageNum = $_GET['page'];
          $offset = ($pageNum - 1) * 10;
        } else {
          $offset = 0;
        }
      ?>

      <div class="row respon-table">
      <div class="col s10 offset-s1">
          <h5 class="center">Your Payout History</h5>
          <hr>
        </div>
        <table id="userstable" class="col s10 offset-s1 centered">
          <thead>
            <th>Date</th>
            <th>Amount</th>
          </thead>
          <tbody>
          <?php
            if ($numberOfPayouts > 0) {
              $sql = "SELECT `date`, `amount` FROM `{$payoutsTableName}` WHERE `affiliate` = '{$_SESSION["userRefCode"]}' LIMIT 10 OFFSET {$offset}";
              $fullResult = $conn->query($sql);
              while ($row = $fullResult->fetch_assoc()) {
                $payoutDate = $row['date'];
                $payoutAmount = $row['amount'];

                echo "<tr>";
                  echo "<td>" . $payoutDate . "</td>";
                  echo "<td>" . $payoutAmount . "</td>";
                echo "</tr>";
              }
            } else {
              echo '<td colspan="2"><p class="red-text">No payouts yet...</p></td>';
            }
          ?>
          <tr class="paginator">
              <td colspan="5" class="center">
                <ul class="pagination">
                  <?php 
                    if (isset($_GET['page'])) {
                      $pageNum = $_GET['page'];
                      if ($pageNum > 2) {
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', ($pageNum - 1)) . '"><i class="material-icons">chevron_left</i></a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', ($pageNum - 2)) . '">' . ($pageNum - 2) . '</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', ($pageNum - 1)) . '">' . ($pageNum - 1) . '</a></li>';
                        echo '<li class="active"><a href="payout.php?' . addQueryToURL('page', ($pageNum)) . '">' . $pageNum . '</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', ($pageNum + 1)) . '">' . ($pageNum + 1) . '</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', ($pageNum + 2)) . '">' . ($pageNum + 2) . '</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', ($pageNum + 1)) . '"><i class="material-icons">chevron_right</i></a></li>';
                      } else if ($pageNum == 2) {
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 1) . '"><i class="material-icons">chevron_left</i></a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 1) . '">1</a></li>';
                        echo '<li class="active"><a href="payout.php?' . addQueryToURL('page', 2) . '">2</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 3) . '">3</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 4) . '">4</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 5) . '">5</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 3) . '"><i class="material-icons">chevron_right</i></a></li>';
                      } else {
                        echo '<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
                        echo '<li class="active"><a href="payout.php?' . addQueryToURL('page', 1) . '">1</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 2) . '">2</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 3) . '">3</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 4) . '">4</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 5) . '">5</a></li>';
                        echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 2) . '"><i class="material-icons">chevron_right</i></a></li>';
                      }
                    } else {
                      echo '<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
                      echo '<li class="active"><a href="payout.php?' . addQueryToURL('page', 1) . '">1</a></li>';
                      echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 2) . '">2</a></li>';
                      echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 3) . '">3</a></li>';
                      echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 4) . '">4</a></li>';
                      echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 5) . '">5</a></li>';
                      echo '<li class="waves-effect"><a href="payout.php?' . addQueryToURL('page', 2) . '"><i class="material-icons">chevron_right</i></a></li>';
                    }
                    function addQueryToURL($query, $queryValue) {
                      $url = "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                      $url_parts = parse_url($url);
                      if (isset($url_parts['query'])) {
                          parse_str($url_parts['query'], $params);
                      } else {
                          $params = array();
                      }
                      
                      $params[$query] = $queryValue;
                      
                      $url_parts['query'] = http_build_query($params);
                      
                      return $url_parts['query'];
                    }
                  ?>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
    <?php include 'foot.php';?>
  </body>
</html>
