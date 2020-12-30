<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include 'head.php';?>
    <title>Assets - Affiliate Panel</title>
  </head>
  <body>
    <!-- Include the Nav into the page -->
    <?php include 'nav.php';?>
    <div class="main">
      <!-- Button to show/hide menu -->
      <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      
    <div class="row">
      <?php
        include 'config.php';

        $images = glob($assetsPath . "/*.webp");
        if (sizeof($images) == 0) {
          echo '<p class="red-text center">No assets available yet. Contact the support of ' . $companyName . '</p>';
        }
        $count = 0;
        foreach($images as $image) {
          echo '<div class="col s12 m6">';
            echo '<div class="card">';
              echo'<div class="card-image">';
                echo '<img class="assetImage" src="' . $image . '" />';

                list($width, $height) = getimagesize($image);

              echo '</div>';
              echo '<div class="card-content">';
                echo '<span class="card-title">' . $width . 'x' . $height . '</span>';
                echo '<input class="imageURL" readonly value="//' . $_SERVER['HTTP_HOST'] . '/' . $image . '">';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        }
      ?>
    </div>
      
    </div>
    <?php include 'foot.php';?>
  </body>
</html>
