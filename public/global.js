// For Searchbar Function
const searchbarFilter = document.querySelector('#search-bar') ? document.querySelector('#search-bar') : null;

function searchBarInstance() {
    searchbarFilter.addEventListener('input', function (e) {

        const activeTabElement = document.querySelector(".nav-tabs .nav-item .active");

        let activeTable;
        if (activeTabElement) {
        activeTable = activeTabElement.getAttribute('data-tablenum')
        } else {
        activeTable = 'pending';
        }
        const pageURL = document.querySelector('#page-url').value
        const activeTableType = (activeTable == 'table1') ? 'pio' : (activeTable == 'table2') ? 'posting' : (activeTable == 'table3') ? 'photo' : (activeTable == 'reports') ? 'reports' : (activeTable == 'user') ? 'user' : 'pending'
        const pageURLview = document.querySelector('#page-view-url').value
        const dateRange = (document.querySelector('#dateRangePicker'))?document.querySelector('#dateRangePicker').value:null
        const requestType = (document.querySelector('#requestDropDown'))?document.querySelector('#requestDropDown').value:null
        const numRow = document.querySelector('#number-rows' + activeTableType)
        const hiddenFieldPage = document.querySelector('#pageNumber' + activeTableType)

        let data
        const tableBody = document.querySelector('#table-request-body-' + activeTable)
        tableBody.innerHTML = '';


        if (e.target.value == "") {
            data = {
                'searchWord': e.target.value,
                'dateRange': dateRange,
                'requestType': requestType,
                'numbeRows': numRow.value,
                'pageNumber': hiddenFieldPage.value,
                'tableType':activeTableType
            }
            document.querySelector('.pagination').style.display = "flex";
        } else {
            data = {
                'searchWord': e.target.value,
                'dateRange': dateRange,
                'requestType': requestType,
                'numbeRows': 5,
                'pageNumber': 1,
                'tableType':activeTableType
            }
            document.querySelector('.pagination').style.display = "none";
        }


        axios({
            method: 'post',
            url: pageURL,
            data: data
        }).then(response => {
            var responseData = response.data.request;
       
            console.log(responseData);
            if (responseData.length == 0) {
                let row = document.createElement('tr');
                row.classList.add('text-center');
                row.innerHTML = '<td class="align-middle text-center my-5" colspan="5">No Request Found</td>';
                tableBody.appendChild(row);
            } else {
         
                if (response.data.searchedData.tableType == "posting") {

                    responseData.forEach(function (data) {
                        console.log(data.request);
                        let statusCss = (data.t_status == 1 ? 'text-bg-primary' : (data.t_status == 2 ? 'text-bg-success' : (data.t_status == 3 ? 'text-bg-warning' : 'text-bg-danger')));
                        let statusText = (data.t_status == 1 ? 'Complete' : (data.t_status == 2 ? 'Approved' : (data.t_status == 3 ? 'Pending' : 'Declined'))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                        let statusRemarks = (data.t_output_status == 'No Output' ? 'text-bg-danger' : (data.t_output_status == 'For Admin Approval' ? 'text-bg-warning' : (data.t_output_status == 'Output for review' ? 'text-bg-warning' : (data.t_output_status == 'Output for revision' ? 'text-bg-warning' : (data.t_output_status == 'Request Has been Declined' ? 'text-bg-danger' : (data.t_output_status == 'Request Completed' ? 'text-bg-primary' : 'text-bg-danger'))))));

                        
                     
                        let row = document.createElement('tr');
                        row.classList.add('text-center');
                        row.innerHTML =
                            '<td class="align-middle ">' + data.user_fn + " " + data.user_ln + '</td>' +
                            '<td class="align-middle text-start text-truncate" style="max-width: 100px;">' + data.r_title + '</td>' +
            
                            '<td class="align-middle text-start">' + data.r_content + '</td>' +
                            '<td class="align-middle ">' + data.t_dateRequested + '</td>' +
                            ' <td class="align-middle"> ' +
                            '     <p class=" "> ' +
                             '    <span style="color:white !important;" class="badge rounded-pill ' + statusCss + ' ">' +statusText  + '</span> ' +
                             '    </p> ' +
                            ' </td> ' +
                            ' <td class="align-middle"> ' +
                            '     <p class="text-center"> ' +
                            '     <span style="color:white !important;" class="badge rounded-pill ' +statusRemarks + ' ">' +data.t_output_status+ '</span> ' +
                            '     </p> ' +
                            ' </td> ' +
                            
                            '<td>' +
                            '<a href="' + pageURLview + 'id=' + data.r_id + '&type=' + response.data.searchedData.tableType + '" ' +
                            '<div class="d-flex justify-content-center">' +
                            '<button type="button" class="btn btn-outline-success action">View</button>' +
                            '</div>' +
                            '</a>' +
                            '</td>';

                        tableBody.appendChild(row);
                    });


                } else if(response.data.searchedData.tableType == "pio"){
                    responseData.forEach(function (data) {
                        let statusCss = (data.t_status == 1 ? 'text-bg-primary' : (data.t_status == 2 ? 'text-bg-success' : (data.t_status == 3 ? 'text-bg-warning' : 'text-bg-danger')));
                        let statusText = (data.t_status == 1 ? 'Complete' : (data.t_status == 2 ? 'Approved' : (data.t_status == 3 ? 'Pending' : 'Declined'))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                        let statusRemarks = (data.t_output_status == 'No Output' ? 'text-bg-danger' : 
                            (data.t_output_status == 'For Admin Approval' ? 'text-bg-warning' : 
                            (data.t_output_status == 'Output for review' ? 'text-bg-warning' : 
                            (data.t_output_status == 'Output for revision' ? 'text-bg-warning' : 
                            (data.t_output_status == 'Request Has been Declined' ? 'text-bg-danger' :
                            (data.t_output_status == 'Request Completed' ? 'text-bg-primary' : 
                            (data.t_output_status == 'Forced Completed' ? 'text-bg-primary' : 'text-bg-danger')))))));

                     
                        let row = document.createElement('tr');
                        row.classList.add('text-center');
                        row.innerHTML =
                            '<td class="align-middle ">' + data.r_request_code + '</td>' +
                            '<td class="align-middle ">' + data.user_fn + " " + data.user_ln + '</td>' +
                            '<td class="align-middle text-start text-truncate" style="max-width: 100px;">' + data.r_activityname + '</td>' +
                            '<td class="align-middle">' + data.r_duration +'</td>' +
                            '<td class="align-middle ">' + data.t_dateRequested + '</td>' +
                            ' <td class="align-middle"> ' +
                            '     <p class=" "> ' +
                             '    <span style="color:white !important;" class="badge rounded-pill ' + statusCss + ' ">' +statusText  + '</span> ' +
                             '    </p> ' +
                            ' </td> ' +
                            ' <td class="align-middle"> ' +
                            '     <p class="text-center"> ' +
                            '     <span style="color:white !important;" class="badge rounded-pill ' +statusRemarks + ' ">' +data.t_output_status+ '</span> ' +
                            '     </p> ' +
                            ' </td> ' +
                            '<td>' +
                            '<a href="' + pageURLview + 'id=' + data.r_id + '&type=' + response.data.searchedData.tableType + '" ' +
                            '<div class="d-flex justify-content-center">' +
                            '<button type="button" class="btn btn-outline-success action">View</button>' +
                            '</div>' +
                            '</a>' +
                            '</td>';

                        tableBody.appendChild(row);
                    });
                }else if(response.data.searchedData.tableType == "photo"){
                    responseData.forEach(function (data) {
                        let statusCss = (data.t_status == 1 ? 'text-bg-primary' : (data.t_status == 2 ? 'text-bg-success' : (data.t_status == 3 ? 'text-bg-warning' : 'text-bg-danger')));
                        let statusText = (data.t_status == 1 ? 'Complete' : (data.t_status == 2 ? 'Approved' : (data.t_status == 3 ? 'Pending' : 'Declined'))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                let statusRemarks = (data.t_output_status == 'No Output' ? 'text-bg-danger' : (data.t_output_status == 'For Admin Approval' ? 'text-bg-warning' : (data.t_output_status == 'Output for review' ? 'text-bg-warning' : (data.t_output_status == 'Output for revision' ? 'text-bg-warning' : (data.t_output_status == 'Request Has been Declined' ? 'text-bg-danger' : (data.t_output_status == 'Request Completed' ? 'text-bg-primary' : 'text-bg-danger'))))));

                     
                     
                        let row = document.createElement('tr');
                        row.classList.add('text-center');
                        row.innerHTML =
                        '<td class="align-middle ">' + data.user_fn + " " + data.user_ln + '</td>' +
                            '<td class="align-middle text-start text-truncate" style="max-width: 100px;">' + data.r_activityname + '</td>' +
                            '<td class="align-middle">' + data.r_durationStart + '</td>' +
                            '<td class="align-middle">' + data.r_durationEnd + '</td>' +
                            ' <td class="align-middle"> ' +
                            '     <p class=" "> ' +
                             '    <span style="color:white !important;" class="badge rounded-pill ' + statusCss + ' ">' +statusText  + '</span> ' +
                             '    </p> ' +
                            ' </td> ' +
                            ' <td class="align-middle"> ' +
                            '     <p class="text-center"> ' +
                            '     <span style="color:white !important;" class="badge rounded-pill ' +statusRemarks + ' ">' +data.t_output_status+ '</span> ' +
                            '     </p> ' +
                            ' </td> ' +
                            '<td>' +
                            '<a href="' + pageURLview + 'id=' + data.r_id + '&type=' + response.data.searchedData.tableType + '" ' +
                            '<div class="d-flex justify-content-center">' +
                            '<button type="button" class="btn btn-outline-success action">View</button>' +
                            '</div>' +
                            '</a>' +
                            '</td>';

                        tableBody.appendChild(row);
                    });
                }else if(response.data.searchedData.tableType == "reports"){
                    console.log(data);
                    responseData.forEach(function (data) {
                        let statusText = (data.t_status == 1 ? 'Complete' : (data.t_status == 2 ? 'Approved' : (data.t_status == 3 ? 'Pending' : 'Declined'))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                        let statusCss = (data.t_status == 1 ? 'text-bg-primary' : (data.t_status == 2 ? 'text-bg-success' : (data.t_status == 3 ? 'text-bg-warning' : 'text-bg-danger')));
                          
                        let row = document.createElement('tr');
                        row.classList.add('text-center');
                        row.innerHTML =
                    
                            '<td class="align-middle text-truncate" style="max-width: 100px;">' + data.r_activityname + '</td>' +
                            '<td class="align-middle ">' + data.user_fn + " " + data.user_ln + '</td>' +
                            '<td class="align-middle">' + data.t_dateRequested + '</td>' +
                            '<td class="align-middle">' + data.t_datecompleted + '</td>' +  
                           
                           ' <td class="align-middle"> ' +
                           '     <p class=" "> ' +
                           '     <span style="color:white !important; " class="badge rounded-pill ' + statusCss + ' ">' + statusText  + '</span> ' +
                           '     </p> ' +
                           ' </td>' +
                            '<td>' +
                            '<a href="' + pageURLview + 'id=' + data.r_id + '&type=' + response.data.searchedData.tableType + '" ' +
                            '<div class="d-flex justify-content-center">' +
                            '<button type="button" class="btn btn-outline-success action">View</button>' +
                            '</div>' +
                            '</a>' +
                            '</td>';

                        tableBody.appendChild(row);
                    });
                }else if(response.data.searchedData.tableType == "pending"){
                    console.log(data);
                    responseData.forEach(function (data) {
                        let statusText = (data.t_status == 1 ? 'Complete' : (data.t_status == 2 ? 'Approved' : (data.t_status == 3 ? 'Pending' : 'Declined'))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                        let statusCss = (data.t_status == 1 ? 'text-bg-primary' : (data.t_status == 2 ? 'text-bg-success' : (data.t_status == 3 ? 'text-bg-warning' : 'text-bg-danger')));
                        let statusRemarks = (data.t_output_status == 'No Output' ? 'text-bg-danger' : (data.t_output_status == 'For Admin Approval' ? 'text-bg-warning' : (data.t_output_status == 'Output for review' ? 'text-bg-warning' : (data.t_output_status == 'Output for revision' ? 'text-bg-warning' : (data.t_output_status == 'Request Has been Declined' ? 'text-bg-danger' : (data.t_output_status == 'Request Completed' ? 'text-bg-primary' : 'text-bg-danger'))))));

                        let requestType = "";

                        if (request.t_r_type === "PHOTO") {
                            requestType = "Request for Copies of Photo";
                        } else if (request.t_r_type === "POSTING") {
                            requestType = "Posting Approval";
                        } else {
                            requestType = "PIO Service Request";
                        }
                     
                        let row = document.createElement('tr');
                        row.classList.add('text-center');
                        row.innerHTML =
                    
                            '<td class="align-middle ">' + requestType + '</td>' +
                            '<td class="align-middle ">' + data.user_fn + " " + data.user_ln + '</td>' +
                        
                            '<td class="align-middle">' + data.t_dateRequested + '</td>' +
                           
                           ' <td class="align-middle"> ' +
                           '     <p class=" "> ' +
                           '     <span style="color:white !important; " class="badge rounded-pill ' + statusCss + ' ">' + statusText  + '</span> ' +
                           '     </p> ' +
                           ' </td>' +
                           ' <td class="align-middle"> ' +
                           '     <p class="text-center"> ' +
                           '     <span style="color:white !important;" class="badge rounded-pill ' +statusRemarks + ' ">' +data.t_output_status+ '</span> ' +
                           '     </p> ' +
                           ' </td> ' +
                            '<td>' +
                            '<a href="' + pageURLview + 'id=' + data.r_id + '&type=' + response.data.searchedData.tableType + '" ' +
                            '<div class="d-flex justify-content-center">' +
                            '<button type="button" class="btn btn-outline-success action">View</button>' +
                            '</div>' +
                            '</a>' +
                            '</td>';

                        tableBody.appendChild(row);
                    });
                }else if(response.data.searchedData.tableType == "user"){
           
                    responseData.forEach(function (data) {
                        let statusText = (data.user_status == 1 ? 'Approved' : (data.user_status == 2 ? 'Pending' : 'Decline'))
                        let statusCss = (data.user_status == 1 ? 'text-bg-primary' : (data.user_status == 2 ? 'text-bg-sucess' : 'text-bg-warning'))
                        let statusRemarks = (data.t_output_status == 'No Output' ? 'text-bg-danger' : (data.t_output_status == 'For Admin Approval' ? 'text-bg-warning' : (data.t_output_status == 'Output for review' ? 'text-bg-warning' : (data.t_output_status == 'Output for revision' ? 'text-bg-warning' : (data.t_output_status == 'Request Has been Declined' ? 'text-bg-danger' : (data.t_output_status == 'Request Completed' ? 'text-bg-primary' : 'text-bg-danger'))))));

                        let userType = "";

                        if (data.user_type === 2) {
                            userType = "Requestor";
                        } else if(data.user_type === 1) {
                            userType = "Admin";
                        } 
                   
                     
                        let row = document.createElement('tr');
                        row.classList.add('text-center');
                        row.innerHTML =
                    
        
                            '<td class="align-middle ">' + data.user_fn + " " + data.user_ln + '</td>' +
                        
                            '<td class="align-middle">' + userType + '</td>' +
                            '<td class="align-middle">' + data.user_office + '</td>' +
                            '<td class="align-middle">' + data.user_date_created + '</td>' +
                           ' <td class="align-middle"> ' +
                           '     <p class=" "> ' +
                           '     <span style="color:white !important; " class="badge rounded-pill ' + statusCss + ' ">' + statusText  + '</span> ' +
                           '     </p> ' +
                           ' </td>' +                    
                            '<td>' +
                            '<a href="' + pageURLview + 'id=' + data.user_id + '&type=' + data.user_type + '" ' +
                            '<div class="d-flex justify-content-center">' +
                            '<button type="button" class="btn btn-outline-success action">View</button>' +
                            '</div>' +
                            '</a>' +
                            '</td>';

                        tableBody.appendChild(row);
                    });
                }
                
            }
           

        }).catch(error => {
            console.error(error)
        })

    })
}
(searchbarFilter !== null) ? searchBarInstance() : '';

// ---------------------------------------------------------------------------------------

//For Row per Page function
const rowNumberFilterPENIDNG = document.querySelector('#filterButton') ? document.querySelector('#number-rowspending') : null;
function rowPerPageInstancePENDING() {
    rowNumberFilterPENIDNG.addEventListener('change', function (e) {
        const form = document.querySelector('#filterForm')
        form.submit()

    })
}

const rowNumberFilterUSER = document.querySelector('#filterForm') ? document.querySelector('#number-rowsuser') : null;

function rowPerPageInstanceUSER() {

    rowNumberFilterUSER.addEventListener('change', function (e) {
        const form = document.querySelector('#filterForm')
        form.submit()

    })
}

const rowNumberFilterREPORTS = document.querySelector('#filterButton') ? document.querySelector('#number-rowsREPORTS') : null;
function rowPerPageInstanceREPORTS() {
    rowNumberFilterREPORTS.addEventListener('change', function (e) {
        const form = document.querySelector('#filterForm')
        form.submit()

    })
}

const rowNumberFilterPIO = document.querySelector('#filterButton') ? document.querySelector('#number-rowspio') : null;
function rowPerPageInstancePIO() {
    rowNumberFilterPIO.addEventListener('change', function (e) {
        const form = document.querySelector('#filterForm')
        form.submit()

    })
}
const rowNumberFilterPHOTO = document.querySelector('#filterButton') ? document.querySelector('#number-rowsphoto') : null;
function rowPerPageInstancePHOTO() {
    rowNumberFilterPHOTO.addEventListener('change', function (e) {
        const form = document.querySelector('#filterForm')
        form.submit()

    })
}
const rowNumberFilterPOSTING = document.querySelector('#filterButton') ? document.querySelector('#number-rowsposting') : null;
function rowPerPageInstancePOSTING() {
    rowNumberFilterPOSTING.addEventListener('change', function (e) {
        const form = document.querySelector('#filterForm')
        form.submit()

    })
}
(rowNumberFilterUSER !== null) ? rowPerPageInstanceUSER() : '';
(rowNumberFilterPENIDNG !== null) ? rowPerPageInstancePENDING() : '';
(rowNumberFilterREPORTS !== null) ? rowPerPageInstanceREPORTS() : '';
(rowNumberFilterPIO !== null) ? rowPerPageInstancePIO() : '';
(rowNumberFilterPHOTO !== null) ? rowPerPageInstancePHOTO() : '';
(rowNumberFilterPOSTING !== null) ? rowPerPageInstancePOSTING() : '';
// ---------------------------------------------------------------------------------------

//Stay at table when page reload
const currActive = document.querySelector('#currActiveTable') ? document.querySelector('#currActiveTable') : null
const tabPane = (currActive !== null) ? document.querySelector('#' + currActive.value.toLowerCase()).closest('.tab-pane') : null

function handlePageReloadPagination() {
    navItems.forEach(navItem => {
        if (navItem.getAttribute('data-tablenum') == currActive.value.toLowerCase()) {
            navItem.classList.add('active')
        }
    });

    allTables.forEach(table => {
        // console.log(table.getAttribute('data-tablenum'));
        if (table.id === currActive.value.toLowerCase()) {
            table.style.display = 'block'
        } else {
            table.style.display = 'none'
        }
    });
}
(currActive !== null) ? handlePageReloadPagination() : '';


// For page Selection
const pageSelectionPENDING = document.querySelectorAll('.paginationPENDING span') ? document.querySelectorAll('.paginationPENDING span') : null;

function pageSelectInstancePENDING() {
    pageSelectionPENDING.forEach(function (e) {
        e.addEventListener('click', function (e) {
            const form = document.querySelector('#filterForm')
            const hiddenFieldPage = document.querySelector('#pageNumberpending')
            console.log(hiddenFieldPage + 's');
            hiddenFieldPage.value = e.target.getAttribute('data-pagePENDING')
            form.submit()

        })
    })
}
(pageSelectionPENDING !== null) ? pageSelectInstancePENDING() : '';

const pageSelectionUSER = document.querySelectorAll('.paginationUSER span') ? document.querySelectorAll('.paginationUSER span') : null;

function pageSelectInstanceUSER() {
    pageSelectionUSER.forEach(function (e) {
        e.addEventListener('click', function (e) {
            const form = document.querySelector('#filterForm')
            const hiddenFieldPage = document.querySelector('#pageNumberuser')
            console.log(hiddenFieldPage + 's');
            hiddenFieldPage.value = e.target.getAttribute('data-pageUSER')
            form.submit()

        })
    })
}
(pageSelectionUSER !== null) ? pageSelectInstanceUSER() : '';

const pageSelectionPIO = document.querySelectorAll('.paginationPIO span') ? document.querySelectorAll('.paginationPIO span') : null;

function pageSelectInstancePIO() {

    pageSelectionPIO.forEach(function (e) {

      
        e.addEventListener('click', function (e) {

            console.log(e.target);
            const form = document.querySelector('#filterForm')
            const hiddenFieldPage = document.querySelector('#pageNumberpio')
            hiddenFieldPage.value = e.target.getAttribute('data-pagepio')
            form.submit()

        })
    })
}
(pageSelectionPIO !== null) ? pageSelectInstancePIO() : '';

const pageSelectionREPORTS = document.querySelectorAll('.paginationREPORTS span') ? document.querySelectorAll('.paginationREPORTS span') : null;

function pageSelectInstanceREPORTS() {

    pageSelectionREPORTS.forEach(function (e) {

      
        e.addEventListener('click', function (e) {

            console.log(e.target);
            const form = document.querySelector('#filterForm')
            const hiddenFieldPage = document.querySelector('#pageNumberREPORTS')
            hiddenFieldPage.value = e.target.getAttribute('data-pageREPORTS')
            form.submit()

        })
    })
}
(pageSelectionREPORTS !== null) ? pageSelectInstanceREPORTS() : '';


const pageSelectionPHOTO = document.querySelectorAll('.paginationPHOTO span') ? document.querySelectorAll('.paginationPHOTO span') : null;
function pageSelectInstancePHOTO() {
    pageSelectionPHOTO.forEach(function (e) {
        e.addEventListener('click', function (e) {
            const form = document.querySelector('#filterForm')
            const hiddenFieldPage = document.querySelector('#pageNumberphoto')
            hiddenFieldPage.value = e.target.getAttribute('data-pagePHOTO')
            form.submit()

        })
    })
}
(pageSelectionPHOTO !== null) ? pageSelectInstancePHOTO() : '';

const pageSelectionPOSTING = document.querySelectorAll('.paginationPOSTING span') ? document.querySelectorAll('.paginationPOSTING span') : null;
function pageSelectInstancePOSTING() {
    pageSelectionPOSTING.forEach(function (e) {
        e.addEventListener('click', function (e) {
            const form = document.querySelector('#filterForm')
            const hiddenFieldPage = document.querySelector('#pageNumberposting')
            hiddenFieldPage.value = e.target.getAttribute('data-pagePOSTING')
            form.submit()

        })
    })
}
(pageSelectionPOSTING !== null) ? pageSelectInstancePOSTING() : '';

// ---------------------------------------------------------------------------------------

//For Date picker
$(function () {
    $('input[name="date-range"]').daterangepicker({
        autoUpdateInput: false,
        monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        locale: {
            format: 'MMM D, YYYY',
            cancelLabel: 'Clear'
        }
    });

    $('input[name="date-range"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MMM D, YYYY') + ' - ' + picker.endDate.format('MMM D, YYYY'));
        console.log(picker.startDate.format('MMM D, YYYY') + ' - ' + picker.endDate.format('MMM D, YYYY'));

    });

    $('input[name="date-range"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('Select Date Range');
        console.log('cancel');
    });
})


$(function () {
    $('input[name="date-deadline"]').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        locale: {
            format: 'MMM D, YYYY',
            cancelLabel: 'Clear'
        }
    });

    $('input[name="date-deadline"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.endDate.format('MMM D, YYYY'));

    });

    $('input[name="date-deadline"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
        console.log('cancel');
    });
})

