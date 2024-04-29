<?php $title = 'Update Race'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mb-4">Update Race</h2>

<form action="raceformupdate" method="POST">
    <input type="hidden" name="id" value="<?php echo $race['RaceID']; ?>">

    <div class="mb-3">
        <label for="meet_id" class="form-label">Update Meet:</label>
        <select id="meet_id" name="meet_id" class="form-select">
            <option value="">Select an option</option>
            <?php foreach ($allmeets as $meet): ?>
            <option value="<?php echo $meet['MeetID']; ?>"
                <?php echo ($meet['MeetName'] == $race['MeetName']) ? 'selected' : ''; ?>>
                <?php echo $meet['MeetName']; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="mb-3">
        <label for="race_name" class="form-label">Race Name:</label>
        <input type="text" class="form-control" id="race_name" name="race_name"
            value="<?php echo $race['RaceName']; ?>">
    </div>

    <div class="mb-3">
        <label for="distance" class="form-label">Distance (in meters):</label>
        <input type="text" class="form-control" id="race_distance" name="race_distance"
            value="<?php echo $race['Distance']; ?>">
    </div>

    <div class="mb-3">
        <label for="stroke" class="form-label">Stroke:</label>
        <input type="text" class="form-control" id="race_stroke" name="race_stroke"
            value="<?php echo $race['Stroke']; ?>">
    </div>

    <div class="mb-3">
        <label for="race_date" class="form-label">Race Date:</label>
        <input type="date" class="form-control" id="race_date" name="race_date" value="<?php echo $race['Date']; ?>">
    </div>

    <div class="mb-3">
        <label for="race_location" class="form-label">Race Location:</label>
        <input type="text" class="form-control" id="race_location" name="race_location"
            value="<?php echo $race['Location']; ?>">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include 'views/layoutFooter.php'; ?>