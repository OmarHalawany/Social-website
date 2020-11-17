<?php
session_start();
if(!empty($_POST['email'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $conn=mysqli_connect("localhost","root","","omar");
    $query="SELECT email, password,id FROM signup WHERE email='$email' AND password= '$pass'";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    $id=mysqli_fetch_array($result);
    if($count!=0){
        $_SESSION['user_id']=$id;
        header("Location: home.php");
    }
    else{
        echo "Problem signing in check email and password!";
    }
}
