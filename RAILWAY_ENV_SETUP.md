# 🚂 RAILWAY ENVIRONMENT VARIABLES SETUP

## ⚠️ IMPORTANT: Email Service Not Working!

Untuk mengaktifkan fitur **Forget Password** di Railway, Anda perlu menambahkan environment variables berikut:

---

## 📧 Step 1: Setup Gmail App Password

1. **Login ke Gmail** (adminsimpik@gmail.com)
2. **Aktifkan 2-Step Verification** (jika belum):
   - Buka: https://myaccount.google.com/security
   - Klik "2-Step Verification" → Follow steps

3. **Generate App Password**:
   - Buka: https://myaccount.google.com/apppasswords
   - Pilih app: "Mail"
   - Pilih device: "Other" → Ketik "Railway SIMPIK"
   - Klik "Generate"
   - **COPY 16-digit password** (contoh: `abcd efgh ijkl mnop`)

---

## 🚀 Step 2: Add to Railway

1. **Buka Railway Dashboard**: https://railway.app
2. **Pilih Project**: `simpik-app`
3. **Klik Tab**: "Variables"
4. **Add New Variables**:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=adminsimpik@gmail.com
MAIL_PASSWORD=<paste 16-digit app password here>
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=adminsimpik@gmail.com
MAIL_FROM_NAME=SIMPIK
```

**Contoh MAIL_PASSWORD:**
```
MAIL_PASSWORD=abcdefghijklmnop
```
(Hapus spasi dari 16-digit password)

5. **Klik "Add" untuk setiap variable**

---

## ✅ Step 3: Restart Railway Service

Setelah menambahkan semua variables:

1. **Klik Tab "Deployments"**
2. **Klik tombol "Restart"** atau tunggu auto-redeploy
3. **Tunggu deployment selesai** (~1-2 menit)

---

## 🧪 Step 4: Test Forget Password

1. Buka: https://simpik-app-production.up.railway.app/login
2. Klik "Lupa Password?"
3. Masukkan email yang terdaftar
4. Klik "Kirim Link Reset"
5. **Cek inbox email** (atau folder spam)
6. Klik link di email
7. Masukkan password baru
8. Login dengan password baru ✅

---

## 🐛 Troubleshooting

### Issue: "Layanan email belum dikonfigurasi"
**Solusi:** MAIL_USERNAME dan MAIL_PASSWORD belum diset di Railway Variables

### Issue: "Gagal mengirim email"
**Solusi:** 
1. Pastikan App Password benar (bukan password Gmail biasa)
2. Pastikan 2FA aktif di Gmail
3. Cek Railway logs: `railway logs`

### Issue: Email tidak masuk
**Solusi:**
1. Cek folder Spam
2. Tunggu 1-2 menit (kadang delay)
3. Cek Railway logs untuk error

---

## 📝 Notes:

- **App Password** berbeda dengan password Gmail biasa
- App Password hanya bisa digunakan untuk aplikasi (tidak bisa login ke Gmail)
- Jika lupa App Password, generate yang baru
- Setiap App Password bisa di-revoke kapan saja dari Google Account settings

---

**Created by:** Dian AI Assistant
**Date:** April 7, 2026
**For:** SIMPIK App Railway Deployment
