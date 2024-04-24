<?php $title = 'View Swim Performances'; ?>
<?php include 'views/includes/header.php'; ?>

<h1 class="mb-4">Swim Performances</h1>
<?php if (empty($performances)): ?>
<p>No performances found.</p>
<?php else: ?>
<table class="table">
    <thead>
        <tr>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Time (s)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($performances as $performance): ?>
        <tr>
            <td><?php echo $performance['event_name']; ?></td>
            <td><?php echo $performance['event_date']; ?></td>
            <td><?php echo $performance['time']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?php include 'views/includes/footer.php'; ?>