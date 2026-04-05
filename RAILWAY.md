# Railway Deployment Guide

## Environment Variables Required

Add these in Railway dashboard (Variables tab):

### Required:
```
APP_KEY=base64:9/NUp63nu7wYFM+uNBHHicSy2fLUa/WaWCZUUDTtKZY=
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app
```

### Database (Auto-filled by Railway PostgreSQL plugin):
```
DB_CONNECTION=pgsql
DB_HOST=${{PGHOST}}
DB_PORT=${{PGPORT}}
DB_DATABASE=${{PGDATABASE}}
DB_USERNAME=${{PGUSER}}
DB_PASSWORD=${{PGPASSWORD}}
```

## Setup Steps

### 1. Create New Project in Railway
- Go to railway.app
- Click "New Project"
- Choose "Deploy from GitHub repo"
- Select your `simpik-app` repository

### 2. Add PostgreSQL Database
- In your project, click "New"
- Select "Database" → "Add PostgreSQL"
- Railway will automatically create and link the database
- Database variables (PGHOST, PGPORT, etc.) will be auto-injected

### 3. Add Environment Variables
- Go to your service → "Variables" tab
- Add the required variables above (APP_KEY, APP_ENV, APP_DEBUG, APP_URL)
- **IMPORTANT:** Copy the APP_KEY exactly as shown above

### 4. Deploy
- Push your code to GitHub main branch
- Railway will automatically detect changes and deploy
- First deployment will run migrations automatically

### 5. Get Your App URL
- Go to "Settings" tab
- Click "Generate Domain"
- Copy the domain (e.g., `simpik-app-production.up.railway.app`)
- Update `APP_URL` variable with this domain

## Deployment Files

- ✅ `nixpacks.toml` - Build configuration (PHP 8.2, extensions)
- ✅ `Procfile` - Start command
- ✅ `start.sh` - Startup script (auto-generate APP_KEY if missing)
- ✅ `railway-deploy.sh` - Migration script (runs at build time)
- ✅ `.env.example` - Example environment variables

## Troubleshooting

### Error: "No application encryption key"
1. Make sure `APP_KEY` is set in Railway Variables
2. Format must be: `base64:xxxxxxxxxxxxx`
3. Redeploy after adding the variable

### Error: "Route cache serialization"
Fixed! Duplicate routes removed from web.php

### Error: "Database connection failed"
1. Check PostgreSQL plugin is added
2. Verify DB variables are auto-set by Railway
3. Check if migrations ran successfully in deployment logs

## First Time Access

After successful deployment:
1. Visit your Railway URL
2. Go to `/register` to create first account
3. Login and use the app!

**Default test accounts (if you imported seed data):**
- Penjual: `hadian@gmail.com` / `dian`
- Penitip: `penitip.hadian@gmail.com` / `hadian`
