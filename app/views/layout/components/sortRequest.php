<div class="dropdown m-2 col-md-4">
    <select id="requestDropDown" class="form-select " aria-label="Default select example" name="request-cat">
        <option value="null" <?php echo ($data['requestCategory'] == 'null') ? 'selected' : ''; ?>>All Request</option>
        <option value="1" <?php echo ($data['requestCategory'] == 1) ? 'selected' : ''; ?>>Complete</option>
        <option value="2" <?php echo ($data['requestCategory'] == 2) ? 'selected' : ''; ?>>Approved</option>
        <option value="3" <?php echo ($data['requestCategory'] == 3) ? 'selected' : ''; ?>>Pending</option>
        <option value="4" <?php echo ($data['requestCategory'] == 4) ? 'selected' : ''; ?>>Declined</option>
    </select>
</div>