<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SIMPIK</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #9B8CFF 0%, #B9B4FF 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 40px 30px;
        }
        .email-body p {
            margin: 0 0 20px 0;
            color: #555;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .reset-button {
            display: inline-block;
            padding: 15px 40px;
            background: #9B8CFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .reset-button:hover {
            background: #8B7CFF;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #9B8CFF;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 0;
            font-size: 14px;
        }
        .email-footer {
            background: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .link-text {
            word-break: break-all;
            background: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
            font-size: 12px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        
        <!-- Header -->
        <div class="email-header">
            <h1>🔐 Reset Password</h1>
        </div>
        
        <!-- Body -->
        <div class="email-body">
            <p>Halo{{ $userName ? ' ' . $userName : '' }},</p>
            
            <p>Kami menerima permintaan untuk reset password akun SIMPIK Anda.</p>
            
            <p>Klik tombol di bawah ini untuk membuat password baru:</p>
            
            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button">Reset Password</a>
            </div>
            
            <div class="info-box">
                <p><strong>⏰ Link ini berlaku selama 24 jam</strong></p>
                <p>Setelah 24 jam, link akan expired dan Anda perlu request reset password lagi.</p>
            </div>
            
            <p>Jika tombol tidak berfungsi, copy dan paste link berikut ke browser Anda:</p>
            <div class="link-text">
                {{ $resetUrl }}
            </div>
            
            <p>Jika Anda tidak melakukan permintaan reset password, abaikan email ini. Password Anda tidak akan berubah.</p>
            
            <p>Terima kasih,<br>
            <strong>Tim SIMPIK</strong></p>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} SIMPIK. All rights reserved.</p>
        </div>
        
    </div>
</body>
</html>
