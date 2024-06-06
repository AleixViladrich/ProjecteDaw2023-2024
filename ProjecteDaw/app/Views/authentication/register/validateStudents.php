<style>
  #header {
    height: 110px;
    /* width:  100vw; */
  }
</style>

<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>


<?php if ($add) : ?>
  <script>
    addEventListener("DOMContentLoaded", (event) => {
      let btn = document.createElement('a');
      btn.href = "<?= base_url('/addStudent') ?>";
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

  <!-- <div class="col-6">
    <form action="<? base_url("/validateStudents") ?>" method="post" class="formAdd">
      <? csrf_field(); ?>
      <div class="form-group my-4 ">
        <label for="mail"></label>
        <input class="form-control" type="text" placeholder="email.." name="mail" id="mail">
      </div>
      <div>
        <? session()->getFlashdata('error') ?>
      </div>
      <div class="bottom-center pe-0 ">
        <input type="submit" class="btn btn-primary m-2">
      </div>
    
  </form>
</div>
</div> -->
<?= $this->endSection(); ?>