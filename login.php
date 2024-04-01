<!-- loing page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    
</head>
<body>
<form method="post" action="login.php" >
        Email: <input type="text" required name="email"><br>
        Password: <input type="password" required name="password"><br>
        <input type="submit" value="Submit" name="submit">
        <a href="signup.php">signup</a>
    </form>
</body>
</html>

<?php
 if(isset($_POST['submit']))
 {

    $conn = mysqli_connect("localhost", "root", "", "BSCS");
    
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }

    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql="select * from users where email='$email' and password='$password'";
    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);
    if($count==1)
    {
       
echo "<script>
        var email = '$email'; 
        var url = 'addrecord.php?email=' + encodeURIComponent(email);
        alert('Login Successful');
        window.location = url;
      </script>";


    }
    else
    {
        echo "<script>alert('Login Failed');window.location='login.php';</script>";
    }
 }

?>