<?php include 'views/includes/header.php'; ?>
<div class="row">
    <!-- Side Navigation -->
    <aside class="col-lg-1_5 border bg-white" style=" min-height: calc(100vh - 57px);">
        <div class="py-4">
            <?php if ($_SESSION['role'] == 'admin'): ?>
            <span class="card py-2 px-3 nav-link mb-3">
                <i class="fas fa-user position-absolute top-50 start-0 translate-middle-y ms-3 text-primary"></i>
                <span class="ps-4">ADMIN</span></span>
            <ul class="list-group">
                <li class="list-group-item"><a class="nav-link" href="admindashboard"><i
                            class="fa-solid fa-gauge me-2 text-primary"></i>Dashboard</a>
                </li>
                <li class="list-group-item"><a class="nav-link" href="manageapplicants"><i
                            class="fa-solid fa-person-circle-check me-2 text-primary"></i>Membership Applications</a>
                </li>
                <li class="list-group-item"><a class="nav-link" href="viewallcoach"><i
                            class="fa-solid fa-person-chalkboard me-2 text-primary"></i>Coaches</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewallswimmer"><i
                            class="fa-solid fa-person-swimming me-2 text-primary"></i>Swimmers</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewmeets"><i
                            class="fa-brands fa-meetup me-2 text-primary"></i>Meets</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewraces"><i
                            class="fa-solid fa-person-running me-2 text-primary"></i>Races</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewsquads"><i
                            class="fa-solid fa-people-line me-2 text-primary"></i>Squads</a></li>
                <li class="list-group-item"><a class="nav-link" href="compare"><i
                            class="fa-solid fa-v me-2 text-primary"></i>Comparison</a></li>

            </ul>
            <?php elseif ($_SESSION['role'] == 'coach'): ?>
            <a class="card py-2 px-3 nav-link mb-3" href="profile">
                <i class="fas fa-user position-absolute top-50 start-0 translate-middle-y ms-3 text-primary"></i>
                <span class="ps-4"><?php echo $_SESSION['name']; ?></span></a>
            <ul class="list-group">
                <li class="list-group-item"><a class="nav-link" href="coachDashboard"><i
                            class="fa-solid fa-gauge me-2 text-primary"></i>Dashboard</a>
                </li>
                <li class="list-group-item"><a class="nav-link" href="viewsquads"><i
                            class="fa-solid fa-people-line me-2 text-primary"></i>Squads</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewsessions"><i
                            class="fa-solid fa-calendar-days me-2 text-primary"></i>Training Session</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewraces"><i
                            class="fa-solid fa-person-running me-2 text-primary"></i>Races</a></li>
                <li class="list-group-item"><a class="nav-link" href="viewmeets"><i
                            class="fa-brands fa-meetup me-2 text-primary"></i>Meets</a></li>
                <li class="list-group-item"><a class="nav-link" href="compare"><i
                            class="fa-solid fa-v me-2 text-primary"></i>Comparison</a></li>
            </ul>
            <?php elseif ($_SESSION['role'] == 'swimmer' || $_SESSION['role'] == 'parent'): ?>
            <a class="card py-2 px-3 nav-link mb-3" href="profile">
                <i class="fas fa-user position-absolute top-50 start-0 translate-middle-y ms-3 text-primary"></i>
                <span class="ps-4"><?php echo $_SESSION['name']; ?></span></a>
            <ul class="list-group">
                <?php if ($_SESSION['role'] == 'swimmer'): ?>
                <li class="list-group-item"><a class="nav-link" href="swimmerdashboard"><i
                            class="fa-solid fa-gauge me-2 text-primary"></i>Dashboard</a>
                </li>
                <?php endif; ?>
                <?php if ($_SESSION['role'] == 'parent'): ?>
                <li class="list-group-item"><a class="nav-link" href="parentdashboard"><i
                            class="fa-solid fa-gauge me-2 text-primary"></i>Dashboard</a>
                </li>
                <?php endif; ?>
                <li class="list-group-item"><a class="nav-link" href="viewsessions"><i
                            class="fa-solid fa-calendar-days me-2 text-primary"></i>Training Schedule</a>
                </li>
                <li class="list-group-item"><a class="nav-link" href="performancedata"><i
                            class="fa-solid fa-chart-line me-2 text-primary"></i>Training Performance</a>
                </li>
                <li class="list-group-item"><a class="nav-link" href="viewraces"><i
                            class="fa-solid fa-person-running me-2 text-primary"></i>Races</a></li>
                <li class="list-group-item"><a class="nav-link" href="dataraceresult"><i
                            class="fa-solid fa-square-poll-vertical me-2 text-primary"></i>Race Results</a></li>
                <li class="list-group-item"><a class="nav-link" href="compare"><i
                            class="fa-solid fa-v me-2 text-primary"></i>Comparison</a></li>
            </ul>
            <?php endif; ?>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="col-lg-4_5">
        <div class="p-4">