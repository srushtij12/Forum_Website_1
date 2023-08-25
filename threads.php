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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sn = $_POST['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$th_title', '$th_desc', '$id', '$sn')";
        $result = mysqli_query($con, $sql);
        $showalert = true;
        if($showalert)
        {
           echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Hiiiiii</strong> Your thread has been added, please wait for community to respond!!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
        }
    }
    ?>


    <div class="container text-center bg-secondary my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?>Forums</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>What is forum use?
                A forum is an online discussion board where people can ask questions, share their experiences, and
                discuss topics of mutual interest. </p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <?php 
     if(isset($_SESSION['loggedin'])  && $_SESSION['loggedin']==true)
     {
     echo '<div class="container">
        <h1>Start a discussion : </h1>
        <form action=" ' .$_SERVER['REQUEST_URI']. '" method="POST">
            <div class="form-group">
                <label for="title">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                <small id="title1" class="form-text text-muted">Keep your title as crisp and short as
                    possible.</small>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
            <br>
            <div class="form-group">
                <label for="desc">Elaborate your problem here!!</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success my-4">Submit</button>
        </form>
    </div>';
     }
     else{

       echo '  <div class="container">
       <h1>Start a discussion : </h1>
       <p class="lead">You are not logged in! Please LOGIN!!</p>
   </div>';
     }
    ?>

  

    <div class="container mb-5" id="ques">
        <h1>Brouse Questions : </h1>

        <?php

        $id = $_GET['catid'];
      
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($con, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $thread_time = $row['time'];
            $th_user_id = $row['thread_user_id'];
            $sql2="Select useremail from `users` where sno='$th_user_id'";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $id1 = $row['thread_id'];
            echo  ' <div class="media my-3">
  
  <div class="media-body">
 
    <h5 class="mt-0"><a href="/thread.php?threadid=' . $id1 . '">' . $thread_title . '</a></h5>
    ' . $thread_desc . '
  </div>
  <p class="fw-bold my-0">Asked by : ' .$row2['useremail']. ' at ' .$thread_time . '</p>
</div>';
        }

        if ($noresult) {
            echo ' <div class="jumbotron jumbotron-fluid ">
    <div class="container">
      <p class="display-4">No Questions Found!</p>
      <p class="lead">****Be the first person to ask a question.****</p>
    </div>
  </div>';
        }
        ?>




    </div>






    <?php include 'partials/footer.php';  ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>