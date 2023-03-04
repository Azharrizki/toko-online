<?php if (session()->getFlashdata('berhasil')) : ?>
    <div id="alert" class="alert alert-success alert-dismissible show fade alert-has-icon" role="alert">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="alert-title">Selamat ! ! !</div>
            <?= session()->getFlashdata('berhasil'); ?>
        </div>
    </div>
<?php elseif (session()->getFlashdata('gagal')) : ?>
    <div id="alert" class="alert alert-danger alert-dismissible show fade alert-has-icon" role="alert">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="alert-title">Maaf</div>
            <?= session()->getFlashdata('gagal'); ?>
        </div>
    </div>
<?php endif; ?>