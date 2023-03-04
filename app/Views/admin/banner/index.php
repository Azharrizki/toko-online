<?= $this->extend('admin/layout/index'); ?>

<?= $this->section('admin-content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Data Banner</h1>
    </div>

    <?= $this->include('admin/layout/alert'); ?>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= base_url('tambah-banner'); ?>" class="btn mb-3 btn-success">Tambah Data</a>
                        <div class="table-responsive">
                            <table id="tabelku" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30" class="text-center">No</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Gambar</th>
                                        <th width="150" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($banner as $key) : ?>
                                        <tr>
                                            <td align="center"><?= $i++; ?></td>
                                            <td align="center"><?= $key['title']; ?></td>
                                            <td align="center">
                                                <img src="<?= base_url(); ?>/img/<?= $key['image']; ?>" width="300" height="175px" alt="">
                                            </td>
                                            <td align="center" class="justify-content-around">
                                                <a class="btn btn-warning mr-1" href="<?= base_url('data-banner/' . $key['id']); ?>"><i class="fas fa-edit"></i></a>
                                                <button class="btn-delete btn btn-danger ml-1" type="button" data-title="Hapus Banner" data-body="#modal-delete-banner" data-id="<?= $key['id']; ?>"><i class="fa fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form hapus data -->
<form class="modal-part" id="modal-delete-banner" action="/Admin/Banner/delete">
    <?= csrf_field(); ?>
    <p>Apakah anda yakin untuk menghapus banner ini?</p>
    <input type="hidden" name="id" id="id">
</form>

<?= $this->endSection(); ?>
<?= $this->section('admin-script'); ?>
<script>
    $(document).on("click", ".btn-delete", function() {
        $(".modal-body #id").val($(this).data("id"));
    });

    // Show Modal Hapus Data
    $(".btn-delete").fireModal({
        title: $(".btn-delete").data("title"),
        body: $($(".btn-delete").data("body")),
        footerClass: "bg-whitesmoke",
        buttons: [{
                text: "Cancel",
                closeButton: true,
                class: "btn btn-secondary btn-shadow",
                handler: function(closeModal) {
                    $.destroyModal(closeModal);
                },
            },
            {
                text: "Hapus",
                submit: true,
                class: "btn btn-danger btn-shadow",
                handler: function(modal) {},
            },
        ],
    });
</script>
<?= $this->endSection(); ?>