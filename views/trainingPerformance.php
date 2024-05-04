<?php $title = 'Add Training Performance'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <h2 class="mt-4">Training Performance</h2>
    <div class="mb-3">
        <label for="participants" class="form-label">Participants:</label>
        <table class="table table-bordered" id="participants_table">
            <thead>
                <tr>
                    <th>Stroke</th>
                    <th>Distance</th>
                    <th>Date</th>
                    <th>Time Taken</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody id="participants_body">
                <?php foreach ($performances as $performance): ?>
                <tr>
                    <td><?= $performance['Stroke'] ?></td>
                    <td><?= $performance['Distance'] ?></td>
                    <td><?= $performance['Date'] ?></td>
                    <td><?= $performance['TimeTaken'] ?></td>
                    <td><?= $performance['Comment'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include 'views/layoutFooter.php'; ?>