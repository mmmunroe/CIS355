<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","mmmunroe","mmmunroe","dumb_password");
if(isset($_POST['login_btn']))
{
    $username=mysql_real_escape_string($_POST['username']);
    $password=mysql_real_escape_string($_POST['password']);
    $password=md5($password); //Remember we hashed password before storing last time
    $sql="SELECT * FROM artists,patrons WHERE name='$username' AND password='$password'";
    $result=mysqli_query($db,$sql);
    if(mysqli_num_rows($result)==1)
    {
        $_SESSION['message']="You are now Loggged In";
        $_SESSION['username']=$username;
        header("location:artHub.php");
    }
   else
   {
                $_SESSION['message']="Username and Password combination incorrect";
				header("location:artHub.php");

    }

}
?>
