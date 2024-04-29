<?php $title = 'Add Training Session'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mb-4">Training Session Form</h2>
<form action="sessionform" method="post">
    <div class="mb-3">
        <label for="session_date" class="form-label">Date:</label>
        <input type="date" class="form-control" id="session_date" name="session_date" required>
    </div>
    <div class="mb-3">
        <label for="session_distance" class="form-label">Distance (in meters):</label>
        <input type="number" class="form-control" id="session_distance" name="session_distance" min="0" step="0.01"
            required>
    </div>
    <div class="mb-3">
        <label for="session_stroke" class="form-label">Stroke:</label>
        <input type="text" class="form-control" id="session_stroke" name="session_stroke" required>
    </div>

    <input type="hidden" id="squad_id" name="squad_id" value="<?php echo $squadId; ?>">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php include 'views/layoutFooter.php'; ?>