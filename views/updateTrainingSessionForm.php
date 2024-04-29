<?php $title = 'Update Squad'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h1>Update Training Session</h1>
<form action="sessionformupdate" method="POST">
    <input type="hidden" name="id" value="<?php echo $session['SessionID']; ?>">
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="<?php echo $session['Date']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="distance" class="form-label">Distance</label>
        <input type="number" class="form-control" id="distance" name="distance"
            value="<?php echo $session['Distance']; ?>" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="stroke" class="form-label">Stroke</label>
        <input type="text" class="form-control" id="stroke" name="stroke" value="<?php echo $session['Stroke']; ?>"
            required>
    </div>
    <div class="mb-3">
        <label for="squad_id" class="form-label">Squad ID</label>
        <input type="number" class="form-control" id="squad_id" name="squad_id"
            value="<?php echo $session['Squad_id']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Session</button>
</form>

<?php include 'views/layoutFooter.php'; ?>