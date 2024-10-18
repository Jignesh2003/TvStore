<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "televisiondb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
} else {

    // echo "Connected successfully";
?>

    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Television Store</title>
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
            * {
                margin: 0 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Varela Round', sans-serif;

            }

            .main-img {
                height: 60vh !important;
            }

            .slidebar div img {
                height: 100vh;
            }

            /* .container {
            display: flex;
            justify-content: space-evenly;
        } */

            .container div {
                text-align: center;
                margin: 10px auto;
            }

            .container img {
                border: 2px solid white;
                border-radius: 15px;
            }

            .aboutUs {
                background-color: #212529;
                height: 30vh;
                color: #ffffff;
            }

            .aboutUs .container-fluid {
                display: inline;
            }

            .aboutUs h3 {
                text-align: center;
            }

            #message {
                margin-right: 5px;
                padding: 7px 10px;
            }
        </style>
    </head>

    <body>
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
                            <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold active" aria-current="page"
                                    href="#">HOME</a> </li>

                            <?php if (!isset($_SESSION['isLogin'])) { ?>

                                <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="./login.php">LOGIN</a> </li>
                                <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="./signup.php">SIGN-UP</a>
                                </li>

                            <?php } else { ?>

                                <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="./signout.php">SIGN-OUT</a>
                                </li>

                            <?php } ?>
                        </ul>

                        <ul class="navbar-nav icons ms-auto mb-2 mb-lg-0">

                            <?php if (isset($_SESSION['isLogin'])) { ?>
                                <li id="message" style="color:white;" class="fs-bold">Welcome
                                    <?php echo $_SESSION['FirstName'] . " " . $_SESSION['LastName']; ?>
                                <?php } ?>
                                </li>

                                <form class="d-flex">
                                    <input class="form-control me-3" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success me-3" type="submit">Search</button>
                                </form>

                                <li class=" nav-item pe-5" style="display: inline;">
                                    <button onclick="window.location.href='./cart.php'" type="button"
                                        class="btn btn-primary position-relative">
                                        <a class="fa fa-shopping-bag" style="color:white;"></a>
                                        <?php
                                        if (isset($_SESSION['isLogin'])) {                                                   // Displaing list of items
                                            $user = $_SESSION['UserId'];
                                            $sql = "SELECT COUNT(*) as total FROM `orders` WHERE UserId=$user and Completed='false';";
                                            $result = $conn->query($sql);
                                            while ($row = $result->fetch_assoc()) { ?>
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
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

        <div class="slidebar">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background-color: hotpink; text-align:center;"
                        data-bs-ride="1000">
                        <img src="./Images/banner_1.jpg" alt="..." width="100%" class="main-img">
                    </div>
                    <div class="carousel-item" style="background-color: green ; text-align:center;" data-bs-ride="1000">
                        <img src="./Images/banner_2.jpg" alt="..." width="100%" class="main-img">
                    </div>
                    <div class="carousel-item" style="background-color: blue ;text-align:center;" data-bs-ride="1000">
                        <img src="./Images/banner_3.jpg" alt="..." width="100%" class="main-img">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>

        <div class="container">
            <div class="row">
                <?php

                try {
                    $sql = "SELECT * FROM `models`;";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {  // Displaying the catalogue
                ?>

                        <div class="col-xxl-3 col-md-6 col-xs-12">
                            <div class="card" style="width: 18rem;">
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Img1']) . '"/>'; ?>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $row['Name']; ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo $row['Description']; ?>
                                    </p>
                                    <a href='./product_description.php?Id=<?php echo $row['Id']; ?>' class='btn btn-primary'>Learn
                                        More</a>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                } catch (Exception $e) {
                    echo "some error occured";
                }
                ?>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <?php
    $conn->close();
} ?>

    </body>

    </html>