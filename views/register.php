<?php $title = 'Swim Club Membership Registration'; ?>
<?php include 'views/includes/header.php'; ?>

<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white py-4">
                    <h2 class="mb-0">Swim Club Membership Registration</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo 'register' ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="dob" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="postcode" class="form-label">Postcode:</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" required>
                        </div>
                        <input type="hidden" id="role" name="role" value="swimmer">

                        <!-- Parent Information -->
                        <div id="parent-info" style="display: none;">
                            <h4 class="mt-4">Parent Information</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="parent_username" class="form-label">Parent Username:</label>
                                    <input type="text" class="form-control" id="parent_username" name="parent_username">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="parent_password" class="form-label">Parent Password:</label>
                                    <input type="password" class="form-control" id="parent_password"
                                        name="parent_password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="parent_first_name" class="form-label">Parent First Name:</label>
                                    <input type="text" class="form-control" id="parent_first_name"
                                        name="parent_first_name">
                                </div>
                                <div class="col-md-6 mb -3">
                                    <label for="parent_last_name" class="form-label">Parent Last Name:</label>
                                    <input type="text" class="form-control" id="parent_last_name"
                                        name="parent_last_name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="parent_email" class="form-label">Parent Email:</label>
                                <input type="email" class="form-control" id="parent_email" name="parent_email">
                            </div>
                            <div class="mb-3">
                                <label for="parent_phone" class="form-label">Parent Phone:</label>
                                <input type="tel" class="form-control" id="parent_phone" name="parent_phone">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="use_swimmer_address"
                                    name="use_swimmer_address">
                                <label class="form-check-label" for="use_swimmer_address">Same as Swimmer's
                                    Address</label>
                            </div>
                            <div class="mb-3">
                                <label for="parent_address" class="form-label">Parent Address:</label>
                                <input type="text" class="form-control" id="parent_address" name="parent_address">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="use_swimmer_postcode"
                                    name="use_swimmer_postcode">
                                <label class="form-check-label" for="use_swimmer_postcode">Same as Swimmer's
                                    Postcode</label>
                            </div>
                            <div class="mb-3">
                                <label for="parent_postcode" class="form-label">Parent Postcode:</label>
                                <input type="text" class="form-control" id="parent_postcode" name="parent_postcode">
                            </div>
                            <input type="hidden" id="parent_role" name="parent_role" value="parent">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4"
                                    id="register-btn">
                                    <i class="fas fa-user-plus me-2"></i> Register
                                </button>
                            </div>
                            <div class="col-md-6 mb-3 d-flex justify-content-center">
                                <a href="login" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                    <i class="fas fa-arrow-left me-2"></i> Back to Login
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'views/includes/footer.php'; ?>

<script>
document.getElementById('dob').addEventListener('change', function() {
    var dob = new Date(this.value);
    var now = new Date();
    var age = now.getFullYear() - dob.getFullYear();
    if (now.getMonth() < dob.getMonth() || (now.getMonth() === dob.getMonth() && now.getDate() < dob
            .getDate())) {
        age--;
    }

    if (age < 18) {
        document.getElementById('parent-info').style.display = 'block';
    } else {
        document.getElementById('parent-info').style.display = 'none';
    }
});

// Function to auto-fill parent address and postcode from swimmer information
document.getElementById('use_swimmer_address').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('parent_address').value = document.getElementById('address').value;
    } else {
        document.getElementById('parent_address').value = '';
    }
});

document.getElementById('use_swimmer_postcode').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('parent_postcode').value = document.getElementById('postcode').value;
    } else {
        document.getElementById('parent_postcode').value = '';
    }
});
</script>