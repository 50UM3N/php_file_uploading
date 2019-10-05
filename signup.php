<?php
require 'header.php';
?>

<main>
  <div class="form">
    <div class="errors">
  <?php
    if (isset($_GET["errors"])) {
      //show all possible errors
      if ($_GET["errors"] == "emptyfields") {
        echo'<p>Empty Field</p>';
      }
      elseif ($_GET["errors"] == "invaliduidandemail") {
        echo'<p>Invalid User Name And password</p>';
      }
      elseif ($_GET["errors"] == "invalidemail") {
        echo'<p>Invalid E-mail Id</p>';
      }
      elseif ($_GET["errors"] == "invaliduname") {
        echo'<p>Invalid User Name</p>';
      }
      elseif ($_GET["errors"] == "pwdcheck") {
        echo'<p>Password not mached</p>';
      }
      elseif ($_GET["errors"] == "usertaken") {
        echo'<p>User Is Already Taken</p>';
      }
      elseif ($_GET["errors"] == "sqlerror") {
        echo'<p>Sql Error</p>';
      }
      else {
        echo'<p>Error</p>';
      }
    }
    elseif (isset($_GET["signup"])) {
      if($_GET["signup"] == "success"){
        echo'<div class="success"><p>Signup Successfull</p></div>';
      }
    }
   ?>
    </div>
   <!--signup form-->
  <form action="include/signup.inc.php" method="post">
    <div class="input"><input type="text" name="uname" required="required"><span>username</span></div>
    <div class="input"><input type="text" name="email" required="required"><span>e-mail</span></div>
    <div class="input"><input type="password" name="pwd" required="required"><span>password</span></div>
    <div class="input"><input type="password" name="repwd" required="required"><span>retype password</span></div>
    <button type="submit" name="signup">Signup</button>
  </form>
</div>
</man>

<?php
require 'footer.php';
 ?>
