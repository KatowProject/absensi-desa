<?= $this->extend('layout/main_admin') ?>

<?= $this->section('head') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<style>
    .vertical-center {
        vertical-align: middle !important;
    }

    thead tr th {
        /* set better background */
        background-color: #f8f9fc;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="archive"></i></div>
                            Absensi
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <form method="GET">
                            <h5>Filter</h5>

                            <!-- set  -->
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <select name="tahun" id="tahun" class="form-control" required>
                                            <option value="">Pilih Tahun</option>
                                            <?php for ($i = 2021; $i <= date('Y'); $i++) { ?>
                                                <option value="<?= $i ?>" <?= $i == $year ? 'selected' : '' ?>><?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <select name="bulan" id="bulan" class="form-control" required>
                                            <option value="">Pilih Bulan</option>
                                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                <option value="<?= $i ?>" <?= $i == $month ? 'selected' : '' ?>><?= date('F', strtotime("2021-$i-01")) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <!-- submit -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="mb-3">
                            <!-- export button -->
                            <div class="btn-group">
                                <a class="btn btn-success" href="<?= base_url('admin/reports/export') ?>?tahun=<?= $year ?>&bulan=<?= $month ?>" target="_blank">
                                    <div class="page-header-icon me-2"><i data-feather="file-text"></i></div>
                                    Export
                                </a>
                            </div>
                        </div>
                        <table id="data" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="vertical-center">Name</th>
                                    <th rowspan="2" class="vertical-center">Jabatan</th>
                                    <th colspan="<?= $days ?>">Hari/Tanggal</th>
                                </tr>

                                <tr>
                                    <?php for ($i = 1; $i <= $days; $i++) { ?>
                                        <!-- check if is weekend -->
                                        <?php
                                        $dayOfWeek = date('N', strtotime(sprintf('%s-%02d-%02d', $year, $month, $i)));
                                        if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                                            $class = 'bg-danger text-white';
                                        } else {
                                            $class = '';
                                        }
                                        ?>
                                        <th class="<?= $class ?>">
                                            <?= $i ?>
                                            <br>
                                            <?= date('D', strtotime(sprintf('%s-%02d-%02d', $year, $month, $i))) ?>
                                        </th>
                                    <?php } ?>

                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($users as $s) { ?>
                                    <tr>
                                        <td class="vertical-center"><?= $s['name'] ?></td>
                                        <td class="vertical-center"><?= $s['jabatan'] ?></td>
                                        <?php foreach ($s['attedance'] as $a) : ?>
                                            <td class="vertical-center">
                                                <?php if ($a['status'] == 'Alpa') : ?>
                                                    <span class="badge bg-danger"><?= $a['status'] ?></span>
                                                <?php elseif ($a['status'] == 'Hadir') : ?>
                                                    <span class="badge bg-success"><?= $a['status'] ?></span>
                                                    <?= date('H:i', strtotime($a['time'])) ?>
                                                <?php elseif ($a['status'] == 'Libur') : ?>
                                                    -
                                                <?php elseif ($a['status'] == 'Belum Terlaksana') : ?>
                                                    -
                                                <?php elseif ($a['status'] == 'Izin') : ?>
                                                    <span class="badge bg-warning"><?= $a['status'] ?></span>
                                                    <?= date('H:i', strtotime($a['time'])) ?>
                                                <?php endif ?>
                                            </td>
                                        <?php endforeach ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('select').select2({
        theme: 'bootstrap-5'
    });
</script>
<?= $this->endSection() ?>