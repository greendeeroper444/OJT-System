<?php include_once(ROOT . '/app/views/layout/components/requestTable.php'); ?>
<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/client/dashboard.css">


<div class="cust-margin">
    <?php
    $eventCount = 0;





    foreach ($data['PIOdata'] as $request) {
        if ($request['r_type'] != 'PIO' || $request['t_status'] != '2') {
            continue;
        }


        $dateStart =  date('Y-m-d', $request['r_durationStart']);
        $dateEnd = date('Y-m-d', $request['r_durationEnd']);

        if ($dateStart == date('Y-m-d')) {
            $eventCount++;
        }
        $start = new DateTime($dateStart);
        $end = new DateTime($dateEnd);

        $interval = $start->diff($end);
        $days = $interval->days + 1;

        $dateFormat = date('Y-m-d', $request['r_durationStart']);

        // $calendar->add_event($request['r_activityname'], $dateFormat, $days, randomColor());
    }

    ?>



    <!-- Page URl -->
    <input id="page-url" type="text" value="<?php echo PARENT_FOLDER ?>/client/dashboard" hidden>
    <input id="page-view-url" type="text" value="<?php echo PARENT_FOLDER ?>/client/request/view?" hidden>

    <h1 class="font-weight-bold">Requests</h1>
    <div class="m-1 fst-italic d-flex justify-content-end">
        <?php
        echo date("F j, Y");
        ?>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-0 pb-2">
            <div class="card shadow block1">
                <div class="card-header event text-center">
                    <h5 class="card-title ">Today's Events</h5>
                </div>
                <h3 class="card-body fs-3 text-center"><?php echo $eventCount ?></h3>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-0 pb-2">
            <div class="card shadow block1">
                <div class="card-header pending text-center">
                    <h5 class="card-title ">PIO Service Request</h5>
                </div>
                <h3 class="card-body fs-3 text-center"><?php echo $data['PIOpending'] ?></h3>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-0 pb-2">
            <div class="card shadow block1">
                <div class="card-header pending text-center">

                    <h5 class="card-title ">Posting Approval</h5>
                </div>
                <h3 class="card-body fs-3 text-center"><?php echo $data['POSTINGpending'] ?>
                </h3>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-0 pb-2">
            <div class="card shadow block1">
                <div class="card-header pending text-center">
                    <h5 class="card-title ">Photo Request</h5>
                </div>
                <h3 class="card-body fs-3 text-center"><?php echo $data['PHOTOpending'] ?></h3>
            </div>
        </div>


    </div>

    <!-- Start of form -->
    <form id="filterForm" action="<?php echo PARENT_FOLDER ?>/client/dashboard" method="POST" class="pt-4 pb-4">
        <input id="currActiveTable" type="text" value="<?php echo $data['currActive'] ?>" name="currActiveTable" hidden>

        <ul class="nav nav-tabs" id="myTab">
            <li class="nav-item">
                <a class="nav-link " aria-current="page" data-tablenum="table1">PIO Service Request</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-tablenum="table2">Posting Approval </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-tablenum="table3">Request Photo</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active">
                <!-- Page URl -->
                <input id="page-url" type="text" value="<?php echo PARENT_FOLDER ?>/admin/request" hidden>

                <!-- Sorting Section -->
                <div class="btn-group d-flex justify-content-between tablet pt-3 pb-3">
                    <div class="btn-group ">
                        <div class="btn-group">
                            <!-- Sort Request -->
                            <?php include(ROOT . '/app/views/layout/components/sortRequest.php'); ?>

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
                <div id="table1" class="container-fluid table-wrapper ">
                    <div class="table-responsive d-flex justify-content-center">

                        <table class="table custom-table table-hover shadow">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Request Code</th>
                                    <th scope="col">Requestor</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Date of event</th>
                                    <th scope="col">Date of requested</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="table-request-body-table1">
                                <!-- Table Section -->
                                <?php renderTable('PIO', $data) ?>
                            </tbody>
                            <tfoot>
                                <!-- Pagination Section -->
                                <?php include_once(ROOT . '/app/views/layout/components/paginationPIO.php'); ?>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Table 2 -->
                <div id="table2" class="container-fluid table-wrapper" style="display:none">

                    <div class="table-responsive d-flex justify-content-center">
                        <table class="table custom-table table-hover shadow">
                            <thead>

                                <tr class="text-center">
                                    <th scope="col">Requestor</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Date Requested</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="table-request-body-table2">
                                <!-- Table Section -->
                                <?php renderTable('POSTING', $data) ?>
                            </tbody>
                            <tfoot>
                                <!-- Pagination Section -->
                                <?php include_once(ROOT . '/app/views/layout/components/paginationPOSTING.php'); ?>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Table 3 -->
                <div id="table3" class="container-fluid table-wrapper" style="display:none">
                    <div class="table-responsive d-flex justify-content-center">
                        <table class="table custom-table table-hover shadow">
                            <thead>
                                <tr class="text-center">
                                <tr class="text-center">
                                    <th scope="col">Requestor</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Date of event</th>
                                    <th scope="col">Date of requested</th>

                                    <th scope="col">Status</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="table-request-body-table3">
                                <!-- Table Section -->
                                <?php renderTable('PHOTO', $data) ?>
                            </tbody>

                            <tfoot>
                                <!-- Pagination Section -->
                                <?php include_once(ROOT . '/app/views/layout/components/paginationPHOTO.php'); ?>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <!-- End of Form -->
    <!-- Calender  -->

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    </div>
</div>

<script>
    const navItems = document.querySelectorAll('.nav-link');
    const tabContents = document.querySelectorAll('.tab-pane');
    const allTables = document.querySelectorAll('.table-wrapper');

    navItems.forEach(navItem => {
        navItem.addEventListener('click', function() {
            const target = navItem.getAttribute('data-tablenum');
            navItems.forEach(item => {
                item.classList.remove('active');
            });

            navItem.classList.add('active');
            let tableToDiplay = document.querySelector('#' + target)
            allTables.forEach(table => {
                // console.log(table.getAttribute('data-tablenum'));
                if (table.id === tableToDiplay.id) {
                    currActive.value = table.id
                    table.style.display = 'block'
                } else {
                    table.style.display = 'none'
                }
            });

        });
    });
</script>