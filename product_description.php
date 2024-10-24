<?php
session_start();

if ($_GET['id']) {
    require_once(__DIR__ . "/Utils/Products.php");

    $init = new Products();

    $products = $init->getProducts($_GET['id']);
} else {
    header("Location: /");
    exit();
}


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
    <?php require_once(__DIR__ . '/Components/Nav.php'); ?>
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
        <div class="row d-flex flex-row">
            <div class="col-md-5 product-image carousel slide carousel-fade" id="carouselExampleFade"
                data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo $products['images'] ?>" class="d-block w-100" />
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
                <img src="<?php echo $products['images'] ?>" class="d-block w-100 img-fluid" />
            </div>
            <div class="col-md-5">
                <h1>
                    <?php echo $products['name']; ?>
                </h1>
                <p>
                    <?php echo $products['description']; ?>
                </p>
                <p>Resolution:
                    <?php echo $products['resolution']; ?>
                </p>
                <p>Launch in :
                    <?php echo $products['launched']; ?>
                </p>
                <p>Only :
                    <?php echo $products['stock']; ?> left!!
                </p>
                <p>Rs :
                    <?php echo $products['price']; ?> /- only
                </p>
                <form action="./addToCart.php">
                    <input style="display:none;" name="itemId" value="<?php echo $products['id']; ?>" />
                    <p>Quantity: <input name="quantity" type="number" value=1 min="1" max="<?php echo $products['stock']; ?>" />
                    </p>
                    <button type="sumbit" class="btn btn-primary">Add to cart</button>
                </form>
            </div>
        </div>
    </div>
    <!--NEW CONTAINER-->

    <!-- Footer -->
    <?php require_once(__DIR__ . '/Components/Footer.php'); ?>
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

    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>
</body>

</html>