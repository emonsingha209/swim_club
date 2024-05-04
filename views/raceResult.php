<?php $title = 'Add Training Performance'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <h2 class="my-4">Race Performance</h2>
    <div class="mb-3">
        <table class="table table-bordered" id="participants_table">
            <thead>
                <tr>
                    <th>Place Achieved</th>
                    <th>RaceName</th>
                    <th>Stroke</th>
                    <th>Distance</th>
                    <th>Date</th>
                    <th>Time Taken</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody id="participants_body">
                <?php foreach ($results as $result): ?>
                <tr>
                    <td>
                        <?php
                    $place = $result['PlaceAchieved'];
                    if ($place == 1) {
                        echo $place . 'st';
                    } elseif ($place == 2) {
                        echo $place . 'nd';
                    } elseif ($place == 3) {
                        echo $place . 'rd';
                    } else {
                        echo $place . 'th';
                    }
                    ?></td>
                    <td><?= $result['RaceName'] ?></td>
                    <td><?= $result['Stroke'] ?></td>
                    <td><?= $result['Distance'] ?></td>
                    <td><?= $result['Date'] ?></td>
                    <td><?= $result['TimeTaken'] ?></td>
                    <td><?= $result['Location'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include 'views/layoutFooter.php'; ?>