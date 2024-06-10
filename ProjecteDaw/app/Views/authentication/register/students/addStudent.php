
<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>
<div class="container-fluid mt-3">
    
    <div id="centres" class="border">

        <div>
            <h3 class="titleForm mt-0"><?= lang('studentsLang.titleAdd') ?></h3>
        </div>

        <form action="<?= base_url("/addStudent") ?>" method="post" class="formAdd p-2 pb-0">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="form-group my-4">
                    <label class="m-1" for="mail"><?= lang('studentsLang.addEmail') ?></label>
                    <input class="form-control" type="text" placeholder="email.." name="mail" id="mail" style="max-width: 100%;">
                </div>
                <div>
                    <label for="pass"><?= lang('studentsLang.genNewPassword') ?></label>
                    <div class="input-group">
                        <input class="form-control" type="password" placeholder="password..." name="pass" id="pass">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary mr-1" onclick="genRandomPassword()">Random</button>
                            <button type="button" id="showHide" name="showHide" class="btn btn-primary" onclick="showHidePass()"><?= lang('studentsLang.show'); ?></button>
                        </div>
                    </div>
                </div>
                <div class="m-2">
                    <?php if (session()->getFlashdata('error')) : ?>
                        <p style="color: red"><?= session()->getFlashdata('error') ?></p>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')) : ?>
                        <p style="color: grey"><?= session()->getFlashdata('success') ?></p>
                    <?php endif; ?>
                </div>
                <div class="bottom-center">
                    <button type="submit" class="btn btn-primary bold m-2"><?= lang('ticketsLang.save') ?></button>
                    <a href="<?= base_url("/viewStudents") ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const pass = document.getElementById('pass');
    const show = document.getElementById('showHide');
    var langShow = <?php echo json_encode(lang('studentsLang.show')); ?>;
    var langHide = <?php echo json_encode(lang('studentsLang.hide')); ?>;

    function genRandomPassword() {
        let random = '';
        for (i = 0; i < 6; i++) {
            var randomNumber = Math.floor(Math.random() * 26);
            var randomLetter = String.fromCharCode(97 + randomNumber);
            random = random + randomLetter;
        }
        pass.value = random;
    }

    function showHidePass() {
        console.log(pass.type);
        //json encode lang si eso 
        if (pass.type == "text") {
            pass.type = "password";
            show.textContent = langShow
        } else if (pass.type == "password") {
            pass.type = "text";
            show.textContent = langHide
        }
    }
</script>
<?= $this->endSection(); ?>