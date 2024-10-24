<?php

require_once(__DIR__ . "/../Utils/Auth.php");

$auth = new Authentication();
$user = $auth->getUser();
?>


<div class="bg-dark navbar-dark">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid pe-lg-2 p-0">
            <a class="navbar-brand ms-5" href="/">
                <img src="Images/logo.png" height="70vh">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-5 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link pe-3 me-4 fw-bold active" aria-current="page" href="/">HOME</a>
                    </li>

                    <?php if (!isset($_SESSION['isLogin'])) { ?>

                        <li class="nav-item">
                            <a class="nav-link pe-3 me-4 fw-bold" href="/login.php">LOGIN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pe-3 me-4 fw-bold" href="/signup.php">SIGN-UP</a>
                        </li>

                    <?php } else { ?>

                        <li class="nav-item">
                            <a class="nav-link pe-3 me-4 fw-bold" href="/signout.php">SIGN-OUT</a>
                        </li>

                    <?php } ?>
                </ul>

                <ul class="navbar-nav icons ms-auto mb-2 mb-lg-0">

                    <?php if (isset($_SESSION['isLogin'])) { ?>
                        <li id="message" style="color:white;" class="fs-bold">
                            Welcome <?php echo $user['firstname'] . " " . $user['lastname']; ?>
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

                            </button>

                        </li>

                </ul>
            </div>
        </div>
    </nav>
</div>