<?php

session_start();

session_destroy();

setcookie("rememberMe", "", time() - 3600, "/", "", false, true);

header("Location: ./index.php");

exit();
