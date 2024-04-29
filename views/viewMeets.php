<?php $title = 'View Coach'; ?>
<?php include 'views/layoutHeader.php'; ?>

<div class="d-flex justify-content-between mb-4">
    <h2>Meets Information</h2>
    <a class="btn btn-primary d-flex justify-content-center align-items-center" href="addmeet">Add New Meet</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allmeets as $meet): ?>
            <tr>
                <td><?php echo $meet['MeetName']; ?></td>
                <td class="text-nowrap"><?php echo $meet['MeetDate']; ?></td>
                <td><?php echo $meet['Location']; ?></td>
                <td>
                    <a class="btn btn-primary" href="updatemeet?meetId=<?php echo $meet['MeetID']; ?>">Edit</a>
                    <a class="btn btn-danger" href=" deletemeet?meetId=<?php echo $meet['MeetID']; ?>"
                        onclick="return confirm('Are you sure you want to delete this meet?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'views/layoutFooter.php'; ?>