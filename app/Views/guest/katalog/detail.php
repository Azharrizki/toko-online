<?= $this->extend('guest/layout/index'); ?>

<?= $this->section('guest-content'); ?>

<!-- page title area start  -->
<section class="page-title-area" data-background="<?= base_url(); ?>/assets/img/bg/page-title-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-wrapper text-center">
                    <h1 class="page-title mb-10">Shop</h1>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>Felted Shirt for Man</span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page title area end  -->

<!-- shop details area start  -->
<section class="shop-details-area pt-120 pb-90">
    <div class="container container-small">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-details-tab-wrapper mb-30">
                    <div class="product-details-tab">
                        <div class="tab-content" id="productDetailsTab">
                            <?php $counter = 0;
                            foreach ($gambar as $key) : ?>
                                <div class="tab-pane fade <?= ($counter == 0) ? 'active show' : ''; ?>" id="pro-<?= $key['id']; ?>" role="tabpanel" aria-labelledby="pro-<?= $key['id']; ?>-tab">
                                    <img class="active" src="<?= base_url(); ?>/img/<?= $key['nama']; ?>" alt="...">
                                </div>
                            <?php $counter++;
                            endforeach; ?>
                        </div>
                    </div>
                    <div class="product-details-nav">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <?php $counter = 0;
                            foreach ($gambar as $key) : ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?= ($counter == 0) ? 'active' : ''; ?>" id="pro-<?= $key['id']; ?>-tab" data-bs-toggle="tab" data-bs-target="#pro-<?= $key['id']; ?>" type="button" role="tab" aria-controls="pro-<?= $key['id']; ?>" aria-selected="false">
                                        <img src="<?= base_url(); ?>/img/<?= $key['nama']; ?>" alt="...">
                                    </button>
                                </li>
                            <?php $counter++;
                            endforeach; ?>
                        </ul>
                    </div>

                </div>

            </div>
            <div class="col-lg-6">
                <div class="product-side-info mb-30">
                    <form action="/Guest/Keranjang/addToCart" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <?php echo form_hidden('barang_id', $barang['id']); ?>
                        <h4 class="product-name mb-10"><?= $barang['nama']; ?></h4>
                        <span class="product-price"><?= number_to_currency($barang['harga'], 'IDR'); ?></span>

                        <p class="mb-30"><?= $barang['deskripsi']; ?></p>
                        <div class="product-quantity-cart mb-25">
                            <div class="product-quantity-form">
                                <form action="#">
                                    <button class="cart-minus"><i class="far fa-minus"></i></button>
                                    <input class="cart-input" type="text" value="1" name="jumlah">
                                    <button class="cart-plus"><i class="far fa-plus"></i></button>
                                </form>
                            </div>
                            <button type="submit" class="fill-btn">Add to Cart</button>
                        </div>
                    </form>
                </div>
                <div class="product_info-faq-area pb-0">
                    <div class="">
                        <nav class="product-details-nav">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-seller-tab" data-bs-toggle="tab" href="#nav-seller" role="tab" aria-selected="true">More Information</a>
                            </div>
                        </nav>
                        <div class="tab-content product-details-content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-seller" role="tabpanel">
                                <div class="tabs-wrapper mt-30">
                                    <div class="product__details-des">
                                        <p>Kondisi: Baru</p>
                                        <p>Berat Satuan: <?= $barang['berat']; ?> g</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<!-- shop details area end  -->

<div class="related_product pb-70">
    <div class="container container-small">
        <div class="section-title mb-55">
            <h2>Produk Lainya</h2>
        </div>
        <!-- Slider main container -->
        <div class="swiper-container r-product-active">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <?php foreach ($barang_lainya as $key) : ?>
                    <div class="swiper-slide">
                        <div class="single-product">
                            <div class="product-image pos-rel">
                                <a href="<?= base_url("katalog/" . $key['slug']); ?>" class=""><img src="<?= base_url(); ?>/img/<?= $key['gambar']; ?>" alt="img"></a>
                                <div class="product-action">
                                    <a href="<?= base_url("katalog/" . $key['slug']); ?>" class="quick-view-btn"><i class="fal fa-eye"></i></a>
                                </div>
                                <div class="product-action-bottom">
                                    <a href="<?= base_url("katalog/" . $key['slug']); ?>" class="add-cart-btn"><i class="fal fa-shopping-bag"></i>Beli</a>
                                </div>
                                <!-- <div class="product-sticker-wrapper">
                                    <span class="product-sticker new">New</span>
                                </div> -->
                            </div>
                            <div class="product-desc">
                                <div class="product-name"><a href="<?= base_url("katalog/" . $key['slug']); ?>"><?= $key['nama']; ?></a></div>
                                <div class="product-price">
                                    <span class="price-now"><?= number_to_currency($key['harga'], 'IDR'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- If we need pagination -->
            <div class="testimonial-pagination text-center"></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>/assets/js/nice-select.min.js"></script>
<?= $this->endSection(); ?>