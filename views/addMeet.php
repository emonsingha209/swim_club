<?php $title = 'Add Coach'; ?>
<?php include 'views/adminMenuHeader.php'; ?>

<h2 class="mt-4">Add New Meet</h2>
<form class="mt-4" method="post" action="<?php echo 'addmeet' ?>">
    <div class="mb-3">
        <div class="mb-3">
            <label for="meet_name" class="form-label">Meet Name:</label>
            <input type="text" class="form-control" id="meet_name" name="meet_name">
        </div>

        <div class="mb-3">
            <label for="meet_date" class="form-label">Meet Date:</label>
            <input type="date" class="form-control" id="meet_date" name="meet_date">
        </div>

        <div class="mb-3">
            <label for="meet_location" class="form-label">Meet Location:</label>
            <input type="text" class="form-control" id="meet_location" name="meet_location">
        </div>

        <button type="submit" class="btn btn-primary" id="register-btn">Register</button>
    </div>
</form>
<?php include 'views/adminMenuFooter.php'; ?>