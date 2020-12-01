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
    <a class="navbar-brand" href=""><img src="https://1000logos.net/wp-content/uploads/2018/08/University-of-San-Carlos-Logo.png" alt="Italian Trulli" style="width:200px;height:80px"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="registration.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">accounts <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav navbar-right">
            </ul>
        </div>
    </nav>
    
    <div class="container  w-25 h-100 shadow-none p-3 mb-5 bg-light rounded">
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group">
                        <form action="login_page.php" method="post">
                                
                                <label>Email</label><br>
                                <input type="email" class="form-control" name="email"><br><br>
                                <label>Password</label><br>
                                <input type="password" class="form-control" name="password"><br><br>
                                <button type="submit" name="register">log-in</button>
                                <a class="nav-link" href="index.php">forgot password? <span class="sr-only">(current)</span></a>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    


    <?php

        if(isset($_POST['register'])){
                include 'thing.php';

                $conn = mysqli_connect($servername, $username, $password, $dbname);
                if(!$conn){
                    die("Connection failed: ".mysqli_connect_error());
                
                }
                $email = $_POST['email'];
                $sql = "SELECT * FROM account WHERE email ='$email'";
                $result = $conn->query($sql);
                if(!$result){
                    echo "yeeeeeet" ;
                }
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                        if($row['password']=== $_POST['password']){
                            $_SESSION['users'][$row['email']] =  array('id'=> $row['account_id'],'fName' => $row['fName'], 'lName' => $row['lName'], 'address' => $row['address'], 'password' => $row['pass'], 'status' => $row['account_type']);
                            $_SESSION['loggedIn'] = $_POST['email'];
    
                            header('location: wazap.php');
                        }
                        
                }
                    
                
                mysqli_close($conn);
            }
        
    ?>
</body>
</html>