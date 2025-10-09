# Guía de despliegue a producción (WordPress)

## 1) Infraestructura
- **PHP**: habilitar `gd` (requerido), `zip`, `intl`, `imagick`.
- **HTTPS**: cert SSL activo (Let’s Encrypt), redirecciones 80→443.
- **DB**: usuario/clave dedicados, backups automáticos.

## 2) Configuración WordPress
- Variables de entorno: `WP_HOME`, `WP_SITEURL`, `FORCE_SSL_ADMIN=1`, `DISABLE_WP_CRON=1`.
- `wp-config.php` ya contiene ajustes seguros (memoria, revisiones, cache opcional, file edit off).
- Guardar “Enlaces permanentes” tras mover el dominio.

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
- Rotar salts en producción.
- `DISALLOW_FILE_EDIT` activo.
- Usuarios con 2FA.

