<style>
    table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
            }
</style> 
<?php
    // Kết nối đến database
    $conn = mysqli_connect('localhost', 'root', '', 'user');

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }

    // Lấy giá trị ID từ biểu mẫu
    $customer_id = $_POST['customerid'];

    // Chạy truy vấn tìm kiếm khách hàng theo ID
    $sql = "SELECT * FROM customer WHERE customer_id = '$customer_id'"; 
    $result = mysqli_query($conn, $sql);

    
    // Kiểm tra kết quả truy vấn
    if (mysqli_num_rows($result) > 0) {
        // Hiển thị thông tin khách hàng
        echo "<table>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["customer_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["date_of_birth"] . "</td><td>" . $row["sex"]  . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["address"] . "</td><td>" . $row["sales_representative_id"] . "</td><td>" . $row["preferences"] . "</td><td>" . $row["purchase_history"] . "</td><td>" . $row["loyalty_program_status"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không tìm thấy khách hàng với ID: " . $customer_id;
    }

    // Đóng kết nối database
    mysqli_close($conn);
?>