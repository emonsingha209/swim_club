<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
</head>

<body class="bg-light">
    <?php if ($title !== "Login" && $title !== "Swim Club Membership Registration"): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-xxl flex justify-between px-3">
            <span class="navbar-brand">Swim Club</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-xxl">
        <?php endif; ?>
        <div>