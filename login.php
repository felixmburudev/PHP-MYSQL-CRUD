<?php
if(isset($_POST['submit'])) {
    $conn = mysqli_connect("localhost", "root", "", "BSCS");
    
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }

    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql="select * from users where email='$email' and password='$password'";
    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);
    if($count==1) {
        echo "<script>
                var url = 'index.php?email=' + '$email';
                alert('Login Successful');
                window.location = url;
              </script>"; //embended javascript code to alert and redirect to index.php with the url attched in the url
    } else {
        echo "<h3 style='position:
         fixed; top: 0;
          left: 0
          ; width: 100%;
           background-color: white;
            z-index: 9999; padding: 10px;
             color: red;'>Wrong Password</h3>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
</head>
<body>
    <div class="login-form-container">
        <form method="post" action="login.php" class="login-form">
            <label for="email">Email:</label>
            <input type="text" required name="email" id="email"><br>
            <label for="password">Password:</label>
            <input type="password" required name="password" id="password"><br>
            <input type="submit" value="Login" name="submit" class="login-submit-btn">
        </form>
        <a href="signup.php" class="signup-link">Signup</a>
    </div>
</body>
</html>
