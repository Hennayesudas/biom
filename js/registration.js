function submitForm() {
    var firstName = document.getElementById('First_Name').value;
    var lastName = document.getElementById('Last_Name').value;
    var dob = document.getElementById('DOB').value;
    var gender = document.getElementById('genders').value;
    var medicareNumber = document.getElementById('medicareNumber').value;
    var address = document.getElementById('address').value;
    var city = document.getElementById('city').value;
    var state = document.getElementById('state').value;
    var postcode = document.getElementById('postcode').value;
    var contactNumber = document.getElementById('contactNumber').value;
    var email = document.getElementById('email').value;
    var medical = document.getElementById('medical').value;
    var emergencyContactName = document.getElementById('namecontact').value;
    var relationship = document.getElementById('relationship').value;
    var emergencyContactNumber = document.getElementById('emerContactNumber').value;
    var isAlcohol = document.getElementById('alcohol').checked;
    var isSmoker = document.getElementById('smoker').checked;
    var roomNumber = document.getElementById('roomNumber').value;
    var image = document.getElementById('image').files[0]; // Assuming you have an input field with type file for image
    
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
  
    formData.append('First_Name', firstName);
    formData.append('Last_Name', lastName);
    formData.append('DOB', dob);
    formData.append('gender', gender);
    formData.append('medicareNumber', medicareNumber);
    formData.append('address', address);
    formData.append('city', city);
    formData.append('state', state);
    formData.append('postcode', postcode);
    formData.append('contactNumber', contactNumber);
    formData.append('medical', medical);
    formData.append('emergencyContactName', emergencyContactName);
    formData.append('relationship', relationship);
    formData.append('emergencyContactNumber', emergencyContactNumber);
    formData.append('alcohol', isAlcohol);
    formData.append('smoker', isSmoker);
    formData.append('roomNumber', roomNumber);
    formData.append('image', image);
    formData.append('email', email);
  
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          console.log('Response Text:', response);
  
          if (response.success) {
            // Redirect or perform other actions on successful registration
            alert(response.message); // or redirect using window.location.href
            window.location.href = 'searchOrRegister.html';
          } else {
            // Display error message
            alert(response.message); // or display the error message as needed
          }
        }
      }
    };
  
    xhr.open('POST', 'php/registration.php', true);
    xhr.send(formData);

  }
  