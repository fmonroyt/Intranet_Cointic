<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
  <h2>Catálogo de tipos de gasto</h2>
  <form method="post" action="/catalogs/expense-types/create" class="form-inline">
    <input type="text" name="name" placeholder="Tipo de gasto" required />
    <label class="checkbox">
      <input type="checkbox" name="requires_project" /> Requiere proyecto
    </label>
    <button class="button" type="submit">Agregar</button>
  </form>

  <ul class="list">
    <?php foreach ($expenseTypes as $expense): ?>
      <li>
        <?= esc($expense['name']) ?>
        <?php if ($expense['requires_project']): ?>
          <span class="tag">Proyecto obligatorio</span>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
    <?php if (count($expenseTypes) === 0): ?>
      <li class="empty">Sin tipos de gasto registrados.</li>
    <?php endif; ?>
  </ul>
</section>
<?= $this->endSection() ?>
