$(document).ready(function () {
    $('#signupBtn').click(function () {
        // Get form data
        var formData = $('#signupForm').serialize();

        // Ajax request
        $.ajax({
            type: 'POST',
            url: '/server/signup.php',
            data: formData,
            dataType: 'json',
            success: function (response) {
                // Handle success response
                
                if (response.status === 'success') {
                    alert(response.message); // You can replace this with a modal or redirect
                    window.location.href = '../html/Login.html';
                } else {
                    alert('Signup failed. Please try again.'); // You can replace this with better error handling
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