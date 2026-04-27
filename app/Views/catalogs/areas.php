<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
  <h2>Catálogo de áreas</h2>
  <form method="post" action="/catalogs/areas/create" class="form-inline">
    <input type="text" name="name" placeholder="Nombre del área" required />
    <button class="button" type="submit">Agregar</button>
  </form>

  <ul class="list">
    <?php foreach ($areas as $area): ?>
      <li><?= esc($area['name']) ?></li>
    <?php endforeach; ?>
    <?php if (count($areas) === 0): ?>
      <li class="empty">Sin áreas registradas.</li>
    <?php endif; ?>
  </ul>
</section>
<?= $this->endSection() ?>
