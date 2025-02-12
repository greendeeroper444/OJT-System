const formEditBtn = document.querySelector('#form-edit-btn')
const formSaveEdit = document.querySelector('#form-save-btn')


formEditBtn.addEventListener('click', function () {
    const editable = document.querySelectorAll('.editable')
    const collectionHide = document.querySelectorAll('.collection-hide')
    const collectionInput = document.querySelectorAll('.collection-input')
    const removeFile = document.querySelectorAll('.remove-file')
    editable.forEach(function (e) {

        if (e.contentEditable === 'true') {
            e.contentEditable = 'false';
            formEditBtn.textContent = 'Edit'
            formSaveEdit.style.display = "none"

            collectionHide.forEach(function (coll) {
                console.log(collectionHide);
                coll.style.display = "block"
            })

            collectionInput.forEach(function (coll) {
                console.log(collectionHide);
                coll.style.display = "none"
            })

            removeFile.forEach(function (files) {
                console.log(collectionHide);
                files.style.display = "none"
            })



        } else {
            e.contentEditable = 'true';
            formSaveEdit.style.display = "block"
            formEditBtn.textContent = 'Cancel'
            collectionHide.forEach(function (coll) {
                console.log(collectionHide);
                coll.style.display = "none"
            })
            collectionInput.forEach(function (coll) {
                console.log(collectionHide);
                coll.style.display = "block"
            })

            removeFile.forEach(function (files) {
                console.log(collectionHide);
                files.style.display = "block"
            })
        }
    })

})
