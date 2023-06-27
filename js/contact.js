/***************************************
 Name: Fred Butoma
 Assignment 6
 File: contact.js
 Purpose: Validates email entry client-side on contact form
 ****************************************/
$(document).ready(function() {
    let validate = function (){
        let valid = true;

        let name = $('#name').val();
        let email = $('#email').val();
        let confirm_email = $('#confirm-email').val();
        let subject = $('#subject').val();
        let message = $('#message').val();

        if (name.length === 0 ){
            $("#name_error").text("required field");
            valid = false;
        }
        if (email.length === 0){
            $("#email_error").text("required field");
            valid = false;
        }
        if (!validEmail(email)){
            $("#email_error").text("email format invalid");
            valid = false;
        }
        if (confirm_email.length === 0){
            $("#confirm_email_error").text("required field");
            valid = false;
        }
        if (!validEmail(email)){
            $("#confirm_email_error").text("email format invalid");
            valid = false;
        }
        if (email !== confirm_email){
            $("#confirm_email_error").text("emails do not match");
            valid = false;
        }
        if (subject.length === 0) {
            $("#subject_error").text("required field");
            valid = false;
        }
        if (message.length === 0){
            $("#msg_error").text("required field");
            valid = false;
        }
        return valid;

        // if (name && email && confirm_email && subject && message) {
        //     if (email === confirm_email) {
        //         if (validEmail(email)) {
        //             return true;
        //         } else {
        //             $('#msg').text('Email is not valid');
        //         }
        //     } else {
        //         $('#msg').text('Emails do not match');
        //     }
        // } else {
        //     $('#msg').text('All fields are required');
        // }
    }

    // document has loaded, fetch the form and add the submit event listener
    $('#email-form').submit(function(event) {
        event.preventDefault();

        let isValid = validate();
        if (!isValid){

        } else {
            let name = $('#name').val();
            let email = $('#email').val();
            let confirm_email = $('#confirm-email').val();
            let subject = $('#subject').val();
            let message = $('#message').val();

            let arguments = {name: name, email: email, confirm_email: confirm_email, subject: subject, message: message}

            $.ajax({
                type: "POST",
                url: "/email.php",
                data: arguments,
                success: function(response) {
                    response = JSON.parse(response)
                    if (response.result === 'error') {
                        $("#msg").text("Sorry, your message was not sent.")
                    } else if (response.result === 'okay') {
                        clearForm({})
                        $("#msg").text("Your message was sent.")
                    }
                }
            });

            return false;
        }
    })


    function clearForm(event) {
        $('#name').val('');
        $("#name_error").text('');

        $('#email').val('');
        $("#email_error").text("");

        $('#confirm-email').val('');
        $("#confirm_email_error").text("");

        $('#subject').val('');
        $("#subject_error").text("");

        $('#message').val('');
        $("#msg_error").text("");

    }

    $('#clear-btn').click(clearForm);
})

