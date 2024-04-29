<?php $title = 'Add Training Performance'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mt-4">Add New Training Performance</h2>
<form class="mt-4" method="post" action="addperformance">
    <input type="hidden" id="session_id" name="session_id" value="<?= $sessionId ?>">

    <div class="mb-3">
        <label for="participants" class="form-label">Participants:</label>
        <table class="table table-bordered" id="participants_table">
            <thead>
                <tr>
                    <th>Swimmer</th>
                    <th>Time Taken</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody id="participants_body">
                <?php foreach ($swimmers as $swimmer): ?>
                <tr>
                    <td>
                        <?= $swimmer['username'] ?>
                        <input type="hidden" name="swimmer_id[]" value="<?= $swimmer['id'] ?>">
                    </td>
                    <td>
                        <div class="row">
                            <div class="col d-flex gap-3 align-items-center">
                                <input type="number" class="form-control" name="time_hours[]" min="0" max="99" value="0"
                                    required>
                                <label class="form-label mb-0">Hours</label>
                            </div>
                            <div class="col d-flex gap-3 align-items-center">
                                <input type="number" class="form-control" name="time_minutes[]" min="0" max="59"
                                    value="0" required>
                                <label class="form-label mb-0">Minutes</label>
                            </div>
                            <div class="col d-flex gap-3 align-items-center">
                                <input type="number" class="form-control" name="time_seconds[]" min="0" max="59"
                                    value="0" required>
                                <label class="form-label mb-0">Seconds</label>
                            </div>
                        </div>
                    </td>
                    <td><input type="text" class="form-control" name="comment[]" required></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include 'views/layoutFooter.php'; ?>