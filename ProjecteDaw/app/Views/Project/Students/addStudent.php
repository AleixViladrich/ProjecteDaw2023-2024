<?php
$this->extend('layouts/mainLayout');
echo $this->section("main_content");
?>


<div class="container-fluid mt-3">
    <div id="centres" class="border">

        <div>
            <h3 class="titleForm mt-0"><?= lang('ticketsLang.add_ticket') ?></h3>
        </div>

        <form action="<?php base_url("/addTickets") ?>" method="POST" class="formAdd p-2 pb-0">

            <div class="row ">

                <?= csrf_field(); ?>

                <div class="form-group my-4 ">
                    <label for="mail" >Correu</label>
                    <input class="form-control" type="text" placeholder="email.." id="mail">
                </div>

                <div class="form-group my-4 ">
                    <label for="Password" class="mb-1">Constrasenya</label>
                    <input class="form-control" type="password" placeholder="Password.." name="pass" id="pass">
                </div>


                <div>
                    <?=  session()->getFlashdata('error') ?>
                </div>


                <!--Començament de les variables-->
                <?php if ($role == 'Professor') : ?>
                    
                <?php endif; ?>

                <div class="col-12 bottom-center pe-0 ">
                    <button type="submit" class="btn btn-primary bold"><?= lang('ticketsLang.save') ?></button>
                    <a href="<?= base_url("/validateStudents") ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- <script>
    $(document).ready(function() {
        // s'inicialitza els select amb selectize
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>
<?php if (session()->get('role') == 'SSTT') : ?>
    <script>
        $(document).ready(function() {
            const selectGen = $('#center_g')[0].selectize;
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            name.disabled = false;
            email.disabled = false;
            selectGen.on('change', function(value) {
                console.log(value);
                if (value != '') {
                    console.log(value);
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                            const response = JSON.parse(xhttp.responseText);
                            console.log(response);
                            email.value = response.email;
                        } else {
                            console.log('error');
                        }
                    }
                    xhttp.open("GET", '/emailCenter/' + value);
                    xhttp.send();
                } else {
                    console.log('del');
                }
            });
        });
    </script>
<?php endif; ?> -->
<?php echo $this->endSection(); ?>