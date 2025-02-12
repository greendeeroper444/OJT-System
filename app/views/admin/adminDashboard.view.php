<?php include_once(ROOT . '/app/views/layout/components/requestTable.php'); ?>
<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/admin/adminDashboard.css">

<main class="" data-bs-theme="light">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class=" title-page">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>
    <div class="m-1 fst-italic d-flex justify-content-end">
        <?php
        echo date("F j, Y");
        ?>
    </div>
    <?php include_once(ROOT . '/app/views/layout/components/calendar.php');
    $calendar = new calendar();
    $color = [];
    $eventCount = 0;

    function randomColor()
    {
        $colors = [
            'red', 'green', 'blue', 'yellow', 'orange', 'purple', 'pink',
            'brown', 'black', 'gray', 'cyan', 'magenta',
            'maroon', 'navy', 'olive', 'teal', 'aqua', 'fuchsia',
        ];
        $randomIndex = array_rand($colors);
        return $colors[$randomIndex];
    }


    foreach ($data['approvedRequest'] as $request) {
        if ($request['t_r_type'] != 'PIO' || $request['t_status'] != '2') {
            continue;
        }
    

      
        $dateStart =  date('Y-m-d', $request['r_durationStart']);
        $dateEnd = date('Y-m-d', $request['r_durationEnd']);


        if($dateStart == date('Y-m-d') ){
            $eventCount++;
        }

        $start = new DateTime($dateStart);
        $end = new DateTime($dateEnd);

        $interval = $start->diff($end);
        $days = $interval->days + 1;

        $dateFormat = date('Y-m-d', $request['r_durationStart']);
        $calendar->add_event($request['r_activityname'], $dateFormat, $days, randomColor());
    }


    ?>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-2 mb-sm-0 pb-2">
            <div class="card shadow block1">
                <div class="card-header event text-center">
                    <h5 class="card-title ">Today's Event</h5>
                </div>
                <h3 class="card-body fs-3 text-center align-items-center"><?php echo $eventCount ?></h3>
            </div>

        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-2 mb-2 mb-sm-0 pb-2">
            <a href="<?php echo PARENT_FOLDER ?>/admin/request#table2">
                <div class="card shadow block1">
                    <div class="card-header  approved text-center">

                        <h5 class="card-title ">Approved</h5>
                    </div>
                    <h3 class="card-body fs-3 text-center"><?php echo $eventCount ?></h3>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2 mb-2 mb-sm-0 pb-2">
            <a href="<?php echo PARENT_FOLDER ?>/admin/request#table1">
                <div class="card shadow block1">
                    <div class="card-header pending text-center">
                        <h5 class="card-title ">PIO Service Request</h5>
                    </div>
                    <h3 class="card-body fs-3 text-center"><?php echo $data['PIOpending'] ?></h3>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2 mb-2 mb-sm-0 pb-2">
            <a href="<?php echo PARENT_FOLDER ?>/admin/request#table2">
                <div class="card shadow block1">
                    <div class="card-header pending text-center">

                        <h5 class="card-title ">Posting Approval</h5>
                    </div>
                    <h3 class="card-body fs-3 text-center"><?php echo $data['POSTINGpending'] ?>
                    </h3>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2 mb-2 mb-sm-0 pb-2">
            <a href="<?php echo PARENT_FOLDER ?>/admin/request#table2">
                <div class="card shadow block1">
                    <div class="card-header pending text-center">
                        <h5 class="card-title ">Photo Request</h5>
                    </div>
                    <h3 class="card-body fs-3 text-center"><?php echo $data['PHOTOpending'] ?></h3>
                </div>
            </a>
        </div>


    </div>
    <input id="page-url" type="text" value="<?php echo PARENT_FOLDER ?>/admin/dashboard" hidden>
    <input id="page-view-url" type="text" value="<?php echo PARENT_FOLDER ?>/admin/request/view?" hidden>
    <!-- Start of form -->
    <form id="filterForm" action="<?php echo PARENT_FOLDER ?>/admin/dashboard" method="POST" class="pt-4 pb-4">

        <!-- Page URl -->
        <input id="page-url" type="text" value="<?php echo PARENT_FOLDER ?>/admin/dashboard" hidden>
        <div class="btn-group d-flex justify-content-between tablet pb-2 pt-2">
            <div class="btn-group ">
                <div class="btn-group">

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
                    <input id='search-bar' class="form-control rounded-input p-2" type="input" placeholder="Search by requestor">
                    </input>
                </div>
            </div>
        </div>

        <div class="container-fluid  ">
            <div class="table-responsive d-flex justify-content-center">
                <table class="table custom-table table-hover shadow">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Type</th>
                            <th scope="col">Requestor</th>
                            <!-- <th scope="col">Date of the Event</th> -->
                            <th scope="col">Date Requested</th>
                            <th scope="col">Status</th>
                            <th scope="col">Remarks</th>
                            <th scope="col"></th>
                        </tr>

                    </thead>
                    <tbody id="table-request-body-pending">
                        <!-- Table Section -->
                        <?php renderTable('PENDING', $data) ?>
                    </tbody>

                    <!-- Sample Footer  -->
                    <tfoot>
                        <!-- Pagination Section -->
                        <?php include_once(ROOT . '/app/views/layout/components/paginationAdminPending.php'); ?>
                    </tfoot>
                </table>
            </div>
        </div>
    </form>
    <!-- End of Form -->
    <?= $calendar ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    </div>

</main>