<?php include 'views/includes/header.php'; ?>
<div class="row">
    <!-- Side Navigation -->
    <aside class="col-lg-1_5 border bg-white" style=" min-height: calc(100vh - 57px);">
        <div class="py-4">
            <?php if ($_SESSION['role'] == 'admin'): ?>
            <h3><a class="nav-link mb-3" href="admindashboard">Admin Dashboard</a></h3>
            <ul class="list-group">
                <li class="list-group-item"><a class="nav-link" href="viewallcoach">Coaches</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewmeets">Meets</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewraces">Races</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewsquads">Squads</a></li>
                <li class="list-group-item"><a class="nav-link" href="membership_applicants">Membership Applicants</a>
                </li>
            </ul>
            <?php elseif ($_SESSION['role'] == 'coach'): ?>
            <h3><a class="nav-link mb-3" href="coachDashboard">Coach Dashboard</a></h3>
            <ul class="list-group">
                <li class="list-group-item"><a class="nav-link" href="viewraces">Races</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewsquads">Squads</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewsessions">Training Session</a></li>
            </ul>
            <?php endif; ?>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="col-lg-4_5">
        <div class="p-4">