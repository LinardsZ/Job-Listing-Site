//if server-side validation fails and redirects, hide empty error elements from view
document.addEventListener('DOMContentLoaded', (event) => {
    let error_edu = document.getElementById('error_edu')
    let eduform = document.getElementById('eduform')
    eduform.style.display = "none"
    error_edu.style.display = "none"
    // let eduform = document.getElementById('eduform')
    // if(error_exp.innerText.length == 0) error_exp.style.display = "none"
    // else {
    //     expform.style.display = "flex"
    //     error_exp.style.display = "inline"
    // }
});

function closeEduForm() {
    let eduform = document.getElementById('eduform')
    eduform.style.display = "none"

    let institution = document.getElementById('institution')
    let program = document.getElementById('program')
    let startyear = document.getElementById('startyear_edu')
    let endyear = document.getElementById('endyear_edu')
    position.value = ""
    workplace.value = ""
    startyear.value = ""
    endyear.value = ""
}


function showEduForm() {
    let eduform = document.getElementById('eduform')
    eduform.style.display = "flex"
}

function validateEduForm() {
    let institution = document.getElementById('institution')
    let program = document.getElementById('program')
    let error_edu = document.getElementById('error_edu')
    let send = true

    error_edu.textContent = ""

    if(institution.value.length == 0 || program.value.length == 0) {
        error_edu.textContent = "Text fields are required."
        send = false
    }
    if(institution.value.length > 50 || program.value.length > 50) {
        error_edu.textContent = "Text fields must not be greater than 50 characters."
        send = false
    }

    if(error_edu.textContent.length == 0) {
        error_edu.style.display = "none";
    }
    else {
        error_edu.style.display = "inline";
    }
    if(send) return true
    else return false
}
