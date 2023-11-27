function searchPatients() {
    // Get form data
    var fullName = document.getElementById('name').value;
    var names = fullName.split(" ");
    var formData = new FormData();
    formData.append('firstName', names[0] || '');
    formData.append('lastName', names[1] || '');
    formData.append('DOB', document.getElementById('DOB').value);
    formData.append('medicare', document.getElementById('medicare').value);
  
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
  
    // Configure it: Use POST method and specify the URL
    xhr.open('POST', 'php/search.php', true);
  
    // Set up a callback function to handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
  
                if (response.success) {
                    var dataLength = response.data.length; 
                    console.log('data length: ' + dataLength);
                    if (dataLength === 0) {
                        document.getElementById('error-message').innerHTML = 'No matching results found';
                    } else if (dataLength === 1) {
                        // If only one result is found, redirect to patient-profile.html
                        var PatientID = response.data[0].PatientID; // Adjust the property based on your actual data
                        window.location.href = '/BIOM9450/patient-profile.html?' + PatientID;
                    } else {
                        // If multiple results are found, display a popup with a list of results
                        showMultipleResultsPopup(response.data);
                    }
                } else {
                    // Display error message
                    document.getElementById('error-message').innerHTML = response.message;
                }
            }
        }
    };
  
    // Send the request with form data
    xhr.send(formData);
}

function showMultipleResultsPopup(results) {
    // Create a container for the results
    var resultsContainer = document.getElementById('search-results');
    resultsContainer.innerHTML = ''; // Clear previous results

    // Loop through the results and create HTML elements for each
    for (var i = 0; i < results.length; i++) {
        var result = results[i];

        if (result.MedicareID !== null && !isNaN(result.MedicareID)) {
            result.MedicareID = result.MedicareID.toString();
        }

        // Create a new div for each result
        var resultDiv = document.createElement('div');
        resultDiv.classList.add('result-item');
        resultDiv.innerHTML = "<p>" + result.PatientFirstName + " " + result.PatientLastName + " " + result.DOB + " " + result.Email + " " + result.Mobile +
            " " + result.Suburb + " " + result.MedicareID + "</p>";

        // Add a click event listener to make the row selectable
        resultDiv.addEventListener('click', function (resultObj) {
            return function () {
                // Redirect to the patient profile page with the selected patient's ID
                window.location.href = '/BIOM9450/patient-profile.html?PatientID=' + resultObj.PatientID;
            };
        }(result));

        // Append the result div to the container
        resultsContainer.appendChild(resultDiv);
    }
}
