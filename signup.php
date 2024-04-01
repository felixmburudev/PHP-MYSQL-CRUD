<!-- signup,php -->
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <h2>Signup</h2>
    <form method="post" action="signup.php" >
        Email: <input type="text" required name="email"><br>
        Password: <input type="password" required name="password"><br>
        Password: <input type="password" required name="confirmpassword"><br>
        <input type="submit" value="Submit" name="submit">
    </form>
    <a href="login.php"> login</a>
</body>
</html


<?php
if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // if (empty($email) || empty($password) || empty($confirmpassword)) {
    //     echo "Please fill in all fields";
    //     exit();
    // }
    if ($password!= $confirmpassword) {
        echo "<h3>password mismatch</h3>";
        exit();
    }


    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "BSCS";



    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

   
    if ($conn->connect_error) {
        echo   "<h3>Error connecting</h3>";
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        echo "<h3>Connected to MySQL</h3>";
    }

    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

   
    if ($conn->query($sql) === TRUE) {
        echo "<h3>New record created successfully</h3>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
>

  