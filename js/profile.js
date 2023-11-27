document.addEventListener('DOMContentLoaded', function () {
    // Retrieve patient ID from URL query parameter
    var urlParams = new URLSearchParams(window.location.search);
    var patientId = urlParams.get('patientID');

    // Fetch patient information using AJAX
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var patientData = JSON.parse(xhr.responseText);
                // Update the HTML with patient information
                updatePatientInformation(patientData);
            } else {
                console.error('Failed to fetch patient information');
            }
        }
    };

    xhr.open('GET', 'php/getPatientInfo.php?patientID=' + patientId, true);
    xhr.send();
});

function updatePatientInformation(patientData) {
    // Update HTML elements with patient information
    document.getElementById('patientInfo').innerHTML = `
        <img src="assets/img/user.png" alt="Icon description" width="170" height="170">
        <h3>${patientData.PatientFirstName} ${patientData.PatientLastName}</h3>
        <p>Date of Birth: ${patientData.DOB}</p>
        <p>Gender: ${patientData.Gender}</p>
        <p>Address: ${patientData.AddressLine1}</p>
        <p>Emergency Contact: <br>
          Name: ${patientData.EmergencyContactPerson} <br>
          Relationship: ${patientData.RelationshipToPatient} <br>
          Phone Number: ${patientData.EmergencyContactNumber}
        </p>
        <!-- Add more information as needed -->
    `;
}