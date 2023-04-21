<?php
// Kết nối đến database
$conn = mysqli_connect("localhost", "root", "", "user");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Xử lý yêu cầu xóa đơn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql = "DELETE purchase, purchase_product FROM purchase INNER JOIN purchase_product ON purchase.purchase_id = purchase_product.purchase_id WHERE purchase.purchase_id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: purchase.php");
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Lấy thông tin đơn hàng cần xóa
$id = $_GET["id"];
$sql = "SELECT *
FROM purchase
INNER JOIN purchase_product
ON purchase.purchase_id = purchase_product.purchase_id
WHERE purchase.purchase_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<h1>Xóa đơn hàng</h1>
<p>Bạn có chắc chắn muốn xóa đơn hàng này không?</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="id" value="<?php echo $row['purchase_id']; ?>">
    <p>Customer ID:
        <?php echo $row['customer_id']; ?>
    </p>
    <p>Purchase Date:
        <?php echo $row['purchase_date']; ?>
    </p>
    <p>Product ID:
        <?php echo $row['product_id']; ?>
    </p>
    <p>Quantity:
        <?php echo $row['quantity']; ?>
    </p>
    <p>Amount:
        <?php echo $row['amount']; ?>
    </p>
    <input type="hidden" name="total_amount" value="<?php echo $row['total_amount']; ?>">
    <p><input type="submit" value="Xóa"></p>
</form>