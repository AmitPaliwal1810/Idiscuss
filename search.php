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
    #maincontainer {
        min-height: 100vh;
    }
    </style>

    <title>iDiscuss-Coding Forum</title>
</head>

<body>

    <?php include 'partial/_header.php';?>
    <?php include 'partial/_dbconnect.php';?>

    <!-- this first query will help you to enable the full search mode and second query help you to run your search query and against your result -->

    <!-- ALTER TABLE threads ADD FULLTEXT (`thread_title` , `thread_desc`) -->

    <!-- SELECT * FROM `threads` WHERE MATCH (thread_title , thread_desc) against ('unable') -->




    <!-- search result -->

    <div class="container my-2" id="maincontainer">
        <h1 class=" mb-4 py-2 text-success">Search results for <em>"  <?php echo $_GET['search'] ?>  "  <em></h1>
        


        <?php

        $noresult = true;
        $query = $_GET['search'];
        $sql = " SELECT * FROM threads WHERE MATCH (thread_title , thread_desc) against ('$query') ";
        
        $result = mysqli_query($conn , $sql);
        

        while($row = mysqli_fetch_assoc($result)){
            $noresult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=".$thread_id;

            // display the reuslt

            echo '<div class="result"> 
             <h3> <a class="text-dark" href="'.$url.'"> '.$title.'</a></h3>
            <p>'.$desc.'</p>
            </div>
            ';             

        }
        if($noresult){
            echo '   <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">Sorry No Result found</h1><br>
              <p class="lead">Your search - '.$query.' - did not match any documents.
              <br><br>
              Suggestions:
              <br>
              Make sure that all words are spelled correctly.<br>
              Try different keywords.<br>
              Try more general keywords.</p>
            </div>
          </div>   ';
        }
    
    
        ?>

            

        

    </div>



    <?php
    include 'partial/_footer.php';
    ?>
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