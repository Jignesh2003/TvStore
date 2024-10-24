<?php
session_start();

if (isset($_SESSION['isLogin'])) {
    header("Location: /");
    exit();
}

require_once 'Utils/Auth.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create an instance of Authentication with the values sent from the form
    $authenticate = new Authentication(
        null,
        null,
        $_POST['email'],      // User's email
        $_POST['password'],    // User's password
    );

    $result = $authenticate->login();

    if ($result) {
        echo "<div id='alert' class='position-fixed top-0 start-0 end-0 alert alert-danger' role='alert' style='z-index:10'>
                $result
            </div>";

        echo "<script>
            setTimeout(() => {
                document.getElementById('alert').style.display = 'none';
            }, 4000);
        </script>";
    } else {
        header('Location: /');
        exit();
    }
}

?>

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

        .login,
        .image {
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

    <!-- NAV BAR -->
    <?php require_once(__DIR__ . '/Components/Nav.php'); ?>
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
                                        <input name="email" type="email" placeholder="Email address" required="" autofocus="" class="form-control rounded-pill border-1 shadow-sm px-4">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input name="password" type="password" placeholder="Password" required="" class="form-control rounded-pill border-1 shadow-sm px-4 text-primary">
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
    <?php require_once(__DIR__ . '/Components/Footer.php'); ?>
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