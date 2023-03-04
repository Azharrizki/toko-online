<?= $this->extend('admin/layout/index'); ?>

<?= $this->section('admin-content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Data Pembayaran</h1>
    </div>

    <?= $this->include('admin/layout/alert'); ?>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabelku" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30" class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Rekening</th>
                                        <th class="text-center">Nomor Rekening</th>
                                        <th width="150" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td align="center">1</td>
                                        <td align="center"><?= $pembayaran['nama']; ?></td>
                                        <td align="center"><?= $pembayaran['rekening']; ?></td>
                                        <td align="center"><?= $pembayaran['no_rekening']; ?></td>
                                        <td align="center">
                                            <a class="btn btn-warning" href="<?= base_url('data-pembayaran/' . $pembayaran['id']); ?>"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>