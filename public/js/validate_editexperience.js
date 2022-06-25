document.addEventListener('DOMContentLoaded', (event) => {
    const errors = []
    let error_workplace = document.getElementById('error-workplace')
    let error_position = document.getElementById('error-position')
    let error_year = document.getElementById('error-year')

    errors.push(error_workplace, error_position, error_year)

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
    let error_workplace = document.getElementById('error-workplace')
    let error_position = document.getElementById('error-position')
    let error_year = document.getElementById('error-year')

    errors.push(error_workplace, error_position, error_year)

    let workplace = document.getElementById('workplace')
    let position = document.getElementById('position')
    let startyear = document.getElementById('startyear')
    let endyear = document.getElementById('endyear')
    let send = true

    error_workplace.textContent = ""
    error_position.textContent = ""
    error_year.textContent = ""

    let pattern = /^[a-zA-Z\u0080-\u00FF\u0100-\u017F\u0180-\u024F\s]+$/
    if(workplace.value.length > 50) {
        error_workplace.textContent = "The workplace must not be greater than 50 characters."
        send = false
    } 
    else if(!pattern.test(workplace.value) && workplace.value.length != 0) {
        error_workplace.textContent = "The workplace must only contain letters."
        send = false
    }


    if(position.value.length > 50) {
        error_position.textContent = "The position must not be greater than 50 characters."
        send = false
    } 
    else if(!pattern.test(position.value) && position.value.length != 0) {
        error_position.textContent = "The position must only contain letters."
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