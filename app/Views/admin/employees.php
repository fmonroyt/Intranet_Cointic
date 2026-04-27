<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
  <h2>Catálogo de empleados</h2>
  <form method="post" action="/admin/employees/create" class="form-grid">
    <label>
      Nombre
      <input type="text" name="first_name" required />
    </label>
    <label>
      Apellido paterno
      <input type="text" name="last_name_paternal" required />
    </label>
    <label>
      Apellido materno
      <input type="text" name="last_name_maternal" required />
    </label>
    <label>
      Puesto
      <input type="text" name="position" required />
    </label>
    <label>
      Área
      <select name="area_id" required>
        <option value="">Selecciona un área</option>
        <?php foreach ($areas as $area): ?>
          <option value="<?= esc($area['id']) ?>"><?= esc($area['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>
      Correo electrónico
      <input type="email" name="email" required />
    </label>
    <label>
      Teléfono
      <input type="text" name="phone" required />
    </label>
    <label class="full">
      Domicilio
      <textarea name="address" rows="2" required></textarea>
    </label>
    <button class="button" type="submit">Registrar empleado</button>
  </form>

  <ul class="list">
    <?php foreach ($employees as $employee): ?>
      <li>
        <strong><?= esc($employee['first_name'] . ' ' . $employee['last_name_paternal']) ?></strong>
        <span><?= esc($employee['email']) ?></span>
      </li>
    <?php endforeach; ?>
    <?php if (count($employees) === 0): ?>
      <li class="empty">Sin empleados registrados.</li>
    <?php endif; ?>
  </ul>
</section>
<?= $this->endSection() ?>
