<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Television Login</title>
    <!-- Required meta tags -->
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->

    <style>
        .alert {
            padding-left: 4rem;
            margin: 0;
        }
        .login, .image {
        min-height: 90vh;
        }

        .bg-image {
            background-image: url("Images/loginImage.png");
            background-size: cover;
            background-position: center center;
        }

    </style>
    <title>Login</title>
  </head>
  <body>

  <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "televisiondb";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
        // die("Connection failed: " . $conn->connect_error);
        }
        else {
            // echo "Connected successfully";
            try {
                $emailId = $_POST['inputEmail'];
                $password = $_POST['inputPassword'];
                $sql = "SELECT * FROM `users` where `EmailId`='$emailId' and `Password`='$password';";
                $result = $conn->query($sql);
                if ($result->num_rows == 1) {
                    session_start();
                    
                    while($row = $result->fetch_assoc()) {
                        $_SESSION["FirstName"] = $row['FirstName'];
                        $_SESSION["LastName"] = $row['LastName'];
                        $_SESSION["UserId"] = $row['UserId'];
                        $_SESSION["Email"] = $row['EmailId']; 
                        $_SESSION["isLogin"] = true;
                        $_SESSION["AvailBalance"] = $row['Balance'];
                      }
                      header("Location: ./index.php");
                    ?>
                        <div class="alert alert-success" role="alert">
                            Login successfully
                        </div>
                <?php
                } else {
                    ?>
                        <div class="alert alert-warning" role="alert">
                            Invalid Credentials
                        </div>
                    <?php
                }
                $conn->close();
            }
            catch(Exception $e) {
                echo "some error occured";
            }
        }
    }
    ?>

    <!-- NAV BAR -->
    <div class="bg-dark navbar-dark">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid pe-lg-2 p-0"> <a class="navbar-brand ms-5" href="#"><img
                        src="Images/logo.png" height="70vh"></a> <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span
                        class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-5 mb-2 mb-lg-0">
                        <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" aria-current="page"
                                href="./index.php">HOME</a> </li>
                        <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold active" href="./login.php">LOGIN</a> </li>
                        <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="./signup.php">SIGN-UP</a> </li>
                    </ul>
                    <ul class="navbar-nav icons ms-auto mb-2 mb-lg-0">
                    <li class=" nav-item pe-5"> 
                        <button onclick="window.location.href='./cart.php'" type="button" class="btn btn-primary position-relative" >
                                <a class="fa fa-shopping-bag" style="color:white;"></a>
                                <?php
                                            if(isset($_SESSION['isLogin'])) {                                                       // Displaing list of items
                                                $user = $_SESSION['UserId']; 
                                                $sql = "SELECT COUNT(*) as total FROM `orders` WHERE UserId=$user;";
                                                $result = $conn->query($sql);
                                                while($row = $result->fetch_assoc()) { ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    <?php
                                                        echo $row['total'];
                                                    ?>
                                </span>
                                <?php
                                                }
                                            }
                                ?>   
                            </button>  
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- NAV BAR -->
    
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 d-none d-md-flex bg-image"></div>
    
    
            <!-- The content half -->
            <div class="col-md-6 bg-light">
                <div class="login d-flex align-items-center py-5">
    
                    <!-- Demo content-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto">
                                <h3 class="display-4">Login Here</h3>
                                <br>
                                <form action="<?php $_PHP_SELF ?>" method="POST">
                                    <div class="form-group mb-3">
                                        <input name="inputEmail" type="email" placeholder="Email address" required="" autofocus="" class="form-control rounded-pill border-1 shadow-sm px-4">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input name="inputPassword" type="password" placeholder="Password" required="" class="form-control rounded-pill border-1 shadow-sm px-4 text-primary">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button>
                                </form>
                                <br>
                                <p>Don't have any account? <a type="button" class="btn btn-warning btn-block text-uppercase mb-2 rounded-pill shadow-sm" href="./signup.php">Sign Up</a></p>
                            </div>
                        </div>
                    </div><!-- End -->
    
                </div>
            </div><!-- End -->
    
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center text-white">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fa fa-facebook-f"></i></a>

                <!-- Twitter -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fa fa-twitter"></i></a>

                <!-- Google -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fa fa-google"></i></a>

                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fa fa-instagram"></i></a>

                <!-- Linkedin -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fa fa-linkedin-square"></i></a>

                <!-- Github -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fa fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2022 Copyright:
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>