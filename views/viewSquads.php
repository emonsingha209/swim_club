<?php $title = 'View Squads'; ?>
<?php include 'views/layoutHeader.php'; ?>

<div class="d-flex justify-content-between mb-4">
    <h2>Squads Information</h2>
    <a class="btn btn-primary d-flex justify-content-center align-items-center" href="addsquad">Add New Squad</a>
</div>



<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Coach</th>
                <th>Training Days</th>
                <th>Training Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allsquads as $squad): ?>
            <tr>
                <td><?php echo $squad['squad_name']; ?></td>
                <td><?php echo isset($squad['coach_name']) ? $squad['coach_name'] : 'Not assigned yet'; ?></td>
                <td><?php echo $squad['training_days']; ?></td>
                <td><?php echo $squad['start_time'] . ' - ' . $squad['end_time']; ?></td>
                <td>
                    <a class="btn btn-success" href="squad?squadId=<?php echo $squad['squad_id']; ?>">View</a>
                    <a class="btn btn-primary" href="updatesquad?squadId=<?php echo $squad['squad_id']; ?>">Edit</a>
                    <a class="btn btn-danger" href="deletesquad?squadId=<?php echo $squad['squad_id']; ?>"
                        onclick="return confirm('Are you sure you want to delete this squad?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'views/layoutFooter.php'; ?>