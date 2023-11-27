<?php
include_once('connection.php');

// Retrieve patient ID from URL query parameter
$patientId = isset($_GET['patientID']) ? $_GET['patientID'] : null;

if ($patientId) {
    // Fetch patient information from the database based on the patient ID
    $sql = "SELECT * FROM Patient WHERE PatientID = :patientId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
    $stmt->execute();

    $patientData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Send patient information as JSON response
    header('Content-Type: application/json');
    echo json_encode($patientData);
} else {
    // Handle invalid or missing patient ID
    echo json_encode(['error' => 'Invalid or missing patient ID']);
}
?>
