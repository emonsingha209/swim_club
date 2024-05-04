<?php $title = 'Login'; ?>
<?php include 'views/includes/header.php'; ?>

<section class="d-flex justify-content-center align-items-center"
    style="height: 100vh; background: linear-gradient(135deg, #56ccf2, #2f80ed);">
    <div class="login-container bg-white rounded-3 shadow p-4">
        <h2 class="text-center mb-4 text-primary">Swimming Club Login</h2>
        <?php if (isset($error)) : ?>
        <div class="alert alert-danger text-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo 'login'; ?>">
            <div class="form-group position-relative mb-3">
                <i class="fas fa-user position-absolute top-50 start-0 translate-middle-y ms-3 text-primary"></i>
                <input type="text" class="form-control rounded-pill ps-5" id="username" name="username"
                    placeholder="Username" required>
            </div>
            <div class="form-group position-relative mb-4">
                <i class="fas fa-lock position-absolute top-50 start-0 translate-middle-y ms-3 text-primary"></i>
                <input type="password" class="form-control rounded-pill ps-5" id="password" name="password"
                    placeholder="Password" required>
            </div>
            <div class="d-grid gap-2 mb-3">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill fw-bold">Login</button>
                    <a href="register" class="btn btn-outline-primary rounded-pill fw-bold">Register</a>
                </div>
        </form>
    </div>
    </div>

    <?php include 'views/includes/footer.php'; ?>