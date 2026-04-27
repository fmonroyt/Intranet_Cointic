<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel auth">
  <h2>Ingreso a la intranet</h2>
  <form method="post" action="/login" class="form-grid">
    <label>
      Correo electrónico
      <input type="email" name="email" required />
    </label>
    <label>
      Contraseña
      <input type="password" name="password" required />
    </label>
    <button class="button" type="submit">Ingresar</button>
  </form>
</section>
<?= $this->endSection() ?>
