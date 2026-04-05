# Railway Deployment Guide

## Environment Variables Required

Add these in Railway dashboard:

```
APP_KEY=                  # Will be auto-generated
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app

# Database (Railway PostgreSQL auto-fills these)
DB_CONNECTION=pgsql
DB_HOST=${{PGHOST}}
DB_PORT=${{PGPORT}}
DB_DATABASE=${{PGDATABASE}}
DB_USERNAME=${{PGUSER}}
DB_PASSWORD=${{PGPASSWORD}}
```

## Setup Steps

1. **Connect PostgreSQL**
   - Add PostgreSQL plugin in Railway
   - Railway will auto-set `PGHOST`, `PGPORT`, etc.

2. **Deploy**
   - Push to GitHub
   - Connect repo to Railway
   - Railway will auto-detect Laravel and build

3. **Post-Deploy**
   - Check logs for migration status
   - Visit your Railway URL

## Files Created for Railway

- `nixpacks.toml` - Build configuration (PHP 8.2, extensions)
- `Procfile` - Start command
- `railway-deploy.sh` - Post-deployment tasks
- `.env.example` - Example environment variables
