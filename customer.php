<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>User Data Management</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Thư viện jQuery -->
	<script src="search_customer.js"></script> <!-- Đường dẫn đến file JavaScript -->
	<link rel="icon" type="image/png" href="./image/icon.png" /> <!-- Favicon --->
</head>

<body>
	<h1>User Data Management</h1>
	<button id="import-btn">Import Data</button>
	<div id="myModal" class="modal">
		<div class="modal-content">
			<form id="user-form" method="post" action="add_customer.php">
				<label for="lastname">Tên:</label>
				<input type="text" id="lastname" name="lastname" required>
				<label for="firstname">Họ:</label>
				<input type="text" id="firstname" name="firstname" required>
				<label for="dob">Date of Birth</label>
				<input type="date" id="dob" name="dob" required>
				<label for="sex">Sex</label>
				<select id="sex" name="sex" required>
					<option value="">--Please choose an option--</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
					<option value="other">Other</option>
				</select>
				<label for="email">Email</label>
				<input type="email" id="email" name="email" required>
				<label for="phone">Phone</label>
				<input type="tel" id="phone" name="phone" required>
				<label for="address">Address</label>
				<textarea id="address" name="address" required></textarea>
				<label for="preferences">Preferences</label>
				<textarea id="preferences" name="preferences"></textarea>
				<label for="sales-rep-id">Sales Representative ID</label>
				<select id="sales-rep-id" name="sales-rep-id" required>
					<option value="">--Please choose an option--</option>
					<option value="21101">21101</option>
					<option value="21102">21102</option>
					<option value="21103">21103</option>
					<option value="21104">21104</option>
					<option value="21105">21105</option>
					<option value="21106">21106</option>
					<option value="21107">21107</option>
					<option value="21108">21108</option>
					<option value="21109">21109</option>
					<option value="21110">21110</option>
				</select>
				<label for="loyalty-status">Loyalty Program Status</label>
				<select id="loyalty-status" name="loyalty-status" required>
					<option value="">--Please choose an option--</option>
					<option value="Green">Green</option>
					<option value="Silver">Silver</option>
					<option value="Gold">Gold</option>
					<option value="Platinum">Platinum</option>
				</select>
				<input type="submit" value="Submit">
				<button class="close-btn" onclick="closeForm()">&times;</button>

			</form>
		</div>
	</div>
	<br>
	<input type="text" id="customer-id-input" placeholder="Nhập ID khách hàng">
	<button onclick="searchCustomer()">Tìm kiếm</button>
	<div id="customer-info"></div> <!-- Để hiển thị kết quả tìm kiếm khách hàng -->
	<script src="app.js"></script>
	<?php
	// Kết nối đến database
	$conn = mysqli_connect("localhost", "root", "", "user");

	// Kiểm tra kết nối
	if (!$conn) {
		die("Kết nối thất bại: " . mysqli_connect_error());
	}

	// Thiết lập và lấy thông tin phân trang
	$limit = 5; // Số bản ghi trên một trang
	if (isset($_GET["page"])) {
		$page = $_GET["page"];
	} else {
		$page = 1;
	}
	$offset = ($page - 1) * $limit;

	// Lấy dữ liệu từ database
	$sql = "SELECT * FROM customer LIMIT $offset, $limit";
	$result = mysqli_query($conn, $sql);

	// Kiểm tra số bản ghi được trả về
	if (mysqli_num_rows($result) > 0) {
		// Hiển thị bảng dữ liệu
		echo "<table>";
		echo "<tr><th>ID Khách hàng</th><th>Họ</th><th>Tên</th><th>Ngày sinh</th><th>Giới tính</th><th>Email</th><th>Số điện thoại</th><th>Địa chỉ</th><th>Sở thích</th><th> Nhân viên bán hàng </th><th>Trạng thái gắn bó </th> </tr>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>" . $row["customer_id"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["sex"] . "</td><td>" . $row["date_of_birth"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["address"] . "</td><td>" . $row["preferences"] . "</td><td>" . $row["sales_representative_id"] . "</td><td>" . $row["loyalty_program_status"] . "</td> </tr>";
		}
		echo "</table>";

		// Tạo nút chuyển trang
		$sql = "SELECT COUNT(*) AS total FROM customer";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$total_records = $row["total"];
		$total_pages = ceil($total_records / $limit);

		echo "<nav class='pagination-container'>";
		echo "<button class='pagination-button' id='prev-button' aria-label='Previous page' title='Previous page' " . ($current_page == 1 ? "disabled" : "") . ">&lt;</button>";
		echo "<div id='pagination-numbers'>";
		for ($i = 1; $i <= $total_pages; $i++) {
			echo "<a href='index.php?page=" . $i . "' class='" . ($i == $current_page ? "active" : "") . "'>" . $i . "</a>";
		}
		echo "</div>";
		echo "<button class='pagination-button' id='next-button' aria-label='Next page' title='Next page' " . ($current_page == $total_pages ? "disabled" : "") . ">&gt;</button>";
		echo "</nav>";
	} else {
		echo "Không có bản ghi nào được tìm thấy.";
	}

	// Đóng kết nối
	mysqli_close($conn);
	?>
	<script src="app.js"></script>
	<div class="wrapper hover_collapse">
		<div class="top_navbar">
			<div class="logo"><img src="./image/logo.png" href="index.php" width=100%></div>
			<div class="menu">
				<div class="hamburger">
					<i class="fas fa-bars"></i>
				</div>

			</div>
		</div>

		<div class="sidebar">
			<div class="sidebar_inner">
				<ul>
					<li>
						<a href="index.php">
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
