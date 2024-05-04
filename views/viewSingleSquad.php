<?php $title = 'View Squads'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h2>Squad Information</h2>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                <button id="toggleSwimmerList"
                    class="btn btn-primary btn-sm d-flex justify-content-center align-items-center">Add
                    Swimmers to Squad
                </button>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $squad['squad_name']; ?></h5>
            <p class="card-text">
                <strong>Coach:</strong>
                <?php echo isset($squad['coach_name']) ? $squad['coach_name'] : 'Not assigned yet'; ?><br>
                <strong>Training Days:</strong> <?php echo $squad['training_days']; ?><br>
                <strong>Time:</strong> <?php echo $squad['start_time'] . ' - ' . $squad['end_time']; ?>
            </p>
        </div>
    </div>

    <div id="swimmerListContainer" style="display: none;">
        <h3 class="mb-3">Swimmer List</h3>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Postcode</th>
                        <th>Squad Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allswimmers as $allswimmer): ?>
                    <?php
                    // Check if the swimmer is already in the squad
                    $isInSquad = false;
                    foreach ($swimmers as $squadMember) {
                        if ($allswimmer['id'] == $squadMember['id']) {
                            $isInSquad = true;
                            break;
                        }
                    }
                    if (!$isInSquad):
                ?>
                    <tr>
                        <td><?php echo $allswimmer['username']; ?></td>
                        <td class="text-nowrap"><?php echo $allswimmer['first_name'] . " ". $allswimmer['last_name']; ?>
                        </td>
                        <td><?php echo $allswimmer['email']; ?></td>
                        <td class="text-nowrap"><?php echo $allswimmer['dob']; ?></td>
                        <td><?php echo $allswimmer['phone']; ?></td>
                        <td class="text-nowrap"><?php echo $allswimmer['address']; ?></td>
                        <td><?php echo $allswimmer['postcode']; ?></td>
                        <td>
                            <?php 
                            if (!isset($allswimmer['squad_id']) || $allswimmer['squad_id'] === null || $allswimmer['squad_id'] === 0) {
                                echo 'Not Assigned yet';
                            } else {
                                echo 'Assigned';
                            }
                        ?>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm"
                                href="addswimmertosquad?swimmerId=<?php echo $allswimmer['id']; ?>&squadId=<?php echo $squad['squad_id']; ?>">Add
                                to Squad</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="squadMembersContainer">
        <h3 class="my-3">Squad Members</h3>

        <div class="table-responsive">
            <table class="table table-bordered">
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
                    <?php foreach ($swimmers as $swimmer): ?>
                    <tr>
                        <td><?php echo $swimmer['username']; ?></td>
                        <td class="text-nowrap"><?php echo $swimmer['first_name'] . " ". $swimmer['last_name']; ?></td>
                        <td><?php echo $swimmer['email']; ?></td>
                        <td class="text-nowrap"><?php echo $swimmer['dob']; ?></td>
                        <td><?php echo $swimmer['phone']; ?></td>
                        <td class="text-nowrap"><?php echo $swimmer['address']; ?></td>
                        <td><?php echo $swimmer['postcode']; ?></td>
                        <td>
                            <a class="btn btn-danger btn-sm"
                                href="removeswimmerfromsquad?swimmerId=<?php echo $swimmer['id']; ?>&squadId=<?php echo $squad['squad_id']; ?>"
                                onclick="return confirm('Are you sure you want to delete this swimmer?')">Remove From
                                Squad</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleSwimmerList');
    const swimmerListContainer = document.getElementById('swimmerListContainer');

    toggleButton.addEventListener('click', function() {
        if (swimmerListContainer.style.display === 'none') {
            swimmerListContainer.style.display = 'block';;
        } else {
            swimmerListContainer.style.display = 'none';
        }
    });
});
</script>

<?php include 'views/layoutFooter.php'; ?>