<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #28a745; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .box { background: #d4edda; padding: 15px; border-left: 4px solid #28a745; margin: 15px 0; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>✅ Report Received</h2>
        </div>
        <div class="content">
            <p>Hello {{ $report->reporter->name }},</p>
            
            <div class="box">
                <p><strong>Thank you for reporting this post.</strong></p>
                <p>Your report has been submitted and will be reviewed by our team.</p>
            </div>
            
            <p><strong>Report details:</strong> {{ $report->message }}</p>
        </div>
        <div class="footer">
            <p>This is an automated message from {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>