<?php
$email = isset($_GET['email']) ? $_GET['email'] : '';
if(isset($_POST['submit'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    if(empty($email)) {
        header("Location: login.php"); 
        exit(); 
    }

    // db connection
    $conn = mysqli_connect("localhost", "root", "", "BSCS");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // check if a record exists for the given email since you can't update details doesn't exist
    $sql_check = "SELECT * FROM students WHERE email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) == 0) {
        header("Location: addrecord.php?email=$email");
        exit();
    }

    // Retrieve form data
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];

    // Update the record in the database
    $sql = "UPDATE students SET name = '$name', dob = '$dob', gender = '$gender', class = '$class' WHERE email = '$email'";
    if (mysqli_query($conn, $sql)) {
        $affected_rows = mysqli_affected_rows($conn);
        echo "Record updated successfully. Affected rows: " . $affected_rows . ". User email: " . $email;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Update Record</title>
</head>
<body>
    <div class="update-record-container">
        <h2>Update Record</h2>
        <h1 id="user"><?php echo "Logged in as " . $email; ?></h1>
        <form method="post" action="update.php" class="update-record-form">
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
            <input type="submit" name="submit" value="Update" class="update-record-submit-btn">
        </form>
        <div class="btn"><button onclick="window.location.href='index.php?email=<?php echo $email; ?>'" class="home-btn">Home</button>
        <button onclick="window.location.href='addrecord.php?email=<?php echo $email; ?>'" class="add-record-btn">Add Record</button>
    </div>
        </div>
</body>
</html>


