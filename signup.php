<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-image: url('https://images.pexels.com/photos/66869/green-leaf-natural-wallpaper-royalty-free-66869.jpeg?cs=srgb&dl=natural-wallpaper-green-leaf-royalty-free-66869.jpg&fm=jpg');">
    <?php
        session_start();

    ?>
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow p-10 mb-10 bg-white rounded">
        <a class="navbar-brand" href=""><img src="https://1000logos.net/wp-content/uploads/2018/08/University-of-San-Carlos-Logo.png" alt="Italian Trulli" style="width:250px;height:100px" > </a>
        <button class="navbar-toggler shadow p-10 mb-10 bg-white rounded" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
           
            <ul class="navbar-nav navbar-right">
            </ul>
        </div>
    </nav>
    <div class="container  w-50 h-100 shadow-none p-3 mb-5 bg-light rounded">
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group"><br><br>
                        <form action="signup.php" method="post">
                                <label>Firstname</label><br>
                                <input type="text" class="form-control" name="fname"><br><br>
                                <label>Lastname</label><br>
                                <input type="text" class="form-control" name="lname"><br><br>
                                <label>Address</label><br>
                                <input type="text" class="form-control" name="add"><br><br>
                                <label>Email</label><br>
                                <input type="email" class="form-control" name="email"><br><br>
                                <input type="radio" id="male" name="account_type" value="student">
                                <label for="male">student</label><br>
                                <input type="radio" id="female" name="account_type" value="faculty">
                                <label for="female">faculty</label><br>
                                <label>Password</label><br>
                                <input type="password" class="form-control" name="password"><br><br>
                                <label>Confirm Password</label><br>
                                <input type="password" class="form-control" name="confirmpassword"><br><br>
                                <button type="submit" name="register">Register</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    


    <?php

        if(isset($_POST['register'])){
            if($_POST['password'] == $_POST['confirmpassword']){
                include 'thing.php';

                $conn = mysqli_connect($servername, $username, $password, $dbname);
                if(!$conn){
                    die("Connection failed: ".mysqli_connect_error());
                }

                $firstname = $_POST['fname'];
                $lastname = $_POST['lname'];
                $address = $_POST['add'];                                                
                $email = $_POST['email'];
                $account_type = $_POST['account_type'];
                $userpass =  $_POST['password'];
                $sql = "INSERT INTO account(fname, lname, address, email, password ,account_type)
                         VALUES('$firstname', '$lastname', '$address', '$email', '$userpass','$account_type')";
                         
                if(mysqli_query($conn, $sql)){
                    echo "New record created!";
                    header('location: login_page.php');
                } else {
                    echo "Error: ".$sql."<br>".mysqli_error($conn);
                }

                mysqli_close($conn);
            }
        }
    ?>
</body>
</html>