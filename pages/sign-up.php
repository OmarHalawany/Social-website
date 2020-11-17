<?php
unset($_POST['fname']);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign up</title>
    <link rel="icon" href="../imgs/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/register-style.css">
  </head>
  <body>
    <?php include_once("sub_nav.html"); ?>
    <div class="container">
      <div class="row">

     <form class="sign-in" action="register.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)" >
       <h3>Sign up</h3>
       <input type="text" name="fname" class="nfield" required placeholder="First name">
       <input type="text" name="lname" class="nfield" required placeholder="Last name">
       <br class="fix">
       <input type="text" name="email" required placeholder="Email">
       <input type="password" name="pass" required placeholder="Password">
       <input type="password" name="cpass" required placeholder="Confirm password">
       <h5 id="picp">Choose a profile picture:</h5>
       <input type="file" accept="image/*" id="image" name="image">
       <button type="Submit" class="signbtn" name="signbtn">Sign up</button>
       <p>Already have an account? <a href="sign-in.php">Sign in</a> </p>
     </form>
      </div>
    </div>
    <?php include_once("footer.html"); ?>
    <script src="../js/signup_script.js"> </script>
  </body>
</html>
