<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BSCS";



    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        echo   "<h3>Error connecting</h3>";
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        echo "<h3>Connected to MySQL</h3>";
    }
    ?>