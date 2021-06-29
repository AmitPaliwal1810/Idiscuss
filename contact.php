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
    <?php
    include 'partial/_header.php';
    include 'partial/_dbconnect.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $name = $_POST["name"];
        $email = $_POST["email"];
        $phoneNo = $_POST["phoneNo"];
        $concern = $_POST["concern"];

        $sql = " INSERT INTO `contact` ( `user_name`, `user_email`, `user_phone_no`, `user_concern`, `datestamp`) VALUES ( '$name', '$email', '$phoneNo', '$concern', current_timestamp()); ";

        $result = mysqli_query($conn , $sql);

        if($result){

            echo ' <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">Your Details and Concern has been submitted successfully </h1>
              <p class="lead">Please click the button goto home page.</p>
              <button class=" btn btn-success"> <a class="text-light" href="./index.php">Home</a> </button>
            </div>
          </div>  ';
            
        }
        else{

            echo ' <div class="alert alert-danger" role="alert">
            A simple warning alert with <a href="#" class="alert-link">an example link</a> Sorry due to some technical Error Unable to submitted <br> Please submit again.
          </div ';
        }


    }
    
    ?>

    <div class="container px-5 my-5" id="outer-container">

    <h1 class="text-center text-success">Please Fill your Details and Concern</h1>

        <div class="container my-4 py-4 " id="inner-container">

            <form action="./contact.php" method="post">

                <div class="form-group">
                    <label class="font-weight-bold" for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>


                <div class="form-group">
                    <label class="font-weight-bold" for="exampleFormControlInput1">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                </div>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>


                <div class="form-group">
                    <label class="font-weight-bold" for="exampleFormControlInput1">Contact number</label>
                    <input type="text" class="form-control" id="phoneNo" name="phoneNo" placeholder="+91 - ">
                </div>



                <div class="form-group">
                    <label class="font-weight-bold" for="exampleFormControlTextarea1">Please discuss your
                        concern</label>
                    <textarea class="form-control" id="concern" name="concern" rows="3"></textarea>
                </div>

                <small id="emailHelp" class="form-text text-muted">We'll never share your detail with anyone
                    else.</small>
                <br>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>


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