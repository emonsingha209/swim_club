<?php $title = 'View Races'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <h1 class="mb-4">Comparison</h1>
    <form action="compare" method="post">
        <div class="row mb-4">
            <div class="w-100 d-flex mb-3 justify-content-center"><button type="submit"
                    class="btn btn-primary">Compare</button></div>

            <div class="col-md-6">

                <div class="mb-3">
                    <label for="swimmer_id" class="form-label">Swimmer:</label>
                    <select class="form-select" id="swimmer_id" name="swimmer_id">
                        <option value="">Select a swimmer</option>
                        <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>">
                            <?php echo $user['first_name'] . ' ' . $user['last_name'] . " -  ". $user['id'] ; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <h2 class="my-4 border-bottom pb-2">Swimmer 1 Performance</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <h3 class="mb-3">Training Performance</h3>
                        <thead>
                            <tr>
                                <th>Stroke</th>
                                <th>Distance</th>
                                <th>Date</th>
                                <th>Time Taken</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trainingPerformance as $performance): ?>
                            <tr>
                                <td><?= $performance['Stroke'] ?></td>
                                <td><?= $performance['Distance'] ?></td>
                                <td><?= $performance['Date'] ?></td>
                                <td><?= $performance['TimeTaken'] ?></td>
                                <td><?= $performance['Comment'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <h3 class="mb-3">Race Performance</h3>
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
                        <tbody>
                            <?php foreach ($raceResult as $result): ?>
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
                                ?>
                                </td>
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
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="swimmer_id2" class="form-label">Swimmer:</label>
                    <select class="form-select" id="swimmer_id2" name="swimmer_id2">
                        <option value="">Select a swimmer</option>
                        <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>">
                            <?php echo $user['first_name'] . ' ' . $user['last_name'] . " -  ". $user['id'] ; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <h2 class="my-4 border-bottom pb-2">Swimmer 2 Performance</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <h3 class="mb-3">Training Performance</h3>
                        <thead>
                            <tr>
                                <th>Stroke</th>
                                <th>Distance</th>
                                <th>Date</th>
                                <th>Time Taken</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trainingPerformance2 as $performance): ?>
                            <tr>
                                <td><?= $performance['Stroke'] ?></td>
                                <td><?= $performance['Distance'] ?></td>
                                <td><?= $performance['Date'] ?></td>
                                <td><?= $performance['TimeTaken'] ?></td>
                                <td><?= $performance['Comment'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <h3 class="mb-3">Race Performance</h3>
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
                        <tbody>
                            <?php foreach ($raceResult2 as $result): ?>
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
                                ?>
                                </td>
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
            </div>
        </div>
    </form>
</section>
<?php include 'views/layoutFooter.php'; ?>