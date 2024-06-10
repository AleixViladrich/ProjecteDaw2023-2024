<?php echo $this->extend('layouts/authLayout/auth.php'); ?>

<?php echo $this->section("auth"); ?>
<div class="container-fluid">
    <form action="<?= base_url('/loginAuth') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="form-group">
            <label for="mail"> <?= lang('loginLang.email') ?></label>
            <input type="text" name="mail" id="mail" class="form-control" placeholder="example@gmail.com" value="<?= old('mail') ?>">
        </div>
        <div class="form-group ">
            <label for="pass"> <?= lang('loginLang.password') ?></label>
            <input type="password" name="pass" id="pass" class="form-control" placeholder="<?= lang('loginLang.password') ?>" value="<?= old('pass') ?>">
        </div>
        <div class="pm-2 mt-2 mb-2 text-center">
            <input type="submit" class="btn btn-primary w-100" value=" <?= lang('loginLang.login_button') ?>">
        </div>
    </form>
    <div class="container">
        <div class="panel panel-default">
            <?php
            if (isset($login_button)) {
                echo  $login_button;
            }
            ?>
        </div>
        <div class="m-2 text-center">
            <div classs="m-3 text-center" style="color:red">
                <?= session()->getFlashdata('error'); ?>
            </div>
        </div>
    </div>
    <div class="mt-3" style="vertical-align: middle; display: flex; gap: 10px; align-items: center; justify-content: center;">
        <a style="text-decoration: none;<?php if (session()->get('lang') == 'es') echo 'border:  5px solid white; border-radius: 35px;'; ?>" class="me-2" href="<?= base_url('changeLang/es') ?>"><img style="border-radius: 10px; width: 26px;" src="<?= base_url('images/spain.png') ?>" /></a>
        <h3 style="color: grey;">|</h3>
        <a style="text-decoration: none;<?php if (session()->get('lang') == 'ca') echo 'border: 5px solid white; border-radius: 35px;'; ?>" class="me-3" href="<?= base_url('changeLang/ca') ?>"><img style="border-radius: 10px; width: 26px;" src="<?= base_url('images/catalunya.png') ?>" /></a>
        <h3 style="color: grey;">|</h3>
        <a style="text-decoration: none;<?php if (session()->get('lang') == 'en') echo 'border: 5px solid white; border-radius: 25px;'; ?>" class="me-3" href="<?= base_url('changeLang/en') ?>"><img style="border-radius: 15px; width: 26px;" class="m-0" src="<?= base_url('images/uk.png') ?>" /></a>
    </div>
</div>
<?php echo $this->endSection(); ?>