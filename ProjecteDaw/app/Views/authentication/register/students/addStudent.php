<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }
</style>
<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>
<div class="d-flex justify-content-center">
    <div class="col-11 mt-5">
        <form action="<?= base_url("/addStudent") ?>" method="post" class="formAdd mx-auto">
            <?= csrf_field(); ?>
            <div>
                <h3 class="titleForm mt-0 text-center"><?= lang('ticketsLang.add_ticket') ?></h3>
            </div>
            <div class="form-group my-4">
                <label class="m-1" for="mail">Afegeix un nou correu</label>
                <input class="form-control" type="text" placeholder="email.." name="mail" id="mail" style="max-width: 100%;">
            </div>
            <div>
                <div class="my-4">
                    <label class="m-1" for="contrasenya">Genera nova contrasenya</label>
                    <input class="form-control" type="text" disabled="true" placeholder="password..." name="pass" id="pass" style="max-width: 100%;">
                </div>
                <div>
                    <button type="button" class="btn btn-primary" onclick="genRandomPassword()">Generar random</button>
                </div>
            </div>
            <div class="m-2">
                <p style="color: red"><?= session()->getFlashdata('error') ?></p>
                <p style="color: grey"><?= session()->getFlashdata('success') ?></p>
            </div>
            <div class="bottom-center text-center">
                <button type="submit" class="btn btn-primary bold"><?= lang('ticketsLang.save') ?></button>
                <a href="<?= base_url("/viewStudents") ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
            </div>
        </form>
    </div>
</div>

<script>
    function genRandomPassword() {
        const pass = document.getElementById('pass');
        console.log(pass);
        let random = '';
        for (i = 0; i < 6; i++) {
            var randomNumber = Math.floor(Math.random() * 26);
            var randomLetter = String.fromCharCode(97 + randomNumber);
            random = random + randomLetter;
        }
        pass.value = random;
    }
</script>
<?= $this->endSection(); ?>