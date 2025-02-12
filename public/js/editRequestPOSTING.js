
//  ----------- Transform Field to editable -----------  //

const formEditBtn = document.querySelector('#form-edit-btn') ?? null
const formSaveEdit = document.querySelector('#form-save-btn') ?? null


formEditBtn && formEditBtn.addEventListener('click', enableEdit);

function enableEdit() {
    const editable = document.querySelectorAll('.editable')
    const collectionHide = document.querySelectorAll('.collection-hide')
    const collectionInput = document.querySelectorAll('.collection-input')
    const removeFile = document.querySelectorAll('.remove-file')
    const contirbutionAttachement = document.querySelector('#customFile')
    const datePicker = document.querySelector('#activity-Duration-viewpage')

    editable.forEach(function (e) {

        if (e.contentEditable === 'true') {
            e.contentEditable = 'false';
            formEditBtn.textContent = 'Edit'
            formEditBtn.classList.remove("cancel-btn")
            formSaveEdit.style.display = "none"
            contirbutionAttachement.style.display = "none"

            collectionHide.forEach(function (coll) {

                coll.style.display = "block"
            })

            collectionInput.forEach(function (coll) {

                coll.style.display = "none"
            })

            removeFile.forEach(function (files) {

                files.style.display = "none"
            })

        } else {
            e.contentEditable = 'true';
            formSaveEdit.style.display = "block"
            formEditBtn.textContent = 'Cancel'
            formEditBtn.classList.add("cancel-btn")

            contirbutionAttachement.style.display = "block"
            collectionHide.forEach(function (coll) {
                coll.style.display = "none"
            })
            collectionInput.forEach(function (coll) {

                coll.style.display = "block"
            })

            removeFile.forEach(function (files) {
                files.style.display = "block"
            })
        }
    })


    // Usage:
    var initializeWidget = initializeDndFileUploadWidget('theWidget1');
    // Call the function only when needed
    initializeWidget();

}


//  ----------- Approve Request -----------  //
const approveBtn = document.querySelector('#form-approve-btn')

// console.log(approveBtn);
approveBtn && approveBtn.addEventListener('click', approveRequest);

