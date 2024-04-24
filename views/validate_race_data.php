<?php $title = 'View Swim Performances'; ?>
<?php include 'views/includes/header.php'; ?>
<h1>Validate Race Data</h1>
<!-- Display swimmer's performance data -->
<?php foreach ($performanceData as $performance): ?>
<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title"><?= $performance['event_name'] ?></h5>
        <p class="card-text">Date: <?= $performance['event_date'] ?></p>
        <p class="card-text">Time: <?= $performance['time'] ?></p>
        <p class="card-text">Time: <?= $performance['validated'] ?></p>
        <form method="post">
            <input type="hidden" name="performance_id" value="<?= $performance['id'] ?>">
            <p>Are you sure you want to validate this race data?</p>

            <button type="submit" class="btn btn-primary">Validate</button>
        </form>
    </div>
</div>
<?php endforeach; ?>
<?php include 'views/includes/footer.php'; ?>