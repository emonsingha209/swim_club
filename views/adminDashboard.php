<?php $title = 'Admin Dashboard'; ?>
<?php include 'views/layoutHeader.php'; ?>

<section>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Swimmer</h5>
                    <p class="card-text">
                        <?= $swimmernumber ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Coach</h5>
                    <p class="card-text"><?= $coachnumber ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Squad</h5>
                    <p class="card-text"><?= $squadnumber ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Manage Applications</h5>
                    <p class="card-text">Approve membership applications of new swimmers.</p>
                    <a href="#" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Manage Race</h5>
                    <p class="card-text">Create, edit, and delete races. Manage results of existing races.</p>
                    <a href="viewraces" class="btn btn-primary">Go to Races</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Manage Squad</h5>
                    <p class="card-text">Assign coach to squad and manage swimmers.</p>
                    <a href="viewsquads" class="btn btn-primary">Go to Squads</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'views/layoutFooter.php'; ?>