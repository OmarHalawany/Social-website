<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:sign-in.php");
}
$conn=mysqli_connect("localhost","root","","omar");
$id_user=$_SESSION['user_id']['id'];
$querygen=mysqli_query($conn,"SELECT * FROM posts WHERE userid='$id_user'");
$query1=mysqli_query($conn,"SELECT fname,lname,profilepic FROM signup WHERE id='$id_user'");
$fet=mysqli_fetch_array($query1);
$username=$fet['fname']." ".$fet['lname'];

if(isset($_POST['subnewpost'])){
    $post=$_POST['newpostarea'];
    $query2="INSERT INTO posts (userid,post,nolikes) VALUES('$id_user','$post',0)";
    mysqli_query($conn,$query2);
}
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
    header("Location:profile.php");
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="icon" href="../imgs/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/profile-style.css">
  </head>
  <body>
    <?php include_once("main_nav.html"); ?>
    <div class="container profileBody">
     <div class="userinfo">

      <div class="links">
        <?php
        if(is_null($fet['profilepic'])){
          ?>
       <img src="../imgs/profilePic.png" id="profilePic">
     <?php } ?>
   <?php if(!is_null($fet['profilepic'])){ ?>
    <img src="../imgs/<?php echo $fet['profilepic']; ?>" id="profilePic">
  <?php } ?>
       <h4 id="username">
           <?PHP
            echo $username;
           ?>
       </h4>

       <hr id="profsplit" >

     </div>

      <a href="edit-profile.php" id="profileLink1" > <i class="far fa-edit"></i> Edit profile</a>
      <br class="fix">
      <a href="liked-posts.php" id="profileLink2"  > <i class="far fa-thumbs-up"></i>Posts you've liked</a>

    </div>

    <div class="postarea">
      <form class="newpost" action="profile.php" method="post">
        <div class="form-group shadow-textarea">
          <label for="newpostarea">New post</label>
          <textarea class="form-control z-depth-1" id="newpostarea" name="newpostarea" rows="3" placeholder="Write something here..." >  </textarea>
          <input type="submit" id="newpostsubmit" value="Post" name="subnewpost">
        </div>
      </form>
      <h4>Posts</h4>
        <?php
        while($ans=mysqli_fetch_array($querygen)){
            $post=$ans['post'];
            $pid=$ans['postid'];
            $nolikes=$ans['nolikes'];
        ?>
      <div class="posts">
          <p>
              <?php echo $username;?>
          </p>
          <hr>
          <p>
              <?php echo $post; ?>
          </p>
          <form action="" method="post">
              <button type="submit" name="sublike" class="likepost"><i class="far fa-thumbs-up lik"></i> <p id="liknum" class="lik"> <?php echo $nolikes; ?> </p> </button>
              <input type="hidden" name="postid" value="<?php echo $pid; ?>">
          </form>
      </div>

      <?php }?>

    </div>

   </div>

  </body>


</html>
 <?php include_once("footer.html"); ?>
