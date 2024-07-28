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
            <a class="nav-link collapsed <?= $path == '/admin' ? 'active' : '' ?>" href="<?= base_url('admin') ?>" aria-expanded="false" aria-controls="dashboard">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboards
            </a>
            <a class="nav-link collapsed <?= $path == '/admin/reports' ? 'active' : '' ?>" href="<?= base_url('admin/reports') ?>">
                <div class="nav-link-icon"><i data-feather="archive"></i></div>
                Absensi
            </a>
            <!-- Sidenav Heading (Custom)-->
            <div class="sidenav-menu-heading">Database </div>
            <a class="nav-link collapsed <?= $path == '/admin/users' ? 'active' : '' ?>" href="<?= base_url('admin/users') ?>">
                <div class="nav-link-icon"><i data-feather="users"></i></div>
                Staff
            </a>

            <a class="nav-link collapsed <?= $path == '/admin/jabatan' ? 'active' : '' ?>" href="<?= base_url('admin/jabatan') ?>">
                <div class="nav-link-icon"><i data-feather="pen-tool"></i></div>
                Jabatan
            </a>

            <a class="nav-link collapsed <?= $path == '/admin/roles' ? 'active' : '' ?>" href="<?= base_url('admin/roles') ?>">
                <div class="nav-link-icon"><i data-feather="users"></i></div>
                Role
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