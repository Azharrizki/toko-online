<?= $this->extend('guest/layout/index'); ?>

<?= $this->section('guest-content'); ?>

<!-- page title area start  -->
<section class="page-title-area" data-background="assets/img/bg/page-title-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-wrapper text-center">
                    <h1 class="page-title mb-10">Checkout</h1>
                    <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items">
                                <li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
                                <li class="trail-item trail-end"><span>Checkout</span></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page title area end  -->

<!-- checkout-area start -->
<section class="checkout-area pt-100 pb-70">
    <div class="container container-small">
        <div class="row">
            <div class="col-lg-6">
                <div class="your-order mb-30 ">
                    <h3>Your order</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $key) : ?>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            <?= $key['nama_barang']; ?> <strong class="product-quantity"> × <?= $key['qty']; ?></strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount"><?= number_to_currency($key['harga'] * $key['qty'], 'IDR'); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <?php $total = 0;
                                $berat = 0;
                                $jumlah = 0;
                                ?>
                                <?php foreach ($barang as $key) : ?>
                                    <?php
                                    $total += $key['harga'] * $key['qty'];
                                    $berat += $key['berat'] * $key['qty'];
                                    $jumlah += $key['qty'];
                                    ?>
                                <?php endforeach; ?>
                                <tr class="cart-subtotal">
                                    <th>Ongkos Kirim</th>
                                    <td><span class="amount" id="ongkos-kirim"></span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Total Bayar</th>
                                    <td><strong><span id="total-harga" class="amount"></span></strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="payment-method">
                        <div class="accordion" id="checkoutAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="checkoutOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bankOne" aria-expanded="true" aria-controls="bankOne">
                                        Direct Bank Transfer
                                    </button>
                                </h2>
                                <div id="bankOne" class="accordion-collapse collapse show" aria-labelledby="checkoutOne" data-bs-parent="#checkoutAccordion">
                                    <div class="accordion-body">
                                        Transfer ke rekening <?= $pembayaran['rekening']; ?> an <?= $pembayaran['nama']; ?> <?= $pembayaran['no_rekening']; ?>.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h3>Billing Details</h3>
                <form class="form-group" action="/Guest/Checkout/beli" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <?php foreach ($barang as $key) {
                        echo form_hidden('keranjang_id[]', $key['id']);
                        echo form_hidden('barang_id[]', $key['barang_id']);
                        echo form_hidden('jumlah[]', $key['qty']);
                    } ?>
                    <input type="hidden" name="total" id="total-harga-2" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="country-select">
                                <label>Provinsi <span class="required">*</span></label>
                                <select id="provinsi">
                                    <?php foreach ($provinsi as $key) : ?>
                                        <option value="<?= $key->province_id; ?>"><?= $key->province; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="country-select">
                                <label>Kabupaten <span class="required">*</span></label>
                                <select class="form-control" id="kabupaten">
                                    <option>Pilih kabupaten tujuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="country-select">
                                <label>Layanan <span class="required">*</span></label>
                                <select class="form-control" id="service">
                                    <option>Pilih Layanan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Alamat Lengkap<span class="required">*</span></label>
                                <input type="text" name="alamat" placeholder="RT/RW, Kel/Desa, Kec, Kab/Kota, Provinsi, Kode POS" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Nomor Telp <span class="required">*</span></label>
                                <input type="text" name="no_telp" placeholder="ex: 089xxxx" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="order-button-payment mt-10">
                                <button type="submit" class="fill-btn">Pesan Sekarang</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- checkout-area end -->
<script>
    $('document').ready(function() {
        let jumlah_pembelian = <?= $jumlah; ?>;
        let harga = <?= $total ?>;
        let ongkir = 0;
        $("#provinsi").on('change', function() {
            $("#kabupaten").empty();
            let id_province = $(this).val();
            $.ajax({
                url: "<?= base_url('Guest/Checkout/getCity') ?>",
                type: 'GET',
                data: {
                    'id_province': id_province,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    let results = data["rajaongkir"]["results"];
                    for (let i = 0; i < results.length; i++) {
                        $("#kabupaten").append($('<option>', {
                            value: results[i]["city_id"],
                            text: results[i]['city_name']
                        }));
                    }
                },

            });
        });

        $("#kabupaten").on('change', function() {
            let id_city = $(this).val();
            $.ajax({
                url: "<?= base_url('Guest/Checkout/getCost') ?>",
                type: 'GET',
                data: {
                    'origin': 154,
                    'destination': id_city,
                    'weight': <?= $berat; ?>,
                    'courier': 'jne'
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    let results = data["rajaongkir"]["results"][0]["costs"];
                    for (let i = 0; i < results.length; i++) {
                        let text = results[i]["description"] + "(" + results[i]["service"] + ")";
                        $("#service").append($('<option>', {
                            value: results[i]["cost"][0]["value"],
                            text: text,
                            etd: results[i]["cost"][0]["etd"]
                        }));
                    }
                },

            });
        });

        $("#service").on('change', function() {
            let estimasi = $('option:selected', this).attr('etd');
            ongkir = parseInt($(this).val());
            $("#ongkos-kirim").text('IDR ' + ongkir.toLocaleString('id-ID', {
                style: 'decimal',
                currency: 'IDR',
                minimumFractionDigits: 0,
                currencyDisplay: 'symbol'
            }));
            $("#estimasi").html(estimasi + " Hari");
            let total_harga = harga + ongkir;
            $("#total-harga-2").val(total_harga)
            $("#total-harga").text('IDR ' + total_harga.toLocaleString('id-ID', {
                style: 'decimal',
                currency: 'IDR',
                minimumFractionDigits: 0,
                currencyDisplay: 'symbol'
            }));
        });
    });
</script>
<?= $this->endSection(); ?>