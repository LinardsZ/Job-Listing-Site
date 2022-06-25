document.addEventListener('DOMContentLoaded', (event) => {
    const errors = []
    let error_firstname = document.getElementById('error-firstname')
    let error_surname = document.getElementById('error-surname')
    let error_email = document.getElementById('error-email')
    let error_password = document.getElementById('error-password')
    let error_newpassword = document.getElementById('error-newpassword')

    errors.push(error_firstname, error_surname, error_email, error_password, error_newpassword)

    for(let i = 0; i < errors.length; ++i) {
        if(errors[i].innerText.length == 0) {
            errors[i].style.display = "none"
        }
        else {
            errors[i].style.display = "inline"
        }
    }
})

function validateEditForm() {
    const errors = []
    let error_firstname = document.getElementById('error-firstname')
    let error_surname = document.getElementById('error-surname')
    let error_email = document.getElementById('error-email')
    let error_password = document.getElementById('error-password')
    let error_newpassword = document.getElementById('error-newpassword')

    errors.push(error_firstname, error_surname, error_email, error_password, error_newpassword)

    let firstname = document.getElementById('firstname')
    let surname = document.getElementById('surname')
    let email = document.getElementById('email')
    let password = document.getElementById('password')
    let newpassword = document.getElementById('newpassword')
    let send = true

    error_firstname.textContent = ""
    error_surname.textContent = ""
    error_email.textContent = ""
    error_password.textContent = ""
    error_newpassword.textContent = ""

    
    let pattern = /^[a-zA-Z\u0080-\u00FF\u0100-\u017F\u0180-\u024F]+$/
    //firstname
    if(firstname.value.length > 30) {
        error_firstname.textContent = "The firstname must not be greater than 30 characters."
        send = false
    } 
    else if(!pattern.test(firstname.value) && firstname.value.length != 0) {
        error_firstname.textContent = "The firstname must only contain letters."
        send = false
    }
    
    //surname
    if(surname.value.length > 30) {
        error_surname.textContent = "The surname must not be greater than 30 characters."
        send = false
    } 
    else if(!pattern.test(surname.value) && surname.value.length != 0) {
        error_surname.textContent = "The surname must only contain letters."
        send = false
    }

    //email
    let email_pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if (email.value.length > 100) {
        error_email.textContent = "The email must not be greater than 100 characters."
        send = false
    }
    else if (!email_pattern.test(email.value) && email.value.length != 0) {
        error_email.textContent = "The email must be a valid email address."
        send = false
    }

    //password
    let password_pattern = /^[a-z0-9]+$/
    if(newpassword.value.length != 0) {
        if(newpassword.value.length < 8) {
            error_newpassword.textContent = "The new password must be at least 8 characters."
            send = false
        }
        else if(password_pattern.test(newpassword.value)) {
            error_newpassword.textContent = "New password must contain at least one capital letter or symbol."
            send = false
        }
        else if(password.value.length == 0) {
            error_password.textContent = "The password field is required in order to update passwords."
            send = false
        }
    }

    for(let i = 0; i < errors.length; ++i) {
        if(errors[i].innerText.length == 0) {
            errors[i].style.display = "none"
        }
        else {
            errors[i].style.display = "inline"
        }
    }

    if (send) return true
    else return false
}