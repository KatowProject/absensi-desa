<?= $this->extend('layout/main_admin'); ?>

<?= $this->section('content') ?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="pen-tool"></i></div>
                            Jabatan List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <button class="btn btn-sm btn-light text-primary add-jabatan">
                            <i class="me-1" data-feather="plus"></i>
                            Add Jabatan
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
                            <th>No</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($jabatan as $i => $j) { ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= $j['name'] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-light edit-jabatan" data-id="<?= $j['id'] ?>">
                                        <i class="me-1" data-feather="edit-2"></i>
                                        Edit
                                    </button>

                                    <button class="btn btn-sm btn-light delete-jabatan" data-id="<?= $j['id'] ?>">
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
                <h5 class="modal-title" id="exampleModalLabel">r</h5>
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

    $('.add-jabatan').click(function() {
        $('.modal-title').text('Add Jabatan');

        $('.modal-body').html(`
            <form id="add-form">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </form>
        `);

        $('.modal-footer').html(`
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" form="add-form">Save changes</button>
        `);

        $('#modal_edit').modal('show');
    });

    $('#data').on('click', '.edit-jabatan', async function() {
        const id = $(this).data('id');
        const jabatan = await $.get('<?= base_url('admin/jabatan/') ?>' + id + '?json=true');

        $('.modal-title').text('Edit Jabatan');

        $('.modal-body').html(`
            <form id="edit-form">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="${jabatan.name}" required>
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

    $('#data').on('click', '.delete-jabatan', async function() {
        const id = $(this).data('id');

        if (confirm('Are you sure?')) {
            $.ajax({
                url: '<?= base_url('admin/jabatan/') ?>' + id,
                type: 'DELETE',
            });

            alert('Jabatan deleted successfully');
        }
    });

    $('#modal_edit').on('submit', '#add-form', async function(e) {
        e.preventDefault();

        const id = $(this).data('id');
        const name = $('#name').val();

        const data = {
            name
        };

        const res = await $.ajax({
            url: `<?= base_url('admin/jabatan') ?>`,
            method: 'POST',
            data
        });

        if (!res.success) return alert('Failed to add Jabatan');

        alert('Jabatan added successfully');

        $('#modal_edit').modal('hide');

        window.location.reload();
    });

    $('#modal_edit').on('submit', '#edit-form', async function(e) {
        e.preventDefault();

        const id = $(this).data('id');
        const name = $('#name').val();

        const data = {
            name
        };

        const res = await $.ajax({
            url: `<?= base_url('admin/jabatan/') ?>${id}`,
            method: 'PUT',
            data
        });

        if (!res.success) return alert('Failed to update Jabatan');

        alert('Jabatan updated successfully');

        $('#modal_edit').modal('hide');

        window.location.reload();
    });
</script>
<?= $this->endSection() ?>