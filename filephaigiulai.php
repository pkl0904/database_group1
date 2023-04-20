<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>User Data Management</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Thư viện jQuery -->
	<script src="search_customer.js"></script> <!-- Đường dẫn đến file JavaScript -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">       
</head>
<body>
	<h1>User Data Management</h1>
	<button id="import-btn">Import Data</button>
	<div id="myModal" class="modal">
        <div class="modal-content" >
		<form id="user-form" method="post" action="add_customer.php">
			<label for="customerid">ID:</label>
            <input type="text" id="customerid" name="customerid" required>
			<label for="name">Name</label>
			<input type="text" id="name" name="name" required>
			<label for="birthday">Date of Birth</label>
			<input type="date" id="dob" name="birthday" required>
			<label for="gender">Gender</label>
			<select id="gender" name="gender" required>
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
			<label for="sale_representative_id">ID nhân viên bán hàng:</label>
            <input type="number" id="sale_representative_id" name="sale_representative_id">
			<label for="preferences">Preferences</label>
			<textarea id="preferences" name="preferences"></textarea>
			<input type="submit" value="Submit">
            <button class="close-btn" onclick="closeForm()">&times;</button>

		</form> </div>
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

    // Lấy dữ liệu từ database
    $sql = "SELECT * FROM customer";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra số bản ghi được trả về
    if (mysqli_num_rows($result) > 0) {
        // Hiển thị bảng dữ liệu
        echo "<table>";
        echo "<tr><th>ID</th><th>Tên Khách hàng</th><th>Ngày sinh</th><th>Giới tính</th><th>Email</th><th>Số điện thoại</th><th>Địa chỉ</th><th>ID nhân viên bán hàng</th><th>Sở thích</th><th>Lịch sử mua hàng</th><th>Trạng thái gắn bó</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>" . $row["customer_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["sex"]  . "</td><td>" . $row["date_of_birth"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["address"] . "</td><td>" . $row["sales_representative_id"] . "</td><td>" . $row["preferences"] . "</td><td>" . $row["purchase_history"] . "</td><td>" . $row["loyalty_program_status"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không có bản ghi nào được tìm thấy.";
    }

    // Đóng kết nối
    mysqli_close($conn);
    ?>
</body>
</html>
