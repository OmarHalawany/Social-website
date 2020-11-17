<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:sign-in.php");
}
$conn=mysqli_connect("localhost","root","","omar");
if(isset($_POST['subbtn']) && !empty($_POST['subbtn'])) {
    $pass = $_POST['password'];
    $userid = $_SESSION['user_id']['id'];
    $query = "SELECT * FROM signup WHERE id='$userid'";
    $answer=mysqli_query($conn,$query);
    $fet=mysqli_fetch_array($answer);
    if($pass!=$fet['password']){
        header("Location:edit-profile.php");
    }
    else{
        if(!empty($_POST['fname'])){
            $fname=$_POST['fname'];
            $query="UPDATE signup SET fname='$fname' WHERE id='$userid'";
            mysqli_query($conn,$query);
        }
        if(!empty($_POST['lname'])){
            $lname=$_POST['lname'];
            $query="UPDATE signup SET lname='$lname' WHERE id='$userid'";
            mysqli_query($conn,$query);
        }
        if(!empty($_POST['newpassword']) && !empty($_POST['newpassword'])){
            $pass=$_POST['newpassword'];
            $query="UPDATE signup SET password='$pass' WHERE id='$userid'";
            mysqli_query($conn,$query);
        }
        header("Location:profile.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit profile</title>
    <link rel="icon" href="../imgs/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/edit-profile-style.css">

  </head>
  <body>
    <?php include_once("sub_nav.html"); ?>
    <div class= "container">
      <div class="row">

     <form class="col-m-8 edit-form" action="edit-profile.php" method="post" onsubmit="return validateForm(this)">
       <h3>Edit info</h3>
       <input type="text" name="fname" class="nfield" placeholder="First name">
       <input type="text" name="lname" class="nfield" placeholder="Last name">
       <input type="password" name="password" placeholder="Password">
       <input type="password" name="newpassword" placeholder="New password">
       <input type="password" name="confirmpassword" placeholder="Confirm password">
       <input type="file" accept="image/*" id="pic" name="pic">
       <input type="submit" class="subbtn" name="subbtn" value="Submit">

     </form>

      </div>

    </div>

    <?php include_once("footer.html"); ?>
    <script src="../js/edit-js.js"></script>
  </body>
</html>
