<?= $this->extend('admin/layout/index'); ?>

<?= $this->section('admin-content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Data Transaksi</h1>
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
                                        <th class="text-center">Id Pemesanan</th>
                                        <th class="text-center">Nama Pemesan</th>
                                        <th class="text-center">No Telpon</th>
                                        <th class="text-center">Total</th>
                                        <th width="150" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($transaksi as $key) : ?>
                                        <tr>
                                            <td align="center"><?= $i++; ?></td>
                                            <td align="center"><?= $key['id']; ?></td>
                                            <td align="center"><?= $key['nama_pembeli']; ?></td>
                                            <td align="center"><?= $key['no_telp']; ?></td>
                                            <td align="center"><?= number_to_currency($key['total'], 'IDR'); ?></td>
                                            <td align="center" class="justify-content-around">
                                                <a class="btn btn-warning mr-1" href="<?= base_url('data-transaksi/' . $key['id']); ?>">Detail</i></a>
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
<?= $this->endSection(); ?>