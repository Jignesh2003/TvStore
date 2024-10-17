<?php
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "televisiondb";
        $total = $_POST["total"];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
        // die("Connection failed: " . $conn->connect_error);
        }
        else {
			if($total == 0) {
				echo "please secect item";
			}
			else {
        	$user = $_SESSION['UserId'];
        	$sql = "SELECT Balance FROM `users` where `UserId`=$user;";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                $availBalance = $row['Balance'];
	        }
				if($availBalance > $total) {
					$newBalance = $availBalance - $total;
					$sql = "UPDATE `users` SET `Balance` = $newBalance WHERE `UserId`=$user;";
					if ($conn->query($sql) === TRUE) {
						//echo "<b>Balance updated successfully</b>";
						$_SESSION["AvailBalance"] = $newBalance;

?>

<style>
	body{margin-top:20px;
    color: #2e323c;
    background: #f5f6fa;
    position: relative;
    height: 100%;
}
.invoice-container {
    padding: 1rem;
}
.invoice-container .invoice-header .invoice-logo {
    margin: 0.8rem 0 0 0;
    display: inline-block;
    font-size: 1.6rem;
    font-weight: 700;
    color: #2e323c;
}
.invoice-container .invoice-header .invoice-logo img {
    max-width: 130px;
}
.invoice-container .invoice-header address {
    font-size: 0.8rem;
    color: #9fa8b9;
    margin: 0;
}
.invoice-container .invoice-details {
    margin: 1rem 0 0 0;
    padding: 1rem;
    line-height: 180%;
    background: #f5f6fa;
}
.invoice-container .invoice-details .invoice-num {
    text-align: right;
    font-size: 0.8rem;
}
.invoice-container .invoice-body {
    padding: 1rem 0 0 0;
}
.invoice-container .invoice-footer {
    text-align: center;
    font-size: 0.7rem;
    margin: 5px 0 0 0;
}

.invoice-status {
    text-align: center;
    padding: 1rem;
    background: #ffffff;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    margin-bottom: 1rem;
}
.invoice-status h2.status {
    margin: 0 0 0.8rem 0;
}
.invoice-status h5.status-title {
    margin: 0 0 0.8rem 0;
    color: #9fa8b9;
}
.invoice-status p.status-type {
    margin: 0.5rem 0 0 0;
    padding: 0;
    line-height: 150%;
}
.invoice-status i {
    font-size: 1.5rem;
    margin: 0 0 1rem 0;
    display: inline-block;
    padding: 1rem;
    background: #f5f6fa;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
}
.invoice-status .badge {
    text-transform: uppercase;
}

@media (max-width: 767px) {
    .invoice-container {
        padding: 1rem;
    }
}


.custom-table {
    border: 1px solid #e0e3ec;
}
.custom-table thead {
    background: #007ae1;
}
.custom-table thead th {
    border: 0;
    color: #ffffff;
}
.custom-table > tbody tr:hover {
    background: #fafafa;
}
.custom-table > tbody tr:nth-of-type(even) {
    background-color: #ffffff;
}
.custom-table > tbody td {
    border: 1px solid #e6e9f0;
}


.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}

.text-success {
    color: #00bb42 !important;
}

.text-muted {
    color: #9fa8b9 !important;
}

.custom-actions-btns {
    margin: auto;
    display: flex;
    justify-content: flex-end;
}

.custom-actions-btns .btn {
    margin: .3rem 0 .3rem .3rem;
}
</style>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap CSS -->

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

<div class="container" style="margin-top:90px;">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-0">
					<div class="invoice-container">
						<div class="invoice-header">
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="custom-actions-btns mb-5">
										<a href="#" class="btn btn-primary">
											<i class="icon-download"></i> Download
										</a>
										<a href="#" class="btn btn-secondary">
											<i class="icon-printer"></i> Print
										</a>
									</div>
								</div>
							</div>
							<!-- Row end -->
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<a href="index.php" class="invoice-logo">
										<img src="./Images/logo.png" alt="">
									</a>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<address class="text-right" style="margin-left: 390px;">
										Maxwell admin Inc, 45 NorthWest Street.<br>
										Sunrise Blvd, San Francisco.<br>
										00000 00000
									</address>
								</div>
							</div>
							<!-- Row end -->
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
									<div class="invoice-details">
											<?php
												   echo $_SESSION['FirstName'].' '.$_SESSION['LastName'].'<br>'; 
												   echo $_SESSION['Email'].'<br>';
												   echo $_POST['address'].'<br>';
												   echo $_POST["city"].', ';
												   echo $_POST["state"].'- ';
												   echo $_POST["pincode"];
												?>
									</div>
								</div>
								<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
									<div class="invoice-details">
										<div class="invoice-num">
											<div style="color: black;">Invoice - #009</div>
											<div>
												<?php
													// Set the new timezone
													date_default_timezone_set('Asia/Kolkata');
													$date = date('d-m-y h:i:s');
													echo $date;
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Row end -->
						</div>
						<div class="invoice-body">
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="table-responsive">
										<?php
											// Invoice logic
											$sql = "SELECT orders.OrderID, orders.ItemId, orders.Quantity, models.Name, models.Price FROM orders INNER JOIN models ON orders.ItemId = models.Id WHERE orders.Completed = 'false';";
											$result = $conn->query($sql);
											
										?>
										<table class="table custom-table m-0">
											<thead>
												<tr>
													<th>Order ID</th>
													<th>Product Name</th>
													<th>Quantity</th>
													<th>Product Cost</th>
													<th>Total Cost</th>
												</tr>
											</thead>
											<?php
												while($row = $result->fetch_assoc()) {
											?>
											<tbody>
												
												<tr>
													<td>
														<?php echo $row['OrderID']."<br>"; ?>
													</td>
													<td>
														<?php echo $row['Name']."<br>"; ?>
													</td>
													<td>
														<?php echo $row['Quantity']."<br>"; ?>
													</td>
													<td>
														<?php echo $row['Price']."<br>"; ?>
													</td>
													<td>
														<?php echo $totalPerProduct = $row['Quantity']*$row['Price']; ?>
													</td>
												</tr>
											</tbody>
											<?php
											}
										?>
										<tr>
											<td colspan="3"></td>
											<td><b>Grand Total</b></td>
											<td> <b><?php echo $total; ?></b></td>
										</tr>	
										</table>
										
									</div>
								</div>
							</div>
							<!-- Row end -->
						</div>
						<div class="invoice-footer">
							Thank you for your Business.
						</div>
					</div>
				</div>
			</div>
		</div>
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


<?php
						$sql = "UPDATE `orders` SET `Completed` = 'true' WHERE `UserId`=$user;";
						if ($conn->query($sql) === TRUE) {
							//echo "<br><b>Records updated successfully</b>";
						}
					}
					else {
						echo "Balance not updated successfully";
					}
				}
	       		else {
	       	 		echo "Balance is not available";
	        	}
			}
	    }
	}

	// echo $_SESSION["FirstName"];
	// echo $_SESSION["Email"];
	// echo $_POST["address"];
	// echo $_POST["city"];
	// echo $_POST["state"];
	// echo $_POST["pincode"];
	// echo $_POST["total"];
?>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
	crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
