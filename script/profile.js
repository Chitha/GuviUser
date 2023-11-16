$(document).ready(function () {
    // Fetch user details and update the profile page
    $.ajax({
        type: 'GET',
        url: '/server/get_user_details.php', // Adjust the URL to your server-side script
        dataType: 'json',
        success: function (userDetails) {
            // Update the HTML with user details
              
            if (userDetails) {
                var profileHTML = '<p><strong>Username:</strong> ' + userDetails.username + '</p>';
                 
                profileHTML +='<div class="form-group">'
                profileHTML +='<label for="newEmail">Email:</label>'
                profileHTML +='<input type="newEmail" class="form-control" id="newEmail" name="newEmail" required value='+userDetails.email +'>'
                profileHTML +='</div>'
                profileHTML +='<div class="form-group">'
                profileHTML +='<label for="newAge">Age:</label>'
                profileHTML +='<input type="text" class="form-control" id="newAge" name="newAge" required value='+userDetails.age +'>'
                profileHTML +='</div>'
                profileHTML +='<div class="form-group">'
                profileHTML +='<label for="newContact">contact:</label>'
                profileHTML +='<input type="text" class="form-control" id="newContact" name="newContact" required value='+userDetails.contact +'>'
                profileHTML +='</div>'
                
                // Add more details as needed

                $('#userDetails').html(profileHTML);
            } else {
                // Handle the case where user details couldn't be retrieved
                $('#userDetails').html('<p>Error retrieving user details.</p>');
            }
        },
        error: function () {
            // Handle error
            $('#userDetails').html('<p>An error occurred during the Ajax request.</p>');
        }
    });

    // Update Profile button click event
    $('#updateProfileBtn').click(function () {
         
         // Get form data
         var formData = $('#userDetails').serialize();
          
        $.ajax({
            type: 'POST',
            url: '/server/update_user_details.php', // Adjust the URL to your server-side script
            data: formData,
            dataType: 'json', 
            success: function (response) {
                // Handle success response
                alert(response.status );
                if (response.status === 'success') {
                     // You can replace this with a modal or redirect
                     window.location.href = '../server/home.php';
                } else {
                    alert('Signup failed. Please try again.'); // You can replace this with better error handling
                }
            },
            error: function (xhr, status, error) {
                window.location.href = '../server/home.php';
                console.log(status);
                console.log(error);
                $('#loginMessage').text('An error occurred during the Ajax request.');
            }
        });
    });
});
