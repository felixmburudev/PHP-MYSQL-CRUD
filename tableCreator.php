<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BSCS";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    echo "<h3>Error connecting to MySQL</h3>";
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "<h3>Connected to MySQL</h3>";

    // Select the database
    if (!mysqli_select_db($conn, $dbname)) {
        $sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
        if ($conn->query($sql_create_db) === TRUE) {
            echo "<p>Database created successfully</p>";
        } else {
            echo "<p>Error creating database: " . $conn->error . "</p>";
            exit();
        }
    }

    // Create the students table
    $sql_create_students_table = "CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        class VARCHAR(255) NOT NULL,
        gender ENUM('Male', 'Female', 'Other') NOT NULL,
        dob DATE NOT NULL,
        email VARCHAR(255) NOT NULL,
        UNIQUE KEY (email(100)) -- Specify the key length here
    )";
    if ($conn->query($sql_create_students_table) === TRUE) {
        echo "<p>Table 'students' created successfully</p>";
    } else {
        echo "<p>Error creating table 'students': " . $conn->error . "</p>";
        exit();
    }

    // Create the users table
    $sql_create_users_table = "CREATE TABLE IF NOT EXISTS users (
        email VARCHAR(100) PRIMARY KEY,
        password VARCHAR(255) NOT NULL,
        UNIQUE KEY (email(100))
    )";
    if ($conn->query($sql_create_users_table) === TRUE) {
        echo "<p>Table 'users' created successfully</p>";
    } else {
        echo "<p>Error creating table 'users': " . $conn->error . "</p>";
        exit();
    }
}

$conn->close();
?>
