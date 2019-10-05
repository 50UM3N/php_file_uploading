<?php
if (isset($_POST['login'])) {
  require 'dbh.inc.php';
  //initilize the signup data
  $emailuid = $_POST['emailuid'];
  $password = $_POST['pwd'];
  //error handlers
  if (empty($emailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else {
   $sql = "SELECT * FROM users WHERE uid=? OR email=?";                         //sql quaries for fetch the user info of thne mail or uid
   $stmt = mysqli_stmt_init($con);                                              //initilize the statement
   //prepare statement
   if (!mysqli_stmt_prepare($stmt, $sql)) {
     header("Location: ../index.php?error=sqlerror1");
     exit();
   }
   else {
     mysqli_stmt_bind_param($stmt, "ss", $emailuid, $emailuid);                 //bind the parameters for avoiding sql injection
     mysqli_stmt_execute($stmt);                                                //execute the quarry
     $result = mysqli_stmt_get_result($stmt);
     if ($row = mysqli_fetch_assoc($result)) {
       $pwdcheck = password_verify($password, $row['pwd']);                     //varify the password it store true or false
       if ($pwdcheck == false) {
         header("Location: ../index.php?error=worngpassword");
         exit();
       }
       elseif ($pwdcheck == true) {
         session_start();                                                        //start the session
         //session variables
         $_SESSION['userId'] = $row['id'];                                      //session variable of user id
         $_SESSION['userUid'] = $row['uid'];                                    //session variable of user name
         header("Location: ../index.php?login=success");
         exit();
       }
       else {
         header("Location: ..index.php?error=worngpwd");
         exit();
       }
     }
   }
  }
}
else {
  header("Location: ../login.php");
  exit();
}
