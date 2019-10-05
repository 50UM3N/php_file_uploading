<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Basic Cloud System</title>
    <link rel="icon" type="image/ico" href="icons/header.png" />
  </head>
  <body>
    <div class="login-page">
    <img class="image" src="icons/body.png"  alt="Logo">
    <p>Welcome To My Basic Cloud Service</p>
    <header>
      <nav>
        <a href="#"></a>
<!--        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">#</a></li>
          <li><a href="#">#</a></li>
          <li><a href="#">#</a></li>
        </ul>-->
        <?php
          //for logout and upload files
          if (isset($_SESSION['userId'])) {
            echo '<p>' . $_SESSION['userUid'] . " You are log in</p>";
            echo'
            <div class="form">
              <form action="include/logout.inc.php" method="post">
                <button type="submit" name="logout" >Logout</button>
              </form>
              <div class="errors">
                  ';
            //show error while uploading the file
            if (isset($_GET['error'])) {
              if ($_GET['error'] == "toobig") {
                echo '<p>The file is too large upload under 90Mb</p>';
              }
              elseif ($_GET['error'] == "uploadingerror") {
                echo '<p>Uploading error</p>';
              }
              elseif ($_GET['error'] == "unsupportext") {
                echo '<p>Unsuppoted Files Extention see <a href="manuals/ext.man.php">MANUAL<a/></p>';
              }
            }
            elseif (isset($_GET['upload'])) {
              if ($_GET['upload'] == "success") {
                echo '<div class="success"><p>Upload Successfull</p></div>';
              }
            }
            echo '
            </div>
            <p></p>
            <p>Uploads Your files</p>
              <form action="include/upload.inc.php" method="post"enctype="multipart/form-data">
                <div class="input"><input type="file" name="file"></div>
                <p></p>
                <button type="submit" name="submit">Submit</button>
              </form>
            </div>
                  ';
          }
          else {
            echo '<p>no user log in</p>';
            echo '<div class="form">
                    <div class="errors">';
            //login error show
            if (isset($_GET['error'])) {
              if ($_GET['error'] == "emptyfields") {
                echo '<p>enter your username and password</p>';
              }
              elseif ($_GET['error'] == "worngpassword") {
                echo '<p>Worng password</p>';
              }
              elseif ($_GET['error'] == "sqlerror1") {
                echo '<p>sql error</p>';
              }
            }
            //for login and if you signup then redirect you to signup.php
            echo '
              </div>
              <form action="include/login.inc.php" method="post">
                    <div class="input"><input type="text" name="emailuid" required="required" ><span> username/email </span></div>
                    <div class="input"><input type="password" name="pwd" required="required"><span> password </span></div>
                    <button type="submit" name="login" >Login</button>
              </form>
              <button type="submit" name="signup" class="message" > <a href="signup.php">Signup</a> </button>
            </div>
            ';
          }
         ?>
      </nav>
    </header>
