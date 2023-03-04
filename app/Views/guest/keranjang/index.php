<?= $this->extend('guest/layout/index'); ?>

<?= $this->section('guest-content'); ?>

<!-- page title area start  -->
<section class="page-title-area" data-background="assets/img/bg/page-title-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-wrapper text-center">
                    <h1 class="page-title mb-10">My Cart</h1>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>Cart</span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page title area end  -->

<!-- cart area start  -->
<section class="cart-area pt-100 pb-100">
    <div class="container container-small">
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Images</th>
                                <th class="cart-product-name">Product</th>
                                <th class="product-price">Unit Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ht = 1;

                            foreach ($barang as $key) : ?>
                                <tr>
                                    <input type="hidden" name="id" value="<?= $key['id']; ?>" class="keranjang-<?= $key['id']; ?>">
                                    <td class="product-thumbnail">
                                        <a href="<?= base_url('katalog/' . $key['slug']); ?>"><img src="<?= base_url(); ?>/img/<?= $key['nama_gambar']; ?>" alt="img"></a>
                                    </td>
                                    <td class="product-name">
                                        <a href="<?= base_url('katalog/' . $key['slug']); ?>"><?= $key['nama_barang']; ?></a>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount"><?= number_to_currency($key['harga'], 'IDR') ?></span>
                                    </td>
                                    <td class="product-quantity text-center">
                                        <div class="product-quantity mt-10 mb-10">
                                            <div class="product-quantity-form">
                                                <form>
                                                    <button class="cart-minus"><i class="far fa-minus"></i></button>
                                                    <input class="cart-input qty-<?= $key['id']; ?>" type="text" value="<?= $key['qty']; ?>">
                                                    <button class="cart-plus"><i class="far fa-plus"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-remove"><a href="<?= base_url('Guest/Keranjang/deleteCart/' . $key['id']); ?>"><i class="fa fa-times"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <div class="cart-page-total">
                            <h2>Total Keranjang</h2>
                            <ul class="mb-20">
                                <?php $total = 0; ?>
                                <?php foreach ($barang as $key) : ?>
                                    <?php $total += $key['harga'] * $key['qty']; ?>
                                <?php endforeach; ?>
                                <li>Total <span id="total-harga"><?= number_to_currency($total, 'IDR'); ?></span></li>
                            </ul>
                            <div class="text-end">
                                <a class="border-btn" href="<?= base_url('checkout'); ?>">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url(); ?>/assets/js/nice-select.min.js"></script>
<script>
    $(document).ready(function() {
        $(".cart-minus").click((e) => {
            e.preventDefault();
            <?php foreach ($barang as $key) : ?>
                $.ajax({
                    url: "<?= base_url(); ?>/Guest/Keranjang/updateCart",
                    type: "post",
                    data: {
                        id: $(".keranjang-<?= $key['id']; ?>").val(),
                        jumlah: $(".qty-<?= $key['id']; ?>").val()
                    },
                    success: function(response) {
                        console.log("Data barang berhasil dikurangi.");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("An error occurred: " + errorThrown);
                    }
                });
            <?php endforeach; ?>

            $.ajax({
                type: 'GET',
                url: "<?= base_url(); ?>/Guest/Keranjang/totalHarga",
                success: function(data) {
                    // Menampilkan total harga barang dalam elemen dengan class "cart-total"
                    $('#total-harga').html(data);
                }
            });
        })

        $(".cart-plus").click((e) => {
            e.preventDefault();

            <?php foreach ($barang as $key) : ?>
                $.ajax({
                    url: "<?= base_url(); ?>/Guest/Keranjang/updateCart",
                    type: "post",
                    data: {
                        id: $(".keranjang-<?= $key['id']; ?>").val(),
                        jumlah: $(".qty-<?= $key['id']; ?>").val()
                    },
                    success: function(response) {
                        console.log("Data barang berhasil ditambah.");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("An error occurred: " + errorThrown);
                    }
                });
            <?php endforeach; ?>

            $.ajax({
                type: 'GET',
                url: "<?= base_url(); ?>/Guest/Keranjang/totalHarga",
                success: function(data) {
                    // Menampilkan total harga barang dalam elemen dengan class "cart-total"
                    $('#total-harga').html(data);
                }
            });
        })
    });
</script>

<!-- cart area end  -->
<?= $this->endSection(); ?>