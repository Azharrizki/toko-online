<?= $this->extend('admin/layout/index'); ?>

<?= $this->section('admin-content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Data Barang</h1>
    </div>

    <?= $this->include('admin/layout/alert'); ?>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= base_url('tambah-barang'); ?>" class="btn mb-3 btn-success">Tambah Data</a>
                        <div class="table-responsive">
                            <table id="tabelku" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30" class="text-center">No</th>
                                        <th class="text-center">Gambar</th>
                                        <th class="text-center">Id Barang</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Harga</th>
                                        <th width="150" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($barang as $key) : ?>
                                        <tr>
                                            <td align="center"><?= $i++; ?></td>
                                            <td align="center">
                                                <img src="<?= base_url(); ?>/img/<?= $key['nama_gambar']; ?>" height="200" width="200" alt="">
                                            </td>
                                            <td align="center"><?= $key['id']; ?></td>
                                            <td align="center"><?= $key['nama']; ?></td>
                                            <td align="center"><span class="badge badge-info"><?= $key['nama_kategori']; ?></span></td>
                                            <td align="center"><?= $key['stok']; ?></td>
                                            <td align="center"><?= number_to_currency($key['harga'], 'IDR'); ?></td>
                                            <td align="center" class="justify-content-around">
                                                <a class="btn btn-warning mr-1" href="<?= base_url('data-barang/' . $key['id']); ?>"><i class="fas fa-edit"></i></a>
                                                <button class="btn-delete btn btn-danger ml-1" type="button" data-title="Hapus Barang" data-body="#modal-delete-barang" data-id="<?= $key['id']; ?>"><i class="fa fa-trash-alt"></i></button>
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
<form class="modal-part" id="modal-delete-barang" action="/Admin/Barang/delete">
    <?= csrf_field(); ?>
    <p>Apakah anda yakin untuk menghapus barang ini?</p>
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