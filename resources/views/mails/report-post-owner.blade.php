<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #ffc107; color: #333; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .box { background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 15px 0; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📢 Your Post Has Been Reported</h2>
        </div>
        <div class="content">
            <p>Hello {{ $report->reportedUser->name }},</p>
            
            <div class="box">
                <p><strong>Your post "{{ $report->feed->title }}" has been reported for:</strong></p>
                <p>{{ $report->message }}</p>
            </div>
            
            <p>Our team will review this report. If you have questions, please contact support.</p>
        </div>
        <div class="footer">
            <p>This is an automated message from {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>