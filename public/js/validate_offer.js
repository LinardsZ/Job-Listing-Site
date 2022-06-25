function showOfferForm() {
    let form = document.getElementById('joboffer')
    form.style.display = "flex"

    let error_g = document.getElementById('error-general')
    let error_p = document.getElementById('error-position')
    let error_c = document.getElementById('error-category')
    let error_l = document.getElementById('error-location')
    let error_w = document.getElementById('error-workload')
    let error_ei = document.getElementById('error-extra_info')

    const errors = []
    errors.push(error_p, error_c, error_l, error_w, error_ei, error_g)

    for(let i = 0; i < errors.length; ++i) {
        errors[i].style.display = "none"
    }
}

function closeOfferForm() {
    let form = document.getElementById('joboffer')
    form.style.display = "none"
}

function validateOffer() {
    let error_g = document.getElementById('error-general')
    let error_p = document.getElementById('error-position')
    let error_c = document.getElementById('error-category')
    let error_l = document.getElementById('error-location')
    let error_w = document.getElementById('error-workload')
    let error_ei = document.getElementById('error-extra_info')

    const errors = []
    errors.push(error_p, error_c, error_l, error_w, error_ei, error_g)

    for(let i = 0; i < errors.length; ++i) {
        errors[i].textContent = ""
    }

    let position = document.getElementById('position')
    let category = document.getElementById('category')
    let location = document.getElementById('location')
    let workload = document.getElementById('workload')
    let extrainfo = document.getElementById('extra_info')
    let send = true
    
    if (position.value.length == 0 || category.value.length == 0 || location.value.length == 0 || workload.value.length == 0 || extrainfo.value.length == 0) {
        error_g.textContent = "Text fields are required."
        send = false
    }

    if (position.value.length > 40) {
        error_p.textContent = "The position must not be greater than 40 characters."
        send = false
    }

    if (workload.value.length > 30) {
        error_w.textContent = "The workload must not be greater than 30 characters."
        send = false
    }

    let location_pattern = /^[a-zA-Z\u0080-\u00FF\u0100-\u017F\u0180-\u024F0-9\s]+$/
    if (location.value.length > 40) {
        error_l.textContent = "The location must not be greater than 40 characters."
        send = false
    }
    if (!location_pattern.test(location.value)) {
        error_l.textContent = "The location must contain only letters and digits."
        send = false
    }

    if (extrainfo.value.length > 50) {
        error_ei.textContent = "The extra info must not be greater than 50 characters."
        send = false
    }  

    for (let i = 0; i < errors.length; ++i) {
        if (errors[i].textContent.length != 0) errors[i].style.display = "inline"
        else errors[i].style.display = "none"
    }

    if(send) return true
    else return false
}
