<?php $title = 'Add Race'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mt-4">Add New Race</h2>
<form class="mt-4" method="post" action="<?php echo 'addrace' ?>">
    <div class="mb-3">
        <div class="mb-3">
            <label for="meet_id" class="form-label">Select Meet:</label>
            <select id="meet_id" name="meet_id" class="form-select">
                <option value="">Select an option</option>
                <?php foreach ($allmeets as $meet): ?>
                <option value="<?php echo $meet['MeetID']; ?>" data-location="<?php echo $meet['Location']; ?>">
                    <?php echo $meet['MeetName']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="race_name" class="form-label">Race Name:</label>
            <input type="text" class="form-control" id="race_name" name="race_name">
        </div>

        <div class="mb-3">
            <label for="distance" class="form-label">Distance:</label>
            <input type="text" class="form-control" id="race_distance" name="race_distance">
        </div>

        <div class="mb-3">
            <label for="stroke" class="form-label">Stroke:</label>
            <input type="text" class="form-control" id="race_stroke" name="race_stroke">
        </div>

        <div class="mb-3">
            <label for="race_date" class="form-label">Race Date:</label>
            <input type="date" class="form-control" id="race_date" name="race_date">
        </div>

        <div class="mb-3">
            <input type="checkbox" class="form-check-input" id="use_meet_location">
            <label class="form-check-label" for="use_meet_location">Use Meet Location</label><br>
            <label for="race_location" class="form-label">Race Location:</label>
            <input type="text" class="form-control" id="race_location" name="race_location">
        </div>

        <button type="submit" class="btn btn-primary" id="add-btn">Add</button>
    </div>
</form>

<script>
document.getElementById('use_meet_location').addEventListener('change', function() {
    var meetLocation = document.getElementById('meet_id').options[document.getElementById('meet_id')
        .selectedIndex].getAttribute('data-location');
    document.getElementById('race_location').value = this.checked ? meetLocation : '';
});
</script>

<?php include 'views/layoutFooter.php'; ?>