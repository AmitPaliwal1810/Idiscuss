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
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn , $sql);
    while($row = mysqli_fetch_assoc($result)){
        $thread_title = $row['thread_title'];
        $thread_desc = $row['thread_desc'];
    }
    ?>

<?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        // insert into comment into db
        $comment = $_POST['comment'];
        $sno = $_POST['sno'];



        $sql = "  INSERT INTO `comments` ( `comment_content`,`thread_id`,`comment_by`) VALUES ('$comment','$id','$sno');
        ";
        $result = mysqli_query($conn , $sql);
        $showAlert = true;
        if($showAlert){
            echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successful !</strong> thankyou so much for your valuable comment.
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
            <h1 class="display-4"><?php echo $thread_title ;?> forum</h1>
            <p class="lead"><?php echo $thread_desc;?></p>
        </div>
    </div>



    <?php
    
// line number 92 <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">   we set the value of user table's sno to get the email on the comment means how comment on the questions


    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){


        echo '
        <div class="container">

        <h1 class="py-4 text-center">Post a Comment</h1>

        <form action="'. $_SERVER["REQUEST_URI"] .'" method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>


                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>

            <button type="submit" class="btn btn-success">Post Comment</button>
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

    


    <div class="container mb-5 my-3" id="ques">
        <h1 class="py-4 text-center">Discussions</h1>


        <?php 
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
        
        $result = mysqli_query($conn , $sql);

        $noresult = true;
        
      while($row = mysqli_fetch_assoc($result)){
          $noresult = false;
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        $comment_time = $row['comment_time'];
        $thread_user_id = $row['comment_by'];

        $sql2 = "  SELECT user_email FROM `users` WHERE sno = $thread_user_id
        ";
        $result2 = mysqli_query($conn , $sql2);
        $row2 =mysqli_fetch_assoc($result2);
        
        echo '
        <div class="media py-3" style=" display : flex ; justify-content : center; align-items:center; ">
            <img src="partial/defaultuser.png" class="mr-5" alt="..." style="width : 60px ; height : auto; ">
            <div class="media-body">
            <p class="font-weight-bold text-success my-0">'.$row2["user_email"].' at '. $comment_time .'</p>             
                '. $content .'
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