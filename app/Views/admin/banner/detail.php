<?= $this->extend('admin/layout/index'); ?>
<?= $this->section('admin-content'); ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= base_url('data-banner'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Edit Banner</h1>
    </div>

    <?= $this->include('admin/layout/alert'); ?>

    <div class="section-body">
        <h2 class="section-title">Create New Item</h2>
        <p class="section-lead">
            On this page you can create a new item and fill in all fields.
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Write Your Item</h4>
                    </div>
                    <div class="card-body">
                        <form action="/Admin/Banner/edit" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <?php echo form_hidden('id', $banner['id']); ?>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Meta Text</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="meta_text" value="<?= $banner['meta_text']; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="title" value="<?= $banner['title']; ?>">
                                </div>
                            </div>
                            <div class=" form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="d-flex flex-wrap">
                                        <img style="width: auto; margin:0 20px 10px 0; height: 200px;" src="<?= base_url(); ?>/img/<?= $banner['image']; ?>" alt="">
                                    </div>
                                    <input class="form-control-file" id="images" type="file" name="image">
                                    <div style="display: flex;" id="preview-images"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary  mr-3" type="submit">Simpan</button>
                                    <a href="<?= base_url('data-banner'); ?>" class="btn btn-secondary">Kembali</a>
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

<?= $this->section('admin-script'); ?>
<script>
    $(document).ready(function() {
        $("#images").change(function() {
            $("#preview-images").empty();
            var total_file = document.getElementById("images").files.length;
            for (var i = 0; i < total_file; i++) {
                $("#preview-images").append("<img style='margin:10px 20px 10px 0;' src='" + URL.createObjectURL(event.target.files[i]) + "' height='200'><br>");
            }
        });
    });
</script>
<?= $this->endSection(); ?>