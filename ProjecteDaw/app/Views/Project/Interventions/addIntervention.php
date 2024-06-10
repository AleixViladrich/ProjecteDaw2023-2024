<?php
$this->extend('layouts/mainLayout');

echo $this->section("main_content");
?>

<<<<<<< Updated upstream
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center bg-dark">
                <img src="<?= base_url('Logo.png') ?>" alt="Logo" style="max-width: 80px">
                <div>
                    <h1 class="text-white text-center"><?= lang('ticketsLang.add_intervention')?></h1>
                </div>
            </div>
=======
        <div>
            <h3 class="titleForm mt-0"><?= lang('ticketsLang.add_intervention') ?></h3>
>>>>>>> Stashed changes
        </div>
        <div id="centres" class="col-10">
            <form action="<?= base_url("/addIntervention") ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="professor" class=""><?= lang('ticketsLang.teacher')?>:</label>
                    <input type="text" class="form-control" name="professor" id="professor">
                </div>
                <div class="form-group">
                    <label for="student"><?= lang('ticketsLang.student')?>:</label>
                    <input type="text" class="form-control" name="student" id="student">
                </div>
                <div class="form-group">
                    <label for="interventionType"><?= lang('ticketsLang.intervention_type')?>:</label>
                    <select class="form-control" name="interventionType" id="interventionType">
                        <?php
                        $valueN = 1;
                        foreach ($interTypes as $value) {
                            echo "<option value='". $valueN. "'>". $value ."</option>";
                            $valueN++;
                        }  
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description"><?= lang('ticketsLang.description')?></label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="cicle"><?= lang('ticketsLang.FP')?></label>
                    <select class="form-control" name="cicle" id="cicle">
                        <?php
                            echo "<option value='ASIX'>ASIX</option>"; 
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="course"><?= lang('ticketsLang.course')?></label>
                    <select class="form-control" name="course" id="course">
                        <?php
<<<<<<< Updated upstream
                            echo "<option value='1'>1r</option>";
                            echo "<option value='2'>2n</option>";
                        ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary"><?= lang('ticketsLang.save')?></button>
                    <a href="<?= base_url("/interventionsOfTicket/" . session()->getFlashdata("idTicket")) ?>" class="btn btn-secondary"><?= lang('ticketsLang.cancel')?></a>
                </div>
            </form>
        </div>
    </div>
</div>
=======
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
                    <a href="<?= base_url("/interventionsOfTicket/" . $id) ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
                </div>
            </div>
        </form>
    </div>
>>>>>>> Stashed changes
</div>
<?php echo $this->endSection(); ?>