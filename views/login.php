<?php $title = 'Login'; ?>
<?php include 'views/includes/header.php'; ?>

<h2 class="mt-4">Login</h2>
<?php if (isset($error)) : ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<form class="mt-4" method="post" action="<?php echo 'login'; ?>">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>

</form>

<a class="nav-link" href="register">Register</a>

<?php include 'views/includes/footer.php'; ?>