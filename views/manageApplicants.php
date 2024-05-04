<?php $title = 'Admin Dashboard'; ?>
<?php include 'views/layoutHeader.php'; ?>

<section>
    <h2 class="text-center mb-4">Applicant Approval</h2>
    <div class="table-responsive">
        <table class="table table-striped">
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
                <?php foreach ($applicants as $applicant): ?>
                <tr>
                    <td><?= $applicant['username'] ?></td>
                    <td class="text-nowrap"><?= $applicant['first_name'] . " " . $applicant['last_name'] ?></td>
                    <td><?= $applicant['email'] ?></td>
                    <td><?= $applicant['dob'] ?></td>
                    <td><?= $applicant['phone'] ?></td>
                    <td><?= $applicant['address'] ?></td>
                    <td><?= $applicant['postcode'] ?></td>
                    <td class="d-flex flex-nowrap gap-2">
                        <form action="handle_approve" method="post">
                            <input type="hidden" name="applicant_id" value="<?= $applicant['id'] ?>">
                            <input type="hidden" name="parent_id" value="<?= $applicant['parent_id'] ?>">
                            <button type="submit" name="approve_applicant" class="btn btn-success btn-sm"><i
                                    class="fa-regular fa-circle-check me-1"></i>Approve</button>
                        </form>
                        <a class="btn btn-danger btn-sm" href="rejectapplicants?id=<?php echo $applicant['id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this?')"><i
                                class="fa-regular fa-circle-xmark me-1"></i>Reject</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'views/layoutFooter.php'; ?>