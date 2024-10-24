<?php
session_start();

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


</head>

<body>

	<!-- NAV BAR -->
	<?php require_once(__DIR__ . '/Components/Nav.php'); ?>
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
											echo $_SESSION['FirstName'] . ' ' . $_SESSION['LastName'] . '<br>';
											echo $_SESSION['Email'] . '<br>';
											echo $_POST['address'] . '<br>';
											echo $_POST["city"] . ', ';
											echo $_POST["state"] . '- ';
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
												while ($row = $result->fetch_assoc()) {
												?>
													<tbody>

														<tr>
															<td>
																<?php echo $row['OrderID'] . "<br>"; ?>
															</td>
															<td>
																<?php echo $row['Name'] . "<br>"; ?>
															</td>
															<td>
																<?php echo $row['Quantity'] . "<br>"; ?>
															</td>
															<td>
																<?php echo $row['Price'] . "<br>"; ?>
															</td>
															<td>
																<?php echo $totalPerProduct = $row['Quantity'] * $row['Price']; ?>
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
	<?php require_once(__DIR__ . '/Components/Footer.php'); ?>
	<!-- Footer -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
		crossorigin="anonymous"></script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	-->
</body>

</html>