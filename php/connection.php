<?php
ob_start();
try {
    // Replace with the actual path to your Access database
    $dbPath = "C:\\Users\\rejis\\Downloads\\AgeCareDB2\\AgeCare.accdb";

    // Attempt to establish a connection to the Access database
    $conn = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$dbPath;Uid=;Pwd=;");

} catch (PDOException $e) {
    // If there is an error, print the error message
    $response = array('success' => false, 'message' => 'Connection failed: ' . $e->getMessage());
    echo json_encode($response);
    die();
}
?>