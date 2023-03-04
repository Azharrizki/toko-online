<?= $this->extend('guest/layout/index'); ?>

<?= $this->section('guest-content'); ?>

<!-- page title area start  -->
<section class="page-title-area" data-background="assets/img/bg/page-title-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-wrapper text-center">
                    <h1 class="page-title mb-10">Katalog</h1>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>Katalog</span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page title area end  -->


<!-- shop main area start  -->
<div class="shop-main-area pt-120 pb-10">
    <div class="container">
        <div class="row">
            <?php
            $pesan = 'Halo kak, saya ingin konfrimasi pembayaran tas kulit';

            $url = 'https://api.whatsapp.com/send?phone=6289634815186&text=' . urlencode($pesan);
            if (session()->getFlashdata('berhasil')) : ?>
                <div class="alert mt-10 alert-success" role="alert">
                    <p><?= session()->getFlashdata('berhasil'); ?></p>
                    <a href="<?= $url; ?>" class="btn btn-success">Konfirmasi</a>
                </div>
            <?php elseif (session()->getFlashdata('gagal')) : ?>
                <div class="alert mt-10 alert-danger" role="alert">
                    <?= session()->getFlashdata('gagal'); ?>
                </div>
            <?php endif; ?>

            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="shop-main-wrapper mb-60">
                    <div class="shop-main-wrapper-head mb-30">
                        <div class="swowing-list">Showing <span>12 of 39</span> Products</div>
                    </div>
                    <div class="products-wrapper">
                        <?php foreach ($barang as $key) : ?>
                            <div class="single-product">
                                <div class="product-image pos-rel">
                                    <a href="<?= base_url("katalog/" . $key['slug']); ?>" class=""><img src="<?= base_url(); ?>/img/<?= $key['gambar']; ?>" alt="<?= $key['nama']; ?>"></a>
                                    <div class="product-action">
                                        <a href="#" class="quick-view-btn"><i class="fal fa-eye"></i></a>
                                    </div>
                                    <div class="product-action-bottom">
                                        <a href="<?= base_url("katalog/" . $key['slug']); ?>" class="add-cart-btn"><i class="fal fa-shopping-bag"></i>Beli</a>
                                    </div>
                                </div>
                                <div class="product-desc">
                                    <div class="product-name"><a href="shop-details.html"><?= $key['nama']; ?></a></div>
                                    <div class="product-price">
                                        <span class="price-now"><?= number_to_currency($key['harga'], 'IDR'); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="sidebar-widget-wrapper mb-110 d-none d-lg-block">
                    <div class="product-filters mb-50">
                        <div class="filter-widget">
                            <h4 class="filter-widget-title drop-btn">Category</h4>
                            <div class="filter-widget-content">
                                <div class="category-items">
                                    <a href="<?= base_url('katalog'); ?>" class="category-item">
                                        <div class="category-name">Semua</div>
                                    </a>
                                    <?php foreach ($kategori as $key) : ?>
                                        <a href="<?= base_url('katalog/kategori/' . $key['nama']); ?>" class="category-item">
                                            <div class="category-name"><?= $key['nama']; ?></div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shop main area end  -->

<script src="<?= base_url(); ?>/assets/js/nice-select.min.js"></script>
<?= $this->endSection(); ?>