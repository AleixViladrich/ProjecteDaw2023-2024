<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }
</style>
<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>
<div class="container-fluid mt-3">
    <div id="centres" class="border">

        <div>
            <h3 class="titleForm mt-0"><?= lang('studentsLang.titleUpdate') ?></h3>
        </div>

        <form action="<?= base_url("/updateStudent/" . $st['student_id']) ?>" method="post" class="formAdd p-2 pb-0">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="form-group my-4 ">
                    <label class="m-1" for="mail"><?= lang('studentsLang.updateEmail') ?></label>
                    <input class="form-control" type="text" value="<?= $st['email'] ?>" name="mail" id="mail">
                </div>
                <div>
                    <label for="pass"><?= lang('studentsLang.genNewPassword') ?></label>
                    <div class="input-group">
                        <input class="form-control" type="password" disabled="true" placeholder="password..." name="pass" id="pass">
                        <div class="input-group-append">
                            <button type="button" id="random" disabled="true" name="random" class="btn btn-primary mr-1" onclick="genRandomPassword()">Random</button>
                            <button type="button" id="showHide" disabled="true" name="showHide" class="btn btn-primary" onclick="showHidePass()"><?= lang('studentsLang.show'); ?></button>
                        </div>
                    </div>
                </div>
                <div class="m-4 row">
                    <div class="col-9">
                        <?php if (session()->getFlashdata('error')) : ?>
                            <p style="color: red"><?= session()->getFlashdata('error') ?></p>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('success')) : ?>
                            <p style="color: grey"><?= session()->getFlashdata('success') ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="col-3">
                        <label for="pass"><?= lang('studentsLang.passCheck'); ?></label>
                        <input type="checkbox" name="allow" id="allow" onchange="allowPass()">
                    </div>
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
    const random = document.getElementById('random');
    const allow = document.getElementById('allow');
    var langShow = <?php echo json_encode(lang('studentsLang.show')); ?>;
    var langHide = <?php echo json_encode(lang('studentsLang.hide')); ?>;
    allow.checked = false;

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

    function allowPass() {
        if (allow.checked) {
            pass.disabled = false;
            random.disabled = false;
            show.disabled = false;
        } else {
            pass.disabled = true;
            random.disabled = true;
            show.disabled = true;
            pass.value = "";
        }
    }
</script>
<?= $this->endSection(); ?>