function approveRequest() {
    Swal.fire({
        text: 'Do you want to approve this request?',
        icon: 'question',
        confirmButtonColor: '#084F08',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: true,
    }).then((result) => {
        if (result.isConfirmed) {
          

            Swal.fire({
                title: "Processing your Request",
                // html: "I will close in <b></b> milliseconds.",
                timer: 3000,
                timerProgressBar: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            this.closest('form').submit()
        }
    });
}

//  ----------- Cancel Request -----------  //
const canceleBtn = document.querySelector('#form-cancel-btn')
canceleBtn && canceleBtn.addEventListener('click', cancelRequest);
function cancelRequest() {
    Swal.fire({
        text: 'Do you want to Cancel this request?',
        icon: 'question',
        confirmButtonColor: '#084F08',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: true,
    }).then((result) => {
        if (result.isConfirmed) {
           

            Swal.fire({
                title: "Processing your Request",
                // html: "I will close in <b></b> milliseconds.",
                timer: 3000,
                timerProgressBar: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            this.closest('form').submit()
        }
    });
}

//  ----------- Accept Request Output-----------  //
const acceptBtn = document.querySelector('#form-accept-btn')
acceptBtn && acceptBtn.addEventListener('click', acceptRequest);
function acceptRequest() {
    Swal.fire({
        text: 'Do you want to Accept this Output?',
        icon: 'question',
        confirmButtonColor: '#084F08',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: true,
    }).then((result) => {
        if (result.isConfirmed) {
           

            Swal.fire({
                title: "Processing your Request",
                // html: "I will close in <b></b> milliseconds.",
                timer: 3000,
                timerProgressBar: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            this.closest('form').submit()
        }
    });
}

//  ----------- Accept Request Output-----------  //
const completeBtn = document.querySelector('#form-complete-btn')
completeBtn && completeBtn.addEventListener('click', completeRequest);
function completeRequest() {
    Swal.fire({
        text: 'Do you want to Complete this Request?',
        icon: 'question',
        confirmButtonColor: '#084F08',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: true,
    }).then((result) => {
        if (result.isConfirmed) {
          

            Swal.fire({
                title: "Processing your Request",
                // html: "I will close in <b></b> milliseconds.",
                timer: 3000,
                timerProgressBar: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            this.closest('form').submit()
        }
    });
}



//  ----------- Revise Request -----------  //
const reviseBtn = document.querySelector('#form-revise-btn')
reviseBtn && reviseBtn.addEventListener('click', reviseRequest);
function reviseRequest() {
    Swal.fire({
        html: `
        <div class="form-group">
            <label for="exampleFormControlTextarea1 p-2 ">Provide Information on the revision</label>
            <textarea class="form-control rounded-input" id="swal-detail" rows="5" name="additional-info"></textarea>
        </div>
        `,
        confirmButtonColor: '#084F08',
        focusConfirm: false,
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: true,
        preConfirm: () => {
            modalDetail = document.getElementById("swal-detail").value,
            document.getElementById("revisionDetails").value = modalDetail,
            Swal.fire({
                title: "Processing your Request",
                // html: "I will close in <b></b> milliseconds.",
                timer: 3000,
                timerProgressBar: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            return [
               
                this.closest('form').submit()
            ];
        }
    });
}

//  ----------- Revise -Output Request -----------  //
const reviseOutputBtn = document.querySelector('#revise-output-btn')
reviseOutputBtn && reviseOutputBtn.addEventListener('click', reviseOutput)
console.log('ss');
function reviseOutput() {
    console.log('ss');
    Swal.fire({
        title: "Add new output",
        html: `

            <div class="form-group">
                <label for="exampleFormControlTextarea1 p-2 " >Add output information or Google Drive Link</label>
                <textarea class="form-control rounded-input" id="swal-detail" rows="5" name="additional-info"></textarea>
            </div>

            <div id="customFile" class="custom-file">

                <div id="theWidget2" class="dnd-file-upload-widget">
                    <div class="form-group drop_zone">
                        <span>Drag files here to attach</span>
                        <span>or</span>
                        <label class="btn btn-outline-success pb-2">
                            Select files
                            <input id="swal-attachment" name="attachement[]" type="file" multiple="" />
                        </label>
                    </div>
                    <div class="files-container"></div>
                </div>
            </div>
            `,
        confirmButtonColor: "#0B790B",
        focusConfirm: false,
        preConfirm: () => {
            modalDetail = document.getElementById("swal-detail").value,
            modalAttachement = document.getElementById("swal-attachment").files,
            document.getElementById("outputAttachment").files = modalAttachement,
            document.getElementById("outputDetails").value = modalDetail,
            Swal.fire({
                title: "Processing your Request",
                // html: "I will close in <b></b> milliseconds.",
                timer: 3000,
                timerProgressBar: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            return [
              
                this.closest('form').submit()
            ];
        }
    });


    // Usage:
    var initializeWidget = initializeDndFileUploadWidget('theWidget2');

    // Call the function only when needed
    initializeWidget();


}


//  ----------- Submit Edited Request -----------  //
const requestEditSave = document.querySelector('#form-save-btn')
requestEditSave && requestEditSave.addEventListener('click', updateRequest)

function updateRequest() {
    var form = document.querySelector('#editForm');

    var input1 = document.querySelector('input[name="title-name"]');
    var input3 = document.querySelector('textarea[name="additional-info"]');
    var input4 = document.querySelector('input[name="attachement[]"]');

    var input2 = document.querySelectorAll('input[name="platforms[]"]:checked');
    var input5 = document.querySelector('input[name="link"]');
    var valuesPlatforms = [];

    input2.forEach(function (checkbox) {
        valuesPlatforms.push(checkbox.value);
    });

    form.appendChild(input1.cloneNode(true));
    form.appendChild(input5.cloneNode(true));
    form.appendChild(input3.cloneNode(true));
    form.appendChild(input4.cloneNode(true));

    var platformInput = document.createElement('input');
    platformInput.type = 'hidden';
    platformInput.name = 'platforms[]';
    platformInput.value = JSON.stringify(valuesPlatforms);
    form.appendChild(platformInput);

    // Submit the form
   

    Swal.fire({
        title: "Processing your Request",
        // html: "I will close in <b></b> milliseconds.",
        timer: 3000,
        timerProgressBar: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });
    form.submit();
}

// function createFormAndSubmit() {

// }
// requestOutput.onclick = async (event) => {
//     Swal.fire({
//         title: "Request Output?",
//         text: "",
//         icon: "question",
//         showCancelButton: true,
//         confirmButtonColor: "#0B790B",
//         cancelButtonColor: "#B20404",
//         confirmButtonText: "Yes, request output"
//     }).then((result) => {
//         if (result.isConfirmed) {
//             Swal.fire({
//                 title: "Output Requested",
//                 text: "You have requested output.",
//                 icon: "success",
//                 confirmButtonColor: "#0B790B"
//             });
//         }
//     });
// }


//  ----------- For file attachement -----------  //


function initializeDndFileUploadWidget(widgetID) {
    var DndFileUploadWidget = (function defineDndFileUploadWidget() {

        /* public static fields */
        DndFileUploadWidget.DEFAULT_MAX_ALLOWED_TOTAL_BYTES = 10 * 1024 * 1024;

        function DndFileUploadWidget(widgetDom, uploadUrl, completeUrl, options) {
            this._widgetDom = widgetDom;
            this._uploadUrl = uploadUrl;
            this._completeUrl = completeUrl;
            this._csrfHeaderName = options && options.csrfHeaderName;
            this._csrfToken = options && options.csrfToken;
            this._maxAllowedTotalBytes = (options && options.maxAllowedTotalBytes) || DndFileUploadWidget.DEFAULT_MAX_ALLOWED_TOTAL_BYTES;

            var dropZone = this._dropZone = widgetDom.querySelector('.drop_zone');

            dropZone.addEventListener('drop', bind(this.drop_handler, this));
            dropZone.addEventListener('dragover', bind(this.dragover_handler, this));
            dropZone.addEventListener('dragleave', bind(this.dragleave_handler, this));
            dropZone.addEventListener('dragend', bind(this.dragend_handler, this));

            var labelInDropZone = dropZone.querySelector('label');
            labelInDropZone.addEventListener('drop', bind(this.drop_handler, this));
            labelInDropZone.addEventListener('dragover', bind(this.dragover_handler, this));
            labelInDropZone.addEventListener('dragleave', bind(this.dragleave_handler, this));
            labelInDropZone.addEventListener('dragend', bind(this.dragend_handler, this));

            var fileInputInDropZone = dropZone.querySelector('input[type="file"]');
            fileInputInDropZone.addEventListener('change', bind(this.fileSelected_handler, this));

            // this.getUploadButton().addEventListener('click', bind(this.validateAndUpload, this));
        }

        /**
         * Public methods
         */
        DndFileUploadWidget.prototype.drop_handler = function (ev) {
            console.log("drop");
            this._dropZone.classList.remove('dragover');
            ev.preventDefault();
            // If dropped items aren't files, reject them
            var dt = ev.dataTransfer;
            if (dt.items) {
                // Use DataTransferItemList interface to access the file(s)
                for (var i = 0; i < dt.items.length; i++) {
                    if (dt.items[i].kind === "file") {
                        var f = dt.items[i].getAsFile();
                        this.addFileUploadRow(f);
                    }
                }
            } else {
                // Use DataTransfer interface to access the file(s)
                for (var i = 0; i < dt.files.length; i++) {
                    var f = dt.files[i];
                    this.addFileUploadRow(f);
                }
            }
            this.validate();
        };

        // Turn off the browser's default drag and drop handler.
        DndFileUploadWidget.prototype.dragover_handler = function (ev) {
            console.log("dragover");
            // Prevent default select and drag behavior
            ev.preventDefault();
            this._dropZone.classList.add('dragover');
        };

        DndFileUploadWidget.prototype.dragleave_handler = function (ev) {
            console.log("dragleave");
            this._dropZone.classList.remove('dragover');
        };

        // Fired when the drag operation ends (signaling the drop has occurred or the drag has been canceled).
        DndFileUploadWidget.prototype.dragend_handler = function (ev) {
            console.log("dragend");
            this._dropZone.classList.remove('dragover');
            // Remove all of the drag data
            var dt = ev.dataTransfer;
            if (dt.items) {
                // Use DataTransferItemList interface to remove the drag data
                for (var i = 0; i < dt.items.length; i++) {
                    dt.items.remove(i);
                }
            } else {
                // Use DataTransfer interface to remove the drag data
                ev.dataTransfer.clearData();
            }
        };

        DndFileUploadWidget.prototype.addFileUploadRow = function (file) {
            var filesContainer = this.getFilesContainer();
            var filename = file.name;
            var fileSize = file.size;
            var domString = '<div class="row form-group"> <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"> <div class="text-left" style="line-height:32px">' + filename + '</div> </div> <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"> <div style="line-height:32px">' + humanReadableFileSize(fileSize) + '</div> </div> <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right"> <button class="btn btn-danger dnd-file-upload-widget-remove-file-button"> Remove </button> </div> </div>'
            var parser = new DOMParser();
            var html = parser.parseFromString(domString, 'text/html');
            var fileUploadRow = html.body.firstChild;
            fileUploadRow.querySelector('button.dnd-file-upload-widget-remove-file-button')
                .addEventListener('click', bind(this.removeFileUploadRow, this));
            filesContainer.appendChild(fileUploadRow);
            fileUploadRow.file = file;
        };

        DndFileUploadWidget.prototype.removeFileUploadRow = function (ev) {
            var row = ev.target.parentNode.parentNode;
            row.parentNode.removeChild(row);

        };

        DndFileUploadWidget.prototype.fileSelected_handler = function (event) {
            var fileList = event.target.files;
            for (var i = 0; i < fileList.length; i++) {
                var file = fileList[i];
                this.addFileUploadRow(file);
            }

        };


        DndFileUploadWidget.prototype.queryWithinWidget = function (selectors) {
            return this._widgetDom.querySelector(selectors);
        };

        DndFileUploadWidget.prototype.getUploadButton = function () {
            return this.queryWithinWidget('.dnd-file-upload-widget-upload-button');
        };

        DndFileUploadWidget.prototype.getUploadingButton = function () {
            return this.queryWithinWidget('.dnd-file-upload-widget-uploading-button');
        };

        DndFileUploadWidget.prototype.getSizeErrorSpan = function () {
            return this.queryWithinWidget('.dnd-file-upload-widget-size-error');
        };

        DndFileUploadWidget.prototype.getFilesContainer = function () {
            return this.queryWithinWidget('.files-container');
        };

        function humanReadableFileSize(b) {
            var u = 0, s = 1024;
            while (b >= s || -b >= s) {
                b /= s;
                u++;
            }
            return (u ? b.toFixed(1) + ' ' : b) + ' KMGTPEZY'[u] + 'iB';
        }

        function bind(func, scope) {
            return function () {
                func.apply(scope, arguments);
            }
        }

        return DndFileUploadWidget;
    })();

    return function useDndFileUploadWidget() {
        var widgetDom = document.getElementById(widgetID);
        var uploadUrl = '';
        var completeUrl = '';
        var options = {
            maxAllowedTotalBytes: 50 * 1024 * 1024,
            csrfHeaderName: '',
            csrfToken: ''
        };

        new DndFileUploadWidget(widgetDom, uploadUrl, completeUrl, options);
    };
}

