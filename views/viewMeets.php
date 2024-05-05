<?php $title = 'View Coach'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <div class="d-flex justify-content-between mb-4">
        <h2>Meets Information</h2>
        <a class="btn btn-primary btn-sm d-flex justify-content-center align-items-center" href="addmeet">Add New
            Meet</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                    <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allmeets as $meet): ?>
                <tr>
                    <td><?php echo $meet['MeetName']; ?></td>
                    <td class="text-nowrap"><?php echo $meet['MeetDate']; ?></td>
                    <td><?php echo $meet['Location']; ?></td>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                    <td>
                        <a class="btn btn-primary btn-sm"
                            href="updatemeet?meetId=<?php echo $meet['MeetID']; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href=" deletemeet?meetId=<?php echo $meet['MeetID']; ?>"
                            onclick="return confirm('Are you sure you want to delete this meet?')">Delete</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include 'views/layoutFooter.php'; ?>