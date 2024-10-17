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
                $total = 0;
                
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
        .gradient-custom {
            /* fallback for old browsers */
            background: rgb(60, 57, 63);

            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(135deg, rgb(102, 97, 107), rgb(255, 255, 255));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(135deg, rgb(102, 97, 107), rgb(255, 255, 255))
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
                        <!-- EMPTY UL FOR KEEPING THE NAVBAR IN THE CENTER -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- NAV BAR -->
    
    <?php
    if(isset($_SESSION['isLogin'])) { 
        $UserId = $_SESSION['UserId'];
        $sql = "SELECT * FROM `orders` WHERE UserId=$UserId and Completed='false';";
        $result = $conn->query($sql);
    ?>


    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Cart - <?php echo mysqli_num_rows( $result ); ?> items</h5>
                        </div>
                        <div class="card-body">
                            <!-- Single item -->
                            <div class="row">

                                <?php while($row = $result->fetch_assoc()) { 
                                            $itemId = $row['ItemId'];
                                            $sqlitem = "SELECT * FROM `models` WHERE Id=$itemId";
                                            $itemResult = $conn->query($sqlitem);
                                            while($itemRow = $itemResult->fetch_assoc()) { 
                                                $total += $itemRow['Price'] * $row['Quantity'];
                                            ?>


                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <!-- Image -->
                                    <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                        data-mdb-ripple-color="light">
                                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $itemRow['Img1'] ).'" class="w-100" alt="Blue Jeans Jacket" />'; ?>
                                        
                                        <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Vertical/12a.webp" -->
                                            <!-- class="w-100" alt="Blue Jeans Jacket" /> -->
                                        <a href="#!">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                        </a>
                                    </div>
                                    <!-- Image -->
                                </div>

                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                    <!-- Data -->
                                    <p><strong> <?php echo $itemRow['Name'] ?> </strong></p>
                                    
                                    <a type="button" class="btn btn-primary btn-sm me-1 mb-2"
                                        data-mdb-toggle="tooltip" title="Remove item" href='./deleteItem.php?Id=<?php echo $row['OrderId']; ?>'>
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <!-- <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                                        title="Move to the wish list">
                                        <i class="fa fa-heart"></i>
                                    </button> -->
                                </div>

                                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                    <!-- Quantity -->
                                    <div class="d-flex mb-4" style="max-width: 300px">

                                        <div class="form-outline">
                                            <input id="form1" min="0" name="quantity" value="<?php echo $row['Quantity']; ?>" type="number"
                                                class="form-control" disabled/>
                                            <label class="form-label" for="form1">Quantity</label>
                                        </div>

                                    </div>
                                    <!-- Quantity -->

                                    <!-- Price -->
                                    <p class="text-start text-md-center">
                                        <strong>= <?php echo $row['Quantity']." x  Rs ".$itemRow['Price']; ?> </strong><br>
                                        <strong>= Rs <?php echo $itemRow['Price'] * $row['Quantity']; ?> </strong>
                                    </p>
                                    <!-- Price -->
                                </div>

                                <?php 
                                }
                                } ?>
                                
                            </div>
                            <!-- Single item -->

                            <hr class="my-4" />

                            <div>
                                <form method="POST" action="./checkout.php">
                                    <b>User Name :</b><br>
                                    <input type="text" name="name" value="<?php echo $_SESSION['FirstName'].' '.$_SESSION['LastName']?>" disabled><br><br>
                                    <b>Email :</b><br>
                                    <input type="email" name="email" value="<?php echo $_SESSION['Email']?>" disabled><br><br>
                                    <b>Address :</b><br>
                                    <textarea type="text" name="address" rows="3" cols="23"></textarea><br><br>
                                    <b>City :</b><br>
                                    <input type="text" name="city"><br><br>
                                    <b>State :</b><br>
                                    <input type="text" name="state"><br><br>
                                    <b>Pincode :</b><br>
                                    <input type="text" name="pincode"><br><br>
                                    <b></b><br>
                                    <input type="number" name="total" value="<?php echo $total ?>" style= "display:none;"><br>

                            </div>
                            <!-- Single item -->
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <p><strong>Expected shipping delivery</strong></p>
                            <p class="mb-0">The item will be dileverd to you within 2 days</p>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body">
                            <p><strong>We accept</strong></p>
                            <span class="fa fa-cc-visa fa-3x" />
                            <span class="fa fa-cc-amex" />
                            <span class="fa fa-cc-mastercard" />
                            <span class="fa fa-cc-paypal" />
                        </div>

                        <hr class="my-4" />

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Products
                                    <span>Rs <?php echo $total; ?> </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Shipping
                                    <span>Free</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total amount</strong>
                                        <strong>
                                            <p class="mb-0">(including GST)</p>
                                        </strong>
                                    </div>
                                    <span><strong>Rs <?php echo $total; ?> </strong></span>
                                </li>
                            </ul>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Go to checkout
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php 
        }  // if end
    else {
        echo "<div>Please login first</div>";
        header("Location: ./login.php");
    }
    ?>

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


<?php 
        $conn->close();
    }
?>

<script type="text/javascript">
         $(function() {
            $( "#expYear" ).datepicker({dateFormat: 'yy'});
         });
</script>

</body>

</html>
