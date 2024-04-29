<?php $title = 'Add Coach'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mt-4">Add New Squad</h2>
<form action="addsquad" method="post">
    <div class="mb-3">
        <label for="squad_name" class="form-label">Squad Name:</label>
        <input type="text" class="form-control" id="squad_name" name="squad_name" required>
    </div>
    <div class="mb-3">
        <label for="coach_id" class="form-label">Coach:</label>
        <select class="form-select" id="coach_id" name="coach_id">
            <option value="">Not assigned yet</option>
            <?php foreach ($coaches as $coach): ?>
            <option value="<?php echo $coach['id']; ?>">
                <?php echo $coach['first_name'] . ' ' . $coach['last_name'] . " -  ". $coach['username'] ; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Training Days:</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="monday" name="training_days[]" value="Monday">
            <label class="form-check-label" for="monday">Monday</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="tuesday" name="training_days[]" value="Tuesday">
            <label class="form-check-label" for="tuesday">Tuesday</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="wednesday" name="training_days[]" value="Wednesday">
            <label class="form-check-label" for="wednesday">Wednesday</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="thursday" name="training_days[]" value="Thursday">
            <label class="form-check-label" for="thursday">Thursday</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="friday" name="training_days[]" value="Friday">
            <label class="form-check-label" for="friday">Friday</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="friday" name="training_days[]" value="Saturday">
            <label class="form-check-label" for="saturday">Saturday</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="friday" name="training_days[]" value="Sunday">
            <label class="form-check-label" for="sunday">Sunday</label>
        </div>
    </div>
    <div class="mb-3">
        <label for="start_time" class="form-label">Start Time:</label>
        <input type="time" class="form-control" id="start_time" name="start_time" required>
    </div>
    <div class="mb-3">
        <label for="end_time" class="form-label">End Time:</label>
        <input type="time" class="form-control" id="end_time" name="end_time" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Squad</button>
</form>
<?php include 'views/layoutFooter.php'; ?>