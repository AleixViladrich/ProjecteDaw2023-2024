<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>
<script>
  import DataTable from 'datatables.net-dt';
  const dataSet = <?= json_encode($data) ?>;
  console.log(dataSet);
  const table = new DataTable('#tickets', {
    columns: [
      { title: 'Ticket_ID' },
      { title: 'device_type_id' }
    ],
    data: dataSet
  });
</script>
<table id="tickets" class="display" width="100%"></table>
<?= $this->endSection(); ?>