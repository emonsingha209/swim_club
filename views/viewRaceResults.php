<?php $title = 'Race Results'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mb-4">Race Results</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Swimmer Name</th>
                <th>Meet Name</th>
                <th>Race Name</th>
                <th>Time Taken</th>
                <th>Place Achieved</th>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                <th>Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allRaceResults as $raceResult): ?>
            <tr>
                <td class="text-nowrap"><?php echo $raceResult['SwimmerName']; ?></td>
                <td><?php echo $raceResult['MeetName']; ?></td>
                <td><?php echo $raceResult['RaceName']; ?></td>
                <td><?php echo $raceResult['TimeTaken']; ?></td>
                <td>
                    <?php
                    $place = $raceResult['PlaceAchieved'];
                    if ($place == 1) {
                        echo $place . 'st';
                    } elseif ($place == 2) {
                        echo $place . 'nd';
                    } elseif ($place == 3) {
                        echo $place . 'rd';
                    } else {
                        echo $place . 'th';
                    }
                    ?>
                </td>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                <td>
                    <a class="btn btn-primary btn-sm"
                        href="updaterresult?raceresultId=<?php echo $raceResult['ResultID']; ?>">Edit</a>
                    <a class="btn btn-danger btn-sm"
                        href="deleterresult?raceresultId=<?php echo $raceResult['ResultID']; ?>"
                        onclick="return confirm('Are you sure you want to delete this race?')">Delete</a>
                </td>n</th>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'views/layoutFooter.php'; ?>