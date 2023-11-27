function submitForm() {
  var name = document.getElementById('name').value;
  var password = document.getElementById('Password').value;

  var xhr = new XMLHttpRequest();
  var formData = new FormData();

  formData.append('name', name);
  formData.append('Password', password);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        console.log('Response Text:', response);

        if (response.success) {
          // Redirect or perform other actions on successful login
          window.location.href = '/BIOM9450/searchOrRegister.html';
        } else {
          // Display error message
          document.getElementById('error-message').innerHTML = response.message;
        }
      }
    }
  };

  xhr.open('POST', 'php/login.php', true);
  xhr.send(formData);
}