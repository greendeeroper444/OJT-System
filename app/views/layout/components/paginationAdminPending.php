<tr>
    <th colspan="7">
        <div class="d-flex justify-content-between footer-margin">
            <div class="btn-group d-flex justify-content-between">
                <div class="btn-group ">
                    <div class="btn-group align-items-center">
                        <label for="pagesperrow">Row per pages</label>
                        <div class="dropdown m-2">
                            <select id="number-rowspending" class="form-select " aria-label="Default select example" name="number-rowsPENDING">
                                <option value="5" <?php echo ($data['itemPerPagePENDING'] == '5') ? 'selected' : ''; ?>>5</option>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           'itemPerPage'] == '5') ? 'selected' : ''; ?>>5</option>
                                <option value="10" <?php echo ($data['itemPerPagePENDING'] == '10') ? 'selected' : ''; ?>>10</option>
                                <option value="15" <?php echo ($data['itemPerPagePENDING'] == '15') ? 'selected' : ''; ?>>15</option>
                                <option value="20" <?php echo ($data['itemPerPagePENDING'] == '20') ? 'selected' : ''; ?>>20</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div>
                <nav aria-label="Page navigation">
                    <ul class="pagination paginationPENDING">
                        <input id="pageNumberpending" type="text" name="pageNumberPENDING" value="<?php echo $data['pagePENDING'] ?>" hidden>
                        <li class="page-item">
                            
                            <a class="page-link" aria-label="Previous">
                                <span data-pageNumber="<?php echo ($data['itemPerPagePENDING']) ?>" data-pagePENDING="<?php echo ($data['pagePENDING'] == 1) ? '1' : ($data['pagePENDING'] - 1) ?>" aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php


            for ($counter = intval($data['pagePENDING']); $counter <= intval($data['pagePENDING']) + 2 && $counter <= intval($data['numberofPagesPENDING']); $counter++) {
                            if ($counter == intval($data['pagePENDING'])) {
                                echo "<li class='page-item active'><span  data-pageNumberPENDING=" . $data['numberofPagesPENDING'] . " data-pagePENDING=" . $counter . " class='page-link' >$counter</span></li>";
                            } else {
                                echo "<li class='page-item'><span data-pageNumberPENDING=" . $data['numberofPagesPENDING'] . " data-pagePENDING=" . $counter . " class='page-link''>$counter</span></li>";
                            }
                        }

                        ?>
                        <li class="page-item">
                            <a class="page-link" aria-label="Next">
                                <span data-pageNumber="<?php echo ($data['numberofPagesPENDING']) ?>" data-pagePENDING="<?php echo ($data['pagePENDING'] + 1) ?>" aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </th>
</tr>