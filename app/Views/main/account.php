<?= $this->extend('layout/main_admin') ?>

<?= $this->section('content') ?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Pengaturan Akun - Profil
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <?php
        $success = session()->getFlashdata('success');
        $err = session()->getFlashdata('error');
        ?>

        <?php if ($success) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $success ?>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($err) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $err ?>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="#!">Profil</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Detail Akun</div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Nama</label>
                                <input class="form-control" id="name" name="name" type="text" placeholder="Isi nama" value="<?= $user['name'] ?>" required />
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email" placeholder="Isi Email" value="<?= $user['email'] ?>" required />
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="L" <?= $user['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= $user['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control" id="password" name="password" type="password" placeholder="Isi Password" value="" />
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti password</small>
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>