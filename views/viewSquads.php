<?php $title = 'View Squads'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <div class="d-flex justify-content-between mb-4">
        <h2>Squads Information</h2>
        <?php if ($_SESSION['role'] == 'admin'): ?>
        <a class="btn btn-primary btn-sm d-flex justify-content-center align-items-center" href="addsquad">Add New
            Squad</a>
        <?php endif; ?>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <?php if ($_SESSION['role'] != 'coach'): ?>
                    <th>Coach</th>
                    <?php endif; ?>
                    <th>Training Days</th>
                    <th>Training Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allsquads as $squad): ?>
                <?php if ($_SESSION['role'] == 'admin' || ($squad['coach_id'] == $_SESSION['user_id'] && $_SESSION['role'] == 'coach')): ?>
                <tr>
                    <td><?php echo $squad['squad_name']; ?></td>
                    <?php if ($_SESSION['role'] != 'coach'): ?>
                    <td><?php echo isset($squad['coach_name']) ? $squad['coach_name'] : 'Not assigned yet'; ?></td>
                    <?php endif; ?>

                    <td><?php echo $squad['training_days']; ?></td>
                    <td><?php echo $squad['start_time'] . ' - ' . $squad['end_time']; ?></td>
                    <td>
                        <a class="btn btn-success btn-sm"
                            href="squad?squadId=<?php echo $squad['squad_id']; ?>">View</a>
                        <a class="btn btn-primary btn-sm"
                            href="updatesquad?squadId=<?php echo $squad['squad_id']; ?>">Edit</a>
                        <?php if ($_SESSION['role'] == 'coach'): ?>
                        <a class="btn btn-secondary btn-sm"
                            href="addsession?squadId=<?php echo $squad['squad_id']; ?>">Add
                            Training</a>
                        <?php endif; ?>

                        <?php if ($_SESSION['role'] == 'admin'): ?>
                        <a class="btn btn-danger btn-sm" href="deletesquad?squadId=<?php echo $squad['squad_id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this squad?')">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include 'views/layoutFooter.php'; ?>