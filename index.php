<?php
require 'header.php';
?>
<main>

  <?php
    if (isset($_SESSION['userId'])) {
      //show the uploaded files of login user
      $numberoffiles = 0;
      $i = 0;
      $u = $_SESSION['userUid'];
      $files = scandir("userfiles/$u");
      sort($files);
      foreach ($files as $file) {
        $numberoffiles++;
      }
      echo '<div class="list">';
      if ($numberoffiles < 3) {
        echo '<p>No file uploaded yeat</p>';
      }
      else {
        echo '<p>Yours fils are </p>';
        echo '<ul class="ul">';
        foreach($files as $file){
          if ($file !== '.' && $file !== '..') {
            echo'<li><a href="userfiles/'.$u.'/'.$file.'">' . $file . '</a></li>';
          }
        }
        echo "</ul>";
      }
      echo '</dev>';
    }
    else{
      //code
    }
   ?>
</man>

<?php
require 'footer.php';
 ?>
