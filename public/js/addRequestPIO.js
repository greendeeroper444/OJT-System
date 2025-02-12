
//  ----------- Check for Empty fields on Add request -----------  //

const requestSubmitBtn = document.querySelector('.requestSubmitBtn')
const activityInformationInputs = document.querySelectorAll('.activity-information-handler input')
const serviceRequestedInputs = document.querySelectorAll('.service-requested-handler input')
const preferredPlatformInputs = document.querySelectorAll('.platforms-requested-handler input')

requestSubmitBtn.onclick = (event) => {
    let noError = true
    let serviceChecked = false;
    let platformChecked = false;

    //Acivity Information
    activityInformationInputs.forEach((input) => {
        

        if(input.name == "activity-highlights"){
            return
        }
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


// ----------- Display image Generated -----------  //

// const imageInputBtn = document.querySelector('#customFile')
// const fileListPreview = document.querySelector('.file-list')
// imageInputBtn.addEventListener("change", handleFiles, false);

// console.log(fileListPreview);
// function handleFiles() {
//     const fileList = [...this.files];

//     console.log([...fileList]);
//     let html = ""
//     fileList.forEach(file => {
//         console.log(file['name']);
//         html = html + `
//         <div class='d-flex align-items-center mb-2'><button class='remove-file' style='display:none'>X</button>
//             <i class='bi bi-file-pdf-fill fs-4'style='margin-right:5px'></i>
//             <p style="margin:0">`+ file['name'] + `</p>
//         </div>
//         `
//         console.log(file);
//     });

//     fileListPreview.innerHTML = html
// }




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

    // DndFileUploadWidget.prototype.validate = function() {
    //   var filesContainer = this.getFilesContainer();
    //   var totalSize = 0;
    //   var fileUploadRows = filesContainer.children;
    //   if (fileUploadRows.length === 0) {
    //     this.getUploadButton().classList.add('hidden');
    //     this.getSizeErrorSpan().classList.add('hidden');
    //     return false;
    //   }

    //   for (var i = 0; i < fileUploadRows.length; i++) {
    //     var fileUploadRow = fileUploadRows[i];
    //     var file = fileUploadRow.file;
    //     totalSize += file.size;
    //   }

    //   if (totalSize <= this._maxAllowedTotalBytes) {
    //     this.getUploadButton().classList.remove('hidden');
    //     this.getSizeErrorSpan().classList.add('hidden');
    //     return true;
    //   } else {
    //     this.getUploadButton().classList.add('hidden');
    //     this.getSizeErrorSpan().classList.remove('hidden');
    //     this.getSizeErrorSpan().innerText = 'Total file size must not be greater than ' + humanReadableFileSize(this._maxAllowedTotalBytes) + '. Current: ' + humanReadableFileSize(totalSize);
    //     return false;
    //   }
    // };

    // DndFileUploadWidget.prototype.validateAndUpload = function() {
    //   if (!this.validate()) {
    //     return;
    //   }
    //   var formData = new FormData();
    //   var filesContainer = this.getFilesContainer();
    //   var fileUploadRows = filesContainer.children;
    //   for(var i = 0; i < fileUploadRows.length; i++) {
    //     var fileUploadRow = fileUploadRows[i];
    //     var file = fileUploadRow.file;
    //     formData.append('files[]', file, file.name);
    //   }

    //   var url = this._uploadUrl;
    //   var completeUrl = this._completeUrl;
    //   var xhr = new XMLHttpRequest();
    //   xhr.open("POST", url, true);
    //   var self = this;
    //   xhr.onload = function () {
    //     if (xhr.status === 200) {
    //       location.assign(completeUrl);
    //     } else {
    //       alert(xhr.statusText);
    //       self.exitLoadingState();
    //     }
    //   };

    //   xhr.onerror = function () {
    //     alert(xhr.statusText);
    //     self.exitLoadingState();
    //   };

    //   if (this._csrfHeaderName && this._csrfToken) {
    //     xhr.setRequestHeader(this._csrfHeaderName , this._csrfToken);
    //   }

    //   xhr.send(formData);
    //   this.enterLoadingState();
    // };


    // DndFileUploadWidget.prototype.enterLoadingState = function() {
    //   this.getUploadButton().classList.add('hidden');
    //   this.getUploadingButton().classList.remove('hidden');
    //   var removeButtons = this.getFilesContainer().querySelectorAll('button');
    //   for (var i = 0; i < removeButtons.length; i++) {
    //     removeButtons[i].disabled = true;
    //   }
    // };

    // DndFileUploadWidget.prototype.exitLoadingState = function() {
    //   this.getUploadButton().classList.remove('hidden');
    //   this.getUploadingButton().classList.add('hidden');
    //   var removeButtons = this.getFilesContainer().querySelectorAll('button');
    //   for (var i = 0; i < removeButtons.length; i++) {
    //     removeButtons[i].disabled = false;
    //   }
    // };

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

(function useDndFileUploadWidget() {
    var widgetDom = document.getElementById('theWidget');
    var uploadUrl = '';
    var completeUrl = '';
    var options = {
        maxAllowedTotalBytes: 50 * 1024 * 1024, // 50MiB
        csrfHeaderName: '',
        csrfToken: ''
    };

    new DndFileUploadWidget(widgetDom, uploadUrl, completeUrl, options);

})();

