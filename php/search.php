<?php
// Include the database connection file
include_once('connection.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve form data
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$DOB = isset($_POST['DOB']) ? $_POST['DOB'] : '';
$medicare = isset($_POST['medicare']) ? $_POST['medicare'] : '';

// Build the SQL query based on the available fields
$query = "SELECT * FROM Patient WHERE 1";
if (!empty($firstName)) {
    $query .= " AND PatientFirstName LIKE :firstName";
}
if (!empty($lastName)) {
    $query .= " AND PatientLastName LIKE :lastName";
}
if (!empty($DOB)) {
    $query .= " AND DOB = :DOB";
}
if (!empty($medicare)) {
    $query .= " AND MedicareID = :medicare";
}

// Prepare and execute the query
$stmt = $conn->prepare($query);

// Bind parameters if they exist
if (!empty($firstName)) {
    $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
}
if (!empty($lastName)) {
    $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
}
if (!empty($DOB)) {
    $stmt->bindParam(':DOB', $DOB, PDO::PARAM_STR);
}
if (!empty($medicare)) {
    $stmt->bindParam(':medicare', $medicare, PDO::PARAM_STR);
}

$stmt->execute();

// Fetch data as an associative array
$patientData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the result as JSON
if (empty($patientData)) {
    $response = array('success' => false, 'message' => 'No matching results found.');
} else {
    $response = array('success' => true, 'data' => $patientData);    
}

echo json_encode($response);
exit();
?>