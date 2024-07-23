<?= $this->extend('layout/main_admin'); ?>

<?= $this->section('head'); ?>
<style>
    .fc-day-sun {
        /** Opacity 0.5 red */
        background-color: rgba(255, 0, 0, 0.5);
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="card mb-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="feather-icon bg-primary text-white rounded-circle"><i data-feather="activity"></i></div>
                    </div>
                    <div class="col">
                        <h5 class="mb-1">Welcome back, <?= session()->get('name') ?></h5>
                        <p class="mb-0">Your
                            <strong>Dashboard</strong> overview
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>

<?= $this->section('script') ?>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('js/datatables/datatables-simple-demo.js') ?>"></script> -->

<script>
    $(document).ready(function() {
        const calendarEl = $('#calendar')[0];
        const calendar = new FullCalendar.Calendar(calendarEl, {
            // set red for holiday
            eventColor: '#ff0000',
            initialView: 'dayGridMonth',
        });
        calendar.render();
    });
</script>
<?= $this->endSection() ?>