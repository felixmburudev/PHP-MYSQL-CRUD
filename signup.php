<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>  
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="signup-container">
        <h2>Signup</h2>
        <form method="post" action="signup.php" class="signup-form">
            <label for="email">Email:</label>
            <input type="text" required name="email" id="email"><br>
            <label for="password">Password:</label>
            <input type="password" required name="password" id="password"><br>
            <label for="confirmpassword">Confirm Password:</label>
            <input type="password" required name="confirmpassword" id="confirmpassword"><br>
            <input type="submit" value="Submit" name="submit" class="signup-submit-btn">
        </form>
        <a href="login.php" class="login-link">Login</a>
    </div>
</body>
</html>

<?php
if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if (empty($email) || empty($password) || empty($confirmpassword) || strlen($password) < 4 ) {
        echo "<h3>Please fill in all fields</h3>";
        exit();
    }
    if ($password != $confirmpassword) {
        echo "<h3>Password mismatch</h3>";
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "BSCS";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    if ($conn->connect_error) {
        echo "<h3>Error connecting to database</h3>";
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Signup Success');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
