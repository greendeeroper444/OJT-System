<?php include_once(ROOT . '/app/views/layout/components/requestTable.php'); ?>
<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/admin/adminViewRequest.css">

<main class="">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class=" title-page">Requests</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>


    <!-- Page URl -->
    <input id="page-url" type="text" value="<?php echo PARENT_FOLDER ?>/admin/request" hidden>
    <input id="page-view-url" type="text" value="<?php echo PARENT_FOLDER ?>/admin/request/view?" hidden>

    <!-- Start of form -->
    <form id="filterForm" action="<?php echo PARENT_FOLDER ?>/admin/request" method="POST">
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
                                    <th scope="col">Date of Event</th>
                                    <th scope="col">Date of Requested</th>
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
                                    <th scope="col">Date of Event</th>
                                    <th scope="col">Date of Requested</th>
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

</main>
<script>
    const navItems = document.querySelectorAll('.nav-link');
    const tabContents = document.querySelectorAll('.tab-pane');
    const allTables = document.querySelectorAll('.table-wrapper');

    navItems.forEach(navItem => {
        navItem.addEventListener('click', function() {
            const target = navItem.getAttribute('data-tablenum');
            console.log(target);
            navItems.forEach(item => {
                item.classList.remove('active');
            });

            navItem.classList.add('active');
            let tableToDiplay = document.querySelector('#' + target)
            allTables.forEach(table => {
                console.log(table.getAttribute('data-tablenum'));
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
