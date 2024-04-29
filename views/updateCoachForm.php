<?php $title = 'Update Coach'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mb-4">Update Coach</h2>

<form action="coachformupdate" method="POST">
    <input type="hidden" name="id" value="<?php echo $coach['id']; ?>">

    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $coach['username']; ?>">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password"
            value="<?php echo $coach['password']; ?>">
    </div>

    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" id="first_name" name="first_name"
            value="<?php echo $coach['first_name']; ?>">
        <input type="hidden" name="current_password" value="<?php echo $coach['password']; ?>">
    </div>

    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" id="last_name" name="last_name"
            value="<?php echo $coach['last_name']; ?>">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $coach['email']; ?>">
    </div>

    <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $coach['dob']; ?>">
    </div>

    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $coach['phone']; ?>">
    </div>

    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo $coach['address']; ?>">
    </div>

    <div class="form-group">
        <label for="postcode">Postcode:</label>
        <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $coach['postcode']; ?>">
    </div>

    <input type="hidden" id="role" name="role" value="coach">

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include 'views/layoutFooter.php'; ?>