<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "user";


// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Escape user inputs for security
$customerid = mysqli_real_escape_string($conn, $_POST['customerid']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$sale_representative_id = mysqli_real_escape_string($conn, $_POST['sale_representative_id']);
$preferences = mysqli_real_escape_string($conn, $_POST['preferences']);

// Attempt insert query execution
$sql = "INSERT INTO customer (customer_id, name, date_of_birth,  sex, email, phone, address, sales_representative_id, preferences) VALUES ('$customerid','$name', '$birthday', '$gender', '$email', '$phone', '$address', '$sale_representative_id', '$preferences')";

if (mysqli_query($conn, $sql)) {
    echo "Records added successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

header("Location: index.php");
exit;
?>
