<?= $this->extend('layouts/default/default'); ?>
<?= $this->section("main_content"); ?>
<script>
  const dataSet = <?= json_encode($data) ?>;
  console.log(dataSet);
  const table = new DataTable('#tickets');
</script>
<table id="tickets" class="display" width="100%"></table>
<?= $this->endSection(); ?>