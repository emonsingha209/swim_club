<?php $title = 'User Profile'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">User Profile</h4>

                </div>
                <div class="position-absolute top-0 end-0 mt-5 me-1">
                    <a href="profileupdate" class="btn btn-primary btn-sm">Edit</a>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="fw-bold">Username:</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted"><?= $user['username'] ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="fw-bold">First Name:</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted"><?= $user['first_name'] ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="fw-bold">Last Name:</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted"><?= $user['last_name'] ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="fw-bold">Email:</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted"><?= $user['email'] ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="fw-bold">Date of Birth:</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted"><?= $user['dob'] ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="fw-bold">Phone:</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted"><?= $user['phone'] ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="fw-bold">Address:</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted"><?= $user['address'] ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="fw-bold">Postcode:</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted"><?= $user['postcode'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'views/layoutFooter.php'; ?>