import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
import sys

print("Python dijalankan.")

# Buat log awal
with open("C:/Users/Pongo/Herd/ALP_BARU_revisisiii/public/python/log.txt", "a", encoding="utf-8") as log:
    log.write("Script started...\n")

try:
    from_email = "keycrate04@gmail.com"
    app_password = "tziqfvhmaoywyjxj"
    to_email = sys.argv[1]
    otp_code = sys.argv[2]

    subject = "Kode OTP Kamu dari KeyCrate"
    
    # Format HTML pesan email (gaming style)
    html_message = f"""
    <html>
        <body style="margin:0; padding:0; background-color:#1a1a1a;">
            <div style="max-width:600px; margin:auto; background-color:#2b2b2b; border-radius:10px; padding:30px; font-family:'Segoe UI', sans-serif; color:#f9f9f9; box-shadow: 0 0 20px rgba(255,215,0,0.1);">
                <div style="text-align:center;">
                    <h2 style="color:#FFD700;">KEYCRATE SECURE ACCESS</h2>
                </div>
                <p style="font-size:15px; color:#ccc; text-align:center;">
                    Gunakan <strong>kode OTP</strong> berikut untuk melanjutkan proses verifikasi Anda.
                </p>
                <div style="margin: 30px auto; text-align: center;">
                    <span style="background-color:#111; border:2px dashed #FFD700; padding:18px 40px; border-radius:8px; font-size:30px; letter-spacing:8px; color:#FFD700;">
                        {otp_code}
                    </span>
                </div>
                <p style="color:#888; font-size:13px;">
                    ⚠️ Kode hanya berlaku sementara dan <strong>jangan dibagikan</strong> kepada siapapun.
                </p>
                <hr style="border:none; border-top:1px solid #444; margin:30px 0;">
                <p style="text-align:right; color:#666; font-size:13px;">
                    — KeyCrate Security System
                </p>
            </div>
        </body>
    </html>
    """

    msg = MIMEMultipart("alternative")
    msg['From'] = from_email
    msg['To'] = to_email
    msg['Subject'] = subject

    part_html = MIMEText(html_message, 'html')
    msg.attach(part_html)

    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.starttls()
    server.login(from_email, app_password)
    server.send_message(msg)
    server.quit()

    with open("C:/Users/Pongo/Herd/ALP_BARU_revisisiii/public/python/log.txt", "a", encoding="utf-8") as log:
        log.write("Email terkirim ke " + to_email + "\n")

    print("Email terkirim")

except Exception as e:
    with open("C:/Users/Pongo/Herd/ALP_BARU_revisisiii/public/python/log.txt", "a", encoding="utf-8") as log:
        log.write("Gagal kirim email: " + str(e) + "\n")
    print("Gagal:", e)
