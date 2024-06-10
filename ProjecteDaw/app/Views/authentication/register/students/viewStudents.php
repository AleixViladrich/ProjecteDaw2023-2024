<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }
</style>
<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>
<?php if ($add) : ?>
    <script>
        addEventListener("DOMContentLoaded", (event) => {
            let btn = document.createElement('a');
            btn.href = "<?= base_url('/addStudent') ?>";
            btn.classList.add('btn', 'btn-info');
            btn.id = 'list-btn-print';
            btn.style.marginLeft = '5px';
            btn.innerHTML = '<i class="fa-solid fa-plus"></i> <?= lang('ticketsLang.add') ?>';
            let div = document.getElementsByClassName('d-flex')[0];
            div.appendChild(btn);
            document.getElementById('list-btn-exportxls').innerHTML = '<i class="fa-solid fa-file-excel" aria-hidden="true" style="margin-right: 5px"></i><?= lang('ticketsLang.export') ?>';
            document.getElementById('list-btn-print').innerHTML = '<i class="fa-solid fa-print" aria-hidden="true" style="margin-right: 5px"></i><?= lang('ticketsLang.print') ?>';
        })
    </script>
<?php endif ?>

<?= $output ?>

<div class="m-2">
    <?php if (session()->getFlashdata('error')) : ?>
        <p style="color: red"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')) : ?>
        <p style="color: grey"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>