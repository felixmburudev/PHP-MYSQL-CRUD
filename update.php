<!-- update.php -->
<?php

$email = isset($_GET['email']) ? $_GET['email'] : '';

if(isset($_POST['submit'])) {
   
    $email = isset($_POST['email']) ? $_POST['email'] : '';

   
    $conn = mysqli_connect("localhost", "root", "", "BSCS");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $useremail = $email; 
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    

    
    $sql = "UPDATE students SET name = '$name', dob = '$dob', gender = '$gender' WHERE email = '$useremail'";

  
    if (mysqli_query($conn, $sql)) {
        $affected_rows = mysqli_affected_rows($conn);
        echo "Record updated successfully. Affected rows: " . $affected_rows . ". User email: " . $useremail;

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

   
    mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>update Record</title>
</head>
<body>
    <h2>Update Record</h2>
    <h1 id="user"><?php echo  " Login in as" . $email; ?></h1>
    <form method="post" action="update.php">
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
        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="index.php">home</a>



</body>
</html>
