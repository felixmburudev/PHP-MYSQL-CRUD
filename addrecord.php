<!-- addrecord.php -->
<?php
$email = isset($_GET['email']) ? $_GET['email'] : '';
$email_exist = strlen($email) > 0;
if(isset($_POST['submit'])) {

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    if(empty($email)) {
        header("Location: login.php"); // Redirect to login.php
        exit(); // Stop further execution
    }
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];

    

    $conn = mysqli_connect("localhost", "root", "", "BSCS");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the email already exists
    $sql_check = "SELECT * FROM students WHERE email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        echo "<script type='text/javascript'>alert('Can't add record, Email already exists');</script>";
    } else {
        // Insert the new record
        $sql_insert = "INSERT INTO students (name, dob, gender, class, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql_insert);
        mysqli_stmt_bind_param($stmt, "sssss", $name, $dob, $gender, $class, $email);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script type='text/javascript'>alert('Registered successfully');</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Add Record</title>
</head>
<body>
    <h2>Add Record</h2>
    <h1 id="user"><?php echo  " Login in as " .  $email; ?></h1>
    <form method="post" action="addrecord.php">
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        Name: <input type="text" name="name" required><br>
        Date of Birth: <input type="date" name="dob" required><br>
        Gender: 
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <br>
        Class: <input type="text" name="class" required><br>
        <input type="submit" name="submit" value="Insert a Record">
    </form>
    <button onclick="window.location.href='index.php?email=<?php echo $email; ?>'">Home</button>
        <button onclick="window.location.href='update.php?email=<?php echo $email; ?>'">Update Record</button>
    


</body>
</html>
