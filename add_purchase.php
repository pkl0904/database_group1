<?php
// Lấy dữ liệu từ biểu mẫu
$customerID = $_POST['customerID'];
$purchaseDate = $_POST['purchaseDate'];
$productInfo = json_decode($_POST['productInfo'], true);

// Tính tổng giá trị đơn hàng
$totalAmount = 0;
foreach ($productInfo as $product) {
    $totalAmount += $product['amount'];
}

// Kết nối đến database
$conn = mysqli_connect("localhost", "root", "", "user");

// Thêm đơn hàng mới vào bảng Purchase
$stmt = $conn->prepare("INSERT INTO purchase (purchase_date, customer_id, total_amount) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $purchaseDate, $customerID, $totalAmount);
$stmt->execute();
$purchaseID = $stmt->insert_id;
$stmt->close();

// Thêm thông tin chi tiết sản phẩm mua vào bảng Purchase_product
$stmt = $conn->prepare("INSERT INTO purchase_product (purchase_id, product_id, quantity, amount) VALUES (?, ?, ?, ?)");
foreach ($productInfo as $product) {
    $productID = $product['productID'];
    $quantity = $product['quantity'];
    $amount = $product['amount'];
    $stmt->bind_param("ssss", $purchaseID, $productID, $quantity, $amount);
    $stmt->execute();
}
$stmt->close();

// Đóng kết nối
mysqli_close($conn);
// Chuyển hướng về trang khác sau khi thêm thành công
header('Location: purchase.php');

?>