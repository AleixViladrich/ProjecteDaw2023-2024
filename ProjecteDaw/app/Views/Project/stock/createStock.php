<?php
$this->extend('layouts/mainLayout');
echo $this->section("main_content");
?>

<div class="container-fluid mt-3">
    <div id="centres" class="border">

        <div>
            <h3 class="titleForm mt-0"><?= lang('stockLang.titleAdd') ?></h3>
        </div>

        <form action="<?php base_url("/addStock") ?>" method="POST" class="formAdd p-2 pb-0">

            <?= csrf_field() ?>

            <div class="row ">
                <div class="form-group col-6 my-4 ">
                    <label for="description" class=" bold fs-5"><?= lang('ticketsLang.description') ?></label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"><?= old('description') ?></textarea>
                </div>
                <div class="form-group col-6 my-4">
                    <label for="type_piece" class=" bold fs-5"><?= lang('stockLang.typePiece') ?></label>
                    <select class="form-control form-select" name="type_piece" id="type_piece">
                        <?php
                        echo "<option value='' default hidden>" . lang('stockLang.selectOption') . "</option>";
                        $valueN = 1;
                        foreach ($types as $value) {
                            if ($valueN == 1) {
                                echo "<option value='" . $valueN . "'>" . $value['name'] . " </option>";
                            } else {
                                echo "<option value='" . $valueN . "'>" . $value['name'] . " </option>";
                            }
                            $valueN++;
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-6 my-4 ">
<<<<<<< Updated upstream
                    <label for="price" class=" bold fs-5">Preu (unitari)</label>
                    <input type="number" class="form-control" name="price" onkeydown="checkValidationPrice(event)" id="price"></input>
                </div>
                <div class="form-group col-6 my-4 ">
                    <label for="number_units" class=" bold fs-5">Numero de unitats</label>
                    <input type="number" class="form-control" onkeydown="checkValidation(event)" name="number_units" id="number_units"></input>
                </div>
                <div class="col-6 mt-4 mb-5">
                    <label for="center" class=" bold fs-5"><?= lang('ticketsLang.issuing_center') ?></label>
                    <select name="center" id="center">
                        <?php
                        echo "<option value='' default hidden>Escull centre...</option>";
                        foreach ($center as $value) {
                            echo "<option value='" . $value['center_id'] . "'>" . $value['name'] . "</option>";
                        }
                        ?>
                    </select>
=======
                    <label for="price" class=" bold fs-5"><?= lang('stockLang.priceUnit') ?></label>
                    <input type="number" class="form-control" name="price" onkeydown="checkValidationPrice(event)" id="price" min="0" value="<?= old('price') ?>"></input>
                </div>
                <div class="form-group col-6 my-4 ">
                    <label for="number_units" class=" bold fs-5"><?= lang('stockLang.numberUnits') ?></label>
                    <input type="number" class="form-control" value="1" onkeydown="checkValidation(event)" name="number_units" id="number_units" min="1" <?= old('number_units') ?>></input>
>>>>>>> Stashed changes
                </div>
                <div>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <p style="color: red"><?= session()->getFlashdata('error') ?></p>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')) : ?>
                        <p style="color: grey"><?= session()->getFlashdata('success') ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-12 bottom-center pe-0 ">
                    <button type="submit" class="btn btn-primary bold"><?= lang('ticketsLang.save') ?></button>
                    <a href="<?= base_url("/viewStock") ?>" class="btn btn-light btn-block"><?= lang('ticketsLang.cancel') ?></a>
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


    function checkValidation(event) {
        //const unitNumber = document.getElementById('number_units');
        var key = event.key;
        const unitNumber = event.target.value;
        if (isNaN(key) && key != 'Backspace') {
            event.stopPropagation();
            event.preventDefault();
            return;
        }
        if (unitNumber.length === 0 && key === '0') {
            event.preventDefault(); // Evitar la inserción del 0 inicial
            return;
        }
    }

    function checkValidationPrice(event) {
        //const unitNumber = document.getElementById('number_units');
        var key = event.key;
        if (key == '-') {
            event.stopPropagation();
            event.preventDefault();
            return;
        }
    }
</script>
<?php echo $this->endSection(); ?>