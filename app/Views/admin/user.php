<?= $this->extend('layout/main_admin'); ?>

<?= $this->section('content') ?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Users List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="<?= base_url('admin/roles') ?>">
                            <i class="me-1" data-feather="users"></i>
                            Manage Groups
                        </a>
                        <button class="btn btn-sm btn-light text-primary add-user">
                            <i class="me-1" data-feather="user-plus"></i>
                            Add New User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="data">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <?php $av = $user['jenis_kelamin'] == 'L' ? 'profile-2.png' : 'profile-1.png' ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2"><img class="avatar-img img-fluid" src="<?= base_url('assets/img/illustrations/profiles/' . $av) ?>" /></div>
                                        <?= $user['name'] ?>
                                    </div>
                                </td>

                                <td><?= $user['email'] ?></td>
                                <td><?= $user['role'] ?></td>
                                <td><?= $user['jenis_kelamin'] == 'L' ? 'Laki - Laki' : 'Perempuan' ?></td>
                                <td><?= $user['jabatan'] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-light edit-user" data-id="<?= $user['id'] ?>">
                                        <i class="me-1" data-feather="edit-2"></i>
                                        Edit
                                    </button>

                                    <button class="btn btn-sm btn-light delete-user" data-id="<?= $user['id'] ?>">
                                        <i class="me-1" data-feather="trash-2"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" form="submit-form">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new simpleDatatables.DataTable('#data');
    });

    $('#data')
        .on('click', '.edit-user', async function() {
            const id = $(this).data('id');
            const user = await $.get(`<?= base_url('admin/users/') ?>${id}?json=true`);

            $('.modal-title').html('Edit User');

            $('.modal-body').html(`
                <form id="edit-form">
                    <div class="container-xl px-2 mt-2">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" type="text" placeholder="Enter your first name" value="${user.name}" />
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email address</label>
                                    <input class="form-control" id="email" type="email" placeholder="Enter your email address" value="${user.email}" />
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" type="password" placeholder="Enter your password" />
                                    <small>Leave blank to keep the same password</small>
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin">
                                        <option value="L" ${user.jenis_kelamin == 'L' ? 'selected' : ''}>Laki - Laki</option>
                                        <option value="P" ${user.jenis_kelamin == 'P' ? 'selected' : ''}>Perempuan</option>
                                    </select>
                                </div>

                                <!-- Form Group (Roles)-->
                                <div class="mb-3">
                                    <label class="small mb-1">Role</label>
                                    <select class="form-select" id="role" aria-label="Default select example">
                                        <option value="1" ${user.role_id == 1 ? 'selected' : ''}>Admin</option>
                                        <option value="2" ${user.role_id == 2 ? 'selected' : ''}>User</option>
                                    </select>
                                </div>

                                <!-- Form Group (Jabatan)-->
                                <div class="mb-3">
                                    <label class="small mb-1">Jabatan</label>
                                    <select class="form-select" id="jabatan">
                                        <?php foreach ($jabatan as $j) { ?>
                                            <option value="<?= $j['id'] ?>" ${user.jabatan_id == <?= $j['id'] ?> ? 'selected' : ''}><?= $j['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            `);

            $('#edit-form').data('id', id);

            $('.modal-footer').html(`
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" form="edit-form">Save changes</button>
            `);

            $('#modal_edit').modal('show');
        });

    $('.add-user').on('click', function() {
        $('.modal-title').html('Add User');

        $('.modal-body').html(`
            <form id="add-form">
                <div class="container-xl px-2 mt-2">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="small mb-1" for="name">Name</label>
                                <input class="form-control" id="name" type="text" placeholder="Enter your first name" required />
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email address</label>
                                <input class="form-control" id="email" type="email" placeholder="Enter your email address" required />
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control" id="password" type="password" placeholder="Enter your password" required />
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <!-- Form Group (Roles)-->
                            <div class="mb-3">
                                <label class="small mb-1">Role</label>
                                <select class="form-select" id="role" aria-label="Default select example" required>
                                    <option value="">Pilih Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div>

                            <!-- Form Group (Jabatan)-->
                            <div class="mb-3">
                                <label class="small mb-1">Jabatan</label>
                                <select class="form-select" id="jabatan" required>
                                    <option value="">Pilih Jabatan</option>
                                    <?php foreach ($jabatan as $j) { ?>
                                        <option value="<?= $j['id'] ?>"><?= $j['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        `);

        $('.modal-footer').html(`
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" form="add-form">Save changes</button>
        `);

        $('#modal_edit').modal('show');
    });

    $('#modal_edit').on('submit', '#edit-form', async function(e) {
        e.preventDefault();

        const id = $(this).data('id');
        const name = $('#name').val();
        const email = $('#email').val();
        const role = $('#role').val();
        const jenis_kelamin = $('#jenis_kelamin').val();
        const jabatan = $('#jabatan').val();
        const password = $('#password').val();

        const data = {
            name,
            email,
            role_id: role,
            jenis_kelamin,
            jabatan_id: jabatan,
        };

        if (password) {
            data.password = password;
        }

        const res = await $.ajax({
            url: `<?= base_url('admin/users/') ?>${id}`,
            method: 'PUT',
            data,
        });

        if (!res.success) return alert('Failed to update user');

        alert('User updated successfully');

        $('#modal_edit').modal('hide');

        window.location.reload();
    });

    $('#modal_edit').on('submit', '#add-form', async function(e) {
        e.preventDefault();

        const name = $('#name').val();
        const email = $('#email').val();
        const role = $('#role').val();
        const jenis_kelamin = $('#jenis_kelamin').val();
        const jabatan = $('#jabatan').val();
        const password = $('#password').val();

        const data = {
            name,
            email,
            role_id: role,
            jenis_kelamin,
            jabatan_id: jabatan,
            password,
        };

        const res = await $.ajax({
            url: `<?= base_url('admin/users') ?>`,
            method: 'POST',
            data,
        });

        if (!res.success) return alert('Failed to add user');

        alert('User added successfully');

        $('#modal_edit').modal('hide');

        window.location.reload();
    });

    $('#data').on('click', '.delete-user', async function() {
        console.log('delete');
        if (!confirm('Are you sure to delete this user?')) return;

        const id = $(this).data('id');

        const res = await $.ajax({
            url: `<?= base_url('admin/users/') ?>${id}`,
            method: 'DELETE',
        });

        if (!res.success) return alert('Failed to delete user');

        alert('User deleted successfully');

        window.location.reload();
    });
</script>

<?= $this->endSection() ?>