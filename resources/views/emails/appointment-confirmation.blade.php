<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Received</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f3f4f6; }
        .container { max-width: 600px; margin: 40px auto; background: white; border-radius: 8px; overflow: hidden; }
        .header { background: #0F172A; padding: 30px; text-align: center; }
        .header-title { color: white; font-size: 24px; font-weight: bold; letter-spacing: 3px; margin: 0; }
        .header-sub { color: #9CA3AF; font-size: 12px; margin: 5px 0 0; }
        .body { padding: 40px; }
        .confirmation-box { background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 8px; padding: 20px; margin-bottom: 30px; text-align: center; }
        .confirmation-number { font-size: 28px; font-weight: bold; color: #DC2626; letter-spacing: 4px; }
        .detail-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #F3F4F6; }
        .detail-label { color: #6B7280; font-size: 13px; }
        .detail-value { font-weight: 600; font-size: 13px; color: #111827; }
        .cta-button { display: block; background: #DC2626; color: white; text-decoration: none; padding: 14px 30px; border-radius: 4px; text-align: center; font-weight: bold; margin: 30px 0; }
        .footer { background: #F9FAFB; padding: 20px 40px; text-align: center; font-size: 11px; color: #9CA3AF; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <p class="header-title">HARRIS CARS SERVICE CENTER</p>
            <p class="header-sub">2023 Richard Baker Dr, Stallings, NC 28104 &nbsp;|&nbsp; (704) 234-8351</p>
        </div>

        <div class="body">
            <h2 style="margin:0 0 10px; color:#111827;">Appointment Request Received!</h2>
            <p style="color:#6B7280; margin:0 0 25px;">Hi {{ $appointment->customer_name }}, thank you for contacting Harris Cars Service Center. We have received your appointment request and will confirm within 1 business day.</p>

            <div class="confirmation-box">
                <p style="margin:0 0 5px; font-size:12px; color:#6B7280;">YOUR CONFIRMATION NUMBER</p>
                <p class="confirmation-number">{{ $appointment->confirmation_number }}</p>
                <p style="margin:8px 0 0; font-size:11px; color:#6B7280;">Save this number for your records</p>
            </div>

            <h3 style="margin:0 0 15px; color:#111827; font-size:14px; text-transform:uppercase; letter-spacing:1px;">Appointment Details</h3>

            <div class="detail-row">
                <span class="detail-label">Service Requested</span>
                <span class="detail-value">{{ $appointment->service?->title ?? 'General Service' }}</span>
            </div>
            @if($appointment->preferred_date)
            <div class="detail-row">
                <span class="detail-label">Preferred Date</span>
                <span class="detail-value">{{ $appointment->preferred_date->format('l, F j, Y') }}</span>
            </div>
            @endif
            @if($appointment->preferred_time)
            <div class="detail-row">
                <span class="detail-label">Preferred Time</span>
                <span class="detail-value">{{ $appointment->preferred_time }}</span>
            </div>
            @endif
            @if($appointment->vehicle_full_name)
            <div class="detail-row">
                <span class="detail-label">Vehicle</span>
                <span class="detail-value">{{ $appointment->vehicle_full_name }}</span>
            </div>
            @endif

            <p style="margin:25px 0 10px; color:#6B7280; font-size:13px;">Have questions? Call us or reply to this email and we will get back to you promptly.</p>

            <a href="tel:7042348351" class="cta-button">CALL (704) 234-8351</a>

            <p style="color:#6B7280; font-size:12px; margin:0;">We look forward to serving you!</p>
        </div>

        <div class="footer">
            <p>Harris Cars Service Center &nbsp;&bull;&nbsp; 2023 Richard Baker Dr, Stallings, NC 28104<br>
            Mon–Fri: 8:00 AM – 5:00 PM &nbsp;&bull;&nbsp; (704) 234-8351</p>
        </div>
    </div>
</body>
</html>
