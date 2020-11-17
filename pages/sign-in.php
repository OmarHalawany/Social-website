<?php
unset($_POST['email']);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign in</title>
    <link rel="icon" href="../imgs/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/register-style.css">
  </head>
  <body>
    <?php include_once("sub_nav.html"); ?>
    <div class= "container">
      <div class="row">

     <form class="col-m-8 sign-in" action="signin.php" method="post" onsubmit="return validateForm(this)">
       <h3>Sign in</h3>
       <input type="text" name="email" required placeholder="Email">
       <input type="password" name="password" required placeholder="Password">
       <button type="submit" class="signbtn" name="signbtn">Sign in</button>
        <p>Don't have an account yet? <a href="sign-up.php">Sign up</a> </p>
     </form>

      </div>

    </div>

    <?php include_once("footer.html"); ?>
    <script src="../js/signin_script.js"></script>
  </body>
</html>
