//Form Validation

const requestSubmitBtn = document.querySelector('.requestSubmitBtn')
const activityInformationInputs = document.querySelectorAll('.activity-information-handler input')
const serviceRequestedInputs = document.querySelectorAll('.service-requested-handler input')
const preferredPlatformInputs = document.querySelectorAll('.platforms-requested-handler input')

requestSubmitBtn.onclick = (event) => {
    Swal.fire({
        title: "Send Request?",
        text: "You can also edit it later.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#0B790B",
        cancelButtonColor: "#B20404",
        confirmButtonText: "Yes, send request"
    }).then((result) => {
        if (result.isConfirmed) {
            submitRequest(event);
        }
    });
}
 

function submitRequest(event) {
    let noError = true
    let serviceChecked = false;
    let platformChecked = false;

    //Acivity Information
    activityInformationInputs.forEach((input) => {
        if (input.value == '') {
            noError = false
            input.classList.add('rounded-input-error')
            input.closest('.form-group').querySelector('label').classList.add('name-activity-error')
            input.closest('.card').querySelector('div').style.backgroundColor = "#B20404";
        }
    });

    //Service Requested
    serviceRequestedInputs.forEach(input => {
        if (input.checked) {
            serviceChecked = true;
            return;
        }
    });

    if (!serviceChecked) {
        noError = false
        serviceRequestedInputs.forEach(input => {
            input.closest('.card').querySelector('div').style.backgroundColor = "#B20404";
            input.closest('.card-body').querySelector('label').style.display = 'block'
            input.closest('.card-body').querySelector('label').classList.add('name-activity-error')
        });

    }

    //Preferred Platforms
    preferredPlatformInputs.forEach(input => {
        if (input.checked) {
            platformChecked = true;
            return;
        }
    });

    if (!platformChecked) {
        noError = false
        preferredPlatformInputs.forEach(input => {
            input.closest('.card').querySelector('div').style.backgroundColor = "#B20404";
            input.closest('.card-body').querySelector('label').style.display = 'block'
            input.closest('.card-body').querySelector('label').classList.add('name-activity-error')
        });

    }

    if (noError) {
        const button = event.target;
        if (button.tagName === 'BUTTON') {
            button.closest('form').submit();
        }
    }
}

