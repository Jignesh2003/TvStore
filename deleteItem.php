<?php
    session_start();
        sleep(1);
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
                $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $components = parse_url($url);
                parse_str($components['query'], $results);
                $Id = $results['Id']; 

                $sql = "DELETE FROM orders WHERE OrderId=$Id";

                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                    header("Location: ./cart.php");
                } 
            }
?>