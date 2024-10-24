<?php
session_start();

require_once(__DIR__ . "/Utils/Products.php");

$init = new Products();

$products = $init->getProductsAll();

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
    <?php require_once(__DIR__ . '/Components/Nav.php'); ?>
    <!-- NAV BAR -->

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
            foreach ($products as $item) {  // Displaying the catalogue
            ?>
                <div class="col-xxl-3 col-md-6 col-xs-12">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $item['images'] ?>" alt="">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $item['name']; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $item['description']; ?>
                            </p>
                            <a href='/product_description.php?id=<?php echo $item['id']; ?>' class='btn btn-primary'>Learn More</a>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/Components/Footer.php'); ?>
    <!-- Footer -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>    -->


</body>

</html>