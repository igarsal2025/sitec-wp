# Guía de despliegue a producción (WordPress)

## 1) Infraestructura
- **PHP**: habilitar `gd` (requerido), `zip`, `intl`, `imagick`.
- **HTTPS**: cert SSL activo (Let’s Encrypt), redirecciones 80→443.
- **DB**: usuario/clave dedicados, backups automáticos.

## 1.1) Hosting compartido (HostGator) con SFTP
- Crea carpeta destino, por ejemplo: `/public_html/sitec/`.
- Apunta el dominio/subdominio a esa ruta, o usa la URL completa con subcarpeta.
- Sube un `.htaccess` según secciones más abajo (subcarpeta vs raíz).

## 1.2) Variables/secretos de entorno (usando `.env`)
- El proyecto soporta `.env` leído por `wp-config.php` (no se versiona).
- Ejemplo en `.env.example`. En producción, el CI genera `.env` con secretos.

## 2) Configuración WordPress
- Variables de entorno: `WP_HOME`, `WP_SITEURL`, `FORCE_SSL_ADMIN=1`, `DISABLE_WP_CRON=1`.
- `wp-config.php` ya contiene ajustes seguros (memoria, revisiones, cache opcional, file edit off).
- Guardar “Enlaces permanentes” tras mover el dominio.
### 2.1) Dominios
- Ajusta `WP_HOME` y `WP_SITEURL` al dominio real. Ej.:
  - `https://intigarciasalgado1760222330000.2190221.misitiohostgator.com/sitec`

### 2.2) Subcarpeta `/sitec/`
- Si WordPress vive en `/sitec/`, usa la variante de `.htaccess` con `RewriteBase /sitec/` y `RewriteRule . /sitec/index.php`.
  - Archivo de ejemplo: `.htaccess.production.sample`.

## 3) Contenido y menús
- Páginas legales creadas: `privacy-policy`, `terms`.
- Menús sincronizados automáticamente en admin (transient diario).

## 4) Rendimiento
- Instalar y configurar plugin de caché de página/objeto (según hosting).
- Opcional: CDN para assets.

## 5) Observabilidad
- Activar logs de errores en servidor (no en pantalla).
- Mantener el `scripts/site_smoke_tests.ps1` para verificaciones post-deploy.

## 6) Tareas
- Programar crawler semanal (o usar cron del host) y revisar `scripts/reports/`.
- Revisar “Salud del sitio” tras habilitar módulos PHP.

## 7) Seguridad

---

# Despliegue continuo por SFTP (GitHub Actions)

Archivo: `.github/workflows/deploy-hostgator.yml`

### Secretos requeridos (en el repositorio):
- `SFTP_HOST`, `SFTP_PORT`, `SFTP_USER`, `SFTP_PASSWORD`.
- `SFTP_DEST_PATH` (p. ej. `/home/usuario/public_html/sitec`).
- `DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST` (para generar `.env`).
- `WP_HOME`, `WP_SITEURL` (URL pública final; incluye `/sitec` si aplica).

### Exclusiones de sincronización
- No se sube `wp-content/uploads/` desde Git: se maneja en el servidor.
- Se excluyen `scripts/reports/`, `.git*`, `.github/`, archivos de infra (Dockerfile/render.yaml).

### Flujo
1. Push a rama `dev` ejecuta workflow.
2. Se genera `.env` con los secretos y se sube todo por SFTP.
3. En el primer deploy, entrar al admin y guardar “Enlaces permanentes”.

---

# Sincronización de contenidos (uploads y base de datos)

## Subir `uploads/`
- Opción A: subir manualmente por SFTP `wp-content/uploads/` al servidor.
- Opción B (recomendada): plugin de Offload/Storage externo (S3/Wasabi) y CDN.

## Base de datos
- Para clonar local → producción: exporta con `wp db export` o phpMyAdmin y
  restaura en el host. Después, realiza un search-replace de URLs:
  - Reemplaza `http://localhost/sitec` → `https://<tu-dominio>/sitec`.
- Plugins recomendados: WP Migrate, Duplicator o WP-CLI.

---

# Comprobaciones rápidas post-deploy
- Ejecuta `scripts/run_smoke.cmd` contra la URL pública (ajusta `-BaseUrl`).
- Revisa el reporte HTML dentro de `scripts/reports/<timestamp>/`.
- Rotar salts en producción.
- `DISALLOW_FILE_EDIT` activo.
- Usuarios con 2FA.





