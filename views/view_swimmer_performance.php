<?php $title = 'View Swim Performances'; ?>
<?php include 'views/includes/header.php'; ?>
<h1>Swimmer Performance</h1>
<!-- Display swimmer's performance data -->
<?php foreach ($performanceData as $performance): ?>
<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title"><?= $performance['event_name'] ?></h5>
        <p class="card-text">Date: <?= $performance['event_date'] ?></p>
        <p class="card-text">Time: <?= $performance['time'] ?></p>
        <p class="card-text">Time: <?= $performance['validated'] ?></p>
    </div>
</div>
<?php endforeach; ?>
<?php include 'views/includes/footer.php'; ?>