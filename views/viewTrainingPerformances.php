<?php $title = 'Add Training Performance'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <h2 class="mt-4">Training Performance</h2>
    <div class="mb-3">
        <label for="participants" class="form-label">Participants:</label>
        <table class="table table-bordered" id="participants_table">
            <thead>
                <tr>
                    <th>Swimmer</th>
                    <th>Time Taken</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="participants_body">
                <?php foreach ($swimmers as $swimmer): ?>
                <tr>
                    <td><?= $swimmer['username'] ?></td>
                    <td><?= $swimmer['TimeTaken'] ?></td>
                    <td><?= $swimmer['Comment'] ?></td>
                    <td>
                        <a href="updateperformance?performanceId=<?= $swimmer['PerformanceID'] ?>"
                            class="btn btn-primary btn-sm">Edit</a>
                        <a href="deleteperformance?performanceId=<?= $swimmer['PerformanceID'] ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include 'views/layoutFooter.php'; ?>