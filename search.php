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
    #mcontainer {
        min-height: 85vh;
    }
    </style>
    <title>My Forum</title>
</head>

<body>

    <?php
     include 'partials/dbconnect.php';
   include 'partials/header.php';

  
?>
    <div class="container my-3" id="mcontainer">
        <h1>Search Results for <?php echo $_GET['search']  ?></h1>

        <?php 
     $noresult=true;  
   $id12 = $_GET['search'];
   $sql = "SELECT * FROM `threads` WHERE match (thread_title,thread_desc) against ('$id12')";
   $result = mysqli_query($con,$sql);
   while($row = mysqli_fetch_assoc($result))
   {
    $thread_title = $row['thread_title'];
    $thread_desc = $row['thread_desc'];
    $th_id= $row['thread_id'];
    $url= "thread.php?threadid=".$th_id;
    $noresult=false;
     echo '   <div class="result">
     <h3><a href="'.$url.'" class="text-dark">' .$thread_title. '</a></h3>
     <p>' .$thread_desc. '</p>
   </div>
  </div>';
  include 'partials/footer.php';  
   }
   ?>
   <?php
   if($noresult)
   {
    echo '<div class="jumbotron">
  
    <hr class="my-4">
    <p>No Results Found!!! </p>
 
</div>';
   }
       
       ?>


      


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

</body>

</html>