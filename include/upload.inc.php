<?php
session_start();
function goto1(){header("Location: ../index.php?upload=success");exit();}
function goto2(){header("Location: ../index.php?error=toobig");exit();}
function goto3(){header("Location: ../index.php?error=uploadingerror");exit();}
function goto4(){header("Location: ../index.php?error=unsupportext");exit();}
$usr = $_SESSION['userUid'];
if (isset($_POST['submit'])) {
  //initialize the all information about uploaded file
  $file = $_FILES['file'];                                                      //file info array
  $fileName = $_FILES['file']['name'];                                          //file name
  $fileTempName = $_FILES['file']['tmp_name'];                                  //file temporary location
  $fileSize = $_FILES['file']['size'];                                          //file size
  $fileError = $_FILES['file']['error'];                                        //error
  $fileType = $_FILES['file']['type'];                                          //file extention

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
  //array of allowed files extention it can be extendex
  //make sure to change the limit of file uploading in php.init file
  //here i set the limit in 100Mb and upload limit is 90Mb
  $allowed = array('jpg', 'pdf', 'rar', 'jpeg', 'zip', 'txt', 'log', 'png', 'exe', 'mp3', 'mp4', 'wpl', 'wav', 'mpa', '7z', 'deb', 'tar.gz', 'iso', 'db', 'sql', 'xml', 'apk', 'bat', 'cpp', 'c', 'sh', 'ico', 'ai', 'psd',  'ttf', 'ps', 'css', 'xml', 'js', 'html', 'vb', '3gp', 'avi', 'm4v', 'mpg', 'mpeg', 'wmv', 'doc', 'docx', 'wpd', 'py', '');
  //error handlers and success upload
  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize <90000000) {
        $fileId = $fileName;
        $fileDestination = "../userfiles/$usr/".$fileId;
        move_uploaded_file($fileTempName, $fileDestination);
        goto1();
        exit();
      }
      else {
        goto2();
      }
    }
    else {
      goto3();
    }
  }
  else {
    goto4();
  }
}
exit;
?>
