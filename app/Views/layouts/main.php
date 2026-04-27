<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= esc($title ?? 'Intranet Cointic') ?></title>
    <link rel="stylesheet" href="/assets/styles.css" />
  </head>
  <body>
    <header class="app-header">
      <div class="brand">
        <div class="logo">COINTIC</div>
        <div>
          <h1>Solicitud de Recursos</h1>
          <p>Intranet de viáticos y autorizaciones</p>
        </div>
      </div>
      <?php if (session('employee_id')): ?>
        <nav>
          <a href="/requests">Solicitudes</a>
          <a href="/requests/new">Nueva solicitud</a>
          <?php if (session('role') === 'admin'): ?>
            <a href="/admin/employees">Empleados</a>
            <a href="/catalogs/areas">Áreas</a>
            <a href="/catalogs/expense-types">Tipos de gasto</a>
          <?php endif; ?>
          <a href="/logout">Salir</a>
        </nav>
      <?php endif; ?>
    </header>

    <main>
      <?php if (session('success')): ?>
        <div class="alert success"><?= esc(session('success')) ?></div>
      <?php endif; ?>
      <?php if (session('error')): ?>
        <div class="alert error"><?= esc(session('error')) ?></div>
      <?php endif; ?>

      <?= $this->renderSection('content') ?>
    </main>
  </body>
</html>
