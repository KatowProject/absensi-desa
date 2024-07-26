<?php
$uri = service('uri');
$path = $uri->getPath();

// remove index.php from path
$path = str_replace('index.php/', '', $path);
?>

<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Core</div>
            <!-- Sidenav Accordion (Dashboard)-->
            <a class="nav-link collapsed <?= $path == '/' ? 'active' : '' ?>" href="<?= base_url('') ?>" aria-expanded="false" aria-controls="dashboard">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboards
            </a>
            <a class="nav-link collapsed <?= $path == '/attendance' ? 'active' : '' ?>" href="<?= base_url('attendance') ?>" aria-expanded="false" aria-controls="attedance">
                <div class="nav-link-icon"><i data-feather="bell"></i></div>
                Attendance
            </a>
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title"><?= session()->get('name') ?></div>
        </div>
    </div>
</nav>