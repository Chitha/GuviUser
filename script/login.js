$(document).ready(function () {
    $('#loginBtn').click(function () {
        // Get form data
        var formData = $('#loginForm').serialize();

        // Ajax request
        $.ajax({
            type: 'POST',
            url: '/server/login.php',
            data: formData,
            dataType: 'json',
            success: function (response) {
                // Handle success response
                $('#loginMessage').text(response.message);
                if (response.status === 'success') {
                    // Redirect to the profile page or perform other actions on successful login
                     window.location.href = '../server/profile.php';
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
                $('#loginMessage').text('An error occurred during the Ajax request.');
            }
        });
    });
});
