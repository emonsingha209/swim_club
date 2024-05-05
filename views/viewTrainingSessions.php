<?php $title = 'View Races'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <div class="d-flex justify-content-between mb-4">
        <h1>Training Sessions</h1>
        <?php if ($_SESSION['role'] == 'coach'): ?>
        <a class="btn btn-primary btn-sm d-flex justify-content-center align-items-center" href="viewsquads">Add New
            Training</a>
        <?php endif; ?>

    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Distance</th>
                <th scope="col">Stroke</th>
                <?php if ($_SESSION['role'] == 'coach'): ?>
                <th scope="col">Squad Name</th>
                <th scope="col">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allsessions as $session): ?>
            <?php if ($_SESSION['role'] == 'admin' || $session['coach_id'] == $_SESSION['user_id'] || $session['squad_id'] == $_SESSION['squad_id']): ?>
            <tr>
                <td><?php echo $session['Date']; ?></td>
                <td><?php echo $session['Distance']; ?></td>
                <td><?php echo $session['Stroke']; ?></td>
                <?php if ($_SESSION['role'] == 'coach'): ?>
                <td><?php echo $session['squad_name']; ?></td>
                <td>
                    <a href="performanceform?sessionId=<?php echo $session['SessionID']; ?>&squadId=<?php echo $session['Squad_id']; ?>"
                        class="btn btn-success btn-sm">Add Performance</a>
                    <a href="viewperformances?sessionId=<?php echo $session['SessionID']; ?>"
                        class="btn btn-success btn-sm">View Performance</a>

                    <a href="updatesession?sessionId=<?php echo $session['SessionID']; ?>"
                        class="btn btn-primary btn-sm">Edit</a>
                    <a href="deletesession?sessionId=<?php echo $session['SessionID']; ?>"
                        class="btn btn-danger btn-sm">Delete</a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<?php include 'views/layoutFooter.php'; ?>