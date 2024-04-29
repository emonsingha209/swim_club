<?php $title = 'Update Squad'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mb-4">Update Squad</h2>

<form action="sqdformupdate" method="POST">
    <div class="mb-3">
        <label for="squad_name" class="form-label">Squad Name:</label>
        <input type="text" class="form-control" id="squad_name" name="squad_name"
            value="<?php echo $squad['squad_name']; ?>" <?php echo ($_SESSION['role'] != 'admin') ? 'disabled' : ''; ?>
            required>
    </div>
    <div class="mb-3">
        <label for="coach_id" class="form-label">Coach:</label>
        <select class="form-select" id="coach_id" name="coach_id"
            <?php echo ($_SESSION['role'] != 'admin') ? 'disabled' : ''; ?>>
            <option value="">Not assigned yet</option>
            <?php foreach ($coaches as $coach): ?>
            <option value="<?php echo $coach['id']; ?>"
                <?php if ($squad['coach_id'] == $coach['id']) echo 'selected'; ?>>
                <?php echo $coach['first_name'] . ' ' . $coach['last_name'] . " -  ". $coach['username']; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Training Days:</label><br>
        <?php
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            foreach ($days as $day):
                $checked = in_array($day, explode(',', $squad['training_days'])) ? 'checked' : '';
            ?>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="<?php echo strtolower($day); ?>" name="training_days[]"
                value="<?php echo $day; ?>" <?php echo $checked; ?>>
            <label class="form-check-label" for="<?php echo strtolower($day); ?>"><?php echo $day; ?></label>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="mb-3">
        <label for="start_time" class="form-label">Start Time:</label>
        <input type="time" class="form-control" id="start_time" name="start_time"
            value="<?php echo $squad['start_time']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="end_time" class="form-label">End Time:</label>
        <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo $squad['end_time']; ?>"
            required>
    </div>
    <input type="hidden" name="squad_id" value="<?php echo $squad['squad_id']; ?>">
    <button type="submit" class="btn btn-primary ">Update Squad</button>
</form>

<?php include 'views/layoutFooter.php'; ?>