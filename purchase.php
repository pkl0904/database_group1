<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Purchase</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<link rel="icon" type="image/png" href="./image/icon.png" /> <!-- Favicon --->
	<script src="add_purchase.js"></script> <!-- Đường dẫn đến file JavaScript -->


</head>

<body>
	<h1>Purchase</h1>
	<button id="import-btn">Import Data</button>
	<div id="myModal" class="modal">
		<div class="modal-content">
			<form id="user-form" method="post" action="add_purchase.php">
				<label for="customerID">Customer ID:</label>
				<input type="text" id="customerID" name="customerID">
				<br>
				<label for="purchaseDate">Purchase date:</label>
				<input type="date" id="purchaseDate" name="purchaseDate">
				<br>
				<div id="productInfoContainer">
					<!-- Form nhỏ dành cho thông tin Product ID -->
					<div id="productIDForm">
						<label for="productID">Product ID:</label>
						<select id="productID" name="productID">
							<option value="">-- Select Product --</option>
						</select>
						<!-- Script cho dropbox  -->
						<script> var productIDSelect = document.getElementById("productID");
							for (var i = 101001; i <= 101050; i++) {
								var option = document.createElement("option");
								option.value = i;
								option.text = "Product " + i;
								productIDSelect.add(option);
							} </script>
						<br>
						<label for="quantity">Quantity:</label>
						<input type="number" id="quantity" name="quantity">
						<br>
						<label for="amount">Amount:</label>
						<input type="number" step="1" id="amount" name="amount">
						<br>
						<input type="button" value="Add Product" onclick="addProductInfo()">
					</div>
				</div>
				<input type="hidden" id="productInfo" name="productInfo">
				<br>
				<input type="submit" value="Submit">
				<button class="close-btn" onclick="closeForm()">&times;</button>
			</form>
			<script>
				var productInfo = [];
				function addProductInfo() {
					// Lấy giá trị từ các trường nhập liệu
					var productID = document.getElementById("productID").value;
					var quantity = document.getElementById("quantity").value;
					var amount = document.getElementById("amount").value;

					// Thêm các giá trị vào mảng
					var product = {
						productID: productID,
						quantity: quantity,
						amount: amount
					};
					productInfo.push(product);

					// Hiển thị thông tin vừa thêm vào bảng
					// ...

					// Update the form fields with the new values
					document.getElementById("productID").value = "";
					document.getElementById("quantity").value = "";
					document.getElementById("amount").value = "";

					// Update the hidden input field with the updated productInfo array
					document.getElementById("productInfo").value = JSON.stringify(productInfo);
				}
			</script>
		</div>
	</div>
	<input type="text" id="search-bar" placeholder="Search...">

	<script src="app.js"></script>
	<div class="wrapper hover_collapse">
		<div class="top_navbar">
			<div class="logo"><img src="./image/logo.png" href="index.html" width=100%></div>
			<div class="menu">
				<div class="hamburger">
					<i class="fas fa-bars"></i>
				</div>
			</div>
		</div>
		<?php
		// Kết nối đến database
		$conn = mysqli_connect("localhost", "root", "", "user");

		// Kiểm tra kết nối
		if (!$conn) {
			die("Kết nối thất bại: " . mysqli_connect_error());
		}

		// Lấy dữ liệu từ database
		$sql = "SELECT *
	FROM purchase
	INNER JOIN purchase_product
	ON purchase.purchase_id = purchase_product.purchase_id;
	";
		$result = mysqli_query($conn, $sql);

		// Kiểm tra số bản ghi được trả về
		if (mysqli_num_rows($result) > 0) {
			// Hiển thị bảng dữ liệu
			echo "<table>";
			echo "<tr><th>Purchase ID</th><th>Customer ID</th><th>Purchase Date</th><th>Product ID</th><th>Quantity</th><th>Amount</th><th>Total</th></tr>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["purchase_id"] . "</td><td>" . $row["customer_id"] . "</td><td>" . $row["purchase_date"] . "</td><td>" . $row["product_id"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["total_amount"] . "</td> </tr>";
			}
			echo "</table>";
		} else {
			echo "Không có bản ghi nào được tìm thấy.";
		}

		// Đóng kết nối
		mysqli_close($conn);
		?>
		<div class="sidebar">
			<div class="sidebar_inner">
				<ul>
					<li>
						<a href="index.html">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">1. Customer</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">2. Product</span>
						</a>
					</li>
					<li>

						<a href="purchase.php">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">3. Purchase</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">4. Sale Respresentative</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">5. Customer Feedback</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">6. Customer Interaction</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">7. Marketing Channel</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">8. Marketting Campaign</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">9. Marketing Budget</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">10. Revenue</span>
						</a>
					</li>
				</ul>
			</div>
		</div>


	</div>
	<!-- partial -->
	<script src="./script.js"></script>
	<!-- partial:index.partial.html -->
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</body>

</html>