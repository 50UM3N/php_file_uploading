<?php
if (isset($_POST['signup'])) {
  require 'dbh.inc.php';
  //initilize the signup data
  $username = $_POST['uname'];
  $email = $_POST['email'];
  $password = $_POST['pwd'];
  $repassword = $_POST['repwd'];
  //error handlers
  if (empty($username) || empty($email) || empty($password) || empty($repassword)) {
    header("Location: ../signup.php?errors=emptyfields&uname=".$username."&email=".$email);
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9*$/]",$username)) {
    header("Location: ../signup.php?errors=invaliduidandemail");
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?errors=invalidemail&uname=".$username."&email=?");
    exit();
  }
  elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?errors=invaliduname&uname=&email=".$email);
    exit();
  }
  elseif ($password !== $repassword) {
    header("Location: ../signup.php?errors=pwdcheck&uname=".$username."&email=".$email);
    exit();
  }
  else {
    //check that the username is taken or not
    $sql = "SELECT uid FROM users WHERE uid=?;";                                //sql quaries for get same user in db
    $stmt = mysqli_stmt_init($con);                                             //initilize the statement
    //prepare the statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../signup.php?errors=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);                            //bind the parameters for avoiding sql injection
      mysqli_stmt_execute($stmt);                                               //execute the quarry
      mysqli_stmt_store_result($stmt);                                          //store the result in $stmt
      $result = mysqli_stmt_num_rows($stmt);                                    //get the number of row in $result
      //check that there is user exist or not
      if ($result > 0) {
        header("Location: ../signup.php?error=usertaken");
        exit();
      }
      else {
        $sql = "INSERT INTO users (uid, email, pwd) values (?, ?, ?);";         //sql quarry for create new user
        //prepare the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        //create new user
        else {
          $hashpwd = password_hash($password, PASSWORD_DEFAULT);                //hashed the password
          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashpwd);    //bind the parameters for avoiding sql injection
          mysqli_stmt_execute($stmt);                                           //execute the quarry
          mkdir("../userfiles/$username");                                      //make the new user directory
          header("Location: ../signup.php?signup=success");
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($con);
}
else {
  header("Location: ../signup.php");
  exit();
}
