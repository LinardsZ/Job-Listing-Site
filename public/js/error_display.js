//if server-side validation fails and redirects, hide empty error elements from view
document.addEventListener('DOMContentLoaded', (event) => {
    let errors = document.getElementsByClassName('msgs')
    let login_error = document.getElementById('error')
    
    if(errors.length != 0) {
        for(let i = 0; i < errors.length; ++i) {
            if(errors[i].innerText.length == 0) {
                errors[i].style.display = "none";
            }
        }
    }
    else if(login_error) {
        if(login_error.innerText.length == 0) login_error.style.display = "none"
        else login_error.style.display = "inline"
    }
});