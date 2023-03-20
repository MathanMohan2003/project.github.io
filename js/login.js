function loginUser() {
    var formData = $('#register-form').serialize();
    
    $.ajax({
      type: 'POST',
      url: 'php/login.php',
      data: formData,
      dataType: 'json',
      encode: true
    })
    .done(function(data) {
      console.log(data);
      if(data.success) {
        window.location.replace("profile.html");
        alert('Login successful!');
      } else {
        alert(data.error);
      }
    });
  }
  
  $(document).ready(function() {
    $('#register-form').submit(function(event) {
      event.preventDefault();
      loginUser();
    });
  });
