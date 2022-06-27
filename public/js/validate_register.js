function validateRegister() {
    let error_firstname = document.getElementById('error-firstname')
    let error_surname = document.getElementById('error-surname')
    let error_username = document.getElementById('error-username')
    let error_email = document.getElementById('error-email')
    let error_password = document.getElementById('error-password')
    //clear any existing error messages from html view
    error_firstname.textContent = ""
    error_surname.textContent = ""
    error_username.textContent = ""
    error_email.textContent = ""
    error_password.textContent = ""

    let firstname = document.getElementById('firstname') 
    let surname = document.getElementById('surname') 
    let username = document.getElementById('username')
    let email = document.getElementById('email')
    let password = document.getElementById('password')
    let name_pattern = /^[a-zA-Z\u0080-\u00FF\u0100-\u017F\u0180-\u024F]+$/
    let username_pattern = /^[a-zA-Z0-9_]+$/
    let email_pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    let password_pattern = /^[a-z0-9]+$/
    let send = true

    //first name validation
    if(firstname.value.length == 0) {
        error_firstname.textContent = "The name field is required."
        send = false
    } 
    else if(firstname.value.length > 30) {
        error_firstname.textContent = "The name must not be greater than 30 characters."
        send = false
    } 
    else if(!name_pattern.test(firstname.value)) {
        error_firstname.textContent = "The name must only contain letters."
        send = false
    }


    //surname validation
    if(surname.value.length == 0) {
        error_surname.textContent = "The surname field is required."
        send = false
    } 
    else if(surname.value.length > 30) {
        error_surname.textContent = "The surname must not be greater than 30 characters."
        send = false
    } 
    else if(!name_pattern.test(surname.value)) {
        error_surname.textContent = "The surname must only contain letters"
        send = false
    }

    //username validation
    if(username.value.length == 0) {
        error_username.textContent = "The username field is required."
        send = false
    }
    else if(username.value.length > 20) {
        error_username.textContent = "The username must not be greater than 20 characters."
        send = false
    }
    else if(!username_pattern.test(username.value)) {
        error_username.textContent = "The username must only contain letters, numbers, dashes and underscores."
        send = false
    }

    //email validation
    if (email.value.length == 0) {
        error_email.textContent = "The email field is required."
        send = false
    }
    else if(!email_pattern.test(email.value) || email.value.length > 100) {
        error_email.textContent = "The email must be a valid email address."
        send = false
    }


    //password validation
    if(password.value.length == 0) {
        error_password.textContent = "The password field is required."
        send = false
    }
    else if(password.value.length < 8) {
        error_password.textContent = "The password must be at least 8 characters."
        send = false
    }
    else if(password_pattern.test(password.value)) {
        error_password.textContent = "Password must contain at least one capital letter or symbol."
        send = false
    }

    //upon each client-side validation, hide/show errors if they're empty/not empty
    let errors = document.getElementsByClassName('msgs')
    for(let i = 0; i < errors.length; ++i) {
        if(errors[i].innerText.length == 0) {
           errors[i].style.display = "none";
        }
        else {
           errors[i].style.display = "inline";
        }
    }

    if(send) return true
    else return false
}