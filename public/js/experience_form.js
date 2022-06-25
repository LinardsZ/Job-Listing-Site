//if server-side validation fails and redirects, hide empty error elements from view
document.addEventListener('DOMContentLoaded', (event) => {
    let error_exp = document.getElementById('error_exp')
    let expform = document.getElementById('expform')
    expform.style.display = "none"
    error_exp.style.display = "none"
    // let eduform = document.getElementById('eduform')
    // if(error_exp.innerText.length == 0) error_exp.style.display = "none"
    // else {
    //     expform.style.display = "flex"
    //     error_exp.style.display = "inline"
    // }
});

function closeExpForm() {
    let expform = document.getElementById('expform')
    expform.style.display = "none"

    let position = document.getElementById('position')
    let workplace = document.getElementById('workplace')
    let startyear = document.getElementById('startyear_exp')
    let endyear = document.getElementById('endyear_exp')
    position.value = ""
    workplace.value = ""
    startyear.value = ""
    endyear.value = ""
}

function showExpForm() {
    let expform = document.getElementById('expform')
    let error_exp = document.getElementById('error_exp')

    expform.style.display = "flex"
    error_exp.style.display = "none"
}

function validateExpForm() {
    let position = document.getElementById('position')
    let workplace = document.getElementById('workplace')
    let error_exp = document.getElementById('error_exp')
    let startyear = document.getElementById('startyear_exp')
    let endyear = document.getElementById('endyear_exp')
    let send = true

    error_exp.textContent = ""

    if(position.value.length == 0 || workplace.value.length == 0) {
        error_exp.textContent = "Text fields are required."
        send = false
    }
    if(position.value.length > 50 || workplace.value.length > 50) {
        error_exp.textContent = "Text fields must not be greater than 50 characters."
        send = false
    }

    if (startyear.value > endyear.value && endyear.value.length != 0) {
        error_exp.textContent = "Start year must not be higher than end year."
        send = false
    }

    if(error_exp.textContent.length == 0) {
        error_exp.style.display = "none";
    }
    else {
        error_exp.style.display = "inline";
    }
    if(send) return true
    else return false
}