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
						<button type="button" onclick="addProductInfo()">Add product</button>
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

		// Số bản ghi trên một trang
		$limit = 10;

		// Tổng số bản ghi
		$sql_count = "SELECT COUNT(*) as count FROM purchase";
		$result_count = mysqli_query($conn, $sql_count);
		$row_count = mysqli_fetch_assoc($result_count);
		$total_records = $row_count['count'];

		// Tổng số trang
		$total_pages = ceil($total_records / $limit);

		// Xác định trang hiện tại
		$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

		// Giới hạn số trang hiển thị trước và sau trang hiện tại
		$page_range = 2;

		// Tạo link đến trang đầu tiên
		$first_link = '';
		if ($current_page > ($page_range + 1)) {
			$first_link = '<a href="?page=1">1</a> <span>...</span> ';
		}

		// Tạo link đến trang cuối cùng
		$last_link = '';
		if ($current_page < ($total_pages - $page_range)) {
			$last_link = ' <span>...</span> <a href="?page=' . $total_pages . '">' . $total_pages . '</a>';
		}

		// Hiển thị phân trang
		$pagination = '';
		if ($total_pages > 1) {
			$pagination .= '<div class="pagination">';

			if ($current_page > 1) {
				$pagination .= '<a href="?page=' . ($current_page - 1) . '">Prev</a>';
			}

			$pagination .= $first_link;

			for ($i = ($current_page - $page_range); $i <= ($current_page + $page_range); $i++) {
				if (($i > 0) && ($i <= $total_pages)) {
					if ($i == $current_page) {
						$pagination .= '<a class="active">' . $i . '</a> ';
					} else {
						$pagination .= '<a href="?page=' . $i . '">' . $i . '</a> ';
					}
				}
			}

			$pagination .= $last_link;

			if ($current_page < $total_pages) {
				$pagination .= '<a href="?page=' . ($current_page + 1) . '">Next</a>';
			}

			$pagination .= '</div>';
		}

		// Vị trí bản ghi đầu tiên của trang hiện tại
		$start = ($current_page - 1) * $limit;


		// Lấy dữ liệu từ database
		$sql = "SELECT *
        FROM purchase
        INNER JOIN purchase_product
        ON purchase.purchase_id = purchase_product.purchase_id
        LIMIT $start, $limit";
		$result = mysqli_query($conn, $sql);

		// Hiển thị bảng dữ liệu
		if (mysqli_num_rows($result) > 0) {
			echo "<table>";
			echo "<tr><th>Purchase ID</th><th>Customer ID</th><th>Purchase Date</th><th>Product ID</th><th>Quantity</th><th>Amount</th><th>Total</th></tr>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["purchase_id"] . "</td><td>" . $row["customer_id"] . "</td><td>" . $row["purchase_date"] . "</td><td>" . $row["product_id"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["total_amount"] . "</td> </tr>";
			}
			echo "</table>";

			// Hiển thị phân trang
			echo "<div class='pagination'>";
			if ($current_page > 1) {
				echo "<a href='?page=" . ($current_page - 1) . "'>Prev</a>";
			}
			for ($i = 1; $i <= $total_pages; $i++) {
				if ($i == $current_page) {
					echo "<a class='active'>$i</a>";
				} else {
					echo "<a href='?page=$i'>$i</a>";
				}
			}
			if ($current_page < $total_pages) {
				echo "<a href='?page=" . ($current_page + 1) . "'>Next</a>";
			}
			echo "</div>";
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
						<a href="customer.php">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">1. Customer</span>
						</a>
					</li>
					<li>
						<a href="product.php">
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
						<a href="sales_reprentative.php">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">4. Sale Respresentative</span>
						</a>
					</li>
					<li>
						<a href="customer_feedback.php">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">5. Customer Feedback</span>
						</a>
					</li>
					<li>
						<a href="customer_interaction.php">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">6. Customer Interaction</span>
						</a>
					</li>
					<li>
						<a href="marketing_channel.php">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">7. Marketing Channel</span>
						</a>
					</li>
					<li>
						<a href="marketing_campaign.php">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">8. Marketting Campaign</span>
						</a>
					</li>
					<li>
						<a href="marketing_budget.php">
							<span class="icon"><i class="fas fa-chess"></i></span>
							<span class="text">9. Marketing Budget</span>
						</a>
					</li>
					<li>
						<a href="revenue.php">
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