<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #dc3545; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .box { background: #f8f9fa; padding: 15px; border-left: 4px solid #dc3545; margin: 15px 0; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🔔 New Report Submitted</h2>
        </div>
        <div class="content">
            <p><strong>From:</strong> {{ $report->reporter->name }} ({{ $report->reporter->email }})</p>
            <p><strong>Reported Post:</strong> {{ $report->feed->title }}</p>
            <p><strong>Reported User:</strong> {{ $report->reportedUser->name }}</p>
            
            <div class="box">
                <strong>Message:</strong>
                <p>{{ $report->message }}</p>
            </div>
            
            @if($report->screenshot)
                <p><strong>Screenshot:</strong> <a href="{{ asset('storage/'.$report->screenshot) }}">View Screenshot</a></p>
            @endif
        </div>
        <div class="footer">
            <p>This is an automated message from {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>