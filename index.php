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
      .container
      {
        min-height: 80vh;
      }
    </style>
    <title>My Forum</title>
</head>

<body>

    <?php
     include 'partials/dbconnect.php';
   include 'partials/header.php';
  
?>
 
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/800x300/?coding,apple" class="card-img-top" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/800x300/?programming" class="card-img-top" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/800x300/?jio" class="card-img-top" class="d-block w-100"
                    alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <div class="container text-center my-4 " id="ques">
        <h1>Welcome to MyForum</h1>
        <div class="row">
        <?php
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result))
        {
          $cat= $row['category_name'];
          $id= $row['category_id'];
          $desc= $row['category_description'];
         echo ' <div class="col-md-4 my-3">
          <div class="card " style="width: 18rem;">
              <!-- <img src="https://source.unsplash.com/500x400/?$cat" alt="" srcset=""> -->
              <img src="https://source.unsplash.com/500x400/?'.$cat.'" class="card-img-top" alt="...">
              <div class="card-body ">
                  <h5 class="card-title"><a href="threads.php?catid=' . $id . '">   ' . $cat . '</a></h5>
                  <p class="card-text">'. substr($desc,0,60) . '....</p>
                  <a href="threads.php?catid=' . $id . '" class="btn btn-primary">View Threads</a>
              </div>
          </div>
      </div>';
        }
        ?>
           



        </div>
    </div>






    <?php  include 'partials/footer.php';  ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>