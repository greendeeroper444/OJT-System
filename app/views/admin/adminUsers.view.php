<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/admin/adminViewUser.css">


<main class="">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="title-page">Users</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>

    <ul class="nav nav-tabs " style="display:none;" id="myTab">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" data-tablenum="user"></a>
            </li>
        </ul>
    <input id="page-url" type="text" value="<?php echo PARENT_FOLDER ?>/admin/users" hidden>
    <input id="page-view-url" type="text" value="<?php echo PARENT_FOLDER ?>/profile?" hidden>
    <!-- Start of form -->
    <form id="filterForm" action="<?php echo PARENT_FOLDER ?>/admin/users" method="POST" class="pt-4 pb-4">
        <div class="btn-group d-flex justify-content-between tablet pb-2 pt-2">
            <div class="btn-group ">

            </div>
            <div class="btn-group">
                <div class="dropdown m-2">
                    <!-- Search filter Function at global -->
                    <input id='search-bar' class="form-control rounded-input p-2" type="input" placeholder="Search user">
                    </input>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="table-responsive d-flex justify-content-center shadow">
                <table class="table custom-table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Name</th>
                            <th scope="col">User Type</th>
                            <th scope="col">Office</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody id="table-request-body-user">

                        <?php
                        foreach ($data['user'] as $user) {

                            $userStatusCss = ($user['user_status'] == 1 ? 'text-bg-primary' : ($user['user_status'] == 2 ? 'text-bg-warning'  : 'text-bg-danger'));
                            $userStatus = ($user['user_status'] == 1 ? 'Approved' : ($user['user_status'] == 2 ? 'Pending'  : 'Declined'));
                            $fullName =  ucwords(strtolower($user['user_fn'])) . ' ' . ucwords(strtolower($user['user_ln']));
                            echo
                            '
                            <tr class="text-center">
                                <td class="align-middle ">' . $fullName . '</td>
                                <td class="align-middle">' . ($user['user_type'] == 1 ? 'Admin' : 'Requestor') . '</td>
                                <td class="align-middle">' . $user['user_office'] . '</td>
                                <td class="align-middle">' . $user['user_date_created'] . ' </td>
                                <td class="align-middle font-weight-bold"><p class="text-center">
                                <span style="color:white !important;" class="badge rounded-pill ' . $userStatusCss . ' ">' . $userStatus . '</span>
                                </p></td>
                                <td>
                                    <a href="' . PARENT_FOLDER . '/profile?id=' . $user['user_id'] . '&type=' . $user['user_type'] . '">
                                        <div class="d-f lex justify-content-center"><button type="button" class="btn btn-outline-success action">View </button></div>
                                    </a>
        
                                </td> 
                            </tr>            
                            ';
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
                                                <select id="number-rowsuser" class="form-select " aria-label="Default select example" name="number-rowsUSER">
                                                    <option value="5" <?php echo ($data['itemPerPageUSER'] == '5') ? 'selected' : ''; ?>>5</option>
                                                    <option value="10" <?php echo ($data['itemPerPageUSER'] == '10') ? 'selected' : ''; ?>>10</option>
                                                    <option value="15" <?php echo ($data['itemPerPageUSER'] == '15') ? 'selected' : ''; ?>>15</option>
                                                    <option value="20" <?php echo ($data['itemPerPageUSER'] == '20') ? 'selected' : ''; ?>>20</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination paginationUSER">
                                            <input id="pageNumberuser" type="text" name="pageNumberUSER" value="<?php echo $data['pageUSER'] ?>" hidden>
                                            <li class="page-item">

                                                <a class="page-link" aria-label="Previous">
                                                    <span data-pageNumber="<?php echo ($data['numberofPagesUSER']) ?>" data-pageUSER="<?php echo ($data['pageUSER'] == 1) ? '1' : ($data['pageUSER'] - 1) ?>" aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php
                                            for ($counter = intval($data['pageUSER']); $counter <= intval($data['pageUSER']) + 2 && $counter <= intval($data['numberofPagesUSER']); $counter++) {

                                                if ($counter == intval($data['pageUSER'])) {
                                                    echo "<li class='page-item active'><span data-pageNumber=" . $data['numberofPagesUSER'] . " data-pageUSER=" . $counter . " class='page-link' >$counter</span></li>";
                                                } else {
                                                    echo "<li class='page-item'><span data-pageNumber=" . $data['numberofPagesUSER'] . " data-pageUSER=" . $counter . " class='page-link'>$counter</span></li>";
                                                }
                                            }
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link" aria-label="Next">
                                                    <span data-pageNumber="<?php echo ($data['numberofPagesUSER']) ?>" data-pageUSER="<?php echo ($data['pageUSER'] + 1) ?>" aria-hidden="true">&raquo;</span>
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
    </div>

</main>