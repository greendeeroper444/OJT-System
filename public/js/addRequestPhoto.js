
//  ----------- Check for Empty fields on Add request -----------  //

const requestSubmitBtn = document.querySelector('.requestSubmitBtn')
const activityInformationInputs = document.querySelectorAll('.activity-information-handler input')

requestSubmitBtn.onclick = (event) => {
    let noError = true


    //Acivity Information
    activityInformationInputs.forEach((input) => {
        if (input.value == '') {
            noError = false
            input.classList.add('rounded-input-error')
            input.closest('.form-group').querySelector('label').classList.add('name-activity-error')
            input.closest('.card').querySelector('div').style.backgroundColor = "#B20404";
        }
    });

    if (noError) {
        submitRequest(event);
    }
}

function submitRequest(event) {
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
            const button = event.target;
            if (button.tagName === 'BUTTON') {

                let timerInterval;
                Swal.fire({
                    title: "Processing your Request",
                    // html: "I will close in <b></b> milliseconds.",
                    timer: 5000,
                    timerProgressBar: false,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer");
                    }
                });
                button.closest('form').submit();
            }
        }
    });
}



