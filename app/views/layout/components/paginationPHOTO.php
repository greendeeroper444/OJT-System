<tr>
    <th colspan="9">
        <div class="d-flex justify-content-between footer-margin">
            <div class="btn-group d-flex justify-content-between">
                <div class="btn-group ">
                    <div class="btn-group align-items-center">
                        <label for="pagesperrow">Row per pages</label>
                        <div class="dropdown m-2">
                            <select id="number-rowsphoto" class="form-select " aria-label="Default select example" name="number-rowsphoto">
                                <option value="5" <?php echo ($data['itemPerPagePHOTO'] == '5') ? 'selected' : ''; ?>>5</option>
                                <option value="10" <?php echo ($data['itemPerPagePHOTO'] == '10') ? 'selected' : ''; ?>>10</option>
                                <option value="15" <?php echo ($data['itemPerPagePHOTO'] == '15') ? 'selected' : ''; ?>>15</option>
                                <option value="20" <?php echo ($data['itemPerPagePHOTO'] == '20') ? 'selected' : ''; ?>>20</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div>
                <nav aria-label="Page navigation">
                    <ul class="pagination paginationphoto">
                        <input id="pageNumberphoto" type="text" name="pageNumberPHOTO" value="<?php echo $data['pagePHOTO'] ?>" hidden>
                        <li class="page-item">

                            <a class="page-link" aria-label="Previous">
                                <span data-pageNumber="<?php echo ($data['numberofPagesPHOTO']) ?>" data-pagePHOTO="<?php echo ($data['pagePHOTO'] == 1) ? '1' : ($data['pagePHOTO'] - 1) ?>" aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php


                        for ($counter = intval($data['pagePHOTO']); $counter <= intval($data['pagePHOTO']) + 2 && $counter <= intval($data['numberofPagesPHOTO']); $counter++) {
                            if ($counter == intval($data['pagePHOTO'])) {
                                echo "<li class='page-item active'><span  data-pageNumber=" . $data['numberofPagesPHOTO'] . " data-pagePHOTO=" . $counter . " class='page-link' >$counter</span></li>";
                            } else {
                                echo "<li class='page-item'><span data-pageNumber=" . $data['numberofPagesPHOTO'] . " data-pagePHOTO=" . $counter . " class='page-link''>$counter</span></li>";
                            }
                        }

                        ?>
                        <li class="page-item">
                            <a class="page-link" aria-label="Next">
                                <span data-pageNumber="<?php echo ($data['numberofPagesPHOTO']) ?>" data-pagePHOTO="<?php echo ($data['pagePHOTO'] + 1) ?>" aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </th>
</tr>