<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
  <h2>Nueva solicitud de recursos</h2>
  <form method="post" action="/requests/create" class="form-grid">
    <label>
      Tipo de gasto
      <select name="expense_type_id" required>
        <option value="">Selecciona una opción</option>
        <?php foreach ($expenseTypes as $item): ?>
          <option value="<?= esc($item['id']) ?>">
            <?= esc($item['name']) ?> <?= $item['requires_project'] ? '(requiere proyecto)' : '' ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>

    <label>
      Área/Departamento
      <input type="text" value="<?= esc($area['name'] ?? '') ?>" disabled />
      <small class="hint">Área asignada al empleado</small>
    </label>

    <label>
      ID de Excel
      <input type="text" name="excel_id" />
    </label>

    <label>
      Empleado
      <input type="text" value="<?= esc($employee['first_name'] . ' ' . $employee['last_name_paternal']) ?>" disabled />
    </label>

    <label>
      Fecha de solicitud
      <input type="date" name="request_date" required />
    </label>

    <label>
      Lugar de visita
      <input type="text" name="visit_place" required />
    </label>

    <label>
      Proyecto (soporte/prospección)
      <input type="text" name="project" />
    </label>

    <label>
      Fecha de salida
      <input type="date" name="start_date" required />
    </label>

    <label>
      Fecha de regreso
      <input type="date" name="end_date" required />
    </label>

    <label>
      Importe solicitado
      <input type="number" name="amount" step="0.01" min="0" required />
    </label>

    <label class="full">
      Resumen de gastos
      <textarea name="summary" required rows="4"></textarea>
    </label>

    <button class="button" type="submit">Guardar solicitud</button>
  </form>
</section>
<?= $this->endSection() ?>
