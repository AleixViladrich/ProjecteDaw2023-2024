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
        <form action="<?= base_url("/updateStudent/" . $st['student_id']) ?>" method="post" class="formAdd">
            <?= csrf_field(); ?>
            <div>
                <div>
                    <h3 class="titleForm mt-0 text-center"><?= lang('ticketsLang.add_ticket') ?></h3>
                </div>
                <div class="form-group my-4 ">
                    <label class="m-1" for="mail">Email a modificar</label>
                    <input class="form-control" type="text" value="<?= $st['email'] ?>" name="mail" id="mail">
                </div>
                <div class="m-2">
                    <p style="color: red"><?= session()->getFlashdata('error') ?></p>
                    <p style="color: grey"><?= session()->getFlashdata('success') ?></p>
                </div>
                <div class="bottom-center pe-0 ">
                    <button type="submit" class="btn btn-primary bold"><?= lang('ticketsLang.save') ?></button>
                    <a href="<?= base_url("/viewStudents") ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>