$(function () {
    $('input[name="activity-Duration"]').daterangepicker({
        autoUpdateInput: false,
        timePicker: true,
    })

    $('input[name="activity-Duration"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MMM D, YYYY hh:mm A') + ' - ' + picker.endDate.format('MMM D, YYYY hh:mm A'));
    });

    $('input[name="activity-Duration"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('Select Date');
    });
});


$(function () {
    $('input[name="activity-Duration-viewpage"]').daterangepicker({
        autoUpdateInput: false,
        timePicker: true,
    })

    let dateTitleViewPage = document.querySelector('#date-view-page')

    $('input[name="activity-Duration-viewpage"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MMM D, YYYY hh:mm A') + ' - ' + picker.endDate.format('MMM D, YYYY hh:mm A'));
        dateTitleViewPage.textContent = picker.startDate.format('MMM D, YYYY') + ' - ' + picker.endDate.format('MMM D, YYYY') + ' | ' + picker.startDate.format('hh:mm A') + ' - ' + picker.endDate.format('hh:mm A')
        console.log(dateTitleViewPage);
        console.log('test');
    });

    // $('input[name="activity-Duration"]').on('cancel.daterangepicker', function (ev, picker) {
    //     $(this).val('Select Date');
    // });
});


// ---------------------------------------------------------------------------------------


