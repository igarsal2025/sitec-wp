# SITEC WordPress Theme & CI/CD

## Ramas y entornos
- dev: desarrollo
- staging: pruebas previas
- main: producción

## Workflows
- CI: .github/workflows/ci.yml (build Tailwind + lint PHP)
- Deploy: .github/workflows/deploy.yml (rsync por rama)

Configure en GitHub Secrets (repo):
- SITEC_dev_REMOTE_HOST, SITEC_dev_REMOTE_USER, SITEC_dev_REMOTE_PATH, SITEC_dev_SSH_KEY
- SITEC_staging_REMOTE_HOST, SITEC_staging_REMOTE_USER, SITEC_staging_REMOTE_PATH, SITEC_staging_SSH_KEY
- SITEC_prod_REMOTE_HOST, SITEC_prod_REMOTE_USER, SITEC_prod_REMOTE_PATH, SITEC_prod_SSH_KEY

## Setup local rápido
- Desde wp-content/themes/sitec:
  - npm install
  - npm run dev (o build)

## Notas
- .htaccess adaptado a subcarpeta /sitec/.
- Ajustes SITEC en Ajustes > Ajustes SITEC.
