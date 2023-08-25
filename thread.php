<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
        #ques {
            min-height: 433px;
        }
    </style>
    <title>My Forum</title>
</head>

<body>

<?php
   include 'partials/header.php';
   include 'partials/dbconnect.php';
   $id = $_GET['threadid'];
   $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
   $result = mysqli_query($con,$sql);
   while($row = mysqli_fetch_assoc($result))
   {
    $thread_title = $row['thread_title'];
    $thread_desc = $row['thread_desc'];
    $thread_user_id = $row['thread_user_id'];
     $sql2="Select useremail from `users` where sno='$thread_user_id'";
     $result2 = mysqli_query($con, $sql2);
     $row2 = mysqli_fetch_assoc($result2);
     $posted_by = $row2['useremail'];
   }

?>
 

 <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $th_comment = $_POST['comment'];
        $sn = $_POST['sno'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$th_comment', '$id', '$sn', current_timestamp())";
   
        $result = mysqli_query($con, $sql);
        $showalert = true;
      }
        if($showalert)
        {
           echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong> Your comment has been added!!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
        }
        // else{
        //   echo "gggggg"; 
        // }
  
    ?>



    <div class="container bg-secondary text-center my-4">
    <div class="jumbotron">
  <h1 class="display-4"><?php   echo $thread_title;?></h1>
  <p class="lead"><?php   echo $thread_desc;?></p>
  <hr class="my-4">
  <p >What is forum use?
A forum is an online discussion board where people can ask questions, share their experiences, and discuss topics of mutual interest. </p>
  <p class="text-left my-3">Posted By -<b> <?php echo $posted_by ?></b></p>
</div>
    </div>










    <?php 
     if(isset($_SESSION['loggedin'])  && $_SESSION['loggedin']==true)
     {
     echo ' <div class="container">
     <h1>Post a comment :  </h1>
     <form action=" ' .$_SERVER['REQUEST_URI']. ' " method = "post">
         
         <br>
         <div class="form-group">
             <label for="desc">Type your comment!!!</label>
             <br>
             <br>
             <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
             <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
         </div>
         <button type="submit" class="btn btn-success my-4">Post Comment</button>
     </form>
 </div>';
     }
     else{

       echo '  <div class="container">
       <h1>Start a discussion : </h1>
       <p class="lead">You are not logged in! Please LOGIN to post a comment!!!</p>
   </div>';
     }
    ?>



















    <div class="container mb-5"  id="ques">
        <h1 >Discussions : </h1>


       <?php
  
  $id = $_GET['threadid'];
  $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
  $result = mysqli_query($con,$sql);
  $noresult = true;
  while($row = mysqli_fetch_assoc($result))
  {
     $noresult=false;
     $comment_time = $row['comment_time'];
     $comment_content = $row['comment_content'];
     $cid = $row['comment_id'];
     $th_user_id = $row['comment_by'];
     $sql2="Select useremail from `users` where sno='$th_user_id'";
     $result2 = mysqli_query($con, $sql2);
     $row2 = mysqli_fetch_assoc($result2);
 

    echo  ' <div class="media my-3">
 
 <div class="media-body">
   <p class="fw-bold my-0">' .$row2['useremail']. ' '." at ".' ' .$comment_time . '</p>
   '. $comment_content .'
 </div>
</div>';
}

if($noresult)
{
   echo ' <div class="jumbotron jumbotron-fluid ">
   <div class="container">
     <p class="display-4">No Comments Found!</p>
     <p class="lead">****Be the first person to comment.****</p>
   </div>
 </div>';
}
?>
        



    </div>






    <?php  include 'partials/footer.php';  ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>