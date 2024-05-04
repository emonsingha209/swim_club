<?php $title = 'View Races'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <div class="d-flex justify-content-between mb-4">
        <h2>Races Information</h2>
        <?php if ($_SESSION['role'] == 'admin'): ?>
        <a class="btn btn-primary btn-sm d-flex justify-content-center align-items-center" href="addrace">Add New
            Race</a>
        <?php endif; ?>

    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Meet Name</th>
                    <th>Race Name</th>
                    <th>Distance</th>
                    <th>Stroke</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allRaces as $race): ?>
                <tr>
                    <td><?php echo $race['MeetName']; ?></td>
                    <td><?php echo $race['RaceName']; ?></td>
                    <td><?php echo $race['Distance']; ?></td>
                    <td><?php echo $race['Stroke']; ?></td>
                    <td class="text-nowrap"><?php echo $race['Date']; ?></td>
                    <td><?php echo $race['Location']; ?></td>
                    <td>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                        <a class="btn btn-success btn-sm" href="addraceresult?raceId=<?php echo $race['RaceID']; ?>">Add
                            Result</a>
                        <a class="btn btn-primary btn-sm"
                            href="updaterace?raceId=<?php echo $race['RaceID']; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="deleterace?raceId=<?php echo $race['RaceID']; ?>"
                            onclick="return confirm('Are you sure you want to delete this race?')">Delete</a>
                        <?php endif; ?>
                        <a class="btn btn-secondary btn-sm"
                            href="raceresults?raceId=<?php echo $race['RaceID']; ?>">View
                            Result</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include 'views/layoutFooter.php'; ?>