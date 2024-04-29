<?php $title = 'Add Coach'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mt-4">Add New Coach</h2>
<form class="mt-4" method="post" action="<?php echo 'register' ?>">
    <div class="mb-3">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="tel" class="form-control" id="phone" name="phone">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>

        <div class="mb-3">
            <label for="postcode" class="form-label">Postcode:</label>
            <input type="text" class="form-control" id="postcode" name="postcode">
        </div>

        <input type="hidden" id="role" name="role" value="coach">

        <button type="submit" class="btn btn-primary" id="register-btn">Register</button>
    </div>
</form>

<?php include 'views/layoutFooter.php'; ?>