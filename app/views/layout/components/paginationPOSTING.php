<tr>
    <th colspan="9">
        <div class="d-flex justify-content-between footer-margin">
            <div class="btn-group d-flex justify-content-between">
                <div class="btn-group ">
                    <div class="btn-group align-items-center">
                        <label for="pagesperrow">Row per pages</label>
                        <div class="dropdown m-2">
                            <select id="number-rowsposting" class="form-select" aria-label="Default select example" name="number-rowsposting">
                                <option value="5" <?php echo ($data['itemPerPagePOSTING'] == '5') ? 'selected' : ''; ?>>5</option>
                                <option value="10" <?php echo ($data['itemPerPagePOSTING'] == '10') ? 'selected' : ''; ?>>10</option>
                                <option value="15" <?php echo ($data['itemPerPagePOSTING'] == '15') ? 'selected' : ''; ?>>15</option>
                                <option value="20" <?php echo ($data['itemPerPagePOSTING'] == '20') ? 'selected' : ''; ?>>20</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div>
                <nav aria-label="Page navigation">
                    <ul class="pagination paginationPOSTING">
                        <input id="pageNumberposting" type="text" name="pageNumberPOSTING" value="<?php echo $data['pagePOSTING'] ?>" hidden>
                        <li class="page-item">

                            <a class="page-link" aria-label="Previous">
                                <span data-pageNumber="<?php echo ($data['numberofPagesPOSTING']) ?>" data-pagePOSTING="<?php echo ($data['pagePOSTING'] == 1) ? '1' : ($data['pagePOSTING'] - 1) ?>" aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php


                        for ($counter = intval($data['pagePOSTING']); $counter <= intval($data['pagePOSTING']) + 2 && $counter <= intval($data['numberofPagesPOSTING']); $counter++) {

                            if ($counter == intval($data['pagePOSTING'])) {
                                echo "<li class='page-item active'><span  data-pageNumber=" . $data['numberofPagesPOSTING'] . " data-pagePOSTING=" . $counter . " class='page-link' >$counter</span></li>";
                            } else {
                                echo "<li class='page-item'><span data-pageNumber=" . $data['numberofPagesPOSTING'] . " data-pagePOSTING=" . $counter . " class='page-link''>$counter</span></li>";
                            }
                        }

                        ?>
                        <li class="page-item">
                            <a class="page-link" aria-label="Next">
                                <span data-pageNumber="<?php echo ($data['numberofPagesPOSTING']) ?>" data-pagePOSTING="<?php echo ($data['pagePOSTING'] + 1) ?>" aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </th>
</tr>