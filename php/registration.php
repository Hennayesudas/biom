<?php
ob_clean();
include_once('connection.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve form data
$firstName = isset($_POST['First_Name']) ? $_POST['First_Name'] : '';
$lastName = isset($_POST['Last_Name']) ? $_POST['Last_Name'] : '';
$dob = isset($_POST['DOB']) ? $_POST['DOB'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$addressLine1 = isset($_POST['address']) ? $_POST['address'] : '';
$states = isset($_POST['state']) ? $_POST['state'] : '';
$suburb = isset($_POST['city']) ? $_POST['city'] : '';
$zipCode = isset($_POST['postcode']) ? $_POST['postcode'] : ''; // Convert to integer
$email = isset($_POST['email']) ? $_POST['email'] : '';
$mobile = isset($_POST['contactNumber']) ? $_POST['contactNumber'] : ''; // Convert to integer
$medicareID = isset($_POST['medicareNumber']) ? $_POST['medicareNumber'] : ''; // Convert to integer
$emergencyContactName = isset($_POST['emergencyContactName']) ? $_POST['emergencyContactName'] : '';
$emergencyContactRelationship = isset($_POST['relationship']) ? $_POST['relationship'] : '';
$emergencyContactNumber = isset($_POST['emergencyContactNumber']) ? ($_POST['emergencyContactNumber']) : 
$roomNumber = isset($_POST['roomNumber']) ? $_POST['roomNumber'] : ''; // Convert to integer
$medical = isset($_POST['medical']) ? $_POST['medical'] : '';
$alcohol = isset($_POST['alcohol']) ? ($_POST['alcohol'] == 'true') : false;
$smoker = isset($_POST['smoker']) ? ($_POST['smoker'] == 'true') : false;
// Add other form fields as needed

try {
    // Prepare the SQL statement
    $sqlInsert = "INSERT INTO Patient (
        PatientFirstName, PatientLastName, DOB, Gender, 
        AddressLine1, `State`, Suburb, ZipCode, Email, 
        Mobile, MedicareID, EmergencyContactPerson, RelationshipToPatient, 
        EmergencyContactNumber, MedicalHistory, Alcoholic, 
        Smoker, RoomNumber
    ) VALUES (
        :firstName, :lastName, :dob, :gender,
        :addressLine1, :states, :suburb, :zipCode, :email,
        :mobile, :medicareID, :emergencyContactName, :emergencyContactRelationship,
        :emergencyContactNumber, :medical, :alcohol,
        :smoker, :roomNumber
    )";

    // // Prepare and execute the statement
    $stmt = $conn->prepare($sqlInsert);
    $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':addressLine1', $addressLine1, PDO::PARAM_STR);
    $stmt->bindParam(':states', $states, PDO::PARAM_STR);
    $stmt->bindParam(':suburb', $suburb, PDO::PARAM_STR);
    $stmt->bindParam(':zipCode', $zipCode, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':mobile', $mobile, PDO::PARAM_INT);
    $stmt->bindParam(':medicareID', $medicareID, PDO::PARAM_STR);
    $stmt->bindParam(':emergencyContactName', $emergencyContactName, PDO::PARAM_STR);
    $stmt->bindParam(':emergencyContactRelationship', $emergencyContactRelationship, PDO::PARAM_STR);
    $stmt->bindParam(':emergencyContactNumber', $emergencyContactNumber, PDO::PARAM_INT);
    $stmt->bindParam(':medical', $medical, PDO::PARAM_STR);
    $stmt->bindParam(':alcohol', $alcohol, PDO::PARAM_INT);
    $stmt->bindParam(':smoker', $smoker, PDO::PARAM_INT);
    $stmt->bindParam(':roomNumber', $roomNumber, PDO::PARAM_STR);

    // Example usage of var_dump for debugging
    // var_dump($firstName, $lastName, $dob, $gender, $addressLine1, $state, $suburb, $zipCode, $email, $mobile, $medicareID, $emergencyContactName, $emergencyContactRelationship, $emergencyContactNumber, $medical, $alcohol, $smoker, $roomNumber);

    $stmt->execute();

    $response = array('success' => true, 'message' => 'Patient registered successfully.');
} catch (PDOException $e) {
    $response = array('success' => false, 'message' => 'Error registering patient: ' . $e->getMessage());
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
