<?= $this->extend('layout/main_admin') ?>

<?= $this->section('content') ?>
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="bell"></i></div>
                            Attendance
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center" style="height: 200px;">
                    <?php if ($absensi) : ?>
                        <div class="col-12">
                            <div class="alert alert-success" role="alert">
                                Anda sudah melakukan absensi hari ini
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="col-12">
                            <h5 class="text-center">Date:
                                <b><?= date('d F Y') ?></b>
                            </h5>
                        </div>

                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <!-- radio hadir, izin, sakit -->
                            <div class="row justify-content-center text-center">
                                <div class="col-12 col-md-12">
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="hadir" value="1" checked>
                                        <label class="form-check-label" for="hadir">Hadir</label>
                                    </div>

                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="izin" value="2">
                                        <label class="form-check-label" for="izin">Izin</label>
                                    </div>

                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="sakit" value="3">
                                        <label class="form-check-label" for="sakit">Sakit</label>
                                    </div>
                                </div>


                                <div class="row justify-content-center text-center mt-3" id="reason-container" style="display: none;">
                                    <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" id="reason" name="reason" placeholder="Masukkan alasan">
                                    </div>
                                </div>


                                <div class="col-12 mt-5">
                                    <button class="btn btn-primary" id="absen">Absen</button>
                                </div>
                            </div>

                        <?php endif ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        // if choose izin or sakit, show reason input
        $('input[type=radio][name=status]').change(function() {
            if (this.value == 2 || this.value == 3) {
                $('#reason-container').show();
            } else {
                $('#reason-container').hide();
            }
        });
    });
</script>
<?= $this->endSection() ?>