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
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$birthday = mysqli_real_escape_string($conn, $_POST['dob']);
$gender = mysqli_real_escape_string($conn, $_POST['sex']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$preferences = mysqli_real_escape_string($conn, $_POST['preferences']);
$sale_representative_id = mysqli_real_escape_string($conn, $_POST['sales-rep-id']);
$loyalty_program_status = mysqli_real_escape_string($conn, $_POST['loyalty-status']);

// Attempt insert query execution
$sql = "INSERT INTO customer (last_name, first_name, date_of_birth, sex, email, phone, address, preferences, sales_representative_id, loyalty_program_status) VALUES ('$lastname','$firstname', '$birthday', '$gender', '$email', '$phone', '$address', '$preferences', '$sale_representative_id', '$loyalty_program_status' )";

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
