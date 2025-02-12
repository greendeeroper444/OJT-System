const searchbarFilter = document.querySelector('#search-bar') ? document.querySelector('#search-bar') : null;

function searchBarInstance() {
    searchbarFilter.addEventListener('input', function (e) {


        const pageURL = document.querySelector('#page-url').value
        const pageURLview = document.querySelector('#page-view-url').value
        const dateRange = document.querySelector('#dateRangePicker').value
        const requestType = document.querySelector('#requestDropDown').value
        const numRow = document.querySelector('#number-rows-' + activeTable)
        const hiddenFieldPage = document.querySelector('#pageNumber-' + activeTable)
        console.log(document.querySelector(".nav-item .active"));
        let data
        const tableBody = document.querySelector('#table-request-body-' + activeTable)
        tableBody.innerHTML = '';


        if (e.target.value == "") {
            data = {
                'searchWord': e.target.value,
                'dateRange': dateRange,
                'requestType': requestType,
                'numbeRows': numRow,
                'pageNumber': hiddenFieldPage,
                'tableType': (activeTable == 'table1') ? 'PIO' : (activeTable == 'table2') ? 'POSTING' : (activeTable == 'table3') ? 'PHOTO' : ''
            }
            document.querySelector('.pagination').style.display = "flex";
        } else {
            data = {
                'searchWord': e.target.value,
                'dateRange': dateRange,
                'requestType': requestType,
                'numbeRows': 5,
                'pageNumber': 1,
                'tableType': (activeTable == 'table1') ? 'PIO' : (activeTable == 'table2') ? 'POSTING' : (activeTable == 'table3') ? 'PHOTO' : ''
            }
            document.querySelector('.pagination').style.display = "none";
        }


        axios({
            method: 'post',
            url: pageURL,
            data: data
        }).then(response => {
            console.log(pageURL);
            var responseData = response.data.request;

            if (responseData.length == 0) {
                let row = document.createElement('tr');
                row.classList.add('text-center');
                row.innerHTML = '<td class="align-middle text-center my-5" colspan="5">No Request Found</td>';
                tableBody.appendChild(row);
            } else {
                console.log(response.data.searchedData.tableType);
                if (response.data.searchedData.tableType == "POSTING") {

                    responseData.forEach(function (data) {

                        let statusCss = (data.t_status == 1 ? 'status-btn-complete' : (data.t_status == 2 ? 'status-btn-approved' : (data.t_status == 3 ? 'status-btn-pending' : 'status-btn-declined')));
                        let statusText = (data.t_status == 1 ? 'Complete' : (data.t_status == 2 ? 'Approved' : (data.t_status == 3 ? 'Pending' : 'Declined'))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];

                        let row = document.createElement('tr');
                        row.classList.add('text-center');
                        row.innerHTML =
                            '<td class="align-middle ">' + data.user_fn + " " + data.user_ln + '</td>' +
                            '<td class="align-middle text-start text-truncate" style="max-width: 100px;">' + data.r_title + '</td>' +
                            '<td class="align-middle text-start">' + data.r_orgname + '</td>' +
                            '<td class="align-middle text-start">' + data.r_content + '</td>' +
                            '<td class="align-middle">' +
                            '<p class="' + statusCss + ' text - center">' + statusText + '</p>' +
                            '</td > ' +
                            '<td class="align-middle">' +
                            '<p class="' + statusCss + ' text - center">' + data.
                                t_output_status + '</p>' +
                            '</td > ' +
                            '<td>' +
                            '<a href="' + pageURLview + 'id=' + data.r_id + '&type=' + response.data.searchedData.tableType + '" ' +
                            '<div class="d-flex justify-content-center">' +
                            '<button type="button" class="btn btn-outline-success action">View</button>' +
                            '</div>' +
                            '</a>' +
                            '</td>';

                        tableBody.appendChild(row);
                    });


                } else {
                    responseData.forEach(function (data) {
                        let statusCss = (data.t_status == 1 ? 'status-btn-complete' : (data.t_status == 2 ? 'status-btn-approved' : (data.t_status == 3 ? 'status-btn-pending' : 'status-btn-declined')));
                        let statusText = (data.t_status == 1 ? 'Complete' : (data.t_status == 2 ? 'Approved' : (data.t_status == 3 ? 'Pending' : 'Declined'))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];

                        let row = document.createElement('tr');
                        row.classList.add('text-center');
                        row.innerHTML =
                            '<td class="align-middle ">' + data.r_id + '</td>' +
                            '<td class="align-middle text-start text-truncate" style="max-width: 100px;">' + data.r_activityname + '</td>' +
                            '<td class="align-middle">' + data.r_durationStart + '</td>' +
                            '<td class="align-middle">' + data.r_durationEnd + '</td>' +
                            '<td class="align-middle">' +
                            '<p class="' + statusCss + ' text - center">' + statusText + '</p>' +
                            '</td > ' +
                            '<td class="align-middle">' +
                            '<p class="' + statusCss + ' text - center">' + data.
                                t_output_status + '</p>' +
                            '</td > ' +
                            '<td>' +
                            '<a href="' + pageURLview + 'id=' + data.r_id + '&type=' + response.data.searchedData.tableType + '" ' +
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