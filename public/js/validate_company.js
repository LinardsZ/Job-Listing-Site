document.addEventListener('DOMContentLoaded', (event) => {
    const errors = []
    let error_name = document.getElementById('error-name')
    let error_registryid = document.getElementById('error-registryid')
    let error_about = document.getElementById('error-about')
    let error_homepage = document.getElementById('error-homepage')
    let error_location = document.getElementById('error-location')

    errors.push(error_name, error_registryid, error_about, error_homepage, error_location)

    for(let i = 0; i < errors.length; ++i) {
        if(errors[i].innerText.length == 0) {
            errors[i].style.display = "none"
        }
        else {
            errors[i].style.display = "inline"
        }
    }
})

function validateForm() {
    const errors = []
    let error_name = document.getElementById('error-name')
    let error_registryid = document.getElementById('error-registryid')
    let error_about = document.getElementById('error-about')
    let error_homepage = document.getElementById('error-homepage')
    let error_location = document.getElementById('error-location')

    errors.push(error_name, error_registryid, error_about, error_homepage, error_location)

    let name = document.getElementById('name')
    let registryid = document.getElementById('registryid')
    let about = document.getElementById('about')
    let homepage = document.getElementById('homepage')
    let location = document.getElementById('location')
    let send = true

    error_name.textContent = ""
    error_registryid.textContent = ""
    error_about.textContent = ""
    error_homepage.textContent = ""
    error_location.textContent = ""

    // name field
    if (name.value.length == 0) {
        error_name.textContent = "The name field is required."
        send = false
    }

    if (name.value.length > 50) {
        error_name.textContent = "The name must not be greater than 50 characters."
        send = false
    }

    // registryid field
    let registryid_pattern = /^[0-9]+$/
    
    if (registryid.value.length == 0) {
        error_registryid.textContent = "The registry ID field is required."
        send = false
    }
    else if (!registryid_pattern.test(registryid.value)) {
        error_registryid.textContent = "The registry ID must only contain digits."
        send = false
    }
    else if (registryid.value.length != 11) {
        error_registryid.textContent = "The registry ID must be 11 digits."
        send = false
    }

    // about field
    if (about.value.length == 0) {
        error_about.textContent = "The about field is required."
        send = false
    }

    // homepage field
    // regular expression source: https://www.geeksforgeeks.org/how-to-validate-url-using-regular-expression-in-javascript/
    let homepage_pattern = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi
    
    if(homepage.value.length == 0) {
        error_homepage.textContent = "The homepage field is required."
        send = false
    }
    else if (!homepage_pattern.test(homepage.value)) {
        error_homepage.textContent = "The homepage must be a valid URL."
        send = false
    }
    else if (homepage.value.length > 30) {
        error_homepage.textContent = "The homepage must not be greater than 30 characters."
        send = false
    }

    // location field 
    let location_pattern = /^[a-zA-Z\u0080-\u00FF\u0100-\u017F\u0180-\u024F0-9\s]+$/

    if (location.value.length == 0) {
        error_location.textContent = "The location field is required."
        send = false
    }
    else if (!location_pattern.test(location.value)) {
        error_location.textContent = "The location must contain only letters and digits."
        send = false
    }
    else if (location.value.length > 30) {
        error_location.textContent = "The location must not be greater than 30 characters."
        send = false
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

