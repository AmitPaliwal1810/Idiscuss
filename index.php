<!doctype html style="scroll:smooth; ">
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
    #category_container {
        min-height: 200vh;
    }
    </style>

    <title>iDiscuss-Coding Forum</title>
</head>

<body>

    <?php include 'partial/_header.php';?>
    <?php include 'partial/_dbconnect.php';?>



    <!-- slider start here -->

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?programmer,google" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?apple,laptops" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?coder,microsoft" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <marquee class="bg-danger">
        <h3 class="text-success my-4">Hey Users, Thank you so much for visiting our site. If You want to add some more
            categories please contact to the developer and submit your concern on contact form. </h3>
    </marquee>

    <!-- category container starts here -->

    <div class="container my-3" id="category_container">
        <h2 class="text-center">iDiscuss Browse Category </h2>
        <div class="row " style="display:flex; justify-content : center; ">


            <!-- fetch all the categories -->
            <!-- use a loop to iterate the category -->
            <?php 
        $sql  = " SELECT * FROM `categories` ";
        $result = mysqli_query($conn , $sql);

        while($row = mysqli_fetch_assoc($result)){

            // echo $row['category_id'];
            // echo $row['category_name'];

            $cat  = $row['category_name'];
            $desc = $row['category_description'];
            $id = $row['category_id'];

            echo '  
            <div class="col-ml-4 my-2">
                <div class="card mx-4 " style="width: 18rem;">
                    <img src="https://source.unsplash.com/500x400/?coding,'.$cat.'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> <a class="text-success" href = "threadlist.php?catid='.$id.' "> '.$cat.' </a></h5>
                        <p class="card-text">'.substr($desc , 0 ,80).'...</p>
                        <a href="threadlist.php?catid='.$id.' " class="btn btn-success">View Threads</a>
                    </div>
                </div>
            </div> ';
        }

        ?>

        </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>
        <?php
            include 'partial/_footer.php';
        ?>

</html>