<?php
if(!empty($_POST['fname'])) {
    $conn = mysqli_connect("localhost","root" , "", "omar");
    $first = $_POST['fname'];
    $second = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $uploaddir = "../imgs/";
    $file_name = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir.$_FILES['image']['name']);
    $checkquery="SELECT * FROM signup WHERE email='$email'";
    $check=mysqli_query($conn,$checkquery);
    if(mysqli_num_rows($check)==0){
    $query = "INSERT INTO signup(fname, lname,email,password,profilepic) VALUES ('$first','$second','$email','$pass','$file_name')";
    mysqli_query($conn, $query);
    header("Location: sign-in.php");
  }
  else if(mysqli_num_rows($check)>0){
     echo "<h4>Email taken</h4>";
  }
  else {
    echo "<h4>Error while signing up</h4>";
  }
}
?>
