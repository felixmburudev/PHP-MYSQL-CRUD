<?php
$email = isset($_GET['email']) ? $_GET['email'] : ''; //getting email from url
$conn = mysqli_connect("localhost", "root", "", "BSCS");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//delleting user record
$sql_delete = "DELETE FROM students WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql_delete);
mysqli_stmt_bind_param($stmt, "s", $email);
if (mysqli_stmt_execute($stmt)) {
    echo "Record deleted successfully";    
    header("Location: index.php?email=$email");
} else {
    echo "alert('Error: " . mysqli_error($conn) . "');";
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>