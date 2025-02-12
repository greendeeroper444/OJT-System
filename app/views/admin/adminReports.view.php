<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/admin/adminReports.css">

<main class="">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3 border-bottom">
        <h1 class="title-page">Reports</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>

    </div>

    <input id="page-url" type="text" value="<?php echo PARENT_FOLDER ?>/admin/reports" hidden>
    <input id="page-view-url" type="text" value="<?php echo PARENT_FOLDER ?>/admin/request/view?" hidden>
    
    
    <!--First form -->
    <form id="filterForm" action="<?php echo PARENT_FOLDER ?>/admin/reports" method="POST">
        <div class="tab-content">
            <div class="btn-group d-flex justify-content-between tablet pb-2 pt-2">
                <div class="btn-group ">
                    <div class="btn-group">

                        <!-- Sort Request -->
                        <?php
                        // include(ROOT . '/app/views/layout/components/sortRequest.php'); 
                        ?>

                        <!-- Sort Date -->
                        <div class="m-2 input-group input-group-sm ">
                            <input id="dateRangePicker" type="text" name="date-range" value="<?php echo ($data['dateRange']) ? $data['dateRange'] : 'Select Date Range' ?>" class="form-control " />
                        </div>

                        <div class="button m-2">
                            <button id="filterButton" class="btn btn-success " type="submit">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <div class="dropdown m-2">
                        <!-- Search filter Function at global -->
                        <input id='search-bar' class="form-control rounded-input p-2" type="input" placeholder="Search activity name">
                        </input>
                    </div>

                </div>

            </div>
            <div class="container-fluid  ">
                <div class="table-responsive d-flex justify-content-center">
                    <table class="table custom-table table-hover" id="taskTable">
                        <thead>
                            <tr class="text-center">
                          
                                <th scope="col ">
                                    <div class="d-flex justify-content-center align-items-center">Activity</div>
                                </th>
                                <th scope="col">Requestor</th>
                                <th scope="col">Date Requested</th>
                                <!-- <th scope="col">Date Approved</th> -->
                                <th scope="col">Date Completed</th>
                                <th scope="col">Status</th>
                                
                                <th scope="col">

                                </th>

                            </tr>
                        </thead>
                        <tbody id="table-request-body-reports">
                            <?php

                                foreach ($data['REPORTdata'] as $request) {
                            $statusCss = ($request['t_status'] == 1 ? 'text-bg-primary' : ($request['t_status'] == 2 ? 'text-bg-success' : ($request['t_status'] == 3 ? 'text-bg-warning' : 'text-bg-danger')));
                            $statusText = ($request['t_status'] == 1 ? 'Complete' : ($request['t_status'] == 2 ? 'Approved' : ($request['t_status'] == 3 ? 'Pending' :  ($request['t_status'] == 4 ? 'Cancelled' : 'Declined')))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                            
                                echo ' <tr class="text-center">

                                    <td class="align-middle ">' . $request['r_activityname'] . '</td>
                                <td class="align-middle">' . ucwords(strtolower($request['user_fn'])) . " " . ucwords(strtolower($request['user_ln'])) . '</td>
                            
                                <td class="align-middle ">' . $request['t_dateRequested'] . '</td>
                                
                                <td class="align-middle ">' . $request['t_datecompleted'] . '</td>
                                <td class="align-middle">
                                    <p class=" ">
                                    <span style="color:white !important; " class="badge rounded-pill ' . $statusCss . ' ">' . $statusText  . '</span>
                                    </p>
                                </td>
                        
                                    <td>
                        <a href="' . PARENT_FOLDER . '/' . $data['userType'] . '/request/view?id=' . $request['r_id'] . '&type=PIO">
                            <div class="d-flex justify-content-center"><button type="button" class="btn btn-outline-success action">View </button></div>
                        </a>
                    </td> 

                            </tr>';

            
                        
                            }
                            
                            
                            ?>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="8">
                                <div class="d-flex justify-content-between footer-margin">
                                <div class="btn-group d-flex justify-content-between">
                                    <div class="btn-group ">
                                        <div class="btn-group align-items-center">
                                            <label for="pagesperrow">Row per pages</label>
                                            <div class="dropdown m-2">
                                                <select id="number-rowsreports" class="form-select " aria-label="Default select example" name="number-rowsREPORTS">
                                                    <option value="5" <?php echo ($data['itemPerPageREPORTS'] == '5') ? 'selected' : ''; ?>>5</option>
                                                    <option value="10" <?php echo ($data['itemPerPageREPORTS'] == '10') ? 'selected' : ''; ?>>10</option>
                                                    <option value="15" <?php echo ($data['itemPerPageREPORTS'] == '15') ? 'selected' : ''; ?>>15</option>
                                                    <option value="20" <?php echo ($data['itemPerPageREPORTS'] == '20') ? 'selected' : ''; ?>>20</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination paginationREPORTS">
                                            <input id="pageNumberreports" type="text" name="pageNumberREPORTS" value="<?php echo $data['pageREPORTS'] ?>" hidden>
                                            <li class="page-item">

                                                <a class="page-link" aria-label="Previous">
                                                    <span data-pageNumber="<?php echo ($data['numberofPagesREPORTS']) ?>" data-pageREPORTS="<?php echo ($data['pageREPORTS'] == 1) ? '1' : ($data['pageREPORTS'] - 1) ?>" aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php
                                            for ($counter = intval($data['pageREPORTS']); $counter <= intval($data['pageREPORTS']) + 2 && $counter <= intval($data['numberofPagesREPORTS']); $counter++) {

                                                if ($counter == intval($data['pageREPORTS'])) {
                                                    echo "<li class='page-item active'><span data-pageNumber=" . $data['numberofPagesREPORTS'] . " data-pageREPORTS=" . $counter . " class='page-link' >$counter</span></li>";
                                                } else {
                                                    echo "<li class='page-item'><span data-pageNumber=" . $data['numberofPagesREPORTS'] . " data-pageREPORTS=" . $counter . " class='page-link'>$counter</span></li>";
                                                }
                                            }
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link" aria-label="Next">
                                                    <span data-pageNumber="<?php echo ($data['numberofPagesREPORTS']) ?>" data-pageREPORTS="<?php echo ($data['pageREPORTS'] + 1) ?>" aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </form>
        <!-- End first form -->
            <div class="button m-2">
                <form id="filterForm" action="<?php echo PARENT_FOLDER ?>/admin/reports/generate" method="POST">          
                    <input type="text" name="prev-url" value="<?php echo PARENT_FOLDER ?>/admin/reports" hidden>
                    <input type="text" name="date-range" value="<?php echo $data['dateRange'] ?>" hidden>       
            
                    <button class="btn btn-success" type="submit">
                        Generate Request Form
                    </button>

                </form>
            </div>

        </div>




</main>

<script>
    document.querySelectorAll('#taskTable tbody tr').forEach(row => {
        row.addEventListener('click', () => {
            // Toggle checkbox when row is clicked
            const checkbox = row.querySelector('.taskCheckbox');
            checkbox.checked = !checkbox.checked;
        });
    });

    var deleteBtn = document.querySelector("#delete")
    deleteBtn && deleteBtn.addEventListener('click', deleteRequest);
    function deleteRequest() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });
            }
        });
    }
</script>