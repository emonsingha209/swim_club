<?php $title = 'View Coach'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <div class="d-flex justify-content-between mb-4">
        <h2>Coaches Information</h2>
        <a class="btn btn-primary btn-sm d-flex justify-content-center align-items-center" href="addCoach">Add New
            Coach</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Postcode</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allcoaches as $coach): ?>
                <tr>
                    <td><?php echo $coach['username']; ?></td>
                    <td class="text-nowrap"><?php echo $coach['first_name'] . " ". $coach['last_name']; ?></td>
                    <td><?php echo $coach['email']; ?></td>
                    <td class="text-nowrap"><?php echo $coach['dob']; ?></td>
                    <td><?php echo $coach['phone']; ?></td>
                    <td class="text-nowrap"><?php echo $coach['address']; ?></td>
                    <td><?php echo $coach['postcode']; ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="updateuser?id=<?php echo $coach['id']; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href=" deleteuser?id=<?php echo $coach['id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this coach?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include 'views/layoutFooter.php'; ?>