


    function executeAuth() {
    // Assuming auth.php is in the same directory
    window.location.href = './api/auth.php';
}

    function executeDelete() {
    // You can add any additional logic or confirmation prompts here if needed

    // Submit the form when the button is clicked
    document.getElementById("deleteForm").submit();
}

    $(document).ready(function () {
        $("#executeButton").on("click", function () {
            $('#executeButton').attr('disabled', true);
            $.ajax({
                url: './api/executeAPI.php',  // Replace with the actual path to your PHP script
                type: 'POST',
                dataType: 'html',
                success: function (response) {
                    $("#output").html(response);

                },
                error: function (error) {
                    console.error('Error executing API script:', error);
                }
            }); // ajax end
            $("#buttonDiv").remove();
            $("#uploadDiv").html("<b>Refresh to leave</b> <br>");
        });
    });


// UPLOADER



