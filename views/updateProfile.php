<?php $title = 'Update User'; ?>
<?php include 'views/layoutHeader.php'; ?>
<section>
    <h2 class="mb-4">Update Profile</h2>

    <form action="userformupdate" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="hidden" name="username" value="<?php echo $user['username']; ?>">

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password"
                value="<?php echo $user['password']; ?>">
        </div>

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name"
                value="<?php echo $user['first_name']; ?>">
            <input type="hidden" name="current_password" value="<?php echo $user['password']; ?>">
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name"
                value="<?php echo $user['last_name']; ?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user['dob']; ?>">
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>">
        </div>

        <div class="form-group">
            <label for="postcode">Postcode:</label>
            <input type="text" class="form-control" id="postcode" name="postcode"
                value="<?php echo $user['postcode']; ?>">
        </div>

        <input type="hidden" id="role" name="role" value="<?php echo $user['role']; ?>">

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <?php if(isset($user2)): ?>
    <h2 class="mt-5">Update Children details</h2>

    <form action="userformupdate" method="POST">
        <input type="hidden" name="id" value="<?php echo $user2['id']; ?>">
        <input type="hidden" name="username" value="<?php echo $user2['username']; ?>">

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password"
                value="<?php echo $user2['password']; ?>">
        </div>

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name"
                value="<?php echo $user2['first_name']; ?>">
            <input type="hidden" name="current_password" value="<?php echo $user2['password']; ?>">
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name"
                value="<?php echo $user2['last_name']; ?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user2['email']; ?>">
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user2['dob']; ?>">
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user2['phone']; ?>">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address"
                value="<?php echo $user2['address']; ?>">
        </div>

        <div class="form-group">
            <label for="postcode">Postcode:</label>
            <input type="text" class="form-control" id="postcode" name="postcode"
                value="<?php echo $user2['postcode']; ?>">
        </div>

        <input type="hidden" id="role" name="role" value="<?php echo $user2['role']; ?>">

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <?php endif; ?>
</section>
<?php include 'views/layoutFooter.php'; ?>