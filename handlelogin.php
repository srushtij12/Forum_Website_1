<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'partials/dbconnect.php';
    $email = $_POST['loginemail'];
    $pass = $_POST['pass'];
    $sql = "Select * from users where useremail='$email'";
    $result=mysqli_query($con,$sql);
    $numrows = mysqli_num_rows($result);
    if($numrows == 1)
    {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['userpass']))
        {
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail']=$email;
           
        }
        else{
            echo "sorry";
        }
     
        header("Location: /index.php");
    }
}
?>