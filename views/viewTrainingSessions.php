<?php $title = 'View Races'; ?>
<?php include 'views/layoutHeader.php'; ?>
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
            <th scope="col">Session ID</th>
            <th scope="col">Date</th>
            <th scope="col">Distance</th>
            <th scope="col">Stroke</th>
            <th scope="col">Squad Name</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allsessions as $session): ?>
        <tr>
            <td><?php echo $session['SessionID']; ?></td>
            <td><?php echo $session['Date']; ?></td>
            <td><?php echo $session['Distance']; ?></td>
            <td><?php echo $session['Stroke']; ?></td>
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
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'views/layoutFooter.php'; ?>