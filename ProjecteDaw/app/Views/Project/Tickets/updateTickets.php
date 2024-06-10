<?php
$this->extend('layouts/mainLayout');
echo $this->section("main_content");
?>


<div class="container-fluid mt-3">
    <div id="centres" class="border">

        <div>
            <h3 class="titleForm mt-0"><?= lang('ticketsLang.update_ticket') ?></h3>
        </div>

        <form id="update" action="<?php base_url("/updateTicket/" . $ticket['ticket_id']) ?>" method="POST" class="formAdd p-2 pb-0">

            <?= csrf_field() ?>
            <div class="row">
                <div class="form-group col-6 my-4">
                    <label for="device" class=" bold fs-5"><?= lang('ticketsLang.device') ?></label>
                    <select class="form-control form-select" name="device" id="device">
                        <?php
                        $valueN = 1;
                        foreach ($device as $value) {
                            echo "<option value='" . $valueN . "'>" . $value . " </option>";
                            $valueN++;
                        }
                        ?>
                    </select>
                </div>
                <!--Començament de les variables-->
                <?php if (session()->get('role') == 'SSTT' || session()->get('role') == 'Admin') : ?>
                    <div class="col-6 mt-4 mb-5">
                        <label for="center_g" class=" bold fs-5"><?= lang('ticketsLang.issuing_center') ?></label>
                        <select name="center_g" id="center_g">
                            <?php
                            echo "<option value='' default hidden>Escull centre...</option>";
                            foreach ($center as $value) {
                                echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="form-group col-6 my-4 ">
                    <label for="status" class=" bold fs-5"><?= lang('ticketsLang.Status') ?></label>
                    <select class="form-control form-select" name="status" id="status">
                        <?php
                        foreach ($status as $value) {
                            echo "<option value='" . $value['status_id'] . "'>" . $value['status'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <p style="color: red"><?= session()->getFlashdata('error') ?></p>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')) : ?>
                        <p style="color: grey"><?= session()->getFlashdata('success') ?></p>
                    <?php endif; ?>
                </div>
                <!--Professor-->
                <!--Fi variables-->
                <div class="col-12 bottom-center pe-0 ">
                    <button type="submit" class="btn btn-primary bold"><?= lang('ticketsLang.save') ?></button>
                    <a href="<?= base_url("/viewTickets") ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
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
        var ticket = <?php echo json_encode($ticket); ?>;
        var change = <?php echo json_encode(session()->getFlashdata('statusChange')); ?>;
        var alert = <?php echo json_encode($alert); ?>;
        const status = $('#status')[0].selectize;
        const device = $('#device')[0].selectize;
        //defaults
        status.setValue(ticket['status_id']);
        device.setValue(ticket['device_type_id']);
        if (change == false) {
            status.disable();
        };
        console.log(alert);
        var text = <?php echo json_encode(lang('ticketsLang.confirm')); ?>;
        if (alert == true) {
            $('#update').on('submit', function(event) {
                var selectedValue = status.getValue();

                if (selectedValue == 3 || selectedValue == 4) {
                    var confirmAction = confirm(text);

                    if (!confirmAction) {
                        event.preventDefault();
                    }
                }
            });
        }

    });
</script>
<?php if (session()->get('role') == 'SSTT') : ?>
    <script>
        $(document).ready(function() {
            var ticket = <?php echo json_encode($ticket); ?>;
            const selectGen = $('#center_g')[0].selectize;
            selectGen.setValue(ticket['g_center_code']);
        });
    </script>
<?php endif; ?>
<?php echo $this->endSection(); ?>