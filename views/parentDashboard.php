<?php $title = 'Add Coach'; ?>
<?php include 'views/layoutHeader.php'; ?>

<section>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Training Sessions</h5>
                    <p class="card-text">View your child training sessions</p>
                    <a href="viewsessions" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Training Performance</h5>
                    <p class="card-text">View your Child training performance</p>
                    <a href="performancedata" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Race Result</h5>
                    <p class="card-text">View your child race result</p>
                    <a href="dataraceresult" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'views/layoutFooter.php'; ?>