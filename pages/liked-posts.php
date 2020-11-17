<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:sign-in.php");
}
$conn=mysqli_connect("localhost","root","","omar");
$id_user=$_SESSION['user_id']['id'];
$querygen=mysqli_query($conn,"SELECT * FROM likedposts WHERE userid='$id_user'");
$query1=mysqli_query($conn,"SELECT fname,lname,profilepic FROM signup WHERE id='$id_user'");
$fet=mysqli_fetch_array($query1);
$username=$fet['fname']." ".$fet['lname'];

if(isset($_POST['sublike']))
{
    $post=$_POST['postid'];
    $query="SELECT * FROM likedposts WHERE postid='$post' and userid='$id_user'";
    $ans=mysqli_query($conn,$query);
    if(mysqli_num_rows($ans)){
        $query="DELETE FROM likedposts WHERE userid='$id_user' and postid='$post'";
        mysqli_query($conn,$query);
        $query="UPDATE posts SET nolikes=nolikes-1 WHERE postid='$post'";
        mysqli_query($conn,$query);
    }
    else{
        $query="INSERT INTO likedposts (userid,postid) VALUES('$id_user','$post')";
        mysqli_query($conn,$query);
        $query="UPDATE posts SET nolikes=nolikes+1 WHERE postid='$post'";
        mysqli_query($conn,$query);
    }
    header("Location:liked-posts.php");
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Liked posts</title>
    <link rel="icon" href="../imgs/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/liked-posts-style.css">
  </head>
  <body>
    <?php include_once("main_nav.html"); ?>
    <div class="container likedMain">
      <?php
      if(is_null($fet['profilepic'])){
        ?>
     <a href="profile.php"><img src="../imgs/profilePic.png" id="hprofilePic">
   <?php } ?>
 <?php if(!is_null($fet['profilepic'])){ ?>
  <a href="profile.php"><img src="../imgs/<?php echo $fet['profilepic']; ?>" id="hprofilePic">
<?php } ?>
      <h6 id="husername">
          <?php
            echo $username;
          ?>
      </h6></a>
      <br class="fix">
      <hr>

      <h3>Posts you've liked</h3>
      <?php
        while($allposts=mysqli_fetch_array($querygen)){
            $postid=$allposts['postid'];
            $userid="SELECT * FROM posts WHERE postid='$postid'";
            $user=mysqli_query($conn,$userid);
            $fet=mysqli_fetch_array($user);
            $id=$fet['userid'];
            $post=$fet['post'];
            $nolikes=$fet['nolikes'];
            $answer="SELECT fname,lname FROM signup WHERE id='$id'";
            $tmp=mysqli_query($conn,$answer);
            $fet=mysqli_fetch_array($tmp);
            $fname=$fet['fname'];
            $lname=$fet['lname'];
      ?>
      <div class="posts">
          <p>
              <?php
                echo $fname." ".$lname;
              ?>
          </p>
          <hr>
          <p>
              <?php
                echo $post;
              ?>
          </p>
          <form action="" method="post">
              <button type="submit" name="sublike" class="likepost"><i class="far fa-thumbs-up lik"></i> <p id="liknum" class="lik"> <?php echo $nolikes; ?> </p> </button>
              <input type="hidden" name="postid" value="<?php echo $postid; ?>">
          </form>
      </div>
      <?php }?>

    </div>


    <?php include_once("footer.html"); ?>
  </body>




</html>
