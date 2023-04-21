<!DOCTYPE html>
<html>

<head>
    <title>Sửa đơn hàng</title>
    <!-- Thêm các tập tin CSS của Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Thêm các tập tin JavaScript của Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    // Kết nối đến database
    $conn = mysqli_connect("localhost", "root", "", "user");

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Xử lý yêu cầu sửa đơn
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $customer_id = $_POST["customer_id"];
        $purchase_date = $_POST["purchase_date"];
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        $amount = $_POST["amount"];
        $total_amount = $_POST["total_amount"];

        $sql = "UPDATE purchase
        INNER JOIN purchase_product
        ON purchase.purchase_id = purchase_product.purchase_id
        SET customer_id='$customer_id',
            purchase_date='$purchase_date',
            product_id='$product_id',
            quantity='$quantity',
            amount='$amount',
            total_amount='$total_amount'
        WHERE purchase.purchase_id=$id AND purchase_product.purchase_id=$id";

        if (mysqli_query($conn, $sql)) {
            header("Location: purchase.php");
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }

    // Lấy thông tin đơn hàng cần sửa
    $id = $_GET["id"];
    $sql = "SELECT *
    FROM purchase
    INNER JOIN purchase_product
    ON purchase.purchase_id = purchase_product.purchase_id
    WHERE purchase.purchase_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <h1>Sửa đơn hàng</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $row['purchase_id']; ?>">
        <p>Customer ID: <input type="text" name="customer_id" value="<?php echo $row['customer_id']; ?>"></p>
        <p>Purchase Date: <input type="date" name="purchase_date" value="<?php echo $row['purchase_date']; ?>"></p>
        <p>Product ID: <input type="text" name="product_id" value="<?php echo $row['product_id']; ?>"></p>
        <p>Quantity: <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>"></p>
        <p>Amount: <input type="text" name="amount" value="<?php echo $row['amount']; ?>"></p>
        <input type="hidden" name="total_amount" value="<?php echo $row['total_amount']; ?>">
        <p><input type="submit" value="Save"></p>
    </form>
</body>

</html>