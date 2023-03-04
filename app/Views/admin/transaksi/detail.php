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
                    <div class="card-header">
                        <h4>Detail Pemesan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pemesan</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" readonly name="nama" value="<?= $pemesan['nama_pembeli']; ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Total Harga</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" readonly name="harga" value="<?= number_to_currency($pemesan['total'], 'IDR'); ?>">
                            </div>
                        </div>
                        <div class=" form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" readonly name="stok" value="<?= $pemesan['alamat']; ?>">
                            </div>
                        </div>
                        <div class=" form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Telpon</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" readonly name="stok" value="<?= $pemesan['no_telp']; ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <a href="<?= base_url('data-transaksi'); ?>" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabelku" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30" class="text-center">No</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($detail_pesanan as $key) : ?>
                                        <tr>
                                            <td align="center"><?= $i++; ?></td>
                                            <td align="center"><?= $key['nama_barang']; ?></td>
                                            <td align="center"><?= $key['jumlah']; ?></td>
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