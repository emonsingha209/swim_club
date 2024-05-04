<?php $title = 'Update Training Performance'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <h2 class="mt-4">Update Training Performance</h2>
    <div class="mb-3">
        <form action="actionupdateperformance" method="post">
            <input type="hidden" name="id" value="<?= $trainingPerformance['PerformanceID'] ?>">
            <input type="hidden" name="session_id" value="<?= $trainingPerformance['SessionID'] ?>">
            <input type="hidden" name="swimmer_id" value="<?= $trainingPerformance['Swimmer_id'] ?>">
            <div class="form-group mb-3">
                <label for="time_taken">Time Taken:</label>
                <input type="text" class="form-control" id="time_taken" name="time_taken"
                    value="<?= $trainingPerformance['TimeTaken'] ?>">
            </div>
            <div class="form-group mb-3">
                <label for="comment">Comment:</label>
                <textarea class="form-control" id="comment"
                    name="comment"><?= $trainingPerformance['Comment'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</section>
<?php include 'views/layoutFooter.php'; ?>