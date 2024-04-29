<?php $title = 'View Races'; ?>
<?php include 'views/layoutHeader.php'; ?>
<div class="d-flex justify-content-between mb-4">
    <h2>Races Information</h2>
    <a class="btn btn-primary d-flex justify-content-center align-items-center" href="addrace">Add New Race</a>
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
                    <a class="btn btn-success" href="addraceresult?raceId=<?php echo $race['RaceID']; ?>">Add
                        Result</a>
                    <a class="btn btn-secondary" href="raceresults?raceId=<?php echo $race['RaceID']; ?>">View
                        Result</a>
                    <a class="btn btn-primary" href="updaterace?raceId=<?php echo $race['RaceID']; ?>">Edit</a>
                    <a class="btn btn-danger" href="deleterace?raceId=<?php echo $race['RaceID']; ?>"
                        onclick="return confirm('Are you sure you want to delete this race?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'views/layoutFooter.php'; ?>