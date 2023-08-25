<?php
$showerror = "false";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'partials/dbconnect.php';
    $useremail = $_POST['signupemail'];
    $userpass = $_POST['password'];
    $usercpass = $_POST['cpassword'];

    $exist = "select * from `users` where useremail = '$useremail'";
    $result = mysqli_query($con,$exist);
    $numrows = mysqli_num_rows($result);
    if($numrows > 0)
    {
        $showerror = "Email already exists";
    }
    else{

        if($userpass == $usercpass)
        {
            $hash = password_hash($userpass,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`useremail`, `userpass`, `time`) VALUES ('$useremail', '$hash', current_timestamp())";
            $result = mysqli_query($con,$sql);
            if($result)
            {
                $showalert = true;
                header("Location: /index.php?signupsuccess=true");
                exit();
            }
        }
        else
        {
            $showerror = "Password does not match";
          
        }
    }
    header("Location: /index.php?signupsuccess=false&error=$showerror");
   
}

?>