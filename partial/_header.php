<?php
include '_dbconnect.php';
session_start();


echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
<a class="navbar-brand" href="index.php">  iDiscuss</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Top Category
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">'; 


      $sql = "  SELECT category_name , category_id FROM `categories` LIMIT 3 ";
      $result = mysqli_query($conn , $sql);
      
      while($row = mysqli_fetch_assoc($result)){

      
      echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
      
      }


      echo '
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="contact.php" aria-disabled="true">Contact</a>
    </li>
  </ul>
  <div class="mx-2 row">';

  echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">';


  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

    echo '  
    <input class="form-control mr-sm-2 " type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    <p class="text-light mx-4 my-0">  '. $_SESSION['useremail'] .'</p>
    
    <a href="./partial/_logout.php" class="btn btn-outline-danger my-2 my-sm-0" type="submit">LogOut</a>
    
    

  </form> ';


  }

  else{


    echo '  <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>

    

            </form>
      
    <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#loginmodal">LogIn</button>
    <button class="btn btn-outline-success" data-toggle="modal" data-target="#signupmodal">SignUp</button> 
   ';

  }


  
  
  
 echo' </div>
  
</div>
</nav>';

include 'partial/_loginmodal.php';
include 'partial/_signupmodal.php';

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){

  echo '   <div class="alert alert-success alert-dismissible fade show my-0 " role="alert">
  <strong>SignUp Succeessfully !</strong> Now you can LogIn in your account.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>   ';

}


elseif(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true1"){
  echo '   <div class="alert alert-warning alert-dismissible fade show my-0 " role="alert">
  <strong>Passwords do not match !</strong> Please insert Password carefully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>      '; 
}


elseif(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false"){
  echo '   <div class="alert alert-danger alert-dismissible fade show my-0 " role="alert">
  <strong>Hello dear !</strong> Your account is already exists <br> Please LogIn .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>      '; 
}

if(isset($_GET['login']) && $_GET['login'] == "true"){

//   echo '   <div class="alert alert-success alert-dismissible fade show my-0 " role="alert">
//   <strong>Login Successfully.
//   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
// </div>      '; 

}
elseif(isset($_GET['login']) && $_GET['login'] == "false"){

  echo '   <div class="alert alert-danger alert-dismissible fade show my-0 " role="alert">
  <strong>Invalid Password.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>      '; 

}

elseif(isset($_GET['login']) && $_GET['login'] == "false1"){

  echo '   <div class="alert alert-danger alert-dismissible fade show my-0 " role="alert">
  <strong>Please Signup first!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>      '; 

}

?>