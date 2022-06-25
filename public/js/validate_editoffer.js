document.addEventListener('DOMContentLoaded', (event) => {
    const errors = []
    let error_position = document.getElementById('error-position')
    let error_category = document.getElementById('error-category')
    let error_workload = document.getElementById('error-workload')
    let error_location = document.getElementById('error-location')
    let error_salary = document.getElementById('error-salary')
    let error_extrainfo = document.getElementById('error-extra_info')

    errors.push(error_position, error_category, error_workload, error_location, error_salary, error_extrainfo)

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
    let error_position = document.getElementById('error-position')
    let error_category = document.getElementById('error-category')
    let error_workload = document.getElementById('error-workload')
    let error_location = document.getElementById('error-location')
    let error_salary = document.getElementById('error-salary')
    let error_extrainfo = document.getElementById('error-extra_info')

    errors.push(error_position, error_category, error_workload, error_location, error_salary, error_extrainfo)

    let position = document.getElementById('position')
    let category = document.getElementById('category')
    let workload = document.getElementById('workload')
    let location = document.getElementById('location')
    let salary = document.getElementById('salary')
    let extrainfo = document.getElementById('extra_info')
    let send = true

    error_position.textContent = ""
    error_category.textContent = ""
    error_workload.textContent = ""
    error_location.textContent = ""
    error_salary.textContent = ""
    error_extrainfo.textContent = ""

    
    let pattern = /^[a-zA-Z\u0080-\u00FF\u0100-\u017F\u0180-\u024F]+$/
    //position
    if(position.value.length > 40 && position.value.length != 0) {
        error_position.textContent = "The position must not be greater than 40 characters."
        send = false
    } 
    else if(!pattern.test(position.value) && position.value.length != 0) {
        error_position.textContent = "The position must only contain letters."
        send = false
    }
    //category
    if(category.value.length > 30 && category.value.length != 0) {
        error_category.textContent = "The category must not be greater than 30 characters."
        send = false
    } 
    else if(!pattern.test(category.value) && category.value.length != 0) {
        error_category.textContent = "The category must only contain letters."
        send = false
    }
    //workload
    if(workload.value.length > 30 && workload.value.length != 0) {
        error_workload.textContent = "The workload must not be greater than 30 characters."
        send = false
    } 
    else if(!pattern.test(workload.value) && workload.value.length != 0) {
        error_workload.textContent = "The workload must only contain letters."
        send = false
    }
    //salary
    if(salary.value <= 0 && salary.value.length != 0) {
        error_salary.textContent = "Salary can only be empty or a positive integer."
        send = false
    }
    // location field 
    let location_pattern = /^[a-zA-Z\u0080-\u00FF\u0100-\u017F\u0180-\u024F0-9\s]+$/
    let l = location.value.replace(/\s+/g, '');
    if (!location_pattern.test(l) && location.value.length != 0) {
        error_location.textContent = "The location must contain only letters and digits."
        send = false
    }
    else if (location.value.length > 40) {
        error_location.textContent = "The location must not be greater than 40 characters."
        send = false
    }
    //extra info
    if(extrainfo.value.length > 50) {
        error_extrainfo.textContent = "The extra information must not be greater than 50 characters."
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