<?php $title = 'Update Coach'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mb-4">Update Meet</h2>

<form action="meetformupdate" method="POST">
    <input type="hidden" name="id" value="<?php echo $meet['MeetID']; ?>">

    <div class="mb-3">
        <label for="meet_name" class="form-label">Meet Name:</label>
        <input type="text" class="form-control" id="meet_name" name="meet_name"
            value="<?php echo $meet['MeetName']; ?>">
    </div>

    <div class="mb-3">
        <label for="meet_date" class="form-label">Meet Date:</label>
        <input type="date" class="form-control" id="meet_date" name="meet_date"
            value="<?php echo $meet['MeetDate']; ?>">
    </div>

    <div class="mb-3">
        <label for="meet_location" class="form-label">Meet Location:</label>
        <input type="text" class="form-control" id="meet_location" name="meet_location"
            value="<?php echo $meet['Location']; ?>">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include 'views/layoutFooter.php'; ?>