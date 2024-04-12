<?php
if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    //checking idf the password and email are not epmty or null
    if (empty($email) || empty($password) || empty($confirmpassword)) {
        echo "<h3 style='position: fixed; top: 0; left: 0; width: 100%; background-color: white; z-index: 9999; padding: 10px; color: red;'>Please fill in all fields</h3>";
        exit();
    }
    if ( strlen($password) < 4 ) {
        echo "<h3 style='position: fixed; top: 0; left: 0; width: 100%; background-color: white; z-index: 9999; padding: 10px; color: red;'>Please type a stronger password</h3>";
        exit();
    }
    if ($password != $confirmpassword) {
        echo "<h3 style='position: fixed; top: 0; left: 0; width: 100%; background-color: white; z-index: 9999; padding: 10px; color: red;'>Password mismatch</h3>";
        exit();
    }

    $conn = mysqli_connect("localhost", "root", "", "BSCS");
    
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }

        
    $email = $_POST['email'];
    $sql_select = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo "Email already exists. Please choose a different email.";
    } else {
        $password = $_POST['password']; 


        // Perform the INSERT query to register the new student account
        $sql_insert = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "<script>alert('Signup Success');</ipt>";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
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
            <input type="submit" value="Signup" name="submit" class="signup-submit-btn">
        </form>
        <a href="login.php" class="login-link">Login</a>
    </div>
</body>
</html>
