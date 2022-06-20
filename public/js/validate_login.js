function validateLogin() {
    //clear any existing error messages from html view
    let error = document.getElementById('error')
    error.textContent = ""

    let username = document.getElementById('username') 
    let password = document.getElementById('password')

    let username_pattern = /^[a-zA-Z0-9_]+$/
    let password_pattern = /^[a-z0-9]+$/
    let send = true

    if(!username_pattern.test(username.value) || username.value.length > 20 || username.value.length == 0) {
        error.textContent = "Invalid username or password."
        send = false
    }


    if(password.value.length < 8) {
        error.textContent = "Invalid username or password."
        send = false
    }

    if(password_pattern.test(password.value)) {
        error.textContent = "Invalid username or password."
        send = false
    }

    //upon each client-side validation, hide/show errors if they're empty/not empty
    if(error.innerText.length == 0) {
        error.style.display = "none";
    }
    else {
        error.style.display = "inline";
    }

    if(send) return true
    else return false
}