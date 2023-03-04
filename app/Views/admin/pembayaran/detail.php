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
                        <h4>Detail Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <form action="/Admin/Pembayaran/edit" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <?php echo form_hidden('id', $pembayaran['id']); ?>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pemilik</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="nama" value="<?= $pembayaran['nama']; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Rekening</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="rekening" value="<?= $pembayaran['rekening']; ?>">
                                </div>
                            </div>
                            <div class=" form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Rekening</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="no_rekening" value="<?= $pembayaran['no_rekening']; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary mr-3">Simpan</button>
                                    <a href="<?= base_url('data-pembayaran'); ?>" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>