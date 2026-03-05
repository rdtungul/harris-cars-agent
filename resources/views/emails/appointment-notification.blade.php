<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Appointment Request</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f3f4f6; }
        .container { max-width: 600px; margin: 40px auto; background: white; border-radius: 8px; overflow: hidden; }
        .header { background: #DC2626; padding: 20px 30px; }
        .header h1 { color: white; margin: 0; font-size: 18px; font-weight: bold; }
        .body { padding: 30px; }
        .detail-row { display: flex; padding: 8px 0; border-bottom: 1px solid #F3F4F6; }
        .detail-label { color: #6B7280; font-size: 13px; width: 140px; flex-shrink: 0; }
        .detail-value { font-weight: 600; font-size: 13px; color: #111827; }
        .notes-box { background: #FFF7ED; border: 1px solid #FED7AA; border-radius: 6px; padding: 15px; margin-top: 20px; }
        .footer { background: #F9FAFB; padding: 20px 30px; font-size: 11px; color: #9CA3AF; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Appointment Request — Action Required</h1>
        </div>

        <div class="body">
            <p style="color:#374151; margin:0 0 20px;">A new appointment request has been submitted via the website. Please review and confirm within 1 business day.</p>

            <h3 style="margin:0 0 12px; font-size:13px; text-transform:uppercase; letter-spacing:1px; color:#374151;">Customer Information</h3>

            <div class="detail-row">
                <span class="detail-label">Confirmation #</span>
                <span class="detail-value" style="color:#DC2626;">{{ $appointment->confirmation_number }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Name</span>
                <span class="detail-value">{{ $appointment->customer_name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email</span>
                <span class="detail-value">{{ $appointment->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Phone</span>
                <span class="detail-value">{{ $appointment->phone }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Service</span>
                <span class="detail-value">{{ $appointment->service?->title ?? 'General Service' }}</span>
            </div>
            @if($appointment->vehicle_full_name)
            <div class="detail-row">
                <span class="detail-label">Vehicle</span>
                <span class="detail-value">{{ $appointment->vehicle_full_name }}</span>
            </div>
            @endif
            @if($appointment->vehicle_mileage)
            <div class="detail-row">
                <span class="detail-label">Mileage</span>
                <span class="detail-value">{{ $appointment->vehicle_mileage }}</span>
            </div>
            @endif
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
            <div class="detail-row">
                <span class="detail-label">Submitted</span>
                <span class="detail-value">{{ $appointment->created_at->format('M j, Y \a\t g:i A') }}</span>
            </div>

            @if($appointment->notes)
            <div class="notes-box">
                <p style="margin:0 0 8px; font-weight:bold; font-size:13px; color:#92400E;">Customer Notes:</p>
                <p style="margin:0; font-size:13px; color:#78350F; line-height:1.6;">{{ $appointment->notes }}</p>
            </div>
            @endif

            <div style="margin-top:25px; padding-top:20px; border-top:1px solid #E5E7EB;">
                <a href="{{ route('admin.appointments.show', $appointment) }}"
                   style="display:inline-block; background:#0F172A; color:white; text-decoration:none; padding:12px 25px; border-radius:4px; font-weight:bold; font-size:13px;">
                    View in Admin Panel
                </a>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated notification from Harris Cars Service Center admin system.</p>
        </div>
    </div>
</body>
</html>
