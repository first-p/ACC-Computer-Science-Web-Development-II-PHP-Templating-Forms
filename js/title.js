/***************************************
 Name: Fred Butoma
 Assignment 5
 File: title.js
 Purpose: Validates title form entries client-side
 and has functions for the form
 ****************************************/

let btn_clear_form = $("#btn-clear-form");

function clearForm(event) {

//jQuery
    $("#title").val('');
    $("#favorite_drink").val('');
    $("#pet_name").val('');
    $("#favorite_fictional_place").val('');
    $("#favorite_real_place").val('');
    $("#email").val('');
    $("#msg").val('');

}

// jQuery
btn_clear_form.click(clearForm);



function formSubmit(event) {

    // event.preventDefault();
    let result = validate();
    if (result.length === 0) {
        let title = $("#title").val();
        let fave_drink = $("#favorite_drink").val();
        let pet_name = $("#pet_name").val();
        let fave_fictional_place = $("#favorite_fictional_place").val();
        let fave_real_place = $("#favorite_real_place").val();
        let email = $("#email").val();

        let arguments = {
            title: title,
            fave_drink: fave_drink,
            pet_name: pet_name,
            fave_fictional_place: fave_fictional_place,
            fave_real_place: fave_real_place,
            email: email
        }

        let search_params = new URLSearchParams(arguments)

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if ( xhr.readyState==4 && xhr.status==200 ) {
                let obj = JSON.parse(xhr.responseText);
                if (obj['length'] < 30) {
                    $("#msg").text("That's a cute little title")
                } else if (obj['length'] >= 30) {
                    $("#msg").text("That's a heck of a title!");
                }
                clearForm({});
            }
        };
        xhr.open("POST", "https://freddybutoma.me/process.php", false);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(search_params);
    } else {
        $("#msg").text(result);
    }
    // let result = validate();
    // if (result.length === 0) {
    //     return true;
    // } else {
    //     $("#msg").text(result);
    // }
    return false;
}
// if ($result_str_len < 30) {
//            $result_response = "That's a cute little title.";
//        } else if ($result_str_len >= 30) {
//            $result_response = "That's a heck of a title!";
//        }
function validate() {
    let result_txt = 'All fields are required';
    let title = $("#title").val();
    let fave_drink = $("#favorite_drink").val();
    let pet_name = $("#pet_name").val();
    let fave_fictional_place = $("#favorite_fictional_place").val();
    let fave_real_place = $("#favorite_real_place").val();
    let email = $("#email").val();

    if (title && fave_drink && pet_name && fave_fictional_place && fave_real_place && email) {
        if (fave_real_place != fave_fictional_place) {
            if (validEmail(email)) {
                result_txt = '';
            }
            else {
                result_txt = 'Please enter a valid email'
            }
        }
        else {
            result_txt = "Real place and favorite place must be different"
        }
    }
    return result_txt;


}

$("#title-form").submit(formSubmit);


