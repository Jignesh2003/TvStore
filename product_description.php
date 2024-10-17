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
            }
            else {
                // echo "Connected successfully";
                $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $components = parse_url($url);
                parse_str($components['query'], $results);
                $Id = $results['Id']; 
                

?>


<!DOCTYPE html>
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
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Varela Round', sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Varela Round', sans-serif;
        }

        .breadcrumb {
            background-color: rgb(187, 209, 209);
        }

        .product-small img {
            max-width: 10rem;
            padding: 1rem;
            cursor: pointer;
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
                        <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" aria-current="page"
                                href="./index.php">HOME</a> </li>
                        
                        <?php if(!isset($_SESSION['isLogin'])) { ?>

                        <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="./login.php">LOGIN</a> </li>
                        <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="./signup.php">SIGN-UP</a> </li>

                        <?php } else { ?>
                        
                        <li class="nav-item"> <a class="nav-link pe-3 me-4 fw-bold" href="./signout.php">SIGN-OUT</a> </li>

                        <?php } ?>
                        </li>
                    </ul>
                    <ul class="navbar-nav icons ms-auto mb-2 mb-lg-0">
                        <?php if(isset($_SESSION['isLogin'])) { ?>
                            <li id="message" style="color:white;" class="me-5">   Welcome <?php echo $_SESSION['FirstName']." ".$_SESSION['LastName'];?>,
                        <?php } ?> 
                        <li class=" nav-item pe-5"> 
                            <button onclick="window.location.href='./cart.php'" type="button" class="btn btn-primary position-relative">
                                <a class="fa fa-shopping-bag" style="color:white;"></a>
                                <?php
                                            if(isset($_SESSION['isLogin'])) {                                                       // Displaing list of items
                                                $user = $_SESSION['UserId']; 
                                                $sql = "SELECT COUNT(*) as total FROM `orders` WHERE UserId=$user and Completed='false';";
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

     <!--NEW CONTAINER-->
     <nav aria-label="breadcrumb ">
        <ol class="breadcrumb p-3">
            <li class="breadcrumb-item"><a href="#" style="text-decoration: none;">Home</a></li>
            <li class="breadcrumb-item"><a href="#" style="text-decoration: none;">Product Description</a></li>
            <li class="breadcrumb-item active" aria-current="page">Image 1</li>
        </ol>
    </nav>

    <div class="container mb-5">
        <?php
            
            try {
                $sql = "SELECT * FROM `models` where Id=$Id;";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {  // Displaying the catalogue
        ?>
        <div class="row d-flex flex-row">
            <div class="col-md-5 product-image carousel slide carousel-fade" id="carouselExampleFade"
                data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Img1'] ).'" class="d-block w-100"/>'; ?>
                    </div>
                    <div class="carousel-item">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Img2'] ).'" class="d-block w-100"/>'; ?>
                    </div>
                    <div class="carousel-item">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Img3'] ).'" class="d-block w-100" style="width: 500px; height:370px;"/>'; ?>
                    </div>
                   
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"
                        style="background-color: rgb(222, 203, 203);"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"
                        style="background-color: rgb(222, 203, 203);"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="col-md-2 product-small d-flex flex-md-column order-md-first justify-content-center">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Img1'] ).'" class="d-block w-100 img-fluid"/>'; ?>
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Img2'] ).'" class="d-block w-100 img-fluid"/>'; ?>
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Img3'] ).'" class="d-block w-100 img-fluid"/>'; ?>
            </div>
            <div class="col-md-5">
                <h1>
                    <?php echo $row['Name']; ?>
                </h1>
                <p>
                    <?php echo $row['Description']; ?>
                </p>
                <p>Resolution:
                    <?php echo $row['Resolution']; ?>
                </p>
                <p>Launch in
                    <?php echo $row['LaunchYear']; ?>
                </p>
                <p>Only
                    <?php echo $row['Quantity']; ?> left!!
                </p>
                <p>Rs
                    <?php echo $row['Price']; ?> /- only
                </p>
                <form action="./addToCart.php">
                    <input style="display:none;" name="itemId" value="<?php echo $row['Id']; ?>" />
                    <p>Quantity: <input name="quantity" type="number" value=1 min="1" max="<?php echo $row['Quantity']; ?>" />
                    </p>
                    <button type="sumbit" class="btn btn-primary">Add to cart</button>
                </form>
            </div>
        </div>
        <?php
                }
            }
            catch(Exception $e) {
                echo "some error occured";
            }
        ?>
    </div>
    <!--NEW CONTAINER-->

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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Item Added</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            The following item has been added to the cart.
        </div>
        </div>
    </div>
    </div>
    

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
<script>
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
    })
</script>
</body>

</html>