const createAccountBtn = document.querySelector('.createAccount');
const inputFields = document.querySelectorAll('input');
const labelFields = document.querySelectorAll('label');
const errorLabel = document.getElementById('error-label');
const officeSelected = document.getElementById('office');

inputFields.forEach((input) => {
    if(window.error == 'required'){
        labelFields.forEach((label) => {
            if(label.id != 'mname'){
                label.style.color = '#B20404';
            }
        });

        if (input.value == '' && input.id != 'mname') {
            input.classList.add('rounded-input-error');
        }
        else{
            input.classList.remove('rounded-input-error');
        }

        if(officeSelected.value == ""){
            officeSelected.classList.add('rounded-input-error');
        }
        else{
            officeSelected.classList.remove('rounded-input-error');
        }
    }
    else if(window.error == 'password'){
        if (input.id == 'pass' || input.id == 'cpass') {
            input.classList.add('rounded-input-error');
        }
        else{
            input.classList.remove('rounded-input-error');
        }
    }
    else if(window.error == 'email'){
        if (input.id == 'email') {
            input.classList.add('rounded-input-error');
        }
        else{
            input.classList.remove('rounded-input-error');
        }
    }
});

labelFields.forEach((label) => {
    if(window.error == 'required'){
        if (label.id == 'fname') {
            label.style.color = '#B20404';
        }
    }
});

