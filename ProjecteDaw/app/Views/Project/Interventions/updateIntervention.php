
<<<<<<< Updated upstream
<?= $this->section("main_content");?>

<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center bg-dark">
                <img src="<?= base_url('Logo.png') ?>" alt="Logo" style="max-width: 80px">
                <div>
                    <h1 class="text-white text-center"><?= $title ?></h1>
                </div>
            </div>
=======
        <div>
            <h3 class="titleForm mt-0"><?= lang('ticketsLang.update_intervention') ?></h3>
>>>>>>> Stashed changes
        </div>
        <?= $this->include("layouts/mainLayout") ?>
        <div id="centres" class="col-10">
            <form action="<?php base_url("/addTickets") ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="person_contact_center" class=""><?= lang('ticketsLang.center_contact')?>:</label>
                    <input type="text" class="form-control" name="person_contact_center" id="person_contact_center">
                </div>
                <div class="form-group">
                    <label for="email_person_contact"><?= lang('ticketsLang.center_contact_email')?>:</label>
                    <input type="text" class="form-control" name="email_person_contact" id="email_person_contact">
                </div>
                <div class="form-group">
                    <label for="description"><?= lang('ticketsLang.description')?></label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="device"><?= lang('ticketsLang.device')?></label>
                    <select class="form-control" name="device" id="device">
                        <?php
                        $valueN = 1;
                        foreach ($device as $value) {
                            echo "<option value='". $valueN. "'>". $value ."</option>";
                            $valueN++;
<<<<<<< Updated upstream
                        }  
                        ?>
                    </select>
                </div>
                <div>
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <?php
                        $valueN = 1;
                        foreach ($status as $value) {
                            echo "<option value='". $valueN . "'>". $value ."</option>";
                            $valueN++;
                        }  
                        ?>
                    </select>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary"><?= lang('ticketsLang.save')?></button>
                    <a href="<?= base_url("/viewTickets") ?>" class="btn btn-secondary"><?= lang('ticketsLang.cancel')?></a>
                </div>
            </form>
        </div>
=======
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-6 my-3 ">
                    <label for="description"><?= lang('ticketsLang.description') ?></label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"><?= $inter['description'] ?></textarea>
                </div>
                <div class="form-group col-6 my-4 ">
                    <label for="cicle"><?= lang('ticketsLang.FP') ?></label>
                    <select class="form-control" name="cicle" id="cicle">
                        <?php
                        echo "<option value='ASIX'>ASIX</option>";
                        echo "<option value='DAM'>DAM</option>";
                        ?>
                    </select>
                </div>
                <div class="form-group col-6 my-4 ">
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
                        if ($noStock == false) {
                            echo "<option value='" . $stockInter['stock_id'] . "'>" . $stockInter['description'] . "</option>";
                        } else {
                            echo "<option value=''></option>";
                        }
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
                <div class="col-12 bottom-center pe-0 ">
                    <input type="submit" class="btn btn-primary" value="<?= lang('ticketsLang.save') ?>">
                    <a href="<?= base_url("/interventionsOfTicket/" . $inter['ticket_id']) ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
                </div>
            </div>
        </form>
>>>>>>> Stashed changes
    </div>
</div>
</div>
<?php echo $this->endSection(); ?>