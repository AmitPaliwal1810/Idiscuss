<!-- what this file will do? -->
<!-- it will select all the threads realted to that we clicked in index.html category page -->
<!-- matlab jaisse agar python wale card pr koi click kre toh ye python k sare related threads dikha dega  -->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>iDiscuss-Coding Forum</title>
</head>

<body>

    <?php include 'partial/_header.php';?>
    <?php include 'partial/_dbconnect.php';?>


    <?php 
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($conn , $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>


    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        // insert into thread into db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sno = $_POST['sno'];


        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp());";
        $result = mysqli_query($conn , $sql);
        $showAlert = true;
        if($showAlert){
            echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successful !</strong> thankyou so much for asking the question.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>  ';
        }
        
    }
    
    ?>

    <!-- category container starts here  -->

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">welcome to <?php echo $catname ;?> forum</h1>
            <p class="lead text-success"><?php echo $catdesc;?></p>
            <hr class="my-4">
            <p>This is a perr to perr forum .
                <br>
                1) No Spam / Advertising / Self-promote in the forums. ...
                <br>
                2) Do not post copyright-infringing material. ...
                <br>
                3) Do not post “offensive” posts, links or images. ...
                <br>
                4) Do not cross post questions. ...
                <br>
                5) Remain respectful of other members at all times.
                <br>
            </p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>





    <?php

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){       

    echo '

    <div class="container">

        <h1 class="py-4 text-center">Strat a Discussion</h1>

        <form action = "'. $_SERVER["REQUEST_URI"].'" method = "post">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                    possible</small>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>

    </div>
    ';

    }

    else{

        echo '   <div class="container">
        <p class="lead text-danger">You are not logged In. Please login to be start a Discussion</p>
        </div>   ';

    }

    ?>

    


    <div class="container mb-5 my-3">
        <h1 class="py-4 text-center">Browse Questions</h1>

        <?php 
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
        
        $result = mysqli_query($conn , $sql);
        // yahan hum noresult variable use kar rhe agar humko koi question nahi milta toh vo ye show kr dega
        // yahan humne maan liya hia ki koi data nahi hai show krne k liye isliye humne noresult koi true dikha diya hai

        $noresult = true;
        
      while($row = mysqli_fetch_assoc($result)){
        //   yahan pr noresult false hai matlab jab result milta tabhi toh while loop k under gya
        $noresult = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['timestamp'];
        $thread_user_id = $row['thread_user_id'];

        $sql2 = "  SELECT user_email FROM `users` WHERE sno = $thread_user_id
        ";
        $result2 = mysqli_query($conn , $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        
        echo '
        <div class="media py-3" style=" display : flex ; justify-content : center; align-items:center; ">
            <img src="partial/defaultuser.png" class="mr-5" alt="..." style="width : 60px ; height : auto; ">
            <div class="media-body">
                <p class="font-weight-bold text-danger my-2">'.$row2['user_email'].' at '. $thread_time .'</p>    
                <h5 class="mt-0"><a class="text-success" href="thread.php?threadid='. $id.'"> '.$title.'</a></h5>
                '.$desc.'
            </div>
        </div>
        ';
      }
      if($noresult){
          echo'
          <div class="jumbotron jumbotron-fluid">
          <div class="container">
              <p class="display-4">No Threads found</p>
              <p class="lead"> <b> Be the first person to ask the question </b>.</p>
          </div>
          </div>
         ';
      }

      
     ?>


    </div>




    <?php include 'partial/_footer.php';?>
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

</html>