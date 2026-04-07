# 📧 EMAIL SERVICE SETUP - GMAIL SMTP

## Steps to Enable Email Service:

### 1. Update .env File (Local)

Open `.env` file di root project dan update konfigurasi mail:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=adminsimpik@gmail.com
MAIL_PASSWORD=AdminSimpik010603
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=adminsimpik@gmail.com
MAIL_FROM_NAME="SIMPIK App"
```

**IMPORTANT:** Jika menggunakan Gmail dengan 2FA enabled, Anda perlu:
1. Buka: https://myaccount.google.com/apppasswords
2. Generate "App Password" untuk aplikasi
3. Gunakan App Password tersebut di `MAIL_PASSWORD` (bukan password Gmail biasa)

### 2. Update Railway Environment Variables

Buka Railway Dashboard → Project `simpik-app` → Variables:

Add the following variables:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=adminsimpik@gmail.com
MAIL_PASSWORD=AdminSimpik010603
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=adminsimpik@gmail.com
MAIL_FROM_NAME=SIMPIK App
```

### 3. Test Email Locally

```bash
php artisan tinker
```

Then run:
```php
Mail::to('test@example.com')->send(new App\Mail\ResetPasswordMail('http://test.com/reset', 'Test User'));
```

### 4. Clear Config Cache (Local & Railway)

Local:
```bash
php artisan config:clear
```

Railway (via CLI):
```bash
railway run php artisan config:clear
```

---

## ✅ Features Implemented:

1. **Beautiful Email Template**
   - Responsive design
   - Purple theme (#9B8CFF)
   - 24-hour expiry notice
   - Fallback link if button doesn't work

2. **Secure Token System**
   - Random 60-character token
   - Hashed in database
   - 24-hour expiry
   - Auto-delete after use

3. **Error Handling**
   - Email send failure fallback
   - Shows reset link if email fails
   - User-friendly error messages

---

## 📬 How It Works:

1. User clicks **"Lupa Password?"** on login page
2. User enters email → Submit
3. System:
   - Validates email exists
   - Generates secure token
   - Sends beautiful email with reset link
4. User clicks link in email
5. User enters new password
6. Password updated ✅

---

## 🔐 Gmail Security Notes:

- Gmail may block "less secure apps" by default
- If email not received:
  1. Check "Less secure app access" is enabled
  2. OR use App Password (recommended)
  3. Check spam folder
  
- For production, consider:
  - SendGrid (free tier 100 emails/day)
  - Mailgun (free tier 5000 emails/month)
  - Amazon SES (very cheap)

---

## 📧 Email Preview:

**Subject:** Reset Password - SIMPIK

**Body:**
```
🔐 Reset Password

Halo [User Name],

Kami menerima permintaan untuk reset password akun SIMPIK Anda.

Klik tombol di bawah ini untuk membuat password baru:

[Reset Password Button]

⏰ Link ini berlaku selama 24 jam
Setelah 24 jam, link akan expired dan Anda perlu request reset password lagi.

---
Email ini dikirim secara otomatis, mohon tidak membalas email ini.
© 2026 SIMPIK. All rights reserved.
```

---

## ✅ Testing Checklist:

- [ ] Update .env local dengan SMTP credentials
- [ ] Test kirim email dari localhost
- [ ] Update Railway environment variables
- [ ] Clear config cache di Railway
- [ ] Test forgot password flow end-to-end
- [ ] Check email received in inbox/spam
- [ ] Test reset password dengan link dari email
- [ ] Verify password berhasil diupdate

---

**Note:** Code sudah ready! Tinggal setup .env variables aja. 🚀
