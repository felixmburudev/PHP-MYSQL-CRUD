<?php
$email = isset($_GET['email']) ? $_GET['email'] : '';
if (empty($email) || is_null($email)) {
    echo "<h3> Login to add or update a record</h3>";
} else {
    echo "<h3> Logged in as $email</h3>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">    
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSCS</title>
</head>
<body>
    <h2>Student Records Software</h2>
    <div class="btn">
    <button onclick="window.location.href='login.php'">Login</button>
    <button onclick="window.location.href='signup.php'">Signup</button>
   <?php if (!empty($email)) { ?>
        <button onclick="window.location.href='addrecord.php?email=<?php echo $email; ?>'">Add Record</button>
<button onclick="window.location.href='update.php?email=<?php echo $email; ?>'">Update Record</button>
<button onclick="window.location.href='login.php'">Logout</button>
    <?php } ?>
 </div>
    <h2>Students Table</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Class</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "BSCS");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT name, dob, gender, email, class FROM students";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["dob"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["class"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
