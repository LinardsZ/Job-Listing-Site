document.addEventListener('DOMContentLoaded', (event) => {
    const errors = []
    let error_name = document.getElementById('error-name')
    let error_registryid = document.getElementById('error-registryid')
    let error_homepage = document.getElementById('error-homepage')
    let error_location = document.getElementById('error-location')
    let error_email = document.getElementById('error-email')
    let error_firstname = document.getElementById('error-firstname')
    let error_surname = document.getElementById('error-surname')
    let error_password = document.getElementById('error-password')
    let error_newpassword = document.getElementById('error-newpassword')

    errors.push(error_name, error_registryid, error_homepage, error_location, error_email, error_firstname, error_surname, error_password, error_newpassword)

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
    let error_name = document.getElementById('error-name')
    let error_registryid = document.getElementById('error-registryid')
    let error_homepage = document.getElementById('error-homepage')
    let error_location = document.getElementById('error-location')
    let error_email = document.getElementById('error-email')
    let error_firstname = document.getElementById('error-firstname')
    let error_surname = document.getElementById('error-surname')
    let error_password = document.getElementById('error-password')
    let error_newpassword = document.getElementById('error-newpassword')

    errors.push(error_name, error_registryid, error_homepage, error_location, error_email, error_firstname, error_surname, error_password, error_newpassword)

    let name = document.getElementById('name')
    let registryid = document.getElementById('registryid')
    let homepage = document.getElementById('homepage')
    let location = document.getElementById('location')
    let email = document.getElementById('email')
    let firstname = document.getElementById('firstname')
    let surname = document.getElementById('surname')
    let password = document.getElementById('password')
    let newpassword = document.getElementById('newpassword')
    let send = true

    error_name.textContent = ""
    error_registryid.textContent = ""
    error_homepage.textContent = ""
    error_location.textContent = ""
    error_email.textContent = ""
    error_firstname.textContent = ""
    error_surname.textContent = ""
    error_password.textContent = ""
    error_newpassword.textContent = ""

    //first name validation
    let name_pattern = /^[a-zA-Z\u0080-\u00FF\u0100-\u017F\u0180-\u024F]+$/
    if(firstname.value.length > 30 && firstname.value.length != 0) {
        error_firstname.textContent = "The name must not be greater than 30 characters."
        send = false
    } 
    else if(!name_pattern.test(firstname.value) && firstname.value.length != 0) {
        error_firstname.textContent = "The name must only contain letters."
        send = false
    }


    //surname validation
    if(surname.value.length > 30 && surname.value.length != 0) {
        error_surname.textContent = "The surname must not be greater than 30 characters."
        send = false
    } 
    else if(!name_pattern.test(surname.value) && surname.value.length != 0) {
        error_surname.textContent = "The surname must only contain letters."
        send = false
    }

    //email validation
    let email_pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if (email.value.length > 100) {
        error_email.textContent = "The email must not be greater than 100 characters."
        send = false
    }
    else if (!email_pattern.test(email.value) && email.value.length != 0) {
        error_email.textContent = "The email must be a valid email address."
        send = false
    }

    // name field
    if (name.value.length > 50) {
        error_name.textContent = "The name must not be greater than 50 characters."
        send = false
    }

    // registryid field
    let registryid_pattern = /^[0-9]+$/
    if (!registryid_pattern.test(registryid.value) && registryid.value.length != 0) {
        error_registryid.textContent = "The registry ID must only contain digits."
        send = false
    }
    else if (registryid.value.length != 0) {
        if (registryid.value.length != 11 ) {
            error_registryid.textContent = "The registry ID must be 11 digits."
            send = false
        }
    }

    // homepage field
    // regular expression source: https://www.geeksforgeeks.org/how-to-validate-url-using-regular-expression-in-javascript/
    let homepage_pattern = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi
    if (homepage.value.length > 30) {
        error_homepage.textContent = "The homepage must not be greater than 30 characters."
        send = false
    }
    else if (!homepage_pattern.test(homepage.value) && homepage.value.length != 0) {
        error_homepage.textContent = "The homepage must be a valid URL."
        send = false
    }

    // location field 
    let location_pattern = /^[a-zA-Z\u0080-\u00FF\u0100-\u017F\u0180-\u024F0-9\s]+$/
    let l = location.value.replace(/\s+/g, '');
    if (!location_pattern.test(l) && location.value.length != 0) {
        error_location.textContent = "The location must contain only letters and digits."
        send = false
    }
    else if (location.value.length > 30) {
        error_location.textContent = "The location must not be greater than 30 characters."
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