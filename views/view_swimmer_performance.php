<?php $title = 'View Swim Performances'; ?>
<?php include 'views/includes/header.php'; ?>
<h1>Swimmer Performance</h1>
<?php if (empty($performanceData)): ?>
<p>No performances found.</p>
<?php else: ?>
<!-- Display swimmer's performance data -->
<h1 class="mb-4">Swimmer Performance</h1>
<h2>Swimmer Details</h2>
<p>Name: <?php echo $swimmerDetails['name']; ?></p>
<p>Date of Birth: <?php echo $swimmerDetails['dob']; ?></p>
<p>Phone: <?php echo $swimmerDetails['phone']; ?></p>
<p>Address: <?php echo $swimmerDetails['address']; ?></p>
<p>Postcode: <?php echo $swimmerDetails['postcode']; ?></p>

<h2 class="mt-4">Swim Performances</h2>
<table class="table">
    <thead>
        <tr>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($performanceData as $performance): ?>
        <tr>
            <td><?php echo $performance['event_name']; ?></td>
            <td><?php echo $performance['event_date']; ?></td>
            <td><?php echo $performance['time']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2 class="mt-4">Relevant Swimmers</h2>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date of Birth</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($relevantSwimmers as $swimmer): ?>
        <tr>
            <td><?php echo $swimmer['name']; ?></td>
            <td><?php echo $swimmer['dob']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'views/includes/footer.php'; ?>