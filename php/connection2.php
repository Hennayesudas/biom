<?php
ob_start();
try {
    // Replace with the actual path to your Access database
    $dbPath = "C:\\Users\\rejis\\Downloads\\AgeCareDB2\\AgeCare.accdb";

    // Attempt to establish a connection to the Access database
    $conn = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$dbPath;Uid=;Pwd=;");

    // If the connection is successful, print a success message
    echo "Connection to the database was successful!";
    die();
} catch (PDOException $e) {
    // If there is an error, print the error message
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>