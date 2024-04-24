<?= $this->extend('layouts/mainLayout'); ?>
<?= $this->section("main_content"); ?>
<script>
  const dataSet = <?= json_encode($data) ?>;
  console.log(dataSet);
  $(document).ready(function () {
    $('#tickets').DataTable({
      data: dataSet,
      columns: [
        { name: 'Ticket ID', data: 'ticket_id' },
        { name: 'Data de creacio', data: 'created_at' },
      ]
    });
  });
</script>
<table id="tickets" class="display" width="100%">
  <thead>
    <tr>
      <th>Ticket ID</th>
      <th>Data de creacio</th>
    </tr>
  </thead>
</table>
<?= $this->endSection(); ?>