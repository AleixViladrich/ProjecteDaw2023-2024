<?php
$this->extend('layouts/mainLayout');
echo $this->section("main_content");
?>
<div class="container-fluid mt-3">
    <div id="centres" class="border">

        <div>
            <h3 class="titleForm mt-0"><?= lang('stockLang.titleUpdate') ?></h3>
        </div>

        <form action="<?php base_url("/updateStock/" . $stock["stock_id"]) ?>" method="POST" class="formAdd p-2 pb-0">
            <?= csrf_field() ?>
            <div class="row">
                <div class="form-group col-6 my-4 ">
                    <label for="price" class=" bold fs-5"><?= lang('stockLang.price') ?></label>
                    <input type="number" class="form-control" name="price" onkeydown="checkValidationPrice(event)" value="<?= $stock['price'] ?>" id="price"></input>
                </div>
                <div class="form-group col-6 my-4">
                    <label for="type_piece" class="bold fs-5"><?= lang('stockLang.typePiece') ?></label>
                    <select class="form-control form-select" name="type_piece" id="type_piece">
                        <?php
                        echo "<option value='' default hidden>" . lang('stockLang.selectOption') . "</option>";
                        $valueN = 1;
                        foreach ($types as $value) {
                            echo "<option value='" . $valueN . "'>" . $value['name'] . " </option>";
                            $valueN++;
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-12 my-4 ">
                    <label for="description" class=" bold fs-5"><?= lang('ticketsLang.description') ?></label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="3"><?= $stock['description'] ?></textarea>
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
        var stock = <?php echo json_encode($stock['stock_type_id']); ?>;
        var enabled = <?php echo json_encode(session()->getFlashdata("enabled")); ?>;
        //selects
        console.log(enabled);
        const piece = $('#type_piece')[0].selectize;
        const description = document.getElementById('description');
        //defaults
        piece.setValue(stock);
        //enabled
        if (enabled == "true") {
            piece.disable();
            description.disabled = true;
        }
    });

    function checkValidation(event) {
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
<?php echo $this->endSection() ?>