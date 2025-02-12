<tr>
    <th colspan="8">
        <div class="d-flex justify-content-between footer-margin">
            <div class="btn-group d-flex justify-content-between">
                <div class="btn-group ">
                    <div class="btn-group align-items-center">
                        <label for="pagesperrow">Row per pages</label>
                        <div class="dropdown m-2">
                            <select id="number-rowspio" class="form-select " aria-label="Default select example" name="number-rowspio">
                                <option value="5" <?php echo ($data['itemPerPagePIO'] == '5') ? 'selected' : ''; ?>>5</option>
                                <option value="10" <?php echo ($data['itemPerPagePIO'] == '10') ? 'selected' : ''; ?>>10</option>
                                <option value="15" <?php echo ($data['itemPerPagePIO'] == '15') ? 'selected' : ''; ?>>15</option>
                                <option value="20" <?php echo ($data['itemPerPagePIO'] == '20') ? 'selected' : ''; ?>>20</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div>
                <nav aria-label="Page navigation">
                    <ul class="pagination paginationPIO">
                        <input id="pageNumberpio" type="text" name="pageNumberPIO" value="<?php echo $data['pagePIO'] ?>" hidden>
                        <li class="page-item">

                            <a class="page-link" aria-label="Previous">
                                <span data-pageNumber="<?php echo ($data['numberofPagesPIO']) ?>" data-pagePIO="<?php echo ($data['pagePIO'] == 1) ? '1' : ($data['pagePIO'] - 1) ?>" aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        for ($counter = intval($data['pagePIO']); $counter <= intval($data['pagePIO']) + 2 && $counter <= intval($data['numberofPagesPIO']); $counter++) {

                            if ($counter == intval($data['pagePIO'])) {
                                echo "<li class='page-item active'><span data-pageNumber=" . $data['numberofPagesPIO'] . " data-pagePIO=" . $counter . " class='page-link' >$counter</span></li>";
                            } else {
                                echo "<li class='page-item'><span data-pageNumber=" . $data['numberofPagesPIO'] . " data-pagePIO=" . $counter . " class='page-link'>$counter</span></li>";
                            }
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" aria-label="Next">
                                <span data-pageNumber="<?php echo ($data['numberofPagesPIO']) ?>" data-pagePIO="<?php echo ($data['pagePIO'] + 1) ?>" aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </th>
</tr>