<style>
    #header {
        height: 110px;
        /* width:  100vw; */
    }
</style>

<?= $this->extend('layouts/mainLayout'); ?>

<<?= $this->section("main_content"); ?> <!-- overflow -->

    <div class="row m-0 p-0">


        <div class="col-3">

            <?php if ($ticket['device_type_id'] == 1) : ?>
                <div class="mb-5 mt-2 text-center">
                    <img src="<?= base_url('images/ordinador.png') ?>" alt="Logo" style="max-height: 300px; max-width:250px;">
                </div>
            <?php elseif ($ticket['device_type_id'] == 2) : ?>
                <div class="mb-2 text-center mt-0">
                    <img src="<?= base_url('images/projector.png') ?>" alt="Logo" style="max-height: 300px; max-width:250px;">
                </div>
            <?php elseif ($ticket['device_type_id'] == 3) : ?>
                <div class="mb-3 text-center">
                    <img src="<?= base_url('images/pantalla.png') ?>" alt="Logo" style="max-height: 300px; max-width:250px;">
                </div>
            <?php endif ?>

            <div class="col-12 mb-4 mt-3">

                <h5 style="font-weight: bold;"> Ticket id: <?= explode("-", $ticket['ticket_id'])[4] ?> </h5>

            </div>

            <div class="row border rounded-3 mb-4 pt-2">

                <div class="col-12">
                    <h5 style="font-weight: bold;"><?= lang('ticketsLang.description') ?></h5>
                    <br>
                    <p class="text-justify"><?php echo $ticket['fault_description'] ?></p>
                    <br>
                </div>


                <!-- <div class="col-12 p-3">
                        <h5 style="font-weight: bold;">Dispositiu</h5>
                        <br>
                        <p class="text-justify"><?php $ticket['device_type_id'] ?></p>
                        <br>
                    </div> -->

                <!-- <hr/> -->

                <div class="col-12">
                    <h5 style="font-weight: bold;"><?= lang('ticketsLang.issuing_center') ?></h5>
                    <br>
                    <p class="text-justify"><?php echo $ticket['email_person_center_g'] ?></p>
                    <br>
                </div>

                <!-- <hr/> -->



                <!-- <hr/> -->

                <div class="col-12">
                    <h5 style="font-weight: bold;"><?= lang('ticketsLang.creation_data') ?></h5>
                    <br>
                    <p class="text-justify"><?php echo $ticket['created_at'] ?></p>
                    <br>
                </div>
                <!-- <hr/> -->
                <div class="col-12">
                    <h5 style="font-weight: bold;"><?= lang('ticketsLang.last_modification') ?></h5>
                    <br>
                    <p class="text-justify"><?php echo $ticket['updated_at'] ?></p>
                    <br>
                </div>

                <!-- <hr/> -->

                <div class="col-12">
                    <h5 style="font-weight: bold;"><?= lang('ticketsLang.state') ?></h5>
                    <br>
                    <p class="text-justify"><?= $status ?></p>
                    <br>
                </div>

                <!-- </div> -->
            </div>
        </div>

        <div class="col-9 h-100 ps-4 mt-5 ">

            <div class="col-12 mb-3 ">

                <h3 style="font-weight: bold;"> <?= lang('ticketsLang.intervention') ?> </h3>

            </div>
            <?php if ($add) : ?>
                <script>
                    addEventListener("DOMContentLoaded", (event) => {
                        let btn = document.createElement('a');
                        btn.href = "<?= base_url('/addIntervention/') . $ticket['ticket_id'] ?>";
                        btn.classList.add('btn', 'btn-info');
                        btn.id = 'list-btn-print';
                        btn.style.marginLeft = '5px';
                        btn.innerHTML = '<i class="fa-solid fa-plus"></i> <?= lang('ticketsLang.add') ?>';
                        let div = document.getElementsByClassName('d-flex')[0];
                        div.appendChild(btn);
                        document.getElementById('list-btn-exportxls').innerHTML = '<i class="fa-solid fa-file-excel" aria-hidden="true" style="margin-right: 5px"></i><?= lang('ticketsLang.export') ?>';
                        document.getElementById('list-btn-print').innerHTML = '<i class="fa-solid fa-print" aria-hidden="true" style="margin-right: 5px"></i><?= lang('ticketsLang.print') ?>';
                        //console.log(document.getElementsByClassName('dataTables_info'));
                        //document.getElementsByClassName('dataTables_info')[0] = 'none';
                    });
                </script>
            <?php endif ?>
            <?= $output ?>
            <div class="m-1">
                <?php if (session()->getFlashdata('error')) : ?>
                    <p style="color: red"><?= session()->getFlashdata('error') ?></p>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')) : ?>
                    <p style="color: grey"><?= session()->getFlashdata('success') ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <?= $this->endSection(); ?>