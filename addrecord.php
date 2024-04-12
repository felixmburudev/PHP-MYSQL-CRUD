
<?php
$email = isset($_GET['email']) ? $_GET['email'] : ''; //check if email is set in the url
$email_exist = strlen($email) > 0;
if(isset($_POST['submit'])) {

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    if(empty($email)) {
        header("Location: login.php"); // Redirect to login.php
        exit();
        
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
        echo "<h3 style='position: fixed; top: 0; left: 0; width: 100%; background-color: white; z-index: 9999; padding: 10px; color: red;'>Can't add record, Email already exists'</h3>";
    } else {
        // Insert the new record
        $sql_insert = "INSERT INTO students (name, dob, gender, class, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql_insert);
        mysqli_stmt_bind_param($stmt, "sssss", $name, $dob, $gender, $class, $email);
        if (mysqli_stmt_execute($stmt)) {
            echo "<h3 style='position: fixed; top: 0; left: 0; width: 100%; background-color: white; z-index: 9999; padding: 10px; color: red;'>Registered successfully</h3>";
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
    <link rel="stylesheet" href="styles.css">
    <title>Add Record</title>
</head>
<body>
    <div class="add-record-container">
        <h2>Add Record</h2>
        <h1 id="user"><?php echo  " Logged in as " .  $email; ?></h1>
        <form method="post" action="addrecord.php" class="add-record-form">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            Name: <input type="text" name="name" required><br>
            Date of Birth: <input type="date" name="dob" required><br>
            Gender: 
            <select name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br>
            Class: <input type="text" name="class" required><br>
            <input type="submit" name="submit" value="Insert a Record" class="add-record-submit-btn">
        </form>
        <div class="btn">
        <button onclick="window.location.href='index.php?email=<?php echo $email; ?>'" class="home-btn">Home</button>
        <button onclick="window.location.href='update.php?email=<?php echo $email; ?>'" class="update-record-btn">Update Record</button>
    </div>
    </div>
</body>
</html>

