<h2>Bienvenido a la intranet de viáticos</h2>
<p>Hola <?= esc($employee['first_name']) ?>,</p>
<p>Tu cuenta ha sido creada. Puedes ingresar con las siguientes credenciales:</p>
<ul>
  <li><strong>Correo:</strong> <?= esc($employee['email']) ?></li>
  <li><strong>Contraseña temporal:</strong> <?= esc($password) ?></li>
</ul>
<p>Por seguridad, cambia tu contraseña en el primer ingreso.</p>
