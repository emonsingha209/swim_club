<?php $title = 'View Swimmer'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <div class="d-flex justify-content-between mb-4">
        <h2>Swimmers Information</h2>
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
                <?php foreach ($allSwimmers as $swimmer): ?>
                <tr>
                    <td><?php echo $swimmer['username']; ?></td>
                    <td class="text-nowrap"><?php echo $swimmer['first_name'] . " ". $swimmer['last_name']; ?></td>
                    <td><?php echo $swimmer['email']; ?></td>
                    <td class="text-nowrap"><?php echo $swimmer['dob']; ?></td>
                    <td><?php echo $swimmer['phone']; ?></td>
                    <td class="text-nowrap"><?php echo $swimmer['address']; ?></td>
                    <td><?php echo $swimmer['postcode']; ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm"
                            href="updatecoach?coachId=<?php echo $swimmer['id']; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href=" deletecoach?coachId=<?php echo $swimmer['id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this coach?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include 'views/layoutFooter.php'; ?>