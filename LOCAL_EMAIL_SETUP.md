# Setup Email di Local Development

## Konfigurasi Email untuk Testing Forgot Password

### 1. Edit file `.env` di local

Buka file `.env` di root project dan tambahkan/update konfigurasi email:

```env
# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=hadiannelvi82@gmail.com
MAIL_PASSWORD=beig sorf wjzt xlvd
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hadiannelvi82@gmail.com
MAIL_FROM_NAME="SIMPIK App"
```

### 2. Clear Config Cache (Penting!)

Setelah edit `.env`, jalankan command ini untuk reload konfigurasi:

```bash
php artisan config:clear
php artisan cache:clear
```

### 3. Test Forgot Password

1. Buka browser: `http://localhost:8000/login`
2. Klik "Lupa Password?"
3. Masukkan email user yang ada di database (contoh: `penitip1@gmail.com`)
4. Cek inbox email hadiannelvi82@gmail.com untuk link reset password

### 4. Troubleshooting

**Jika email tidak terkirim:**

1. Pastikan App Password benar:
   - Login Gmail hadiannelvi82@gmail.com
   - Buka https://myaccount.google.com/apppasswords
   - Generate App Password baru jika perlu

2. Cek Laravel logs:
   ```bash
   tail -f storage/logs/laravel.log
   ```

3. Pastikan tidak ada firewall/antivirus yang block port 587

**Jika error "MAIL_USERNAME not set":**
- Jalankan `php artisan config:clear` lagi
- Restart Laravel server (`Ctrl+C` lalu `php artisan serve` lagi)

### 5. Test di Railway

Setelah berhasil di local, push ke Railway:

```bash
git add -A
git commit -m "Test forgot password email working"
git push origin main
```

Pastikan environment variables di Railway sudah sama dengan local!

---

## Quick Reference

| Variable | Value |
|----------|-------|
| MAIL_MAILER | smtp |
| MAIL_HOST | smtp.gmail.com |
| MAIL_PORT | 587 |
| MAIL_USERNAME | hadiannelvi82@gmail.com |
| MAIL_PASSWORD | App Password (16 digits tanpa spasi) |
| MAIL_ENCRYPTION | tls |
| MAIL_FROM_ADDRESS | hadiannelvi82@gmail.com (HARUS SAMA dengan MAIL_USERNAME) |
| MAIL_FROM_NAME | SIMPIK App |
