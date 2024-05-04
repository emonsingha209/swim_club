<?php $title = 'Add Coach'; ?>
<?php include 'views/layoutHeader.php'; ?>

<section>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Personal Best Times</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>50m Freestyle</td>
                                <td>25.32s</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Races</h5>
                    <ul class="list-group">
                        <li class="list-group-item">Race 1</li>
                        <li class="list-group-item">Race 2</li>
                        <!-- Add more races as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Training Schedule</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Session</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Monday</td>
                                <td>6:00 PM</td>
                                <td>Strength Training</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Squad Announcements</h5>
                    <ul class="list-group">
                        <li class="list-group-item">Announcement 1</li>
                        <li class="list-group-item">Announcement 2</li>
                        <!-- Add more announcements as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'views/layoutFooter.php'; ?>