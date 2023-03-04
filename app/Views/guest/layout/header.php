    <!-- header area start  -->
    <header class="header4">
        <div class="header-top d-none d-md-block">
            <div class="container header-container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="header-top-link">
                            <a href="<?= base_url("about"); ?>" class="text-btn">About Us</a>
                            <a href="register.html" class="text-btn">My account</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="header-top-right">
                            <?php if (logged_in()) : ?>
                                <a href="<?= base_url("logout"); ?>" class="text-btn"><i class="flaticon-avatar"></i>Logout</a>
                            <?php else : ?>
                                <a href="<?= base_url("login"); ?>" class="text-btn"><i class="flaticon-avatar"></i>Sign in</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="header-sticky" class="header-main header-main1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="header-main-content-wrapper">
                            <div class="header-main-left header-main-left-header1">
                                <div class="header-logo header1-logo">
                                    <a href="index.html" class="logo-bl"><img src="<?= base_url(); ?>/assets/img/logo/logo-bl-tr.png" alt="logo-img"></a>
                                </div>
                                <div class="main-menu main-menu4 d-none d-lg-block">
                                    <nav id="mobile-menu">
                                        <ul>
                                            <li><a href="<?= base_url("/"); ?>">Home</a></li>
                                            <li><a href="<?= base_url("katalog"); ?>">Katalog</a></li>
                                            <li><a href="<?= base_url("about"); ?>">About</a></li>
                                            <li><a href="<?= base_url("contact"); ?>">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="header-main-right header-main-right-header1">
                                <form action="#" class="filter-search-input header-search d-none d-xl-inline-block">
                                    <input type="text" placeholder="Search Products.....">
                                    <button><i class="fal fa-search"></i></button>
                                </form>
                                <div class="action-list d-none d-md-flex action-list-header1">
                                    <div class="action-item action-item-cart">
                                        <a href="<?= base_url('keranjang'); ?>" class="view-cart-button">
                                            <i class="fal fa-shopping-bag"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->