<?php
ob_clean();
include_once('connection.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = isset($_POST['name']) ? $_POST['name'] : '';
$password = isset($_POST['Password']) ? $_POST['Password'] : '';

$query = "SELECT * FROM Practitioner WHERE UserName = :username AND `Password` = :password";
$stmt = $conn->prepare($query);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->execute();

$practitionerData = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($practitionerData) {
    $response = array('success' => true);
    echo json_encode($response);
    exit();
} else {
    $response = array('success' => false, 'message' => 'Invalid username or password');
    echo json_encode($response);
    exit();
}
?>