<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Aplikasi Sistem Informasi Absensi Desa" />
    <meta name="author" content="KKN Periode 7 Karangmulya" />
    <title><?= $title ?? 'Sistem Informasi Absensi Desa' ?></title>
    <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png') ?>" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>

    <?= $this->renderSection('head') ?>
</head>

<body class="nav-fixed">
    <?= $this->include('layout/navbar_admin') ?>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?= $this->include('layout/sidebar_admin') ?>
        </div>

        <div id="layoutSidenav_content">
            <?= $this->renderSection('content') ?>
            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &copy; Your Website 2021</div>
                        <div class="col-md-6 text-md-end small">
                            <a href="#!">Privacy Policy</a>
                            &middot;
                            <a href="#!">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/scripts.js') ?>"></script>

    <?= $this->renderSection('script') ?>
</body>

</html>