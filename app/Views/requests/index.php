<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
  <div class="panel-header">
    <h2>Solicitudes registradas</h2>
    <a class="button" href="/requests/new">Registrar solicitud</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>Empleado</th>
        <th>Área</th>
        <th>Tipo de gasto</th>
        <th>Proyecto</th>
        <th>Fecha solicitud</th>
        <th>Salida</th>
        <th>Importe</th>
        <th>Autorizaciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($requests as $item): ?>
      <tr>
        <td><?= esc($item['first_name'] . ' ' . $item['last_name_paternal']) ?></td>
        <td><?= esc($item['area_name']) ?></td>
        <td><?= esc($item['expense_name']) ?></td>
        <td><?= esc($item['project'] ?? '-') ?></td>
        <td><?= esc(date('d/m/Y', strtotime($item['request_date']))) ?></td>
        <td><?= esc(date('d/m/Y', strtotime($item['start_date']))) ?> - <?= esc(date('d/m/Y', strtotime($item['end_date']))) ?></td>
        <td>$<?= esc(number_format((float) $item['amount'], 2)) ?></td>
        <td>
          <?php if ($isAdmin): ?>
            <div class="approval">
              <form method="post" action="/requests/<?= esc($item['id']) ?>/approve">
                <input type="hidden" name="approval_type" value="manager" />
                <button class="small" type="submit" <?= $item['approved_manager'] ? 'disabled' : '' ?>>
                  <?= $item['approved_manager'] ? 'Jefe autorizado' : 'Jefe inmediato' ?>
                </button>
              </form>
              <form method="post" action="/requests/<?= esc($item['id']) ?>/approve">
                <input type="hidden" name="approval_type" value="accounting" />
                <button class="small" type="submit" <?= $item['approved_accounting'] ? 'disabled' : '' ?>>
                  <?= $item['approved_accounting'] ? 'Contabilidad autorizada' : 'Contabilidad' ?>
                </button>
              </form>
            </div>
          <?php else: ?>
            <div class="status">
              <span><?= $item['approved_manager'] ? 'Jefe autorizado' : 'Pendiente jefe' ?></span>
              <span><?= $item['approved_accounting'] ? 'Contabilidad autorizada' : 'Pendiente contabilidad' ?></span>
            </div>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (count($requests) === 0): ?>
      <tr>
        <td colspan="8" class="empty">Aún no hay solicitudes registradas.</td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>
<?= $this->endSection() ?>
