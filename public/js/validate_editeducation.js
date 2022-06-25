document.addEventListener('DOMContentLoaded', (event) => {
    const errors = []
    let error_institution = document.getElementById('error-institution')
    let error_program = document.getElementById('error-program')
    let error_year = document.getElementById('error-year')

    errors.push(error_institution, error_program, error_year)

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
    let error_institution = document.getElementById('error-institution')
    let error_program = document.getElementById('error-program')
    let error_year = document.getElementById('error-year')

    errors.push(error_institution, error_program, error_year)

    let institution = document.getElementById('institution')
    let program = document.getElementById('program')
    let startyear = document.getElementById('startyear')
    let endyear = document.getElementById('endyear')
    let send = true

    error_institution.textContent = ""
    error_program.textContent = ""
    error_year.textContent = ""

    let pattern = /^[0-9a-zA-Z\u0080-\u00FF\u0100-\u017F\u0180-\u024F\s]+$/
    if(institution.value.length > 50) {
        error_institution.textContent = "The institution must not be greater than 50 characters."
        send = false
    } 
    else if(!pattern.test(institution.value) && institution.value.length != 0) {
        error_institution.textContent = "The institution must only contain letters."
        send = false
    }


    if(program.value.length > 50) {
        error_program.textContent = "The program must not be greater than 50 characters."
        send = false
    } 
    else if(!pattern.test(program.value) && program.value.length != 0) {
        error_program.textContent = "The program must only contain letters."
        send = false
    }

    if (startyear.value > endyear.value && endyear.value.length != 0) {
        error_year.textContent = "Start year must not be higher than end year."
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