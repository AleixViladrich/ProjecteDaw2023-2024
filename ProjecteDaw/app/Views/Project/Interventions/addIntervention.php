<?php
$this->extend('layouts/mainLayout');

echo $this->section("main_content");
?>

<div class="container-fluid mt-3">
    <div id="centres" class="border">
        <div>
            <h3 class="titleForm mt-0"><?= lang('ticketsLang.add_intervention') ?></h3>
        </div>
        <form action="<?= base_url("/addIntervention")?>" method="POST">
            <?= csrf_field() ?>
            <div class="row">
                <div class="form-group col-6">
                    <label for="interventionType"><?= lang('ticketsLang.intervention_type') ?>:</label>
                    <select class="form-control" name="interventionType" id="interventionType">
                        <?php
                        $valueN = 1;
                        foreach ($interTypes as $value) {
                            echo "<option value='" . $valueN . "'>" . $value . "</option>";
                            $valueN++;
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="description"><?= lang('ticketsLang.description') ?></label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group col-6">
                    <label for="cicle"><?= lang('ticketsLang.FP') ?></label>
                    <select class="form-control" name="cicle" id="cicle">
                        <?php
                        echo "<option value='ASIX'>ASIX</option>";
                        ?>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="course"><?= lang('ticketsLang.course') ?></label>
                    <select class="form-control" name="course" id="course">
                        <?php
                        echo "<option value='1'>1r</option>";
                        echo "<option value='2'>2n</option>";
                        ?>
                    </select>
                </div>
                <!--language-->
                <div class="col-12 my-3">
                    <label for="stock"><?= lang('ticketsLang.stock') ?></label>
                    <select name="stock" id="stock">
                        <?php
                        echo "<option value=''</option>";
                        foreach ($stock as $value) {
                            echo "<option value='" . $value['stock_id'] . "'>" . $value['description'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="m-2">
                    <?php if (session()->getFlashdata('error')) : ?>
                        <p style="color: red"><?= session()->getFlashdata('error') ?></p>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')) : ?>
                        <p style="color: grey"><?= session()->getFlashdata('success') ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-12 bottom-center pe-0">
                    <input type="submit" class="btn btn-primary" value="<?= lang('ticketsLang.save') ?>">
                    <a href="<?= base_url("/interventionsOfTicket/" . session()->getFlashdata('idTicket')) ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        // s'inicialitza els select amb selectize
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>
<?php echo $this->endSection(); ?>