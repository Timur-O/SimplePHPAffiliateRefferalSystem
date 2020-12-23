<?php
session_start();

include 'loginCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['connectID'])) {
    $_SESSION['user'] = $_POST['connectID'];
    $_SESSION['connectedByAdmin'] = true;
    //Redirect to Dashbaord
    header("Location: https://ultifreehosting.com/dashboard.php"); die();
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include 'head.php';?>
    <title>Conversions - Affiliate Panel</title>
  </head>
  <body>
    <!-- Include the Nav into the page -->
    <?php include 'nav.php';?>
    <div class="main">
      <!-- Button to show/hide menu -->
      <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      
      <?php
        include 'dbInfo.php';
        
        $sql = "SELECT COUNT(*) as 'num' FROM `{$conversionsTableName}` WHERE `affiliate` = '{$_SESSION['userRefCode']}'";
        $result = $conn->query($sql)->fetch_assoc();
        $numberOfConversions = $result['num'];
        
        if (isset($_GET['page'])) {
          $pageNum = $_GET['page'];
          $offset = ($pageNum - 1) * 10;
        } else {
          $offset = 0;
        }
      ?>
      
      <div class="row respon-table">
        <table id="userstable" class="col s10 offset-s1 centered">
          <thead>
            <th>Date</th>
            <th>Type</th>
            <th>Commission Amount</th>
            <th>Approved</th>
          </thead>
          <tbody>
            <?php
              if ($numberOfConversions > 0) {
                $sql = "SELECT `date`, `type`, `commissionAmount`, `approved` FROM `{$conversionsTableName}` LIMIT 10 OFFSET {$offset}";
                $fullResult = $conn->query($sql);
                
                while ($row = $fullResult->fetch_assoc()) {
                  $commissionDate = $row['date'];
                  $commissionType = $row['type'];
                  $commissionAmount = $row['commissionAmount'];
                  $commissionApproved = $row['approved'];

                  echo "<tr>";
                    echo "<td>" . $commissionDate . "</td>";
                    echo "<td>" . $commissionType . "</td>";
                    echo "<td>" . $commissionAmount . " " . $currency . "</td>";
                    if ($commissionApproved) {
                      echo "<td>Approved</td>";
                    } else {
                      echo "<td>Pending Approval</td>";
                    }
                  echo "</tr>";
                }
              } else {
                echo '<td colspan="2"><p class="red-text">No conversions yet. Visit the <a href="assets.php">assets</a></p> page ot get started.</td>';
              }
            ?>
            <tr class="paginator">
              <td colspan="5" class="center">
                <ul class="pagination">
                  <?php 
                    if (isset($_GET['page'])) {
                      $pageNum = $_GET['page'];
                      if ($pageNum > 2) {
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', ($pageNum - 1)) . '"><i class="material-icons">chevron_left</i></a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', ($pageNum - 2)) . '">' . ($pageNum - 2) . '</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', ($pageNum - 1)) . '">' . ($pageNum - 1) . '</a></li>';
                        echo '<li class="active"><a href="manageusers.php?' . addQueryToURL('page', ($pageNum)) . '">' . $pageNum . '</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', ($pageNum + 1)) . '">' . ($pageNum + 1) . '</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', ($pageNum + 2)) . '">' . ($pageNum + 2) . '</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', ($pageNum + 1)) . '"><i class="material-icons">chevron_right</i></a></li>';
                      } else if ($pageNum == 2) {
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 1) . '"><i class="material-icons">chevron_left</i></a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 1) . '">1</a></li>';
                        echo '<li class="active"><a href="manageusers.php?' . addQueryToURL('page', 2) . '">2</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 3) . '">3</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 4) . '">4</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 5) . '">5</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 3) . '"><i class="material-icons">chevron_right</i></a></li>';
                      } else {
                        echo '<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
                        echo '<li class="active"><a href="manageusers.php?' . addQueryToURL('page', 1) . '">1</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 2) . '">2</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 3) . '">3</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 4) . '">4</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 5) . '">5</a></li>';
                        echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 2) . '"><i class="material-icons">chevron_right</i></a></li>';
                      }
                    } else {
                      echo '<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
                      echo '<li class="active"><a href="manageusers.php?' . addQueryToURL('page', 1) . '">1</a></li>';
                      echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 2) . '">2</a></li>';
                      echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 3) . '">3</a></li>';
                      echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 4) . '">4</a></li>';
                      echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 5) . '">5</a></li>';
                      echo '<li class="waves-effect"><a href="manageusers.php?' . addQueryToURL('page', 2) . '"><i class="material-icons">chevron_right</i></a></li>';
                    }
                    function addQueryToURL($query, $queryValue) {
                      $url = "https://admin.ultifreehosting.com" . $_SERVER['REQUEST_URI'];
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
