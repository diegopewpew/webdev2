<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >Document</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body style="background-image: url('https://images.pexels.com/photos/66869/green-leaf-natural-wallpaper-royalty-free-66869.jpeg?cs=srgb&dl=natural-wallpaper-green-leaf-royalty-free-66869.jpg&fm=jpg');">

    <?php
    include 'thing.php';
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
        session_start();

    ?>
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow p-10 mb-10 bg-white rounded">
    <a class="navbar-brand" href=""><img src="https://1000logos.net/wp-content/uploads/2018/08/University-of-San-Carlos-Logo.png" alt="Italian Trulli" style="width:200px;height:80px"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav navbar-right">
            </ul>
        </div>
    </nav>
    
    <?php
 
    
    if(!isset($_SESSION['loggedIn'])) { 
      header("Location: login.php");
    }else{

      if($_SESSION['users'][$_SESSION['loggedIn']]['status'] ==="admin"){
        include "./tables/adminT.php";
      }else if($_SESSION['users'][$_SESSION['loggedIn']]['status'] ==="student"){
        include "./tables/stud.php";
      }else if($_SESSION['users'][$_SESSION['loggedIn']]['status'] ==="faculty"){
        include "./tables/teacherT.php";
      }
    }

    if(isset($_GET['logout'])) { #if u wanna logout, remove current login session and redirect to login page
      unset($_SESSION['loggedIn']);
      header("Location: login.php");
    }

    
  ?>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</body>
</html>