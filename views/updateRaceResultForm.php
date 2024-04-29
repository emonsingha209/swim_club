<?php $title = 'Update Race'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mb-4">Update Race Result </h2>

<form action="rresultformupdate" method="POST">
    <input type="hidden" name="id" value="<?php echo $raceResult['ResultID']; ?>">

    <div class="mb-3">
        <label for="race_id" class="form-label">Race</label>
        <select class="form-select" name="race_id" id="race_id" required>
            <option value="">Select Race</option>
            <?php foreach ($allRaces as $race): ?>
            <?php $selected = ($race['RaceName'] == $raceResult['RaceName']) ? 'selected' : ''; ?>
            <option value="<?php echo $race['RaceID']; ?>" <?php echo $selected; ?>>
                <?php echo $race['RaceName']; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="swimmer_id" class="form-label">Swimmer</label>
        <select class="form-select" name="swimmer_id" id="swimmer_id" required>
            <option value="">Select Swimmer</option>
            <?php foreach ($allSwimmers as $swimmer): ?>
            <?php $selected = ($swimmer['first_name']." ".$swimmer['last_name'] . " - " .$swimmer['username'] == $raceResult['SwimmerName']) ? 'selected' : ''; ?>
            <option value="<?php echo $swimmer['id']; ?>" <?php echo $selected; ?>>
                <?php echo $swimmer['first_name']." ".$swimmer['last_name'] . " - " .$swimmer['username'] ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3 d-flex gap-3 align-items-center">
        <div><label class="form-label mb-0">Time Taken:</label></div>
        <div class="row">
            <div class="col d-flex gap-3 align-items-center">
                <input type="number" class="form-control" id="hours" name="hours" min="0" max="99"
                    value="<?= $raceResult["hours"]; ?>" required>
                <label for="hours" class="form-label mb-0">Hours</label>
            </div>
            <div class="col d-flex gap-3 align-items-center">
                <input type="number" class="form-control" id="minutes" name="minutes" min="0" max="59"
                    value="<?= $raceResult["minutes"]; ?>" required>
                <label for="minutes" class="form-label mb-0">Minutes</label>
            </div>
            <div class="col d-flex gap-3 align-items-center">
                <input type="number" class="form-control" id="seconds" name="seconds" min="0" max="59"
                    value="<?= $raceResult["seconds"]; ?>" required>
                <label for="seconds" class="form-label mb-0">Seconds</label>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="place_achieved" class="form-label">Place Achieved</label>
        <input type="number" class="form-control" id="place_achieved" name="place_achieved"
            value="<?= $raceResult["PlaceAchieved"]; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include 'views/layoutFooter.php'; ?>