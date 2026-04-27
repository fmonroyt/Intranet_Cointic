# Intranet Cointic - Solicitud de Viáticos (CodeIgniter 4)

Aplicación intranet en PHP (CodeIgniter 4) para solicitudes de viáticos con autenticación de empleados, catálogos y flujo de autorizaciones.

## Requisitos

- PHP 8.1+
- Composer
- MySQL 8+

## Instalación

```bash
composer install
```

Copia y ajusta la configuración de entorno:

```bash
cp env .env
```

Edita `.env` y configura la base de datos y correo SMTP:

```ini
database.default.hostname = localhost
database.default.database = intranet_cointic
database.default.username = root
database.default.password =

database.default.DBDriver = MySQLi

email.protocol = smtp
email.SMTPHost = smtp.example.com
email.SMTPUser = usuario@example.com
email.SMTPPass = password
email.SMTPPort = 587
email.SMTPCrypto = tls
email.fromEmail = no-reply@cointic.local
email.fromName = "Intranet Cointic"
```

## Migraciones y datos iniciales

```bash
php spark migrate
php spark db:seed InitialSeeder
```

Esto crea:
- Catálogo inicial de áreas y tipos de gasto.
- Usuario administrador: `admin@cointic.local` / `Admin1234`.

## Ejecución local

```bash
php spark serve --host 0.0.0.0 --port 8080
```

## Flujo funcional

- Los empleados se autentican con correo y contraseña.
- El administrador registra empleados y el sistema genera la contraseña temporal, enviada por correo.
- Las solicitudes deben registrarse con 48 horas de anticipación.
- Para tipo de gasto **Soporte** o **Prospección** es obligatorio indicar proyecto.
- El administrador puede autorizar como jefe inmediato y contabilidad.

## Despliegue en hosting o VM

1. Instala PHP, Composer y MySQL.
2. Configura el virtual host apuntando el document root a `public/`.
3. Ejecuta `composer install` en el directorio del proyecto.
4. Ajusta `.env` con credenciales de base de datos y SMTP.
5. Ejecuta migraciones y seeder.
6. Verifica permisos de escritura en `writable/`.

> Nota: El envío de contraseñas requiere SMTP válido en producción.

## Despliegue en Apache / WAMP / XAMPP

### Apache (Linux/VM)

1. Copia el proyecto en `/var/www/intranet-cointic`.
2. Habilita `mod_rewrite` y el virtual host:

```bash
sudo a2enmod rewrite
sudo nano /etc/apache2/sites-available/intranet-cointic.conf
```

Ejemplo de VirtualHost:

```apache
<VirtualHost *:80>
    ServerName intranet-cointic.local
    DocumentRoot /var/www/intranet-cointic/public

    <Directory /var/www/intranet-cointic/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

3. Activa el sitio y reinicia:

```bash
sudo a2ensite intranet-cointic
sudo systemctl restart apache2
```

4. Configura `.env`, ejecuta migraciones y seeder:

```bash
php spark migrate
php spark db:seed InitialSeeder
```

### WAMP (Windows)

1. Copia el proyecto en `C:\wamp64\www\intranet-cointic`.
2. Asegúrate de que `mod_rewrite` esté habilitado en Apache.
3. Crea un virtual host apuntando a `C:\wamp64\www\intranet-cointic\public`.
4. Configura `.env` y ejecuta migraciones:

```bash
cd C:\wamp64\www\intranet-cointic
php spark migrate
php spark db:seed InitialSeeder
```

### XAMPP (Windows/Mac)

1. Copia el proyecto en `C:\xampp\htdocs\intranet-cointic` (o `/Applications/XAMPP/htdocs/` en Mac).
2. Habilita `mod_rewrite` en `httpd.conf`.
3. Crea un virtual host o accede vía `http://localhost/intranet-cointic/public`.
4. Configura `.env` y ejecuta migraciones:

```bash
cd C:\xampp\htdocs\intranet-cointic
php spark migrate
php spark db:seed InitialSeeder
```
